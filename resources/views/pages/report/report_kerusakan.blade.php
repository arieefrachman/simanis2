@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Laporan Kerusakan Alat</h1>
    <p class="mb-4">Laporan Kerusakan Alat</p>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Laporan Kerusakan Alat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Alat</th>
                                <th>Serial Number</th>
                                <th>Kondisi</th>
                                <th>Tanggal Kerusakan</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Nilai MMEL</th>
                                <th>Biaya Perbaikan</th>
                                <th>Tahun Pengadaan</th>
                                <th>Tipe</th>
                                <th>Ruangan</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Alat</th>
                                <th>Serial Number</th>
                                <th>Kondisi</th>
                                <th>Tanggal Kerusakan</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Nilai MMEL</th>
                                <th>Biaya Perbaikan</th>
                                <th>Tahun Pengadaan</th>
                                <th>Tipe</th>
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
                    url: `table/report/kerusakan`,
                    type: 'GET'
                },
                columns: [
                    {data: 'alat', name: 'alat'},
                    {data: 'serial_number', name: 'serial_number'},
                    {data: 'status_alat_label', name: 'status_alat_label'},
                    {data: 'tanggal_kerusakan', name: 'tanggal_kerusakan'},
                    {data: 'tanggal_perbaikan', name: 'tanggal_perbaikan'},
                    {data: 'mmel', name: 'mmel', width: '150px'},
                    {data: 'biaya_perbaikan', name: 'biaya_perbaikan', width: '150px'},
                    {data: 'tahun_pengadaan', name: 'tahun_pengadaan', width: '150px'},
                    {data: 'type', name: 'type', width: '150px'},
                    {data: 'ruangan', name: 'ruangan', width: '200px'},
                ],
                rowGroup: {
                    dataSrc: 'ruangan'
                },
                order: [[9, 'asc']],
            });
        });
    </script>
@stop

