 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahtestimoni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Testimoni user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('testimoni/perbaruidata', ['class' => 'formModalubahtestimoni']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Testimoni</label>
                  <input class="form-control" type="text"  placeholder="TSTI001" readonly
                        name="testimoni_kodeubah" id="testimoni_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniKodeubah">test</div>
                </div>
				
				<div class="form-group">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="testimoni_recentimg" width="100%"/>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User</label>
                  <input class="form-control" type="text" placeholder="Marlene Visconte" 
                        name="testimoni_namaubah" id="testimoni_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniNamaubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Perusahaan</label>
                  <input class="form-control" type="text" placeholder="Scouter" 
                        name="testimoni_companyubah" id="testimoni_companyubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniCompanyubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Jabatan</label>
                  <input class="form-control" type="text" placeholder="General Manager" 
                        name="testimoni_positionubah" id="testimoni_positionubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniPositionubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Testimoni</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorTestimoniContentubah">testte</div>
                  <textarea id="testimoni_contentubah" name="testimoni_contentubah" class="form-control" rows="2"></textarea>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="testimoni_imageubah" class="form-control" id="testimoni_imageubah" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback errorTestimoniImageubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahtestimoni">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>