<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::where('user_id', Auth::id())->get();
        return view('farms.index', compact('farms'));
    }

    public function create()
    {
        return view('farms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'area' => 'required|numeric|min:0.1',
            'crop_type' => 'required|string',
            'soil_type' => 'required|integer',
        ]);

        Farm::create([
            'user_id' => Auth::id(),
            ...$request->all()
        ]);

        return redirect()->route('farms.index')->with('success', 'Lahan berhasil ditambahkan');
    }

    public function show(Farm $farm)
    {
        $this->authorize('view', $farm);
        return view('farms.show', compact('farm'));
    }

    public function edit(Farm $farm)
    {
        $this->authorize('update', $farm);
        return view('farms.edit', compact('farm'));
    }

    public function update(Request $request, Farm $farm)
    {
        $this->authorize('update', $farm);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'area' => 'required|numeric|min:0.1',
            'crop_type' => 'required|string',
            'soil_type' => 'required|integer',
        ]);

        $farm->update($request->all());
        return redirect()->route('farms.index')->with('success', 'Lahan berhasil diupdate');
    }

    public function destroy(Farm $farm)
    {
        $this->authorize('delete', $farm);
        $farm->delete();
        return redirect()->route('farms.index')->with('success', 'Lahan berhasil dihapus');
    }
}
