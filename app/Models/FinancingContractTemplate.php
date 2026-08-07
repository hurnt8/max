<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingContractTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'content', 'is_default', 'created_by',
        'template_type', 'locale',
        'watermark_path', 'logo_left_path', 'logo_right_path',
        'stamp_path', 'signature_admin_path', 'signature_agent_path',
        'docx_template_path', 'docx_version', 'docx_detected_vars',
    ];

    protected $casts = [
        'is_default'         => 'boolean',
        'docx_detected_vars' => 'array',
    ];

    public function hasDocxTemplate(): bool
    {
        return (bool) $this->docx_template_path;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function financingRequests()
    {
        return $this->hasMany(FinancingRequest::class, 'contract_template_id');
    }

    public function assignedAdmins()
    {
        return $this->belongsToMany(
            User::class,
            'admin_financing_template',
            'financing_template_id',
            'admin_id'
        );
    }
}
