<?= $this->extend('components/template_login') ?>

<?= $this->section('content') ?>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="<?= base_url() ?>">
					<img src="<?= base_url() ?>/public/images/deskapp-logo.svg" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?= base_url() ?>/public/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To Admin Panel</h2>
						</div>
						<!-- <form> -->
						<?= form_open('login/auth', ['class' => 'formLogin']); ?>
                		<?= csrf_field(); ?>
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" placeholder="Email address" name="inputuser" id="inputuser">
								<div class="input-group-append custom handlermail">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password" id="password">
								<div class="input-group-append custom handlerpass">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<!-- <div class="forgot-password"><a href="<?= base_url() . '/resetmypassword'; ?>">Forgot Password</a></div> -->
									<div class="forgot-password"><a href="#">Forgot Password</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit -->
										<input class="btn btn-primary btn-lg btn-block btn-login" type="submit" value="Sign In">
										
										<!-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a> -->
									</div>
								</div>
							</div>
						<!-- </form> -->
						<?= form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>