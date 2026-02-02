<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'referral_id',
        'purchase_id',
        'amount',
    ];

    // Define the relationship to the User (who earned the commission)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Define the relationship to the referred user (who made the purchase)
    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }
}
