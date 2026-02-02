<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;

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

        // Upload BEFORE image (your existing 'image' field)
        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('uploads'), $filename);
        $signal->image = $filename;

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

        // Upload AFTER image (proof)
        if ($request->hasFile('after_image')) {
            $afterName = time() . '_after_' . $request->file('after_image')->getClientOriginalName();
            $request->file('after_image')->move(public_path('uploads'), $afterName);
            $signal->after_image = $afterName;
        }

        $signal->save();

        return redirect()->route('admin.signals.show')->with('success', 'Signal updated successfully');
    }
}