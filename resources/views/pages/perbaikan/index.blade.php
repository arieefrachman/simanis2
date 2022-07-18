@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Alat</h1>
    <p class="mb-4">Data tentang Perbaikan Alat</p>
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
                            <span class="text">Buat Pengajuan Perbaikan</span>
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
                    <h6 class="m-0 font-weight-bold text-primary">Table Perbaikan Alat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-alat">
                            <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Ruangan</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.perbaikan.form')
    @include('pages.perbaikan.form_perbaikan')
@stop

@section('script')
    <script>
        $(document).ready(() => {
            let table = $('#t-alat').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: `table/perbaikan`,
                    type: 'GET'
                },
                columns: [
                    {data: 'alat_ruangan.serial_number', name: 'alat_ruangan.serial_number'},
                    {data: 'alat_ruangan.alat.nama', name: 'alat_ruangan.alat.nama', width: "200px"},
                    {data: 'tanggal_perbaikan', name: 'tanggal_perbaikan', width: "200px"},
                    {data: 'status', name: 'status', width: "200px"},
                    {data: 'action', name: 'action', width: "200px"},
                    {data: 'alat_ruangan.ruangan.nama', name: 'alat_ruangan.ruangan.nama', width: "200px"}
                ],
                rowGroup: {
                    dataSrc: 'alat_ruangan.ruangan.nama'
                },
                order: [[5, 'asc']],
            });

            $('.money').mask('000.000.000.000.000.000', {reverse: true});


            $(`#btn-simpan-modal`).click(() => {
                let formData = new FormData($('#modalForm')[0]);
                addDataModal('perbaikan', table, formData);
            });
            $(`#btn-simpan-perbaikan`).click(() => {
                $.LoadingOverlay("show");
                let id = $('#id').val();
                let formData = new FormData($('#modalFormPerbaikan')[0]);
                $.ajax({
                    url: `perbaikan/simpan-perbaikan/${id}`,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    statusCode:{
                        400: (err) => {
                            let data = JSON.parse(err.responseText);
                            printErrorModal(data);
                            $.LoadingOverlay("hide");
                        },
                        404: (err) => {
                            let data = JSON.parse(err.responseText);
                            printErrorModal(data);
                            $.LoadingOverlay("hide");
                        },
                        500: (err) => {
                            let errMsg = JSON.parse(err.responseText);
                            $.LoadingOverlay("hide");
                            Swal.fire({
                                icon: 'error',
                                title: `${errMsg.msg}`,
                            });
                        }
                    },
                    success: (res, textStatus, jqXHR) => {
                        $.LoadingOverlay("hide");
                        $('#formModalPerbaikan').modal('hide');
                        table.ajax.reload();
                        $('#modalFormPerbaikan').trigger("reset");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: `Sukses memasukan data!`,
                            width: 200,
                            height: 100,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });

        });

        $.ajax({
            url: `alatruangan/ruangan/list`,
            method: 'GET',
            success: (res) => {
                let _items = `<option>Pilih Ruangan....</option>`;
                $.each(res, (k,v) => {
                    _items+= `<option value=${v.ruangan.id}>${v.ruangan.nama}</option>`
                });
                $('#ruangan_id').html(_items).selectpicker('refresh');
            }
        });

        $('#ruangan_id').on('change', () => {
            $.LoadingOverlay("show");
            let id = $('select#ruangan_id').val();
            if(id === 'Pilih Ruangan....'){
                id = 0
            }
            $.ajax({
                url: `alatruangan/alat/${id}`,
                method: 'GET',
                success: (res) => {
                    let _items = '';
                    $.each(res, (k,v) => {
                        _items+= `<option value=${v.id}>${v.alat.nama} (${v.serial_number})</option>`
                    });
                    $('#alat_id').html(_items).selectpicker('refresh');
                    $.LoadingOverlay("hide");
                    //$('#alat_ruangan_id').val();
                }
            });


        });

        $( "#tgl_kerusakan" ).datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        $( "#tgl_perbaikan" ).datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });


        const showFormfix = (id) => {
            $.LoadingOverlay("show");
            $('#formModalPerbaikan').modal({backdrop: 'static', keyboard: false});
            $.ajax({
                url: `perbaikan/${id}`,
                method: `GET`,
                success: res => {
                    $('#ruangan').val(res.alat_ruangan.ruangan.nama);
                    $('#id').val(res.id);
                    $('#alat').val(res.alat_ruangan.alat.nama);
                    $('#tgl_kerusakan_val').val(res.tgl_kerusakan);
                    $('#catatan_kerusakan').val(res.catatan);
                    $.LoadingOverlay("hide");
                }
            });
        };
        $('.money').mask('000.000.000.000.000.000', {reverse: true});
    </script>
@stop

