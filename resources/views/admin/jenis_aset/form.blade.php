@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $jenis->exists ? 'Edit Jenis Aset' : 'Tambah Jenis Aset' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $jenis->exists ? route('admin.jenis_aset.update', $jenis) : route('admin.jenis_aset.store') }}">
            @csrf
            @if($jenis->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $jenis->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori Punca Risiko</label>
                <select name="kategori_punca_risiko_id" class="form-select">
                    <option value="">-- Tiada --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_punca_risiko_id', $jenis->kategori_punca_risiko_id) == $kategori->id)>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.jenis_aset.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
