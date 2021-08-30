 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahcustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="titlemodalubahcustom">Ubah Custom</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('custom/perbaruidata', ['class' => 'formModalubahcustom']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keywords</label>
				   <input class="form-control" type="hidden" placeholder="General Manager" 
                        name="custom_kodeubah" id="custom_kodeubah" readonly/>
                  <input class="form-control" type="text" placeholder="General Manager" 
                        name="custom_keyubah" id="custom_keyubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorCustomKeyubah">testte</div>
                </div>
				
				<div class="form-group" id="control-recentubah">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="custom_recentimg" width="100%"/>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul</label>
                  <input class="form-control" type="text" placeholder="" 
                        name="custom_judulubah" id="custom_judulubah" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorCustomJudullubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Link</label>
                  <input class="form-control" type="text" placeholder="" 
                        name="custom_linkubah" id="custom_linkubah" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorCustomLinkubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Counter</label>
                  <input class="form-control" type="text" placeholder="" 
                        name="custom_counterubah" id="custom_counterubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorCustomCounterubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi 1</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCustomDesc1ubah">testte</div>
                  <textarea id="custom_desc1ubah" name="custom_desc1ubah" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Dekripsi 2</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorCustomDesc2ubah">testte</div>
                  <textarea id="custom_desc2ubah" name="custom_desc2ubah" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group" id="control-imgubah">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="custom_imgubah" class="form-control" id="custom_imgubah" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback errorCustomImgubah">testte</div>
                </div>
				
				<div class="form-group" id="control-isactiveubah">
					<label class="custom-toggle float-right">
                    <input type="checkbox" id="custom_isactiveubah" class="custom_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan Layanan &nbsp; </label>
				  
				  <br />
				</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahcustom">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>