 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambaharticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('article/simpandata', ['class' => 'formModaltambaharticle']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Artikel</label>
                  <input class="form-control" type="text"  placeholder="ARTC001" readonly
                        name="article_kode" id="article_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleKode">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Jenis Artikel</label>
                  <select class="form-control" id="article_type" name="article_type">
                    <?php foreach($arttype as $item): ?>
                    <option value="<?= $item['kode_type']; ?>">
                        <?= $item['type']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Artikel</label>
                  <input class="form-control" type="text" placeholder="Office space for banking" 
                        name="article_title" id="article_title" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleTitle">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Slug</label>
                  <input class="form-control" type="text" placeholder="Office-space-for-banking" 
                        name="article_slug" id="article_slug" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleSlug">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi Singkat</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorArticleDesc">testte</div>
                  <textarea id="article_desc" name="article_desc" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Dekripsi Lengkap</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorArticleDescfull">testte</div>
                  <textarea id="article_descfull" name="article_descfull" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group" id="control-imgubah">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="article_img" class="form-control" id="article_img" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback errorArticleImg">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambaharticle">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>