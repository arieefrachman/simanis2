<div class="modal" role="dialog" id="formModalCalibrate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kalibrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="modalFormCalibrate">
                    <input type="hidden" name="alat_ruangan_id" id="alat_ruangan_id"/>
                    <input type="hidden" name="frek_kalibrasi_val" id="frek_kalibrasi_val"/>
                    <div class="form-group">
                        <label for="nama_alat">Alat</label>
                        <input class="form-control" id="nama_alat" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" class="form-control" id="serial_number" autocomplete="off" disabled>
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>

                    <div class="form-group">
                        <label for="nama">Frekuensi Kalibrasi</label>
                        <input type="text" class="form-control" id="frek_kalibrasi" autocomplete="off" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nama">Harga</label>
                        <input type="text" class="form-control money" id="harga" autocomplete="off" name="harga">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-simpan-modal-kalibrasi" class="btn btn-primary">
                    Simpan
                </button>
                <button type="button" id="btn-tutup-modal" class="btn btn-secondary" data-dismiss="modal" onclick="closeFormModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
