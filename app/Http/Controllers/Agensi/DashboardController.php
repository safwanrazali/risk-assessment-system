<?php

namespace App\Http\Controllers\Agensi;

use App\Http\Controllers\Controller;
use App\Models\DaftarRisiko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GreetingService;

class DashboardController extends Controller
{
    public function index()
    {
        $agensiId = Auth::user()->agensi_id;
        $query = DaftarRisiko::query();
        if ($agensiId) {
            $query->where('agensi_id', $agensiId);
        } else {
            $query->whereNull('agensi_id');
        }
        $jumlah_risiko = $query->count();

        $riskLevels = DaftarRisiko::select('tahap_risiko', DB::raw('COUNT(*) as total'))
            ->when($agensiId, fn($q) => $q->where('agensi_id', $agensiId), fn($q) => $q->whereNull('agensi_id'))
            ->groupBy('tahap_risiko')
            ->pluck('total', 'tahap_risiko')
            ->toArray();

        $greeting = app(GreetingService::class)->greeting(Auth::user());
        return view('agensi.dashboard', compact('jumlah_risiko', 'riskLevels', 'greeting'));
    }
}
