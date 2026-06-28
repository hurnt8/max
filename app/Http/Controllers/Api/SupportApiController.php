<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminSupportMail;
use App\Models\AdminNotification;
use App\Models\SupportMessage;
use App\Models\User;
use App\Services\SupportAiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SupportApiController extends Controller
{
    public function __construct(private SupportAiService $ai) {}

    // GET /api/support/messages?after=0
    public function index(Request $request): JsonResponse
    {
        $user  = $request->user();
        $after = (int) $request->query('after', 0);

        $messages = SupportMessage::where('client_id', $user->id)
            ->when($after > 0, fn ($q) => $q->where('id', '>', $after))
            ->oldest()->get();

        SupportMessage::where('client_id', $user->id)
            ->where('sender_type', 'admin')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'messages' => $messages->map(fn ($m) => $m->toChat()),
            'last_id'  => $messages->last()?->id ?? $after,
        ]);
    }

    // POST /api/support/messages
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'body' => 'nullable|string|max:2000',
            'file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp|max:10240',
        ]);

        if (!$request->filled('body') && !$request->hasFile('file')) {
            return response()->json(['message' => __('api.support.empty_message')], 422);
        }

        $user     = $request->user();
        $filePath = null;
        $fileType = null;

        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $mime     = $file->getMimeType();
            $fileType = str_starts_with($mime, 'image/') ? 'image' : 'audio';
            $filePath = $file->store("support/{$user->id}", 'public');
        }

        $msg = SupportMessage::create([
            'client_id'   => $user->id,
            'sender_type' => 'client',
            'body'        => $request->body,
            'file_path'   => $filePath,
            'file_type'   => $fileType,
        ]);

        $this->notifyAdmin($user, $msg);

        $aiMessage = null;
        if ($request->filled('body')) {
            try {
                $history = SupportMessage::where('client_id', $user->id)->where('id', '<', $msg->id)->oldest()->get();
                $aiReply = $this->ai->generateReply($user, $history);
                if ($aiReply) {
                    $aiMsg     = SupportMessage::create([
                        'client_id'   => $user->id,
                        'sender_type' => 'admin',
                        'is_bot'      => true,
                        'body'        => $aiReply,
                    ]);
                    $aiMessage = $aiMsg->toChat();
                }
            } catch (\Throwable) {}
        }

        return response()->json([
            'message'    => $msg->toChat(),
            'ai_message' => $aiMessage,
        ], 201);
    }

    private function notifyAdmin(User $client, SupportMessage $msg): void
    {
        $adminIds = User::role(['admin', 'super-admin'])->pluck('id');
        $preview  = $msg->body ? Str::limit($msg->body, 80) : ($msg->file_type === 'image' ? '📷 Image' : '🎤 Audio');

        foreach ($adminIds as $adminId) {
            try {
                AdminNotification::forAdmin($adminId, 'support', 'Message de ' . $client->name, $preview, ['client_id' => $client->id]);
                $admin = User::find($adminId);
                if ($admin) Mail::to($admin->email)->send(new AdminSupportMail($client, $msg));
            } catch (\Throwable) {}
        }
    }
}
