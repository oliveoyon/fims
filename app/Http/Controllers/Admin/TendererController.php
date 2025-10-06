<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenderer;
use Illuminate\Support\Facades\Storage;

class TendererController extends Controller
{
    public function index()
    {
        $tenderers = Tenderer::latest()->get();
        return view('admin.tenderers.index', compact('tenderers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'nullable|string|max:500',
            'phone'       => 'nullable|string|max:20',
            'license_no'  => 'nullable|string|max:100',
            'document'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'is_active'   => 'nullable|boolean',
        ]);

        $data = $request->only(['name', 'address', 'phone', 'license_no']);
        $data['is_active'] = $request->input('is_active', 0);

        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('tenderers', 'public');
        }

        Tenderer::updateOrCreate(['id' => $request->id], $data);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $tenderer = Tenderer::findOrFail($id);
        return response()->json($tenderer);
    }

    public function update(Request $request, Tenderer $tenderer)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:500',
                'phone' => 'nullable|string|max:20',
                'license_no' => 'nullable|string|max:100',
                'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'is_active' => 'nullable|boolean',
            ]);

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('tenderers', $filename, 'public');
                $validated['document'] = $path;
            }

            $validated['is_active'] = $request->input('is_active', 0);

            $tenderer->update($validated);

            return response()->json(['success' => true, 'message' => 'Tenderer updated successfully.']);
        } catch (\Exception $e) {
            \Log::error('Tenderer update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Update failed.'], 500);
        }
    }


    public function destroy($id)
    {
        $tenderer = Tenderer::findOrFail($id);
        if ($tenderer->document) {
            Storage::disk('public')->delete($tenderer->document);
        }
        $tenderer->delete();
        return response()->json(['success' => true]);
    }
}
