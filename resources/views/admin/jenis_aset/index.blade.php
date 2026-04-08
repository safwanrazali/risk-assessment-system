@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Jenis Aset</h5>
    <a href="{{ route('admin.jenis_aset.create') }}" class="btn btn-primary">Tambah Jenis</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori Punca Risiko</th>
                        <th>Risiko Terkait</th>
                        <th class="text-end">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategoriPuncaRisiko?->nama }}</td>
                            <td>
                                @php
                                    $risikos = $item->asets()
                                        ->with('daftarRisikos.risiko')
                                        ->get()
                                        ->flatMap(function($aset) {
                                            return $aset->daftarRisikos->pluck('risiko.nama');
                                        })
                                        ->unique()
                                        ->values();
                                @endphp
                                @if($risikos->count() > 0)
                                    <small>
                                        {{ $risikos->take(3)->implode(', ') }}
                                        @if($risikos->count() > 3)
                                            <br><em>({{ $risikos->count() }} risiko)</em>
                                        @endif
                                    </small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.jenis_aset.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('admin.jenis_aset.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Padam rekod ini?')">Padam</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tiada rekod.</td>
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
