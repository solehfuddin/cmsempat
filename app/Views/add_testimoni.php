 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahtestimoni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Testimoni user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('testimoni/simpandata', ['class' => 'formModaltambahtestimoni']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Testimoni</label>
                  <input class="form-control" type="text"  placeholder="TSTI001" readonly
                        name="testimoni_kode" id="testimoni_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User</label>
                  <input class="form-control" type="text" placeholder="Marlene Visconte" 
                        name="testimoni_nama" id="testimoni_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniNama">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Perusahaan</label>
                  <input class="form-control" type="text" placeholder="Scouter" 
                        name="testimoni_company" id="testimoni_company" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniCompany">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Jabatan</label>
                  <input class="form-control" type="text" placeholder="General Manager" 
                        name="testimoni_position" id="testimoni_position" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorTestimoniPosition">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Isi Testimoni</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorTestimoniContent">testte</div>
                  <textarea id="testimoni_content" name="testimoni_content" class="form-control" rows="2"></textarea>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="testimoni_image" class="form-control" id="testimoni_image" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback errorTestimoniImage">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahtestimoni">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>