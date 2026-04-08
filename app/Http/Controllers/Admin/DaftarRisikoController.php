<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DaftarRisikoRequest;
use App\Models\DaftarRisiko;
use App\Models\Agensi;
use App\Models\Aset;
use App\Models\KategoriRisiko;
use App\Models\SubKategoriRisiko;
use App\Models\Risiko;
use App\Models\KategoriPuncaRisiko;
use App\Models\PuncaRisiko;
use App\Services\DaftarRisikoService;
use App\Exports\LaporanRisikoExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Dompdf\Dompdf;

class DaftarRisikoController extends Controller
{
    public function __construct(private DaftarRisikoService $service)
    {
    }

    public function index(): View
    {
        $items = $this->service->query()
            ->with(['agensi','aset','kategori','subKategori','risiko','kategoriPuncaRisiko','puncaRisiko'])
            ->latest()
            ->paginate();

        return view('admin.daftar_risiko.index', compact('items'));
    }

    public function create(): View
    {
        $daftar = new DaftarRisiko();
        $agensis = Agensi::orderBy('nama_agensi')->get();
        $asets = Aset::orderBy('nama_aset')->get();
        $kategoris = KategoriRisiko::orderBy('nama')->get();
        $subKategoris = SubKategoriRisiko::orderBy('nama')->get();
        $risikos = Risiko::orderBy('nama')->get();
        $kategoriPunca = KategoriPuncaRisiko::orderBy('nama')->get();
        $puncaRisikos = PuncaRisiko::orderBy('nama')->get();

        return view('admin.daftar_risiko.form', compact(
            'daftar','agensis','asets','kategoris','subKategoris','risikos','kategoriPunca','puncaRisikos'
        ));
    }

    public function store(DaftarRisikoRequest $request): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $data['skor_risiko'] = ($data['impak'] ?? 0) * ($data['kebarangkalian'] ?? 0);
        $data['tahap_risiko'] = $this->tentukanTahap($data['skor_risiko']);

        $this->service->create($data);
        return redirect()->route('admin.daftar_risiko.index')->with('success', 'Risiko berjaya didaftarkan.');
    }

    public function edit(DaftarRisiko $daftar_risiko): View
    {
        $daftar = $daftar_risiko;
        $agensis = Agensi::orderBy('nama_agensi')->get();
        $asets = Aset::orderBy('nama_aset')->get();
        $kategoris = KategoriRisiko::orderBy('nama')->get();
        $subKategoris = SubKategoriRisiko::orderBy('nama')->get();
        $risikos = Risiko::orderBy('nama')->get();
        $kategoriPunca = KategoriPuncaRisiko::orderBy('nama')->get();
        $puncaRisikos = PuncaRisiko::orderBy('nama')->get();
        return view('admin.daftar_risiko.form', compact(
            'daftar','agensis','asets','kategoris','subKategoris','risikos','kategoriPunca','puncaRisikos'
        ));
    }

    public function update(DaftarRisikoRequest $request, DaftarRisiko $daftar_risiko): RedirectResponse
    {
        $data = $this->service->fillableOnly($request->validated());
        $data['skor_risiko'] = ($data['impak'] ?? 0) * ($data['kebarangkalian'] ?? 0);
        $data['tahap_risiko'] = $this->tentukanTahap($data['skor_risiko']);

        $this->service->update($daftar_risiko, $data);
        return redirect()->route('admin.daftar_risiko.index')->with('success', 'Risiko berjaya dikemas kini.');
    }

    public function destroy(DaftarRisiko $daftar_risiko): RedirectResponse
    {
        $this->service->delete($daftar_risiko);
        return redirect()->route('admin.daftar_risiko.index')->with('success', 'Risiko berjaya dipadam.');
    }

    public function laporan(): View
    {
        $items = $this->service->query()->latest()->paginate(10);
        
        // Highest risk in agency (paginated with through to preserve paginator)
        $highestRiskByAgency = DaftarRisiko::select('agensi_id')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko IN ("Sangat Tinggi", "Tinggi") THEN 1 ELSE 0 END) as high_risk_count')
            ->with('agensi')
            ->groupBy('agensi_id')
            ->orderByDesc('high_risk_count')
            ->paginate(10, ['*'], 'page_agency')
            ->through(function($row) {
                return [
                    'nama_agensi' => $row->agensi?->nama_agensi ?? 'Unknown',
                    'total_risiko' => $row->total_risiko,
                    'high_risk_count' => $row->high_risk_count
                ];
            });
        
        // Asset type with highest total risk (paginated with through to preserve paginator)
        $highestRiskByAssetType = DaftarRisiko::join('asets', 'daftar_risikos.aset_id', '=', 'asets.id')
            ->join('jenis_asets', 'asets.jenis_aset_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.id', 'jenis_asets.nama')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko = "Sangat Tinggi" THEN 5 WHEN tahap_risiko = "Tinggi" THEN 4 WHEN tahap_risiko = "Sederhana" THEN 3 WHEN tahap_risiko = "Rendah" THEN 2 ELSE 1 END) as total_skor')
            ->groupBy('jenis_asets.id', 'jenis_asets.nama')
            ->orderByDesc('total_skor')
            ->paginate(10, ['*'], 'page_asset')
            ->through(function($row) {
                return [
                    'nama' => $row->nama,
                    'total_risiko' => $row->total_risiko,
                    'total_skor' => $row->total_skor
                ];
            });
        
        return view('admin.daftar_risiko.laporan', compact('items', 'highestRiskByAgency', 'highestRiskByAssetType'));
    }

    public function downloadCsv()
    {
        $export = new LaporanRisikoExport();
        $csv = $export->exportCsv();
        
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'laporan_risiko_' . date('Y-m-d_H-i-s') . '.csv', [
            'Content-Type' => 'text/csv; charset=utf-8',
        ]);
    }

    public function downloadPdf()
    {
        $items = $this->service->query()->latest()->get();
        
        // Highest risk in agency
        $highestRiskByAgency = DaftarRisiko::select('agensi_id')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko IN ("Sangat Tinggi", "Tinggi") THEN 1 ELSE 0 END) as high_risk_count')
            ->with('agensi')
            ->groupBy('agensi_id')
            ->orderByDesc('high_risk_count')
            ->limit(10)
            ->get();
        
        // Asset type with highest total risk
        $highestRiskByAssetType = DaftarRisiko::join('asets', 'daftar_risikos.aset_id', '=', 'asets.id')
            ->join('jenis_asets', 'asets.jenis_aset_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.id', 'jenis_asets.nama')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko = "Sangat Tinggi" THEN 5 WHEN tahap_risiko = "Tinggi" THEN 4 WHEN tahap_risiko = "Sederhana" THEN 3 WHEN tahap_risiko = "Rendah" THEN 2 ELSE 1 END) as total_skor')
            ->groupBy('jenis_asets.id', 'jenis_asets.nama')
            ->orderByDesc('total_skor')
            ->limit(10)
            ->get();
        
        $html = $this->generatePdfHtml('Laporan Risiko', [
            'tables' => [
                [
                    'title' => 'Agensi dengan Risiko Tertinggi',
                    'headers' => ['Agensi', 'Total Risiko', 'Risiko Tinggi'],
                    'rows' => $highestRiskByAgency->map(fn($row) => [
                        $row->agensi?->nama_agensi,
                        $row->total_risiko,
                        $row->high_risk_count
                    ])->toArray()
                ],
                [
                    'title' => 'Jenis Aset dengan Risiko Tertinggi',
                    'headers' => ['Jenis Aset', 'Total Risiko', 'Skor'],
                    'rows' => $highestRiskByAssetType->map(fn($row) => [
                        $row->nama,
                        $row->total_risiko,
                        $row->total_skor
                    ])->toArray()
                ],
                [
                    'title' => 'Detail Risiko',
                    'headers' => ['Agensi', 'Aset', 'Risiko', 'Skor', 'Tahap'],
                    'rows' => $items->map(fn($item) => [
                        $item->agensi?->nama_agensi,
                        $item->aset?->nama_aset,
                        $item->risiko?->nama,
                        $item->skor_risiko,
                        $item->tahap_risiko
                    ])->toArray()
                ]
            ]
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        return response()->stream(function () use ($dompdf) {
            echo $dompdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="laporan_risiko_' . date('Y-m-d_H-i-s') . '.pdf"'
        ]);
    }

    public function downloadAgencyCsv()
    {
        $export = new LaporanRisikoExport();
        $csv = $export->exportAgencyCsv();
        
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'agensi_risiko_' . date('Y-m-d_H-i-s') . '.csv', [
            'Content-Type' => 'text/csv; charset=utf-8',
        ]);
    }

    public function downloadAgencyPdf()
    {
        $highestRiskByAgency = DaftarRisiko::select('agensi_id')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko IN ("Sangat Tinggi", "Tinggi") THEN 1 ELSE 0 END) as high_risk_count')
            ->with('agensi')
            ->groupBy('agensi_id')
            ->orderByDesc('high_risk_count')
            ->get();
        
        $html = $this->generatePdfHtml('Agensi dengan Risiko Tertinggi', [
            'tables' => [[
                'headers' => ['Agensi', 'Total Risiko', 'Risiko Tinggi'],
                'rows' => $highestRiskByAgency->map(fn($row) => [
                    $row->agensi?->nama_agensi,
                    $row->total_risiko,
                    $row->high_risk_count
                ])->toArray()
            ]]
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return response()->stream(function () use ($dompdf) {
            echo $dompdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="agensi_risiko_' . date('Y-m-d_H-i-s') . '.pdf"'
        ]);
    }

    public function downloadAssetCsv()
    {
        $export = new LaporanRisikoExport();
        $csv = $export->exportAssetCsv();
        
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'aset_risiko_' . date('Y-m-d_H-i-s') . '.csv', [
            'Content-Type' => 'text/csv; charset=utf-8',
        ]);
    }

    public function downloadAssetPdf()
    {
        $highestRiskByAssetType = DaftarRisiko::join('asets', 'daftar_risikos.aset_id', '=', 'asets.id')
            ->join('jenis_asets', 'asets.jenis_aset_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.id', 'jenis_asets.nama')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko = "Sangat Tinggi" THEN 5 WHEN tahap_risiko = "Tinggi" THEN 4 WHEN tahap_risiko = "Sederhana" THEN 3 WHEN tahap_risiko = "Rendah" THEN 2 ELSE 1 END) as total_skor')
            ->groupBy('jenis_asets.id', 'jenis_asets.nama')
            ->orderByDesc('total_skor')
            ->get();
        
        $html = $this->generatePdfHtml('Jenis Aset dengan Risiko Tertinggi', [
            'tables' => [[
                'headers' => ['Jenis Aset', 'Total Risiko', 'Skor'],
                'rows' => $highestRiskByAssetType->map(fn($row) => [
                    $row->nama,
                    $row->total_risiko,
                    $row->total_skor
                ])->toArray()
            ]]
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return response()->stream(function () use ($dompdf) {
            echo $dompdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="aset_risiko_' . date('Y-m-d_H-i-s') . '.pdf"'
        ]);
    }

    public function downloadDetailCsv()
    {
        $export = new LaporanRisikoExport();
        $csv = $export->exportDetailCsv();
        
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'detail_risiko_' . date('Y-m-d_H-i-s') . '.csv', [
            'Content-Type' => 'text/csv; charset=utf-8',
        ]);
    }

    public function downloadDetailPdf()
    {
        $items = $this->service->query()->latest()->get();
        
        $html = $this->generatePdfHtml('Detail Risiko', [
            'tables' => [[
                'headers' => ['Agensi', 'Aset', 'Risiko', 'Skor', 'Tahap'],
                'rows' => $items->map(fn($item) => [
                    $item->agensi?->nama_agensi,
                    $item->aset?->nama_aset,
                    $item->risiko?->nama,
                    $item->skor_risiko,
                    $item->tahap_risiko
                ])->toArray()
            ]]
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        return response()->stream(function () use ($dompdf) {
            echo $dompdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="detail_risiko_' . date('Y-m-d_H-i-s') . '.pdf"'
        ]);
    }

    private function generatePdfHtml($title, $data)
    {
        $html = '<html><head><meta charset="UTF-8"><title>' . $title . '</title>';
        $html .= '<style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            h1 { color: #333; }
            h2 { color: #666; margin-top: 30px; }
            table { border-collapse: collapse; width: 100%; }
            table, th, td { border: 1px solid #ddd; padding: 8px; }
            th { background-color: #f2f2f2; }
            tr:nth-child(even) { background-color: #f9f9f9; }
        </style></head><body>';
        $html .= '<h1>' . $title . '</h1>';
        
        if (isset($data['tables'])) {
            foreach ($data['tables'] as $index => $table) {
                if ($index > 0 && isset($table['title'])) {
                    $html .= '<h2>' . $table['title'] . '</h2>';
                }
                $html .= '<table><thead><tr>';
                foreach ($table['headers'] as $header) {
                    $html .= '<th>' . $header . '</th>';
                }
                $html .= '</tr></thead><tbody>';
                
                foreach ($table['rows'] as $row) {
                    $html .= '<tr>';
                    foreach ($row as $cell) {
                        $html .= '<td>' . ($cell ?? '-') . '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody></table>';
            }
        }
        
        $html .= '</body></html>';
        return $html;
    }

    private function tentukanTahap(int $skor): string
    {
        return match (true) {
            $skor >= 20 => 'Sangat Tinggi',
            $skor >= 12 => 'Tinggi',
            $skor >= 8 => 'Sederhana',
            default => 'Rendah',
        };
    }
}
