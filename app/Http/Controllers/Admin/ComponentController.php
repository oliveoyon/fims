<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Component')->only(['index']);
        $this->middleware('permission:Create Component')->only(['store']);
        $this->middleware('permission:Edit Component')->only(['edit', 'update']);
        $this->middleware('permission:Delete Component')->only(['destroy']);
    }

    public function index()
    {
        $components = Component::all();
        return view('admin.components.index', compact('components'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:components,name',
        ]);

        $component = Component::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'id' => $component->id]);
    }

    public function update(Request $request, Component $component)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:components,name,' . $component->id,
        ]);

        $component->update([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'id' => $component->id]);
    }

    public function destroy(Component $component)
    {
        $component->delete();
        return response()->json(['success' => true]);
    }
}
