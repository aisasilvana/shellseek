<?php

namespace App\Http\Controllers;

use App\Models\ReconResult;
use App\Models\ScanResult;

class ReportController extends Controller
{
    public function index()
    {
        $lastUsername = ReconResult::latest()->value('username');
        $lastTarget = ScanResult::latest()->value('target');

        $reconResults = $lastUsername
            ? ReconResult::where('username', $lastUsername)->get()
            : collect();

        $scanResults = $lastTarget
            ? ScanResult::where('target', $lastTarget)->orderBy('port')->get()
            : collect();

        return view('report.index', [
            'username' => $lastUsername,
            'target' => $lastTarget,
            'reconResults' => $reconResults,
            'scanResults' => $scanResults,
        ]);
    }
}