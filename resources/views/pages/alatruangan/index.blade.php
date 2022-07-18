@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Alat Ruangan</h1>
    <p class="mb-4">Data tentang Alat yang tersedia di masing-masing Ruangan</p>
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
                        {{--<div class="form-group row">
                            <div class="col-sm-12">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>Kategori...</option>
                                    <option value="1">Instalasi Laboratorium</option>
                                    <option value="2">Instalasi Radiologi</option>
                                </select>
                            </div>
                        </div>--}}
                        <button class="btn btn-primary btn-icon-split">
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Alat Ruangan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Nama Alat</th>
                                <th>Serial Number</th>
                                <th>Inspeksi Terakhir</th>
                                <th>Status Inspeksi Terakhir</th>
                                <th>Kalibrasi Terakhir</th>
                                <th>Status Kalibrasi Terakhir</th>
                                <th>Ruangan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.alatruangan.form')
    @include('pages.alatruangan.calibrate-form')
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
                    url: `table/alatruangan`,
                    type: 'GET'
                },
                columns: [
                    {data: 'alat.nama', name: 'alat.nama', width: '230px'},
                    {data: 'serial_number', name: 'serial_number'},
                    {data: 'last_inspection_formatted', name: 'last_inspection_formatted', width: '150px'},
                    {data: 'status_inspeksi', name: 'status_inspeksi', width: '150px'},
                    {data: 'last_calibration_formatted', name: 'last_calibration_formatted', width: '150px'},
                    {data: 'status_kalibrasi', name: 'status_kalibrasi', width: '150px'},
                    {data: 'ruangan.nama', name: 'ruangan.nama', width: '150px'},
                    {data: 'action', name: 'action', width: '150px'},
                ],
                rowGroup: {
                    dataSrc: 'ruangan.nama'
                },
                order: [[6, 'asc']],
            });

            $(`#btn-simpan-modal`).click(() => {
                let formData = new FormData($('#modalForm')[0]);
                addDataModal('alatruangan', table, formData);
            });

            $(`#btn-simpan-modal-kalibrasi`).click(() => {
                let modalForm = $('#modalFormCalibrate');
                let formData = new FormData(modalForm[0]);
                addDataModal(`alatruangan/create/schedule/calibration`, table, formData);
                $('#formModalCalibrate').modal('hide');
                modalForm.trigger("reset");
            });

            $.ajax({
                url: `rest/alat`,
                method: 'GET',
                success: (res) => {
                    let _items = "";
                    $.each(res, (k,v) => {
                        _items+= `<option value=${v.id}>${v.alat_label_ref}</option>`
                    });
                    $('#alat_id').html(_items).selectpicker('refresh');
                }
            });

            $.ajax({
                url: `rest/ruangan`,
                method: 'GET',
                success: (res) => {
                    let _items = "";
                    $.each(res, (k,v) => {
                        _items+= `<option value=${v.id}>${v.nama}</option>`
                    });
                    $('#ruangan_id').html(_items).selectpicker('refresh');
                }
            });
        });

        const inspection = (id) => {
            $.LoadingOverlay("show");
            $.ajax({
                url: `alatruangan/${id}`,
                method: 'GET',
                success: (res) => {
                    //const data = JSON.parse(res);
                    $.LoadingOverlay("hide");
                    Swal.fire({
                        title: 'Perhatian!',
                        html: `Apakah Anda yakin ingin membuat jadwal <b>INSPEKSI</b>? <br><br>alat: <h5><span class="badge badge-primary">${res.alat.nama}</span></h5>serial: <h5><span class="badge badge-primary">${res.serial_number}</span></h5>frekuensi: <h5><span class="badge badge-primary">${inspectionLabel(res.alat.frek_inspeksi)}</span></h5>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Buat Jadwal Inspeksi!',
                        cancelButtonText: 'Batalkan!'
                    }).then((result) => {
                        if (result.value) {
                            $.LoadingOverlay("show");
                            $.ajax({
                                url: `alatruangan/create/schedule/inspection/${id}`,
                                method: 'POST',
                                statusCode: {
                                    500: (err) => {
                                        $.LoadingOverlay("hide");
                                        console.log(err);
                                        Swal.fire(
                                            'Error!',
                                            'Terjadi kesalahan, silahkan hubungi Admin!',
                                            'error'
                                        );

                                    }
                                },
                                success: res => {
                                    $.LoadingOverlay("hide");
                                    Swal.fire(
                                        'Tersimpan!',
                                        'Jadwal inspeksi telah dibuat!',
                                        'success'
                                    );
                                    $('#t-alat').DataTable().ajax.reload();
                                }
                            });
                        }
                    })
                }
            });
        };

        const calibrate = (id) => {
            $.LoadingOverlay("show");
            $.ajax({
                url: `alatruangan/${id}`,
                method: 'GET',
                success: (res) => {
                    console.log(res);
                    $.LoadingOverlay("hide");
                    $('#formModalCalibrate').modal({backdrop: 'static', keyboard: false});
                    $("#nama_alat").val(res.alat.nama);
                    $("#alat_ruangan_id").val(res.id);
                    $("#frek_kalibrasi_val").val(res.alat.frek_kalibrasi);
                    $("#serial_number").val(res.serial_number);
                    $("#frek_kalibrasi").val(res.alat.frek_kalibrasi +" Tahun");
                    /*Swal.fire({
                        title: 'Perhatian!',
                        html: `Apakah Anda yakin ingin membuat jadwal <b>KALIBRASI</b>? <br><br> alat: <h5><span class="badge badge-primary">${res.alat.nama}</span></h5>serial: <h5><span class="badge badge-primary">${res.serial_number}</span></h5>frekuensi: <h5><span class="badge badge-primary">${res.alat.frek_kalibrasi} Tahun</span></h5>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Buat Jadwal Kalibrasi!',
                        cancelButtonText: 'Batalkan!'
                    }).then((result) => {
                        if (result.value) {
                            $.LoadingOverlay("show");
                        }
                    });*/
                }
            });
        };

        const executeCalibrate = () => {
            $.ajax({
                url: `alatruangan/create/schedule/calibration/${id}`,
                method: 'POST',
                statusCode: {
                    500: (err) => {
                        $.LoadingOverlay("hide");
                        console.log(err);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan, silahkan hubungi Admin!',
                            'error'
                        );

                    }
                },
                success: res => {
                    $.LoadingOverlay("hide");
                    Swal.fire(
                        'Tersimpan!',
                        'Jadwal inspeksi telah dibuat!',
                        'success'
                    );
                    $('#t-alat').DataTable().ajax.reload();
                }
            });
        }

        $('.money').mask('000.000.000.000.000.000', {reverse: true});
    </script>
@stop

