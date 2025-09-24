<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Division')->only(['index']);
        $this->middleware('permission:Create Division')->only(['store']);
        $this->middleware('permission:Edit Division')->only(['edit', 'update']);
        $this->middleware('permission:Delete Division')->only(['destroy']);
    }
    
    public function index()
    {
        $divisions = Division::all();
        return view('admin.divisions.index', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
        ]);

        $division = Division::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'id' => $division->id]);
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $division->id,
        ]);

        $division->update(['name' => $request->name]);

        return response()->json(['success' => true, 'id' => $division->id]);
    }

    public function destroy(Division $division)
    {
        $division->delete();

        return response()->json(['success' => true]);
    }
}
