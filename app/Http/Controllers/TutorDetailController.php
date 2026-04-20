<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TutorDetail;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Storage;


class TutorDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tutorial $tutorial)
    {
        $details = $tutorial->details()->orderBy('order', 'asc')->get();

        return view('tutorials.details', compact('tutorial', 'details'));
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
    public function store(Request $request, Tutorial $tutorial)
    {
        $request->validate([
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
        ]);

        $lastOrder = $tutorial->details()->max('order') ?? 0;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tutor_images', 'public');
        }

        TutorDetail::create([
            'tutorial_id' => $tutorial->id,
            'text' => $request->text,
            'code' => $request->code,
            'image' => $imagePath,
            'url' => $request->url,
            'order' => $lastOrder + 1,
            'status' => 'show',
        ]);

        return redirect()->route('tutorial.details.index', $tutorial->id)
            ->with('success', 'Detail berhasil ditambahkan.');
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
    public function update(Request $request, TutorDetail $detail)
    {
        $request->validate([
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|url'
        ]);

        $imagePath = $detail->image;

        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('tutor_images', 'public');
        }

        $detail->update([
            'text' => $request->text,
            'code' => $request->code,
            'image' => $imagePath,
            'url' => $request->url
        ]);

        return redirect()->route('tutorial.details.index', $detail->tutorial_id)->with('success', 'Tutorial detail updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TutorDetail $detail)
    {
        $tutorialId = $detail->tutorial_id;
        $detail->delete();
        return redirect()->route('tutorial.details.index', $tutorialId)
            ->with('success', 'Detail berhasil dihapus.');
    }

    public function toggleStatus(TutorDetail $detail)
    {
        $detail->update([
            'status' => $detail->status === 'show' ? 'hide' : 'show',
        ]);
        return back()->with('success', 'Status detail berhasil diubah.');
    }
}
