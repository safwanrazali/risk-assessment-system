<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarRisiko;
use App\Models\Agensi;
use App\Models\Sektor;
use App\Models\Risiko;
use Illuminate\Support\Facades\DB;
use App\Services\GreetingService;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'jumlah_risiko' => DaftarRisiko::count(),
            'jumlah_agensi' => Agensi::count(),
            'jumlah_sektor' => Sektor::count(),
            'jenis_risiko' => Risiko::count(),
        ];

        $riskLevels = DaftarRisiko::select('tahap_risiko', DB::raw('COUNT(*) as total'))
            ->groupBy('tahap_risiko')
            ->pluck('total', 'tahap_risiko')
            ->toArray();

        $highRiskAgencies = DaftarRisiko::select('agensi_id', DB::raw('COUNT(*) as total'))
            ->whereIn('tahap_risiko', ['Tinggi', 'Sangat Tinggi'])
            ->groupBy('agensi_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                $name = Agensi::find($row->agensi_id)?->nama_agensi ?? 'Tidak diketahui';
                return ['name' => $name, 'total' => (int) $row->total];
            })
            ->toArray();

        $greeting = app(GreetingService::class)->greeting(auth()->user());
        return view('admin.dashboard', compact('stats', 'riskLevels', 'highRiskAgencies', 'greeting'));
    }
}
