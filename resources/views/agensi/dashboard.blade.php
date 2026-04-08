@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard Agensi</h4>
                    <div class="btn-group">
                        <a href="{{ route('agensi.daftar_risiko.create') }}" class="btn btn-primary">Daftar Risiko</a>
                        <a href="{{ route('agensi.laporan.risiko') }}" class="btn btn-outline-primary">Laporan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <div class="alert alert-primary d-flex align-items-center gap-2 mb-0">
                    {{-- <i class="bi bi-hand-thumbs-up-fill"></i> --}}
                    <span>🤙</span>
                    <span>{{ $greeting }}</span>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="badge bg-primary mb-2">Jumlah Risiko</div>
                        <h2 class="mb-0">{{ $jumlah_risiko }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Tindakan Pantas</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('agensi.daftar_risiko.index') }}"
                                class="list-group-item list-group-item-action">Senarai Risiko</a>
                            <a href="{{ route('agensi.laporan.risiko') }}"
                                class="list-group-item list-group-item-action">Laporan Risiko</a>
                            <a href="{{ route('agensi.pengguna.index') }}"
                                class="list-group-item list-group-item-action">Senarai Pengguna</a>
                            <a href="{{ route('agensi.pengguna.create') }}"
                                class="list-group-item list-group-item-action">Daftar Pengguna Baharu</a>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Taburan Tahap Risiko</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="agencyRiskLevelsChart" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var riskData = @json($riskLevels ?? []);
                            var labels = Object.keys(riskData);
                            var values = Object.values(riskData);
                            
                            // Color mapping for each risk level
                            var colorMap = {
                                'Sangat Tinggi': '#dc3545',
                                'Tinggi': '#fd7e14',
                                'Sederhana': '#ffc107',
                                'Rendah': '#198754',
                                'Sangat Rendah': '#0d6efd'
                            };
                            
                            var riskChartData = labels.map(function(label, index) {
                                return {
                                    value: values[index],
                                    name: label,
                                    itemStyle: {
                                        color: colorMap[label] || '#999'
                                    }
                                };
                            });

                            var riskChart = echarts.init(document.getElementById('agencyRiskLevelsChart'));
                            
                            // Function to get text color based on current theme
                            function getThemeColors() {
                                var theme = document.documentElement.getAttribute('data-bs-theme') || 'light';
                                return {
                                    textColor: theme === 'dark' ? '#f8f9fa' : '#212529'
                                };
                            }
                            
                            var themeColors = getThemeColors();
                            var riskOption = {
                                tooltip: {
                                    trigger: 'item',
                                    backgroundColor: themeColors.textColor === '#f8f9fa' ? '#2a2a2a' : '#fff',
                                    borderColor: themeColors.textColor,
                                    textStyle: {
                                        color: themeColors.textColor
                                    }
                                },
                                legend: {
                                    orient: 'horizontal',
                                    bottom: 10,
                                    data: labels,
                                    textStyle: {
                                        fontSize: 12,
                                        color: themeColors.textColor
                                    }
                                },
                                grid: {
                                    containLabel: true
                                },
                                series: [{
                                    name: 'Tahap Risiko',
                                    type: 'pie',
                                    radius: ['25%', '60%'],
                                    center: ['50%', '45%'],
                                    itemStyle: {
                                        borderRadius: 10,
                                        borderColor: '#000',
                                        borderWidth: 2
                                    },
                                    data: riskChartData,
                                    label: {
                                        show: false
                                    }
                                }]
                            };
                            riskChart.setOption(riskOption);

                            // Handle window resize
                            window.addEventListener('resize', function() {
                                riskChart.resize();
                            });

                            // Handle theme changes
                            var themeObserver = new MutationObserver(function(mutations) {
                                mutations.forEach(function(mutation) {
                                    if (mutation.attributeName === 'data-bs-theme') {
                                        themeColors = getThemeColors();
                                        riskOption.legend.textStyle.color = themeColors.textColor;
                                        riskOption.tooltip.textStyle.color = themeColors.textColor;
                                        riskOption.tooltip.backgroundColor = themeColors.textColor === '#f8f9fa' ? '#2a2a2a' : '#fff';
                                        riskOption.tooltip.borderColor = themeColors.textColor;
                                        riskChart.setOption(riskOption);
                                    }
                                });
                            });

                            themeObserver.observe(document.documentElement, {
                                attributes: true,
                                attributeFilter: ['data-bs-theme']
                            });
                        });
                    </script>
                @endsection
