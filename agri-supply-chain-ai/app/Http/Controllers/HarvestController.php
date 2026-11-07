<?php

namespace App\Http\Controllers;

use App\Models\HarvestData;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HarvestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        $harvests = HarvestData::whereIn('farm_id', $farms->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('harvest.index', compact('harvests', 'farms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_type' => 'required|string',
            'planting_date' => 'required|date',
            'estimated_harvest_date' => 'required|date',
            'estimated_yield' => 'required|numeric',
            'yield_unit' => 'required|string',
            'production_cost' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        HarvestData::create([
            ...$request->all(),
            'status' => 'Dalam Proses'
        ]);

        return redirect()->route('harvest.index')->with('success', 'Rencana panen berhasil ditambahkan');
    }
}
