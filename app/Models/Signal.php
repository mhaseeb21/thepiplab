<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory;

    protected $table = 'signals';

    protected $fillable = [
        'pair_name',
        'signal_type',
        'image',
        'after_image',
        'description',
        'tp1',
        'tp2',
        'entry_criteria',
        'result_status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * BEFORE image url (storage symlink)
     * image stored like: "uploads/xxxx.png"
     */
    public function getBeforeImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    /**
     * AFTER image url (storage symlink)
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        return $this->after_image ? asset('storage/' . $this->after_image) : null;
    }

    public function getResultLabelAttribute(): string
    {
        return match ($this->result_status) {
            'pending' => 'Pending',
            'tp_hit' => 'TP Hit',
            'sl_hit' => 'SL Hit',
            'entry_not_met' => 'Entry Criteria Not Met',
            default => ucfirst(str_replace('_', ' ', (string) $this->result_status)),
        };
    }

    public function getResultBadgeClassAttribute(): string
    {
        return match ($this->result_status) {
            'pending' => 'text-bg-light',
            'tp_hit' => 'text-bg-success',
            'sl_hit' => 'text-bg-danger',
            'entry_not_met' => 'text-bg-warning',
            default => 'text-bg-secondary',
        };
    }
}
