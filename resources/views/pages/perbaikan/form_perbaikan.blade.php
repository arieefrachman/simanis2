<div class="modal" tabindex="-1" role="dialog" id="formModalPerbaikan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbaikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="modalFormPerbaikan">
                    <div class="form-group">
                        <label for="kode">Ruangan</label>
                        <input id="ruangan" class="form-control" disabled/>
                        {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Alat</label>
                        <input id="alat" class="form-control" disabled/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Tanggal Kerusakan</label>
                        <input id="tgl_kerusakan_val" class="form-control" disabled/>
                    </div>

                    <div class="form-group">
                        <label for="nama">Catatan Kerusakan</label>
                        <textarea class="form-control" name="catatan" disabled id="catatan_kerusakan"> </textarea>
                    </div>
                    <hr>
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
                        <label for="nama">Biaya Perbaikan</label>
                        <input id="biaya" name="biaya" class="form-control money"/>
                    </div>
                    <label for="nama">Tanggal Perbaikan</label>
                    <input id="tgl_perbaikan" name="tgl_perbaikan" class="form-control"/>
                    <div class="form-group">
                        <label for="nama">Catatan Perbaikan</label>
                        <textarea class="form-control" name="catatan_perbaikan"> </textarea>
                    </div>
                    <input type="hidden" id="id" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-simpan-perbaikan" class="btn btn-primary">
                    Simpan
                </button>
                <button type="button" id="btn-tutup-modal" class="btn btn-secondary" data-dismiss="modal" onclick="closeFormModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
