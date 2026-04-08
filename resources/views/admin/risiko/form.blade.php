@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $risiko->exists ? 'Edit Risiko' : 'Tambah Risiko' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $risiko->exists ? route('admin.risiko.update', $risiko) : route('admin.risiko.store') }}">
            @csrf
            @if($risiko->exists)
                @method('PUT')
            @endif
            <div class="mb-3">
                <label class="form-label">Subkategori Risiko</label>
                <select name="sub_kategori_risiko_id" class="form-select" required>
                    <option value="">-- Pilih Subkategori --</option>
                    @foreach($subKategoris as $sub)
                        <option value="{{ $sub->id }}" @selected(old('sub_kategori_risiko_id', $risiko->sub_kategori_risiko_id) == $sub->id)>{{ $sub->nama }} ({{ $sub->kategori->nama }})</option>
                    @endforeach
                </select>
                @error('sub_kategori_risiko_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $risiko->nama) }}" class="form-control" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.risiko.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
