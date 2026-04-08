@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Agensi</h5>
    <a href="{{ route('admin.agensi.create') }}" class="btn btn-primary">Tambah Agensi</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Agensi</th>
                        <th>Sektor</th>
                        <th>Website</th>
                        <th class="text-end">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_agensi }}</td>
                            <td>{{ $item->sektor->nama }}</td>
                            <td><a href="{{ $item->website }}" target="_blank">{{ $item->website }}</a></td>
                            <td class="text-end">
                                <a href="{{ route('admin.agensi.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('admin.agensi.destroy', $item) }}" method="POST" class="d-inline">
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
