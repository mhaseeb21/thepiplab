<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSignalController extends Controller
{
    /**
     * Show upload form
     */
    public function index()
    {
        return view('admin.signalUpload');
    }

    /**
     * CREATE signal (Before image + details)
     * Route example: admin.signalUpload (POST)
     */
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

        // Default status on create
        $signal->result_status = 'pending';

        // ✅ Store BEFORE image in storage/app/public/uploads
        $beforeFilename = time() . '_' . Str::random(8) . '.' . $request->file('file')->extension();
        $beforePath = $request->file('file')->storeAs('uploads', $beforeFilename, 'public');

        // Save "uploads/filename.png" in DB
        $signal->image = $beforePath;

        $signal->save();

        return redirect()->back()->with('success', 'Signal uploaded successfully');
    }

    /**
     * List all signals (Admin list page)
     * Route example: admin.signals.show (GET)
     */
    public function show()
    {
        $signals = Signal::orderBy('created_at', 'desc')->get();
        return view('admin.signalList', compact('signals'));
    }

    /**
     * UPDATE signal result status + optional after_image
     * Route example: admin.signals.edit (POST) or (PATCH) with {id}
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'result_status' => 'required|in:pending,tp_hit,sl_hit,entry_not_met',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $signal = Signal::findOrFail($id);
        $signal->result_status = $request->result_status;

        // ✅ Store AFTER image in storage/app/public/uploads
        if ($request->hasFile('after_image')) {

            // delete old after image (optional but recommended)
            if ($signal->after_image && Storage::disk('public')->exists($signal->after_image)) {
                Storage::disk('public')->delete($signal->after_image);
            }

            $afterFilename = time() . '_after_' . Str::random(8) . '.' . $request->file('after_image')->extension();
            $afterPath = $request->file('after_image')->storeAs('uploads', $afterFilename, 'public');

            $signal->after_image = $afterPath; // "uploads/xxx.png"
        }

        $signal->save();

        return redirect()->route('admin.signals.show')->with('success', 'Signal updated successfully');
    }
}
