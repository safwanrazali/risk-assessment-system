@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock"></i>
                    <h5 class="mb-0">Tukar Kata Laluan</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Anda perlu menukar kata laluan anda pada kali pertama log masuk untuk keselamatan akaun.
                    </div>

                    <form method="POST" action="{{ route('auth.change-password.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kata Laluan Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autofocus>
                            </div>
                            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                            <small class="form-text text-muted">Sekurang-kurangnya 8 aksara.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sahkan Kata Laluan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Tukar Kata Laluan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
