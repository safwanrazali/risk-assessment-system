@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $kategori->exists ? 'Edit Kategori Risiko' : 'Tambah Kategori Risiko' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $kategori->exists ? route('admin.kategori_risiko.update', $kategori) : route('admin.kategori_risiko.store') }}">
            @csrf
            @if($kategori->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kategori_risiko.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
