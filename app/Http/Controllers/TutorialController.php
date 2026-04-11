<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tutorials = Tutorial::latest()->paginate(5);
        return view('tutorials.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $token = Session::get('refreshToken');
        $cleanToken = trim(str_replace('"', '', $token));
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $cleanToken,
            'Accept'        => 'application/json',
        ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');

        $makulData = $response->successful() ? $response->json('data') : [];
        return view('tutorials.create', compact('makulData'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kode_makul' => 'required|string',
            'creator_email' => 'required|email',
        ]);

        Tutorial::create([
            'title' => $request->title,
            'kode_makul' => $request->kode_makul,
            'creator_email' => $request->creator_email,
        ]); 

        return redirect()->route('tutorials.index')->with('success', 'Master Tutorial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial -> delete();
        return redirect()->route('tutorials.index')->with('success', 'Master Tutorial deleted successfully).');
    }
}
