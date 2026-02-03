<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
     * BEFORE image url
     * DB stores: "uploads/xxx.png" (or sometimes just filename)
     * Public path: public_html/uploads/xxx.png
     */
   public function getBeforeImageUrlAttribute(): string {
    if (!$this->image) return '';
    return url('uploads/' . ltrim($this->image, 'uploads/'));
}

    /**
     * AFTER image url
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        if (!$this->after_image) return null;

        if (Str::startsWith($this->after_image, 'uploads/')) {
            return asset($this->after_image);
        }

        return asset('uploads/' . $this->after_image);
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
