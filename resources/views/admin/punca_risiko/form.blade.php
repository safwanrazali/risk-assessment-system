@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $punca->exists ? 'Edit Punca Risiko' : 'Tambah Punca Risiko' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $punca->exists ? route('admin.punca_risiko.update', $punca) : route('admin.punca_risiko.store') }}">
            @csrf
            @if($punca->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Kategori Punca Risiko</label>
                <select name="kategori_punca_risiko_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_punca_risiko_id', $punca->kategori_punca_risiko_id) == $kategori->id)>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_punca_risiko_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $punca->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.punca_risiko.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
