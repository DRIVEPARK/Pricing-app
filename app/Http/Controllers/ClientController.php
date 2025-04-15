<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all(); // Zwraca wszystkich klientów w formacie JSON
    }

    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\-]+$/u' // Only letters, spaces, and hyphens are allowed
            ],
            'email' => 'required|email|max:255',
            'company_name' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\s.]+$/' // Must contain at least one letter, can include numbers, spaces, and periods
            ],
            'address' => 'nullable|string|min:10|max:255', // More relaxed validation for address
        ]);
    
        // Tworzenie nowego klienta
        $client = Client::create($request->only(['name', 'email', 'company_name', 'address']));
    
        return response()->json($client, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
