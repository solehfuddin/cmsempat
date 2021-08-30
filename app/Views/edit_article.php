 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubaharticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Artikel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('article/perbaruidata', ['class' => 'formModalubaharticle']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode Artikel</label>
                  <input class="form-control" type="text"  placeholder="ARTC001" readonly
                        name="article_kodeubah" id="article_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleKodeubah">test</div>
                </div>
				
				<div class="form-group" id="control-article-recentimg">
                  <label class="form-control-label">Gambar sebelumnya</label>
                  <img id="article_recentimg" width="100%"/>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Jenis Artikel</label>
                  <select class="form-control" id="article_typeubah" name="article_typeubah">
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
                        name="article_titleubah" id="article_titleubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleTitleubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Slug</label>
                  <input class="form-control" type="text" placeholder="Office-space-for-banking" 
                        name="article_slugubah" id="article_slugubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorArticleSlugubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi Singkat</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorArticleDescubah">testte</div>
                  <textarea id="article_descubah" name="article_descubah" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Dekripsi Lengkap</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorArticleDescfullubah">testte</div>
                  <textarea id="article_descfullubah" name="article_descfullubah" class="form-control" rows="2" required></textarea>
                </div>
				
				<div class="form-group" id="control-article-imgubah">
                  <label for="nama-infocategory-input" class="form-control-label">Gambar</label>
                  <input type="file" name="article_imgubah" class="form-control" id="article_imgubah" 
                    accept=".jpg, .jpeg, .png" /></p>
                  <div class="invalid-feedback errorArticleImgubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubaharticle">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>