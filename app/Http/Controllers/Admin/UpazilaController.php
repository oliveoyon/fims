<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upazila;
use App\Models\District;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Upazila')->only(['index']);
        $this->middleware('permission:Create Upazila')->only(['store']);
        $this->middleware('permission:Edit Upazila')->only(['edit', 'update']);
        $this->middleware('permission:Delete Upazila')->only(['destroy']);
    }
    
    public function index()
    {
        $upazilas = Upazila::with('district')->get();
        $districts = District::all();
        return view('admin.upazilas.index', compact('upazilas', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:upazilas,name',
            'district_id' => 'required|exists:districts,id',
        ]);

        $upazila = Upazila::create([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ]);

        return response()->json(['success' => true, 'id' => $upazila->id]);
    }

    public function update(Request $request, Upazila $upazila)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:upazilas,name,' . $upazila->id,
            'district_id' => 'required|exists:districts,id',
        ]);

        $upazila->update([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ]);

        return response()->json(['success' => true, 'id' => $upazila->id]);
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        return response()->json(['success' => true]);
    }
}
