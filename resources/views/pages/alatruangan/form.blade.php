<div class="modal" role="dialog" id="formModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alat Ruangan</h5>
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
                        <label for="ruangan_id">Ruangan</label>
                        <select class="form-control" name="ruangan_id" id="ruangan_id" data-live-search="true">
                        </select>
                    </div>

                    <label for="alat_id">Alat</label>
                    <div class="form-group">
                        <select class="form-control sel2" name="alat_id" id="alat_id" data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" autocomplete="off">
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
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
