<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all(); // Zwraca wszystkich klientów w formacie JSON
    }

    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
             
            ],
            'client_id' => 'required|numeric',
            'description' => [
                'nullable',
                'string',
                'max:255'
             
            ]
        ]);
    
        // Tworzenie nowego klienta
        $project = Project::create($request->only(['name', 'client_id', 'description']));
    
        return response()->json($project, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
