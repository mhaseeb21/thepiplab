<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\StudyMaterial;

class StudentMaterialController extends Controller
{
public function lectures()
{
    $items = StudyMaterial::where('type','lecture')
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->get();

    return view('client.student.lectures', compact('items'));
}

public function resources()
{
    $items = StudyMaterial::where('type','resource')
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->get();

    return view('client.student.resources', compact('items'));
}
public function download(StudyMaterial $material)
    {
        abort_unless($material->is_published, 404);

        // ✅ forces auth + enrollment via middleware
        return Storage::disk('public')->download($material->file_path, $material->original_name);
    }
}
