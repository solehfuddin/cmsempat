<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/public/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/public/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/public/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/styles/style.css">
</head>
<body>
	<!-- Loader -->
	<?= $this->include('components/loader'); ?>

	<!-- Header -->
	<?= $this->include('components/header'); ?>

	<!-- Left Side Nav -->
	<?= $this->include('components/left_sidebar'); ?>

	<!-- Right Side Nav -->
	<?= $this->include('components/right_sidebar'); ?>

    <!-- Page content -->
    <?= $this->renderSection('content'); ?>

	<!-- js -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>/public/scripts/core.js"></script>
	<script src="<?= base_url() ?>/public/scripts/script.min.js"></script>
	<script src="<?= base_url() ?>/public/scripts/process.js"></script>
	<script src="<?= base_url() ?>/public/scripts/layout-settings.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/public/scripts/dashboard.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="<?= base_url() ?>/public/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<!-- <script src="<?= base_url() ?>/public/scripts/datatable-setting.js"></script></body> -->
    <script src="<?= base_url() ?>/public/scripts/myapp.js"></script>
	<script>
   	 var BASE_URL = "<?= base_url(); ?>";
  	</script>
</body>
</html>