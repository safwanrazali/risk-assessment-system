@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Senarai Risiko</h5>
    <a href="{{ route('admin.daftar_risiko.create') }}" class="btn btn-primary">Daftar Risiko</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Agensi</th>
                        <th>Aset</th>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Risiko</th>
                        <th>Impak</th>
                        <th>Kebarangkalian</th>
                        <th>Skor</th>
                        <th>Tahap</th>
                        <th class="text-end">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->agensi->nama_agensi }}</td>
                            <td>{{ $item->aset->nama_aset }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>{{ $item->subKategori->nama }}</td>
                            <td>{{ $item->risiko->nama }}</td>
                            <td>{{ $item->impak }}</td>
                            <td>{{ $item->kebarangkalian }}</td>
                            <td><span class="badge bg-primary">{{ $item->skor_risiko }}</span></td>
                            <td><span class="badge bg-info">{{ $item->tahap_risiko }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('admin.daftar_risiko.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('admin.daftar_risiko.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Padam rekod ini?')">Padam</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Tiada rekod.</td>
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
