<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'team_members',
        'description',
        'is_contacted',
        'contacted_at',
    ];

    protected $casts = [
        'is_contacted' => 'boolean',
        'contacted_at' => 'datetime',
    ];
}
