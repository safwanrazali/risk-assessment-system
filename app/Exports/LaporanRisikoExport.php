<?php

namespace App\Exports;

use App\Models\DaftarRisiko;

class LaporanRisikoExport
{
    public function exportCsv($agensi_id = null)
    {
        // Get all data, filtered by agency if provided
        $query = DaftarRisiko::with(['agensi', 'aset', 'risiko']);
        if ($agensi_id) {
            $query->where('agensi_id', $agensi_id);
        }
        $items = $query->latest()->get();
        
        // Highest risk in agency
        $highestRiskByAgencyQuery = DaftarRisiko::select('agensi_id')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko IN ("Sangat Tinggi", "Tinggi") THEN 1 ELSE 0 END) as high_risk_count')
            ->with('agensi');
        
        if ($agensi_id) {
            $highestRiskByAgencyQuery->where('agensi_id', $agensi_id);
        }
        
        $highestRiskByAgency = $highestRiskByAgencyQuery
            ->groupBy('agensi_id')
            ->orderByDesc('high_risk_count')
            ->limit(10)
            ->get();
        
        // Asset type with highest total risk
        $highestRiskByAssetTypeQuery = DaftarRisiko::join('asets', 'daftar_risikos.aset_id', '=', 'asets.id')
            ->join('jenis_asets', 'asets.jenis_aset_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.id', 'jenis_asets.nama')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko = "Sangat Tinggi" THEN 5 WHEN tahap_risiko = "Tinggi" THEN 4 WHEN tahap_risiko = "Sederhana" THEN 3 WHEN tahap_risiko = "Rendah" THEN 2 ELSE 1 END) as total_skor');
        
        if ($agensi_id) {
            $highestRiskByAssetTypeQuery->where('daftar_risikos.agensi_id', $agensi_id);
        }
        
        $highestRiskByAssetType = $highestRiskByAssetTypeQuery
            ->groupBy('jenis_asets.id', 'jenis_asets.nama')
            ->orderByDesc('total_skor')
            ->limit(10)
            ->get();
        
        // Create CSV with multiple sections
        $csv = "AGENSI DENGAN RISIKO TERTINGGI\n";
        $csv .= "Agensi,Total Risiko,Risiko Tinggi/Sangat Tinggi\n";
        foreach ($highestRiskByAgency as $row) {
            $csv .= "\"{$row->agensi?->nama_agensi}\",{$row->total_risiko},{$row->high_risk_count}\n";
        }
        
        $csv .= "\n\nJENIS ASET DENGAN RISIKO TERTINGGI\n";
        $csv .= "Jenis Aset,Total Risiko,Skor Risiko\n";
        foreach ($highestRiskByAssetType as $row) {
            $csv .= "\"{$row->nama}\",{$row->total_risiko},{$row->total_skor}\n";
        }
        
        $csv .= "\n\nDETAIL RISIKO\n";
        $csv .= "Agensi,Aset,Risiko,Impak,Kebarangkalian,Skor Risiko,Tahap Risiko\n";
        foreach ($items as $item) {
            $csv .= "\"{$item->agensi?->nama_agensi}\",\"{$item->aset?->nama_aset}\",\"{$item->risiko?->nama}\",{$item->impak},{$item->kebarangkalian},{$item->skor_risiko},\"{$item->tahap_risiko}\"\n";
        }
        
        return $csv;
    }

    public function exportExcel()
    {
        // Check if maatwebsite/excel is installed
        if (!class_exists('\\Maatwebsite\\Excel\\Facades\\Excel')) {
            return null; // Excel export not available
        }

        // This will be used if maatwebsite/excel is installed
        return new \stdClass(); // Placeholder
    }

    public function exportAgencyCsv($agensi_id = null)
    {
        // Highest risk in agency
        $highestRiskByAgencyQuery = DaftarRisiko::select('agensi_id')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko IN ("Sangat Tinggi", "Tinggi") THEN 1 ELSE 0 END) as high_risk_count')
            ->with('agensi');
        
        if ($agensi_id) {
            $highestRiskByAgencyQuery->where('agensi_id', $agensi_id);
        }
        
        $highestRiskByAgency = $highestRiskByAgencyQuery
            ->groupBy('agensi_id')
            ->orderByDesc('high_risk_count')
            ->get();
        
        $csv = "Agensi,Total Risiko,Risiko Tinggi/Sangat Tinggi\n";
        foreach ($highestRiskByAgency as $row) {
            $csv .= "\"{$row->agensi?->nama_agensi}\",{$row->total_risiko},{$row->high_risk_count}\n";
        }
        
        return $csv;
    }

    public function exportAssetCsv($agensi_id = null)
    {
        // Asset type with highest total risk
        $highestRiskByAssetTypeQuery = DaftarRisiko::join('asets', 'daftar_risikos.aset_id', '=', 'asets.id')
            ->join('jenis_asets', 'asets.jenis_aset_id', '=', 'jenis_asets.id')
            ->select('jenis_asets.id', 'jenis_asets.nama')
            ->selectRaw('COUNT(*) as total_risiko')
            ->selectRaw('SUM(CASE WHEN tahap_risiko = "Sangat Tinggi" THEN 5 WHEN tahap_risiko = "Tinggi" THEN 4 WHEN tahap_risiko = "Sederhana" THEN 3 WHEN tahap_risiko = "Rendah" THEN 2 ELSE 1 END) as total_skor');
        
        if ($agensi_id) {
            $highestRiskByAssetTypeQuery->where('daftar_risikos.agensi_id', $agensi_id);
        }
        
        $highestRiskByAssetType = $highestRiskByAssetTypeQuery
            ->groupBy('jenis_asets.id', 'jenis_asets.nama')
            ->orderByDesc('total_skor')
            ->get();
        
        $csv = "Jenis Aset,Total Risiko,Skor Risiko\n";
        foreach ($highestRiskByAssetType as $row) {
            $csv .= "\"{$row->nama}\",{$row->total_risiko},{$row->total_skor}\n";
        }
        
        return $csv;
    }

    public function exportDetailCsv($agensi_id = null)
    {
        // Get all data, filtered by agency if provided
        $query = DaftarRisiko::with(['agensi', 'aset', 'risiko']);
        if ($agensi_id) {
            $query->where('agensi_id', $agensi_id);
        }
        $items = $query->latest()->get();
        
        $csv = "Agensi,Aset,Risiko,Impak,Kebarangkalian,Skor Risiko,Tahap Risiko\n";
        foreach ($items as $item) {
            $csv .= "\"{$item->agensi?->nama_agensi}\",\"{$item->aset?->nama_aset}\",\"{$item->risiko?->nama}\",{$item->impak},{$item->kebarangkalian},{$item->skor_risiko},\"{$item->tahap_risiko}\"\n";
        }
        
        return $csv;
    }
}

