@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $sektor->exists ? 'Edit Sektor' : 'Tambah Sektor' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $sektor->exists ? route('admin.sektor.update', $sektor) : route('admin.sektor.store') }}">
            @csrf
            @if($sektor->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $sektor->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.sektor.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
