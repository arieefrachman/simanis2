@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Alat</h1>
    <p class="mb-4">Data tentang Alat yang tersedia</p>
    <div class="row">
        <div class="col-md-4">
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
                        <button href="#" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search"></i>
                                        </span>
                            <span class="text">Cari</span>
                        </button>
                        <button type="button" class="btn btn-success btn-icon-split" onclick="openFormModal()">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                            <span class="text">Tambah</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Alat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Type</th>
                                <th>Tahun Pengadaan</th>
                                <th>Harga</th>
                                <th>Frekuensi Kalibrasi</th>
                                <th>Frekuensi Inspeksi</th>
                                <th>Usia Teknis</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.alat.form')
    @include('pages.alat.form-edit')
@stop

@section('script')
    <script>
        let table = $('#t-alat').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 6,
            scrollX: true,
            ajax: {
                url: `table/alat`,
                type: 'GET'
            },
            columns: [
                {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'nama', width: "200px"},
                {data: 'type', name: 'type', width: "100px"},
                {data: 'tahun_pengadaan', name: 'tahun_pengadaan', width: "100px"},
                {data: 'harga_formatted', name: 'harga_formatted', width: "250px"},
                {data: 'frek_kalibrasi', name: 'frek_kalibrasi'},
                {data: 'frek_inspeksi', name: 'frek_inspeksi'},
                {data: 'usia_teknis', name: 'usia_teknis'},
                {data: 'action', name: 'action'},
            ],
        });
        $(document).ready(() => {


            $('.money').mask('000.000.000.000.000.000', {reverse: true});

            $(`#btn-simpan-modal`).click(() => {
                let formData = new FormData($('#modalForm')[0]);
                addDataModal('alat', table, formData);
            });

            $(`#btn-update-modal`).click(() => {
                let formData = new FormData($('#modalFormEdit')[0]);
                editDataModal('rest/alat/update', table, formData);
            });
        });

        const hapus = (id) => {
            $.LoadingOverlay("show");
            $.ajax({
                url: `alat/${id}`,
                method: 'GET',
                success: (res) => {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: `${res.nama}`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batalkan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.LoadingOverlay("show");
                            $.ajax({
                                url: `rest/alat/delete/${id}`,
                                method: 'POST',
                                statusCode:{
                                    500: (err) => {
                                        let errMsg = JSON.parse(err.responseText);
                                        $.LoadingOverlay("hide");
                                        Swal.fire({
                                            icon: 'error',
                                            title: `${errMsg.message}`,
                                        });
                                    },
                                    409: (err) => {
                                        let errMsg = JSON.parse(err.responseText);
                                        $.LoadingOverlay("hide");
                                        Swal.fire({
                                            icon: 'warning',
                                            title: `Gagal menghapus`,
                                            text: `${errMsg.message}`
                                        });
                                    }
                                },
                                success: (res) => {
                                    $.LoadingOverlay("hide");
                                    Swal.fire(
                                        'Deleted!',
                                        'Data telah dihapus',
                                        'success'
                                    );
                                    table.ajax.reload();
                                }
                            });
                        }
                    });
                    $.LoadingOverlay("hide");
                }
            });
        };

        const edit = (id) => {
            $.LoadingOverlay("show");
            $.ajax({
                url: `alat/${id}`,
                method: 'GET',
                success: (res) => {

                    $("#edit-kode").val(res.kode);
                    $('#edit-nama_alat').val(res.nama);
                    $('#edit-type').val(res.type);
                    $('#edit-thn_pengadaan').val(res.tahun_pengadaan);
                    $('#edit-harga').val(res.harga);
                    $('#edit-usia_teknis').val(res.usia_teknis);
                    $('#edit-frek_inspeksi').val(res.frek_inspeksi);
                    $('#edit-frek_kalibrasi').val(res.frek_kalibrasi);
                    $('#id').val(res.id);
                    $.LoadingOverlay("hide");
                }
            });
            $('#formModalEdit').modal({backdrop: 'static', keyboard: false});
        }
    </script>
@stop

