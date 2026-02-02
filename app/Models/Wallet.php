<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    // Define the relationship to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to WalletTransaction
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }
}
