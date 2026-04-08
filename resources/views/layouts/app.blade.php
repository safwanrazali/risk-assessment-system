<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Penilaian Risiko Kuantum') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"
        crossorigin="anonymous">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
    <style>
        /* Theme-aware text colors */
        :root[data-bs-theme="light"] {
            --text-color: #212529;
            --navbar-bg: #f8f9fa;
            --navbar-text: #212529;
            --btn-outline-color: #212529;
        }
        :root[data-bs-theme="dark"] {
            --text-color: #f8f9fa;
            --navbar-bg: #212529;
            --navbar-text: #f8f9fa;
            --btn-outline-color: #f8f9fa;
        }

        body {
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar {
            background-color: var(--navbar-bg) !important;
            color: var(--navbar-text) !important;
        }

        .navbar .btn-outline-light {
            color: var(--btn-outline-color);
            border-color: var(--btn-outline-color);
        }

        .navbar .btn-outline-light:hover {
            background-color: var(--btn-outline-color);
            color: var(--navbar-bg);
        }

        .navbar-brand,
        .navbar-text {
            color: var(--navbar-text) !important;
        }

        #digitalClock {
            color: var(--btn-outline-color);
            border-color: var(--btn-outline-color);
        }

        .offcanvas {
            color: var(--text-color);
        }

        .offcanvas-header {
            color: var(--text-color);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .offcanvas-body {
            color: var(--text-color);
        }

        /* Ensure text is readable in dark mode */
        :root[data-bs-theme="dark"] .card {
            background-color: #1a1a1a;
            color: #f8f9fa;
            border-color: #333;
        }

        :root[data-bs-theme="dark"] .alert {
            background-color: #2a2a2a;
            border-color: #444;
        }

        :root[data-bs-theme="dark"] .form-control,
        :root[data-bs-theme="dark"] .form-select {
            background-color: #2a2a2a;
            color: #f8f9fa;
            border-color: #444;
        }

        :root[data-bs-theme="dark"] .btn-outline-secondary {
            color: #f8f9fa;
            border-color: #666;
        }

        :root[data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: #666;
            border-color: #666;
        }

        :root[data-bs-theme="dark"] h1,
        :root[data-bs-theme="dark"] h2,
        :root[data-bs-theme="dark"] h3,
        :root[data-bs-theme="dark"] h4,
        :root[data-bs-theme="dark"] h5,
        :root[data-bs-theme="dark"] h6 {
            color: #f8f9fa;
        }

        :root[data-bs-theme="dark"] .list-group-item {
            background-color: #2a2a2a;
            color: #f8f9fa;
            border-color: #444;
        }

        :root[data-bs-theme="dark"] .list-group-item:hover {
            background-color: #3a3a3a;
        }
    </style>
</head>

<body class="bg-body">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mainSidebar" aria-controls="mainSidebar" id="sidebarToggleBtn" aria-label="Menu">
                    <i class="bi bi-list" id="sidebarToggleIcon" aria-hidden="true"></i>
                </button>
                <a class="navbar-brand d-flex align-items-center gap-2"
                    href="{{ auth()->check() ? (auth()->user()->peranan === 'admin' ? route('admin.dashboard') : route('agensi.dashboard')) : route('login') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
                </a>
            </div>
            <!-- <div class="collapse navbar-collapse">
                <form class="ms-3 me-auto d-none d-md-flex" role="search" method="GET" action="#">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input class="form-control" type="search" placeholder="Cari..." aria-label="Cari">
                    </div>
                </form>
            </div> -->
            <div class="ms-auto d-flex align-items-center gap-2">
                <div class="btn btn-outline-light" type="button" id="digitalClock" style="font-family: 'Courier New', monospace; font-weight: bold; cursor: default;">
                    00:00:00
                </div>
                <button class="btn btn-outline-light" id="themeToggleBtn" type="button" >
                    <i class="bi bi-brightness-high-fill"></i>
                </button>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-right me-1"></i> Log Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Log Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start bg-body-tertiary" tabindex="-1" id="mainSidebar"
        aria-labelledby="mainSidebarLabel">
        <div class="offcanvas-header border-bottom d-flex align-items-center justify-content-between gap-2">
            <h5 class="offcanvas-title d-flex align-items-center gap-2" id="mainSidebarLabel">
                <i class="bi bi-list"></i> <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 50px;">
            </h5>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-3">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
    <main class="py-4">
        <div class="container">
            @include('partials.alerts')
            @yield('content')
        </div>
    </main>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        @if (session('success'))
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto"><i class="bi bi-check-circle-fill text-success me-1"></i> Berjaya</strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto"><i class="bi bi-exclamation-triangle-fill text-danger me-1"></i>
                        Ralat</strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('mainSidebar');
            var icon = document.getElementById('sidebarToggleIcon');
            sidebar.addEventListener('show.bs.offcanvas', function() {
                icon.className = 'bi bi-x-lg';
            });
            sidebar.addEventListener('hide.bs.offcanvas', function() {
                icon.className = 'bi bi-list';
            });
            sidebar.querySelectorAll('a.list-group-item').forEach(function(link) {
                link.addEventListener('click', function() {
                    var offcanvas = bootstrap.Offcanvas.getOrCreateInstance(sidebar);
                    offcanvas.hide();
                });
            });
            var themeToggleBtn = document.getElementById('themeToggleBtn');
            var currentTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', currentTheme);
            themeToggleBtn.addEventListener('click', function() {
                var theme = document.documentElement.getAttribute('data-bs-theme') === 'light' ? 'dark' :
                    'light';
                document.documentElement.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
            });
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            });
            document.querySelectorAll('.toast').forEach(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            });

            // Digital Clock in 24-hour format
            var digitalClock = document.getElementById('digitalClock');
            if (digitalClock) {
                function updateClock() {
                    var now = new Date();
                    var hours = String(now.getHours()).padStart(2, '0');
                    var minutes = String(now.getMinutes()).padStart(2, '0');
                    var seconds = String(now.getSeconds()).padStart(2, '0');
                    digitalClock.textContent = hours + ':' + minutes + ':' + seconds;
                }
                updateClock();
                setInterval(updateClock, 1000);
            }
        });
    </script>
</body>

</html>
