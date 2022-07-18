@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Kategori Ruangan</h1>
    <p class="mb-4">Data tentang kategori ruangan yang tersedia</p>
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
                                       placeholder="Ruang/Pelayanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>Kategori...</option>
                                    <option value="1">Instalasi Laboratorium</option>
                                    <option value="2">Instalasi Radiologi</option>
                                </select>
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
                    <h6 class="m-0 font-weight-bold text-primary">Table Kategori Ruangan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="t-ruangan">
                            <thead>
                            <tr>
                                <th>Ruangan Kategori</th>
                                <th>Alias</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.kategoriruangan.form')
@stop

@section('script')
    <script>
        $(document).ready(() => {
            let table = $('#t-ruangan').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: `table/ruangankategori`,
                    type: 'GET'
                },
                columns: [
                    {data: 'nama', name: 'nama', width: '300px'},
                    {data: 'alias', name: 'alias', width: '230px'},
                ]
            });


            $(`#btn-simpan-modal`).click(() => {
                let formData = new FormData($('#modalForm')[0]);
                addDataModal('ruangankategori', table, formData);
            })
        });

    </script>
@stop
