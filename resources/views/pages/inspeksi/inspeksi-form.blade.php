<div class="modal" tabindex="-1" role="dialog" id="formModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspeksi Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="modalForm">
                    <input type="hidden" name="jadwal_id" id="jadwal_id"/>
                    <div class="form-group">
                        <label>(Serial Number) Nama Alat</label>
                        <input class="form-control" id="nama_alat" type="text" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Inspeksi</label>
                        <input class="form-control" id="tgl_inspeksi" type="text" value="" disabled>
                    </div>
                    <label for="alias">Status Alat</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasil"  value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Baik
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hasil"  value="-1">
                            <label class="form-check-label" for="exampleRadios2">
                                Rusak
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" rows="3" name="catatan"> </textarea>
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
