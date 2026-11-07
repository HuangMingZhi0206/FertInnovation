<?php

namespace App\Http\Controllers;

use App\Models\FertilizerUsage;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FertilizerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        $fertilizers = FertilizerUsage::whereIn('farm_id', $farms->pluck('id'))
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('fertilizer-usage.index', compact('fertilizers', 'farms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'fertilizer_type' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'fertilizer_cost' => 'required|numeric|min:0',
            'application_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        FertilizerUsage::create($request->all());
        return redirect()->route('fertilizer-usage.index')->with('success', 'Data penggunaan pupuk berhasil ditambahkan');
    }
}
