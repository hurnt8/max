<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancingRequestHistory extends Model
{
    protected $fillable = ['financing_request_id', 'admin_id', 'action', 'old_value', 'new_value'];

    protected $casts = ['old_value' => 'array', 'new_value' => 'array'];

    public function financingRequest()
    {
        return $this->belongsTo(FinancingRequest::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
