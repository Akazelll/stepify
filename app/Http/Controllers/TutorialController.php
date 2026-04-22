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
        ])->get(config('services.jwt.url') . '/getMakul');

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
            'kode_matkul' => 'required|string',
        ]);

        $creatorEmail = Session::get('user_email');

        if (!$creatorEmail) {
            return back()->withErrors(['creator_email' => 'Creator email is required. Please log in again.'])->withInput();
        }

        Tutorial::create([
            'title' => $request->title,
            'kode_matkul' => $request->kode_matkul,
            'creator_email' => $creatorEmail,
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
    public function update(Request $request)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return redirect()->route('tutorials.index')->with('success', 'Master Tutorial deleted successfully).');
    }

    public function apiTutorials($kode_matkul)
    {
        $rawToken = Session::get('refreshToken');
        $cleanToken = trim(str_replace('"', '', $rawToken));

        $tutorials = Tutorial::where('kode_matkul', $kode_matkul)->get();

        if ($tutorials->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'No tutorials found for the given course code.',
                'results' => [],
                'debug_token' => $cleanToken
            ], 404);
        }

        $tutorialData = $tutorials->map(function ($tutorial) {
            return [
                'id' => $tutorial->id,
                'title' => $tutorial->title,
                'kode_matkul' => $tutorial->kode_matkul,
                'url_presentasi' => $tutorial->url_presentasi,
                'url_final' => $tutorial->url_final,
                'creator_email' => $tutorial->creator_email,
            ];
        });

        return response()->json([
            'results' => [
                $kode_matkul => [
                    'nama_matkul' => 'Matakuliah ' . $kode_matkul,
                    'tutorials' => $tutorialData
                ]
            ],
            'debug_token' => $cleanToken
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
