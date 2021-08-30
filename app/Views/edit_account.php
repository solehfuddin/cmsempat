 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahuaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('account/perbaruidata', ['class' => 'formModalubahaccount']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode User</label>
                  <input class="form-control" type="text"  placeholder="USR001" readonly
                        name="account_kodeubah" id="account_kodeubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User</label>
                  <input class="form-control" type="text" placeholder="Solehfuddin" 
                        name="account_namaubah" id="account_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountNamaubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Alamat Email</label>
                  <input class="form-control" type="text" placeholder="solehfuddin@gmail.com" 
                        name="account_emailubah" id="account_emailubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountEmailubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Level User</label>
                  <select class="form-control" id="account_levelubah" name="account_levelubah">
                    <option value="0">User</option>
					<option value="1">Administrator</option>
                  </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahaccount">Update</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>