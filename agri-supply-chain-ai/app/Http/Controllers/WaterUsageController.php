<?php

namespace App\Http\Controllers;

use App\Models\WaterUsage;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaterUsageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        $water = WaterUsage::whereIn('farm_id', $farms->pluck('id'))
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('water-usage.index', compact('water', 'farms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'water_amount' => 'required|numeric|min:0',
            'water_source' => 'required|string',
            'irrigation_method' => 'required|string',
            'water_cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        WaterUsage::create($request->all());
        return redirect()->route('water-usage.index')->with('success', 'Data penggunaan air berhasil ditambahkan');
    }
}
