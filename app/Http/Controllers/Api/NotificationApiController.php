<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    // GET /api/notifications
    public function index(Request $request): JsonResponse
    {
        $user          = $request->user();
        $notifications = ClientNotification::where('user_id', $user->id)
            ->latest()->limit(50)->get()
            ->map(fn ($n) => [
                'id'         => $n->id,
                'type'       => $n->type,
                'title'      => $n->title,
                'body'       => $n->body,
                'url'        => $n->data['url'] ?? null,
                'read'       => !is_null($n->read_at),
                'created_at' => $n->created_at?->toISOString(),
            ]);

        $unread = $notifications->where('read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unread,
        ]);
    }

    // POST /api/notifications/read-all
    public function readAll(Request $request): JsonResponse
    {
        $user = $request->user();
        ClientNotification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'Toutes les notifications marquées comme lues.']);
    }

    // POST /api/notifications/{id}/read
    public function read(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        ClientNotification::where('id', $id)
            ->where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['ok' => true]);
    }

    // GET /api/notifications/count
    public function count(Request $request): JsonResponse
    {
        $user  = $request->user();
        $count = ClientNotification::where('user_id', $user->id)->whereNull('read_at')->count();

        return response()->json(['count' => $count]);
    }
}
