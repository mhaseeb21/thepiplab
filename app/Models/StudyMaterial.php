<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    protected $fillable = [
        'type','title','description','file_path','original_name','mime','size','sort_order','is_published'
    ];
}
