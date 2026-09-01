<?php

namespace App\Http\Controllers;

use App\Models\ScanResult;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        $lastTarget = ScanResult::latest()->value('target');

        $results = $lastTarget
            ? ScanResult::where('target', $lastTarget)->orderBy('port')->get()
            : collect();

        return view('scan.index', [
            'target' => $lastTarget,
            'results' => $results,
        ]);
    }

    public function scan(Request $request)
    {
        $request->validate([
            'target' => 'required|string|max:100',
        ]);

        $ports = $this->runScan($request->target);

        foreach ($ports as $p) {
            ScanResult::create([
                'target' => $request->target,
                'port' => $p['port'],
                'service' => $p['service'],
                'version' => $p['version'],
            ]);
        }

        return redirect()->route('scan.index');
    }

    protected function runScan(string $target): array
    {
        // MOCK — nanti bisa diganti manggil Flask (yang jalankan Nmap beneran)
        return [
            ['port' => 22, 'service' => 'ssh', 'version' => 'OpenSSH 8.9'],
            ['port' => 80, 'service' => 'http', 'version' => 'nginx 1.24.0'],
            ['port' => 3306, 'service' => 'mysql', 'version' => 'MySQL 8.0.34'],
        ];
    }
}