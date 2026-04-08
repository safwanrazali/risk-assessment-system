@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $daftar->exists ? 'Edit Daftar Risiko' : 'Daftar Risiko Baharu' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ $daftar->exists ? route('agensi.daftar_risiko.update', $daftar) : route('agensi.daftar_risiko.store') }}">
            @csrf
            @if($daftar->exists)
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Agensi</label>
                    <select name="agensi_id" class="form-select" required>
                        <option value="">-- Pilih Agensi --</option>
                        @foreach($agensis as $agensi)
                            <option value="{{ $agensi->id }}" @selected(old('agensi_id', $daftar->agensi_id) == $agensi->id)>{{ $agensi->nama_agensi }}</option>
                        @endforeach
                    </select>
                    @error('agensi_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Aset</label>
                    <select name="aset_id" class="form-select" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach($asets as $aset)
                            <option value="{{ $aset->id }}" @selected(old('aset_id', $daftar->aset_id) == $aset->id)>{{ $aset->nama_aset }}</option>
                        @endforeach
                    </select>
                    @error('aset_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kategori Risiko</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected(old('kategori_id', $daftar->kategori_id) == $kategori->id)>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subkategori Risiko</label>
                    <select name="sub_kategori_id" class="form-select" required>
                        <option value="">-- Pilih Subkategori --</option>
                        @foreach($subKategoris as $sub)
                            <option value="{{ $sub->id }}" @selected(old('sub_kategori_id', $daftar->sub_kategori_id) == $sub->id)>{{ $sub->nama }}</option>
                        @endforeach
                    </select>
                    @error('sub_kategori_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Risiko</label>
                    <select name="risiko_id" class="form-select" required>
                        <option value="">-- Pilih Risiko --</option>
                        @foreach($risikos as $r)
                            <option value="{{ $r->id }}" @selected(old('risiko_id', $daftar->risiko_id) == $r->id)>{{ $r->nama }}</option>
                        @endforeach
                    </select>
                    @error('risiko_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kategori Punca Risiko</label>
                    <select name="kategori_punca_risiko_id" class="form-select" required>
                        <option value="">-- Pilih Kategori Punca --</option>
                        @foreach($kategoriPunca as $kp)
                            <option value="{{ $kp->id }}" @selected(old('kategori_punca_risiko_id', $daftar->kategori_punca_risiko_id) == $kp->id)>{{ $kp->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_punca_risiko_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Punca Risiko</label>
                    <select name="punca_risiko_id" class="form-select" required>
                        <option value="">-- Pilih Punca Risiko --</option>
                        @foreach($puncaRisikos as $punca)
                            <option value="{{ $punca->id }}" @selected(old('punca_risiko_id', $daftar->punca_risiko_id) == $punca->id)>{{ $punca->nama }}</option>
                        @endforeach
                    </select>
                    @error('punca_risiko_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Impak (1-5)</label>
                    <input type="number" min="1" max="5" name="impak" value="{{ old('impak', $daftar->impak) }}" class="form-control" required>
                    @error('impak')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kebarangkalian (1-5)</label>
                    <input type="number" min="1" max="5" name="kebarangkalian" value="{{ old('kebarangkalian', $daftar->kebarangkalian) }}" class="form-control" required>
                    @error('kebarangkalian')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kawalan Sedia Ada</label>
                    <textarea name="kawalan_sedia_ada" class="form-control" rows="3">{{ old('kawalan_sedia_ada', $daftar->kawalan_sedia_ada) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pelan Mitigasi</label>
                    <textarea name="pelan_mitigasi" class="form-control" rows="3">{{ old('pelan_mitigasi', $daftar->pelan_mitigasi) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pemilik Risiko</label>
                    <input type="text" name="pemilik_risiko" value="{{ old('pemilik_risiko', $daftar->pemilik_risiko) }}" class="form-control">
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('agensi.daftar_risiko.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
