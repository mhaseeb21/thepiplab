<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use Illuminate\Support\Str;

class AdminSignalController extends Controller
{
    public function index()
    {
        return view('admin.signalUpload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pair_name' => 'required|string|max:50',
            'signal_type' => 'required|in:buy,sell',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:3000',
            'tp1' => 'nullable|string|max:50',
            'tp2' => 'nullable|string|max:50',
            'entry_criteria' => 'nullable|string|max:2000',
        ]);

        $signal = new Signal();
        $signal->pair_name = $request->pair_name;
        $signal->signal_type = $request->signal_type;
        $signal->description = $request->description;
        $signal->tp1 = $request->tp1;
        $signal->tp2 = $request->tp2;
        $signal->entry_criteria = $request->entry_criteria;
        $signal->result_status = 'pending';

        // ✅ Always upload inside Laravel public/ so asset('uploads/...') works
        $uploadsDir = public_path('uploads');
        if (!is_dir($uploadsDir)) {
            @mkdir($uploadsDir, 0775, true);
        }

        $beforeFilename = time() . '_' . Str::random(8) . '.' . $request->file('file')->extension();
        $request->file('file')->move($uploadsDir, $beforeFilename);

        // ✅ store relative path for asset()
        $signal->image = 'uploads/' . $beforeFilename;

        $signal->save();

        return redirect()->back()->with('success', 'Signal uploaded successfully');
    }

    public function show()
    {
        $signals = Signal::orderBy('created_at', 'desc')->get();
        return view('admin.signalList', compact('signals'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'result_status' => 'required|in:pending,tp_hit,sl_hit,entry_not_met',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $signal = Signal::findOrFail($id);
        $signal->result_status = $request->result_status;

        $uploadsDir = public_path('uploads');
        if (!is_dir($uploadsDir)) {
            @mkdir($uploadsDir, 0775, true);
        }

        if ($request->hasFile('after_image')) {

            // delete old if exists
            if ($signal->after_image) {
                $oldPath = public_path(ltrim($signal->after_image, '/'));
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $afterFilename = time() . '_after_' . Str::random(8) . '.' . $request->file('after_image')->extension();
            $request->file('after_image')->move($uploadsDir, $afterFilename);

            $signal->after_image = 'uploads/' . $afterFilename;
        }

        $signal->save();

        return redirect()->route('admin.signals.show')->with('success', 'Signal updated successfully');
    }
}
