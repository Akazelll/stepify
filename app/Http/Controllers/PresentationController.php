<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Str;

class PresentationController extends Controller
{
    public function index($url)
    {
        $tutorial = Tutorial::where('url_presentasi', $url)->firstOrFail();
        $details = $tutorial->details()->where('status', 'show')->orderBy('order', 'asc')->get();

        $totalSteps = $tutorial->details()->count();

        $hiddenSteps = $tutorial->details()->where('status', 'hide')->count();

        $isFinished = ($totalSteps > 0) && ($hiddenSteps === 0);

        return view('presentation.index', compact('tutorial', 'details', 'isFinished'));
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
}
