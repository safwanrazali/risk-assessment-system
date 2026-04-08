@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Senarai Pengguna</h5>
    <a href="{{ route(app()->request->routeIs('admin.*') ? 'admin.pengguna.create' : 'agensi.pengguna.create') }}" class="btn btn-primary">Daftar Pengguna</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Emel</th>
                        <th>Peranan</th>
                        <th>Agensi</th>
                        <th class="text-end">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->peranan }}</td>
                            <td>{{ $item->agensi?->nama_agensi }}</td>
                            <td class="text-end">
                                <a href="{{ route(app()->request->routeIs('admin.*') ? 'admin.pengguna.edit' : 'agensi.pengguna.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route(app()->request->routeIs('admin.*') ? 'admin.pengguna.destroy' : 'agensi.pengguna.destroy', $item) }}" method="POST" class="d-inline">
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
