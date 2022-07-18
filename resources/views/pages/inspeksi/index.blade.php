@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Jadwal Inspeksi</h1>
    <p class="mb-4">Data tentang Jadwal Inspeksi</p>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                       placeholder="Alat..">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search"></i>
                                        </span>
                            <span class="text">Cari</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Jadwal Ruangan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Tanggal Inspeksi</th>
                                <th>Serial</th>
                                <th>Ruangan</th>
                                <th>Status</th>
                                <th>Nama Alat</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.inspeksi.inspeksi-form')
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
                    url: `table/inspeksi`,
                    type: 'GET'
                },
                columns: [
                    {data: 'tanggal_formatted', name: 'tanggal_formatted', width: '200px'},
                    {data: 'alat_ruangan.serial_number', name: 'alat_ruangan.serial_number'},
                    {data: 'alat_ruangan.ruangan.nama', name: 'alat_ruangan.ruangan.nama', width: '200px'},
                    {data: 'status', name: 'status'},
                    {data: 'concated_serial_alat', name: 'concated_serial_alat', width: '200px'},
                    {data: 'action', name: 'action'},
                ],
                rowGroup: {
                    dataSrc: 'concated_serial_alat'
                },
                order: [[4, 'asc']],
            });
            $(`#btn-simpan-modal`).click(() => {
                let formData = new FormData($('#modalForm')[0]);
                addDataModal('inspeksi/create/hasil', table, formData);
            });
        });

        const checkInspeksiForm = (id) => {
            $.LoadingOverlay("show");
            $.ajax({
                url: `inspeksi/${id}`,
                method: 'GET',
                success: res => {
                    $.LoadingOverlay("hide");
                    $('#jadwal_id').val(res.id);
                    $('#nama_alat').val(res.concated_serial_alat);
                    $('#tgl_inspeksi').val(res.tanggal_formatted);
                }
            });
            $('#formModal').modal({backdrop: 'static', keyboard: false});
        }
    </script>
@stop

