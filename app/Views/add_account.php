 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahuaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('account/simpandata', ['class' => 'formModaltambahaccount']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Kode User</label>
                  <input class="form-control" type="text"  placeholder="USR001" readonly
                        name="account_kode" id="account_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama User</label>
                  <input class="form-control" type="text" placeholder="Solehfuddin" 
                        name="account_nama" id="account_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountNama">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Alamat Email</label>
                  <input class="form-control" type="text" placeholder="solehfuddin@gmail.com" 
                        name="account_email" id="account_email" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountEmail">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Password</label>
                  <input class="form-control" type="password" placeholder="******" 
                        name="account_password" id="account_password" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback errorAccountPassword">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Level User</label>
                  <select class="form-control" id="account_level" name="account_level">
                    <option value="0">User</option>
					<option value="1">Administrator</option>
                  </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahaccount">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>