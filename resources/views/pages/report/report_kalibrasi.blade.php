@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Laporan Kalibrasi Alat</h1>
    <p class="mb-4">Laporan Kalibrasi Alat</p>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Laporan Kalibrasi Alat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Alat</th>
                                <th>Serial Number</th>
                                <th>Biaya Kalibrasi</th>
                                <th>Ruangan</th>
                            </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Alat</th>
                                    <th>Serial Number</th>
                                    <th>Biaya Kalibrasi</th>
                                    <th>Ruangan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(document).ready(() => {
            let table = $('#t-alat').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: `table/report/kalibrasi`,
                    type: 'GET'
                },
                columns: [
                    {data: 'alat', name: 'alat'},
                    {data: 'serial_number', name: 'serial_number'},
                    {data: 'biaya_kalibrasi_label', name: 'biaya_kalibrasi_label'},
                    {data: 'ruangan', name: 'ruangan', width: '200px'},
                ],
                rowGroup: {
                    dataSrc: 'ruangan'
                },
                order: [[3, 'asc']],
            });
        });
    </script>
@stop

