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
        'image',          // before image
        'after_image',    // after proof image
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
     * BEFORE image url (uploads folder)
     */
    public function getBeforeImageUrlAttribute(): string
    {
        return asset('uploads/' . $this->image);
    }

    /**
     * AFTER image url (uploads folder)
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        return $this->after_image ? asset('uploads/' . $this->after_image) : null;
    }

    /**
     * Result label for UI
     */
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

    /**
     * Optional badge class for UI
     */
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