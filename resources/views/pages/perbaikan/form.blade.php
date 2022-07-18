<div class="modal" tabindex="-1" role="dialog" id="formModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permintaan Perbaikan Alat</h5>
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
                        <label for="kode">Ruangan</label>
                        <select class="form-control" id="ruangan_id">
                        </select>
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Alat</label>
                        <select class="form-control" id="alat_id" name="alat_id">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Tanggal Kerusakan</label>
                        <input class="form-control" id="tgl_kerusakan" name="tgl_kerusakan" />
                    </div>

                    <div class="form-group">
                        <label for="nama">Catatan Kerusakan</label>
                        <textarea class="form-control" name="catatan"> </textarea>
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
