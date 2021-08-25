 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubaharticletype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Tipe Artikel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('articletype/perbaruidata', ['class' => 'formModalubaharticletype']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Tipe Artikel</label>
                  <input class="form-control" type="text"  placeholder="TART001" readonly
                        name="articletype_kodeubah" id="articletype_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticletypeKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Tipe Artikel</label>
                  <input class="form-control" type="text" placeholder="Portofolio" 
                        name="articletype_judulubah" id="articletype_judulubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticletypeJudulubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubaharticletype">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>