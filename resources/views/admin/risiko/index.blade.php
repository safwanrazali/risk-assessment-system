@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Risiko</h5>
    <a href="{{ route('admin.risiko.create') }}" class="btn btn-primary">Tambah Risiko</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subkategori</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Tahap Risiko</th>
                        <th class="text-end">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->subKategoriRisiko->nama }}</td>
                            <td>{{ $item->subKategoriRisiko->kategori->nama }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @php
                                    $levels = $item->daftarRisikos()->distinct('tahap_risiko')->pluck('tahap_risiko')->unique()->toArray();
                                    $colorMap = [
                                        'Sangat Tinggi' => '#dc3545',
                                        'Tinggi' => '#fd7e14',
                                        'Sederhana' => '#ffc107',
                                        'Rendah' => '#198754',
                                        'Sangat Rendah' => '#0d6efd'
                                    ];
                                @endphp
                                @if(count($levels) > 0)
                                    @foreach($levels as $level)
                                        <span class="badge" style="background-color: {{ $colorMap[$level] ?? '#999' }}; color: {{ in_array($level, ['Sederhana']) ? '#000' : '#fff' }};">{{ $level }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.risiko.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('admin.risiko.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Padam rekod ini?')">Padam</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tiada rekod.</td>
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
</div>
@endsection
