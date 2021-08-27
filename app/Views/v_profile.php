<?php
  $session = \Config\Services::session();
?>
<?= $this->extend('components/template_admin') ?>
    
<?= $this->section('content') ?>
<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<!-- <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a> -->
								<img src="<?= base_url() ?>/public/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="<?= base_url() ?>/public/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0"><?= $account[0]['nama_user']; ?></h5>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?= $account[0]['email']; ?>
									</li>
									<li>
										<span>User Level:</span>
										<?= $account[0]['user_level'] == 1 ? "Administrator" : "User"; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Settings</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Setting Tab start -->
										<div class="tab-pane fade show active height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<!-- <form> -->
												<!-- Handle Form -->
												<?= form_open_multipart('profile/perbaruidata', ['class' => 'formUpdateProfil']); ?>
												<?= csrf_field(); ?>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-12">
															<h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
															<div class="form-group">
																<label>Nama User:</label>
																<input class="form-control form-control-lg" type="text" placeholder="solehfuddin" 
																id="profile_nama" name="profile_nama" value="<?= $account[0]['nama_user']; ?>">
																 <!-- Error Validation -->
																 <div class="invalid-feedback errorProfileNama">test</div>
															</div>
															<div class="form-group">
																<label>Alamat Email:</label>
																<input class="form-control form-control-lg" type="text" placeholder="solehfuddin@gmail.com"
																id="profile_email" name="profile_email" value="<?= $account[0]['email']; ?>">
																<div class="invalid-feedback errorProfileEmail">test</div>
															</div>
															<div class="form-group">
																<label>New Password:</label>
																<input class="form-control form-control-lg" type="password" placeholder="******"
																id="profile_newpass" name="profile_newpass">
																<div class="invalid-feedback errorProfileNewPass">test</div>
															</div>
															<div class="form-group">
																<label>Confirm Password:</label>
																<input class="form-control form-control-lg" type="password" placeholder="******"
																id="profile_confirmpass" name="profile_confirmpass">
																<div class="invalid-feedback errorProfileConfirmPass">test</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary btnubahprofile" value="Save & Update">
															</div>
														</li>
													</ul>
												<!-- </form> -->
												<?= form_close(); ?>
												<!-- Handle FORM -->
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				Copyright By Empat Berkah | 2021
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>