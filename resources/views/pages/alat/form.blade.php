<div class="modal" tabindex="-1" role="dialog" id="formModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="modalForm">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" name="kode"  autocomplete="off">
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Alat</label>
                        <input type="text" class="form-control my-datepicker" name="nama_alat"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Type</label>
                        <input type="text" class="form-control" name="type"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Tahun Pengadaan</label>
                        <input type="number" class="form-control" name="thn_pengadaan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Harga</label>
                        <input type="text" class="form-control money" name="harga"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Usia Teknis</label>
                        <input type="number" class="form-control" name="usia_teknis" autocomplete="off">
                        <small class="form-text text-muted font-italic">Dalam satuan tahun.</small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Frekuensi Inspeksi</label>
                        <select class="custom-select" name="frek_inspeksi">
                            <option selected>Pilih frekuensi inspeksi...</option>
                            <option value="A">Annual</option>
                            <option value="S">Semi-annual</option>
                            <option value="T">Three-yearly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Frekuensi Kalibrasi</label>
                        <input type="number" class="form-control" name="frek_kalibrasi" autocomplete="off">
                        <small class="form-text text-muted font-italic">Dalam satuan tahun.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-simpan-modal" class="btn btn-primary">
                    Simpan
                </button>
                <button type="button" id="btn-tutup-modal" class="btn btn-secondary" data-dismiss="modal" onclick="closeFormModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
