<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF; 
use Illuminate\Support\Str;

class PresentationController extends Controller
{
    public function show($url)
    {
        $tutorial = Tutorial::where('url_presentasi', $url)->firstOrFail();
        $details = $tutorial->details()->where('status', 'show')->orderBy('order', 'asc')->get();

        return view('presentation.show', compact('tutorial', 'details'));
    }

    public function downloadPdf($url)
    {
        $tutorial = Tutorial::where('url_final', $url)->firstOrFail();
        $details = $tutorial->details()->orderBy('order', 'asc')->get();

        $pdf = PDF::loadView('presentation.pdf', compact('tutorial', 'details'))
            ->setPaper('a4')
            ->setOption('margin-bottom', 10)
            ->setOption('enable-local-file-access', true); 

        return $pdf->inline('Tutorial_' . Str::slug($tutorial->title) . '.pdf');
    }
    public function finished($url_final){
        $tutorial = Tutorial::where('url_final', $url_final)->firstOrFail();

        $details = $tutorial->details()->orderBy('order', 'asc')->get();
        $pdf = PDF::loadView('presentation.pdf', compact('tutorial', 'details'))
            ->setPaper('a4')
            ->setOption('margin-bottom', 10)
            ->setOption('enable-local-file-access', true);
        
        return $pdf->inline('Tutorial_' . Str::slug($tutorial->title) . '.pdf');
    }
}
