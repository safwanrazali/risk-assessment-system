@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard Admin</h4>
                    <div class="btn-group">
                        <a href="{{ route('admin.daftar_risiko.create') }}" class="btn btn-primary">Daftar Risiko</a>
                        <a href="{{ route('admin.laporan.risiko') }}" class="btn btn-outline-primary">Laporan</a>
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
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="badge bg-primary mb-2">Jumlah Risiko</div>
                        <h2 class="mb-0">{{ $stats['jumlah_risiko'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="badge bg-success mb-2">Jumlah Agensi</div>
                        <h2 class="mb-0">{{ $stats['jumlah_agensi'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="badge bg-info mb-2">Jumlah Sektor</div>
                        <h2 class="mb-0">{{ $stats['jumlah_sektor'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="badge bg-warning text-dark mb-2">Jenis Risiko</div>
                        <h2 class="mb-0">{{ $stats['jenis_risiko'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Pengurusan Pengguna</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Taburan Tahap Risiko</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="riskLevelsChart" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Agensi dengan Risiko Tinggi (Top 10)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="highRiskAgenciesChart" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Function to get text color based on current theme
                                function getThemeColors() {
                                    var theme = document.documentElement.getAttribute('data-bs-theme') || 'light';
                                    return {
                                        textColor: theme === 'dark' ? '#f8f9fa' : '#212529',
                                        axisLineColor: theme === 'dark' ? '#444' : '#ccc',
                                        tooltipBg: theme === 'dark' ? '#2a2a2a' : '#fff'
                                    };
                                }

                                // 3D Pie Chart for Risk Levels
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

                                var riskChart = echarts.init(document.getElementById('riskLevelsChart'));
                                var themeColors = getThemeColors();
                                var riskOption = {
                                    tooltip: {
                                        trigger: 'item',
                                        backgroundColor: themeColors.tooltipBg,
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

                                // 3D Bar Chart for Agencies with High Risk
                                var agencyData = @json($highRiskAgencies ?? []);
                                var aLabels = agencyData.map(x => x.name);
                                var aValues = agencyData.map(x => x.total);

                                var agencyChart = echarts.init(document.getElementById('highRiskAgenciesChart'));
                                var agencyOption = {
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        },
                                        backgroundColor: themeColors.tooltipBg,
                                        borderColor: themeColors.textColor,
                                        textStyle: {
                                            color: themeColors.textColor
                                        }
                                    },
                                    grid: {
                                        left: 150,
                                        right: 30,
                                        bottom: 30,
                                        top: 30,
                                        containLabel: true
                                    },
                                    xAxis: {
                                        type: 'value',
                                        boundaryGap: [0, 0.01],
                                        axisLine: {
                                            lineStyle: {
                                                color: themeColors.axisLineColor
                                            }
                                        },
                                        axisLabel: {
                                            color: themeColors.textColor
                                        },
                                        splitLine: {
                                            lineStyle: {
                                                color: themeColors.axisLineColor
                                            }
                                        }
                                    },
                                    yAxis: {
                                        type: 'category',
                                        data: aLabels,
                                        axisLine: {
                                            lineStyle: {
                                                color: themeColors.axisLineColor
                                            }
                                        },
                                        axisLabel: {
                                            color: themeColors.textColor
                                        }
                                    },
                                    series: [{
                                        name: 'Bilangan Risiko Tinggi',
                                        type: 'bar',
                                        data: aValues,
                                        itemStyle: {
                                            color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [
                                                { offset: 0, color: '#dc3545' },
                                                { offset: 1, color: '#ff6b7a' }
                                            ]),
                                            borderRadius: [0, 8, 8, 0]
                                        },
                                        label: {
                                            show: true,
                                            position: 'right',
                                            color: themeColors.textColor
                                        }
                                    }]
                                };
                                agencyChart.setOption(agencyOption);

                                // Handle window resize
                                window.addEventListener('resize', function() {
                                    riskChart.resize();
                                    agencyChart.resize();
                                });

                                // Handle theme changes
                                var themeObserver = new MutationObserver(function(mutations) {
                                    mutations.forEach(function(mutation) {
                                        if (mutation.attributeName === 'data-bs-theme') {
                                            themeColors = getThemeColors();
                                            
                                            // Update risk chart
                                            riskOption.legend.textStyle.color = themeColors.textColor;
                                            riskOption.tooltip.textStyle.color = themeColors.textColor;
                                            riskOption.tooltip.backgroundColor = themeColors.tooltipBg;
                                            riskOption.tooltip.borderColor = themeColors.textColor;
                                            riskChart.setOption(riskOption);
                                            
                                            // Update agency chart
                                            agencyOption.tooltip.textStyle.color = themeColors.textColor;
                                            agencyOption.tooltip.backgroundColor = themeColors.tooltipBg;
                                            agencyOption.tooltip.borderColor = themeColors.textColor;
                                            agencyOption.xAxis.axisLabel.color = themeColors.textColor;
                                            agencyOption.xAxis.axisLine.lineStyle.color = themeColors.axisLineColor;
                                            agencyOption.xAxis.splitLine.lineStyle.color = themeColors.axisLineColor;
                                            agencyOption.yAxis.axisLabel.color = themeColors.textColor;
                                            agencyOption.yAxis.axisLine.lineStyle.color = themeColors.axisLineColor;
                                            agencyOption.series[0].label.color = themeColors.textColor;
                                            agencyChart.setOption(agencyOption);
                                        }
                                    });
                                });

                                themeObserver.observe(document.documentElement, {
                                    attributes: true,
                                    attributeFilter: ['data-bs-theme']
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
@endsection
