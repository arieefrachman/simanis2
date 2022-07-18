<div class="modal" tabindex="-1" role="dialog" id="formModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ruangan</h5>
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
                        <label for="nama_ruangan">Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan"  autocomplete="off">
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <div class="form-group">
                        <label for="nama">PIC</label>
                        <input type="text" class="form-control" name="pic"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Kategori Ruangan</label>
                        <select class="custom-select" name="ruangan_kategori_id" id="ruangan_kategori_id">
                            <option selected>Pilih kategori ruangan...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alias">Alias</label>
                        <input type="text" class="form-control" name="alias" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Keterangan</label>
                        <textarea class="form-control" name="keterangan">
                        </textarea>
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
