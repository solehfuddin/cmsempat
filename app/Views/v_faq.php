<?= $this->extend('components/template_admin') ?>
    
<?= $this->section('content') ?>
    <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Data Pertanyaan User</h4>
					</div>
					<div class="pb-20">
                        <div class="table-responsive">
                            <table class="table stripe hover nowrap" id="datatable-faq">
                                <thead>
                                    <tr>
                                        <th>Tgl Input</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Pesan</th>
                                        <th>Respon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				Copyright By Empat Berkah | 2021
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>