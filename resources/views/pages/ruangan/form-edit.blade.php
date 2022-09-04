<div class="modal" tabindex="-1" role="dialog" id="formModalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="modalFormEdit">
                    <input id= 'edit-id_ruangan' type="hidden" class="form-control" name="id_ruangan"  autocomplete="off">
                    <div class="form-group">
                        <label for="nama_ruangan">Nama Ruangan</label>
                        <input id= 'edit-nama_ruangan' type="text" class="form-control" name="nama_ruangan"  autocomplete="off">
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <div class="form-group">
                        <label for="nama">PIC</label>
                        <input id="edit-pic" type="text" class="form-control" name="pic"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Kategori Ruangan</label>
                        <select class="custom-select" name="ruangan_kategori_id" id="edit-ruangan_kategori_id">
                            <option selected>Pilih kategori ruangan...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alias">Alias</label>
                        <input id="edit-alias" type="text" class="form-control" name="alias" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Keterangan</label>
                        <textarea id="edit-keterangan" class="form-control" name="keterangan">
                        </textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-update-modal" class="btn btn-primary">
                    Update
                </button>
                <button type="button" id="btn-tutup-modal" class="btn btn-secondary" data-dismiss="modal" onclick="closeFormModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
