<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Tutorial;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalTutorials = Tutorial::count();

        $rawToken = Session::get('refreshToken');
        $cleanToken = trim(str_replace('"', '', $rawToken));

        // dd($cleanToken);
        

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $cleanToken,
            'Accept'        => 'application/json',
        ])->get(config('services.jwt.url') . '/getMakul');

        if ($response->status() === 401) {
            Session::forget('refreshToken');

            return redirect('/')->withErrors([
                'email' => 'Sesi API telah berakhir. Silakan login kembali untuk memuat data.'
            ]);
        }

        $makulData = $response->successful() ? $response->json('data') : [];

        return view('dashboard', compact('totalTutorials', 'makulData', 'cleanToken'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
