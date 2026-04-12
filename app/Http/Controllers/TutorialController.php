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
            'kode_matkul' => 'required|string',
            'creator_email' => 'required|email',
        ]);

        Tutorial::create([
            'title' => $request->title,
            'kode_matkul' => $request->kode_matkul,
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
        $tutorial->delete();
        return redirect()->route('tutorials.index')->with('success', 'Master Tutorial deleted successfully).');
    }
    
    public function apiTutorials()
    {
        $allTutorials = Tutorial::all();
        $grouped = $allTutorials->groupBy('kode_matkul');
        $result = [];

        foreach ($grouped as $kode_matkul => $tutorials) {
            $tutotialData = $tutorials->map(function ($tutor) {
                return [
                    'judul' => $tutor->title,
                    'url_presentasi' => url('/presentation/' . $tutor->url_presentasi),
                    'url_final' => url('/finished/' . $tutor->url_final),
                    'creator_email' => $tutor->creator_email,
                    'created_at' => $tutor->created_at->toDateTimeString(),
                    'updated_at' => $tutor->updated_at->toDateTimeString(),

                ];
            });
            $result[] = [
                'kode_matkul' => $kode_matkul,
                'nama_matkul' => 'Mata Kuliah ' . $kode_matkul,
                'tutorials' => $tutotialData,
            ];
        }
        return response()->json([
            'results' => $result
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
