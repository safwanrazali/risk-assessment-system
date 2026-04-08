@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Laporan Risiko (Agensi)</h5>
    <div class="btn-group">
        <a href="{{ route('agensi.laporan.risiko.download-csv') }}" class="btn btn-success">
            <i class="bi bi-download me-1"></i> CSV
        </a>
        <a href="{{ route('agensi.laporan.risiko.download-pdf') }}" class="btn btn-danger">
            <i class="bi bi-download me-1"></i> PDF
        </a>
    </div>
</div>

<!-- Highest Risk by Agency -->
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Agensi dengan Risiko Tertinggi (Top 10)</h6>
        <div class="btn-group btn-group-sm">
            <a href="{{ route('agensi.laporan.risiko.download-agency-csv') }}" class="btn btn-success" title="Download CSV">
                <i class="bi bi-file-earmark-csv"></i>
            </a>
            <a href="{{ route('agensi.laporan.risiko.download-agency-pdf') }}" class="btn btn-danger" title="Download PDF">
                <i class="bi bi-file-earmark-pdf"></i>
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Agensi</th>
                        <th>Total Risiko</th>
                        <th>Risiko Tinggi/Sangat Tinggi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($highestRiskByAgency as $row)
                        <tr>
                            <td>{{ $row['nama_agensi'] }}</td>
                            <td><span class="badge bg-primary">{{ $row['total_risiko'] }}</span></td>
                            <td><span class="badge bg-danger">{{ $row['high_risk_count'] }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tiada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $highestRiskByAgency->links() }}
    </div>
</div>

<!-- Highest Risk by Asset Type -->
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Jenis Aset dengan Risiko Tertinggi (Top 10)</h6>
        <div class="btn-group btn-group-sm">
            <a href="{{ route('agensi.laporan.risiko.download-asset-csv') }}" class="btn btn-success" title="Download CSV">
                <i class="bi bi-file-earmark-csv"></i>
            </a>
            <a href="{{ route('agensi.laporan.risiko.download-asset-pdf') }}" class="btn btn-danger" title="Download PDF">
                <i class="bi bi-file-earmark-pdf"></i>
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Jenis Aset</th>
                        <th>Total Risiko</th>
                        <th>Skor Risiko</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($highestRiskByAssetType as $row)
                        <tr>
                            <td>{{ $row['nama'] }}</td>
                            <td><span class="badge bg-info">{{ $row['total_risiko'] }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $row['total_skor'] }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tiada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $highestRiskByAssetType->links() }}
    </div>
</div>

<!-- Detailed Risk Report -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Detail Risiko</h6>
        <div class="btn-group btn-group-sm">
            <a href="{{ route('agensi.laporan.risiko.download-detail-csv') }}" class="btn btn-success" title="Download CSV">
                <i class="bi bi-file-earmark-csv"></i>
            </a>
            <a href="{{ route('agensi.laporan.risiko.download-detail-pdf') }}" class="btn btn-danger" title="Download PDF">
                <i class="bi bi-file-earmark-pdf"></i>
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Agensi</th>
                        <th>Aset</th>
                        <th>Risiko</th>
                        <th>Skor</th>
                        <th>Tahap</th>
                        <th>Dikemas Kini</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->agensi?->nama_agensi }}</td>
                            <td>{{ $item->aset?->nama_aset }}</td>
                            <td>{{ $item->risiko?->nama }}</td>
                            <td><span class="badge bg-primary">{{ $item->skor_risiko }}</span></td>
                            <td>
                                @php
                                    $colorMap = [
                                        'Sangat Tinggi' => '#dc3545',
                                        'Tinggi' => '#fd7e14',
                                        'Sederhana' => '#ffc107',
                                        'Rendah' => '#198754',
                                        'Sangat Rendah' => '#0d6efd'
                                    ];
                                @endphp
                                <span class="badge" style="background-color: {{ $colorMap[$item->tahap_risiko] ?? '#999' }}; color: {{ $item->tahap_risiko === 'Sederhana' ? '#000' : '#fff' }};">{{ $item->tahap_risiko }}</span>
                            </td>
                            <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tiada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $items->links() }}
    </div>
</div>
@endsection
