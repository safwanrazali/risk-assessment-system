@php
    $role = auth()->check() ? auth()->user()->peranan : null;
@endphp
<nav>
    @auth
        @if ($role === 'admin')
            <div class="small text-uppercase text-muted mb-2">Admin</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.dashboard')) active @endif"
                    href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
            </div>
            <div class="small text-uppercase text-muted mt-3 mb-2">Pengurusan Risiko</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.daftar_risiko.*')) active @endif"
                    href="{{ route('admin.daftar_risiko.index') }}"><i class="bi bi-list-check"></i> <span>Senarai
                        Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.laporan.risiko')) active @endif"
                    href="{{ route('admin.laporan.risiko') }}"><i class="bi bi-graph-up"></i> <span>Laporan
                        Risiko</span></a>
            </div>
            <div class="small text-uppercase text-muted mt-3 mb-2">Pengurusan Pengguna</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.pengguna.create')) active @endif"
                    href="{{ route('admin.pengguna.create') }}"><i class="bi bi-person-plus"></i> <span>Daftar
                        Pengguna</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.pengguna.index')) active @endif"
                    href="{{ route('admin.pengguna.index') }}"><i class="bi bi-people"></i> <span>Senarai
                        Pengguna</span></a>
            </div>
            <div class="small text-uppercase text-muted mt-3 mb-2">Pengurusan Data</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.sektor.*')) active @endif"
                    href="{{ route('admin.sektor.index') }}"><i class="bi bi-diagram-3"></i> <span>Sektor</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.agensi.*')) active @endif"
                    href="{{ route('admin.agensi.index') }}"><i class="bi bi-building"></i> <span>Agensi</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.jenis_aset.*')) active @endif"
                    href="{{ route('admin.jenis_aset.index') }}"><i class="bi bi-box-seam"></i> <span>Jenis Aset</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.kategori_risiko.*')) active @endif"
                    href="{{ route('admin.kategori_risiko.index') }}"><i class="bi bi-tags"></i> <span>Kategori
                        Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.sub_kategori_risiko.*')) active @endif"
                    href="{{ route('admin.sub_kategori_risiko.index') }}"><i class="bi bi-tag"></i> <span>Subkategori
                        Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.risiko.*')) active @endif"
                    href="{{ route('admin.risiko.index') }}"><i class="bi bi-exclamation-diamond"></i>
                    <span>Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.kategori_punca_risiko.*')) active @endif"
                    href="{{ route('admin.kategori_punca_risiko.index') }}"><i class="bi bi-diagram-2"></i> <span>Kategori
                        Punca Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('admin.punca_risiko.*')) active @endif"
                    href="{{ route('admin.punca_risiko.index') }}"><i class="bi bi-sign-turn-right"></i> <span>Punca
                        Risiko</span></a>
            </div>
        @elseif($role === 'agensi')
            <div class="small text-uppercase text-muted mb-2">Agensi</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('agensi.dashboard')) active @endif"
                    href="{{ route('agensi.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
            </div>
            <div class="small text-uppercase text-muted mt-3 mb-2">Pengurusan Risiko</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('agensi.daftar_risiko.*')) active @endif"
                    href="{{ route('agensi.daftar_risiko.index') }}"><i class="bi bi-list-check"></i> <span>Senarai
                        Risiko</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('agensi.laporan.risiko')) active @endif"
                    href="{{ route('agensi.laporan.risiko') }}"><i class="bi bi-graph-up"></i> <span>Laporan
                        Risiko</span></a>
            </div>
            <div class="small text-uppercase text-muted mt-3 mb-2">Pengurusan Pengguna</div>
            <div class="list-group">
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('agensi.pengguna.create')) active @endif"
                    href="{{ route('agensi.pengguna.create') }}"><i class="bi bi-person-plus"></i> <span>Daftar
                        Pengguna</span></a>
                <a class="list-group-item list-group-item-action d-flex align-items-center gap-2 @if (request()->routeIs('agensi.pengguna.index')) active @endif"
                    href="{{ route('agensi.pengguna.index') }}"><i class="bi bi-people"></i> <span>Senarai
                        Pengguna</span></a>
            </div>
        @endif
    @else
        <div class="list-group">
            <a class="list-group-item list-group-item-action d-flex align-items-center gap-2"
                href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> <span>Log Masuk</span></a>
        </div>
    @endauth
</nav>
