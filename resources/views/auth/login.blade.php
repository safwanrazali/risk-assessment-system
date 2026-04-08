@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <h5 class="mb-0">Log Masuk</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Emel</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                            </div>
                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kata Laluan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" value="1" class="form-check-input" id="rememberCheck">
                            <label class="form-check-label" for="rememberCheck">Ingat saya</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-right-circle me-1"></i> Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
