<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::orderBy('type')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'        => 'required|in:lecture,resource',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
            'file'        => 'required|file|mimes:pdf|max:20480', // 20MB
            'is_published'=> 'nullable|boolean',
        ]);

        $file = $request->file('file');

        // ✅ store on public disk
        $path = $file->store('study-materials/'.$data['type'], 'public');

        StudyMaterial::create([
            'type'          => $data['type'],
            'title'         => $data['title'],
            'description'   => $data['description'] ?? null,
            'file_path'     => $path, // e.g study-materials/lecture/xxx.pdf
            'original_name' => $file->getClientOriginalName(),
            'mime'          => $file->getMimeType(),
            'size'          => $file->getSize(),
            'sort_order'    => $data['sort_order'] ?? 0,
            'is_published'  => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.index')->with('success', 'Material uploaded successfully.');
    }

    public function destroy(StudyMaterial $material)
    {
        Storage::disk('public')->delete($material->file_path);
        $material->delete();

        return back()->with('success', 'Material deleted successfully.');
    }
}

