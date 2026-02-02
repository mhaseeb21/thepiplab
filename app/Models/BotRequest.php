<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        // ✅ ADD THIS
        'bot_type',
        'platform',
        'market',
        'risk_profile',
        'timeframe',
        'strategy_notes',
        'budget_range',
        'contact',
        'status',
        'quoted_amount',
        'quote_message',
        'quote_sent_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
