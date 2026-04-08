@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $aset->exists ? 'Edit Aset' : 'Tambah Aset' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $aset->exists ? route('admin.aset.update', $aset) : route('admin.aset.store') }}">
            @csrf
            @if($aset->exists)
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Agensi</label>
                    <select name="agensi_id" class="form-select" required>
                        <option value="">-- Pilih Agensi --</option>
                        @foreach($agensis as $agensi)
                            <option value="{{ $agensi->id }}" @selected(old('agensi_id', $aset->agensi_id) == $agensi->id)>{{ $agensi->nama_agensi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Aset</label>
                    <select name="jenis_aset_id" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenisAsets as $jenis)
                            <option value="{{ $jenis->id }}" @selected(old('jenis_aset_id', $aset->jenis_aset_id) == $jenis->id)>{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Aset</label>
                    <input type="text" name="nama_aset" value="{{ old('nama_aset', $aset->nama_aset) }}" class="form-control" required>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.aset.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
