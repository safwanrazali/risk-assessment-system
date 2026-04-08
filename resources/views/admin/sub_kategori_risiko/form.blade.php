@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $subKategori->exists ? 'Edit Subkategori Risiko' : 'Tambah Subkategori Risiko' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $subKategori->exists ? route('admin.sub_kategori_risiko.update', $subKategori) : route('admin.sub_kategori_risiko.store') }}">
            @csrf
            @if($subKategori->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_id', $subKategori->kategori_id) == $kategori->id)>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $subKategori->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.sub_kategori_risiko.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
