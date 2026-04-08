@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $agensi->exists ? 'Edit Agensi' : 'Tambah Agensi' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $agensi->exists ? route('admin.agensi.update', $agensi) : route('admin.agensi.store') }}">
            @csrf
            @if($agensi->exists)
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Agensi</label>
                    <input type="text" name="nama_agensi" value="{{ old('nama_agensi', $agensi->nama_agensi) }}" class="form-control" required>
                    @error('nama_agensi')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sektor</label>
                    <select name="sektor_id" class="form-select" required>
                        <option value="">-- Pilih Sektor --</option>
                        @foreach($sektors as $sektor)
                            <option value="{{ $sektor->id }}" @selected(old('sektor_id', $agensi->sektor_id) == $sektor->id)>{{ $sektor->nama }}</option>
                        @endforeach
                    </select>
                    @error('sektor_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Tel Agensi</label>
                    <input type="text" name="no_tel_agensi" value="{{ old('no_tel_agensi', $agensi->no_tel_agensi) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" value="{{ old('website', $agensi->website) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama PIC</label>
                    <input type="text" name="nama_pic" value="{{ old('nama_pic', $agensi->nama_pic) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">No. Tel PIC</label>
                    <input type="text" name="no_tel_pic" value="{{ old('no_tel_pic', $agensi->no_tel_pic) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Emel PIC</label>
                    <input type="email" name="emel_pic" value="{{ old('emel_pic', $agensi->emel_pic) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Agensi</label>
                    <input type="text" name="jenis_agensi" value="{{ old('jenis_agensi', $agensi->jenis_agensi) }}" class="form-control">
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.agensi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
