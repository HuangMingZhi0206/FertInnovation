<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;

class MarketPriceController extends Controller
{
    public function index()
    {
        $prices = MarketPrice::orderBy('date', 'desc')->paginate(15);
        $products = MarketPrice::distinct('product_name')->pluck('product_name')->toArray();
        
        return view('market-prices.index', compact('prices', 'products'));
    }
}
