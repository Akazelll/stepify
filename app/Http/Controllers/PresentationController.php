<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class PresentationController extends Controller
{
    public function show($url)
    {
        $tutorial = Tutorial::where('url_presentasi', $url)->firstOrFail();

        $details = $tutorial->details()->where('status', 'show')->orderBy('created_at', 'asc')->get();

        return view('presentation.show', compact('tutorial', 'details'));
        
    }
}
