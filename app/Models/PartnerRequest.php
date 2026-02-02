<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_size',
        'experience',
        'promotion_method',
        'message',
        'status',
        'reviewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
