@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>--}}
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Alat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_alat_card">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Baik</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="total_baik_card">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Wajib Kalibrasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_wajibkalibrasi_card">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rusak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_rusak_card">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heart-broken fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktifitas Inspeksi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="inspection_activity"></canvas>
                    {{--<canvas id="myAreaChart" width="1244" height="640" class="chartjs-render-monitor" style="display: block; height: 320px; width: 622px;"></canvas>--}}

                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktifitas Kalibrasi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{--<canvas id="myAreaChart" width="1244" height="640" class="chartjs-render-monitor" style="display: block; height: 320px; width: 622px;"></canvas>--}}
                    <canvas id="calibration_activity"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total alat berdasarkan tipe inspeksi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        {{--<canvas id="myAreaChart" width="1244" height="640" class="chartjs-render-monitor" style="display: block; height: 320px; width: 622px;"></canvas>--}}
                        <canvas id="total_inspeksi_canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Alat Kalibrasi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="total_kalibrasi_canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(() => {
            $.ajax({
                url: `home/total/alat`,
                method: `GET`,
                async: true,
                success: res => {
                    $('#total_alat_card').html(res.value);
                }
            });

            $.ajax({
                url: `home/total/baik`,
                method: `GET`,
                async: true,
                success: res => {
                    $('#total_baik_card').html(res.value);
                }
            });

            $.ajax({
                url: `home/total/wajib-kalibrasi`,
                method: `GET`,
                async: true,
                success: res => {
                    $('#total_wajibkalibrasi_card').html(res.value);
                }
            });

            $.ajax({
                url: `home/total/rusak`,
                method: `GET`,
                async: true,
                success: res => {
                    $('#total_rusak_card').html(res.value);
                }
            });

            $.ajax({
                url: `home/chart/inspection-act`,
                method: 'GET',
                success: res => {
                    const inspection_activity = document.getElementById('inspection_activity').getContext('2d');
                    const c = new Chart(inspection_activity, {
                        type: 'bar',
                        data: {
                            labels: ['Total Alat', 'Belum Inspeksi', 'Baik', 'Rusak'],
                            datasets: [{
                                label: '',
                                data: [res.total, res.eval, res.good, res.bad],
                                backgroundColor: [
                                    'rgba(29,162,216, 0.2)',
                                    'rgba(170, 170, 170, 0.2)',
                                    'rgba(165,255,165, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(29,162,216, 1)',
                                    'rgba(170, 170, 170, 1)',
                                    'rgba(165,255,165, 1)',
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options:{
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display:false
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display:false
                                    },
                                    ticks:{
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: `home/chart/calibration-act`,
                method: 'GET',
                success: res => {
                    const calibration_activity = document.getElementById('calibration_activity').getContext('2d');
                    const c = new Chart(calibration_activity, {
                        type: 'bar',
                        data: {
                            labels: ['Total Alat', 'Belum Kalibrasi', 'Laik', 'Tidak Laik'],
                            datasets: [{
                                label: '',
                                data: [res.total, res.eval, res.good, res.bad],
                                backgroundColor: [
                                    'rgba(29,162,216, 0.2)',
                                    'rgba(170, 170, 170, 0.2)',
                                    'rgba(165,255,165, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(29,162,216, 1)',
                                    'rgba(170, 170, 170, 1)',
                                    'rgba(165,255,165, 1)',
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options:{
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display:false
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display:false
                                    },
                                    ticks:{
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: `home/total/alat/inspeksi`,
                method: 'GET',
                success: res => {
                    let labels = [], values = [], colors = [];

                    $.each(res, (k, v) => {
                        labels.push(v.frek_inspeksi);
                        values.push(v.count);
                        colors.push("#" + Math.random().toString(16).slice(2, 8));
                    });

                    const total_inspeksi_canvas = document.getElementById('total_inspeksi_canvas').getContext('2d');
                    const chart = new Chart(total_inspeksi_canvas, {
                        type: 'pie',
                        data: {
                            labels : labels,
                            datasets: [{
                                label: 'My First dataset',
                                backgroundColor: colors,
                                //borderColor: 'rgb(255, 99, 132)',
                                data: values
                            }]
                        }
                    });
                }
            });

            $.ajax({
                url: `home/total/alat/kalibrasi`,
                method: 'GET',
                success: res => {
                    let labels = [], values = [], colors = [];

                    $.each(res, (k, v) => {
                        labels.push(v.frek_kalibrasi);
                        values.push(v.count);
                        colors.push("#" + Math.random().toString(16).slice(2, 8));
                    });

                    const total_kalibrasi_canvas = document.getElementById('total_kalibrasi_canvas').getContext('2d');
                    const chart = new Chart(total_kalibrasi_canvas, {
                        type: 'pie',
                        data: {
                            labels : labels,
                            datasets: [{
                                label: 'My First dataset',
                                backgroundColor: colors,
                                //borderColor: 'rgb(255, 99, 132)',
                                data: values
                            }]
                        }
                    });
                }
            });
        });
    </script>
@stop
