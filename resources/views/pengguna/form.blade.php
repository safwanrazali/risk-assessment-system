@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $pengguna->exists ? 'Edit Pengguna' : 'Daftar Pengguna' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $pengguna->exists ? route(app()->request->routeIs('admin.*') ? 'admin.pengguna.update' : 'agensi.pengguna.update', $pengguna) : route(app()->request->routeIs('admin.*') ? 'admin.pengguna.store' : 'agensi.pengguna.store') }}">
            @csrf
            @if($pengguna->exists)
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $pengguna->name) }}" class="form-control" required>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Emel</label>
                    <input type="email" name="email" value="{{ old('email', $pengguna->email) }}" class="form-control" required>
                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kata Laluan</label>
                    <input type="password" name="password" class="form-control" {{ $pengguna->exists ? '' : 'required' }}>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Peranan</label>
                    <select name="peranan" class="form-select" required>
                        <option value="admin" @selected(old('peranan', $pengguna->peranan) == 'admin')>Admin</option>
                        <option value="agensi" @selected(old('peranan', $pengguna->peranan) == 'agensi')>Agensi</option>
                    </select>
                    @error('peranan')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Agensi</label>
                    <select name="agensi_id" class="form-select">
                        <option value="">-- Tiada --</option>
                        @foreach($agensis as $agensi)
                            <option value="{{ $agensi->id }}" @selected(old('agensi_id', $pengguna->agensi_id) == $agensi->id)>{{ $agensi->nama_agensi }}</option>
                        @endforeach
                    </select>
                    @error('agensi_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route(app()->request->routeIs('admin.*') ? 'admin.pengguna.index' : 'agensi.pengguna.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
