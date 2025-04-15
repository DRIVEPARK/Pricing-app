<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Pricing;
use App\Models\Client;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        return Pricing::all(); // Zwraca wszystkich klientów w formacie JSON
    }


    public function store(Request $request)
    {

        $pricing = Pricing::create($request->only(['id', 'client_id', 'project_id','amount','description']));

        return response()->json($pricing);
    }
}
