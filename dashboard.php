<?php
include_once('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();
$server_name = getServerProperty('server_name');
$fast_packages = json_decode(getServerProperty('fast_packages'), true);
$fixed_informations = getServerProperty('fixed_informations');
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $server_name; ?></title>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins2/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins2/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist2/css/adminlte.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="plugins2/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
	<div class="wrapper">
		<?php include_once('sidebar.php'); ?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Dashboard</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total de clientes</span>
									<span class="info-box-number">
										<?php echo number_format(getClientsCount($logged_user), 0, ',', ','); ?>
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total de clientes ativos</span>
									<span class="info-box-number"><?php echo number_format(getActiveCount($logged_user), 0, ',', ','); ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix hidden-md-up"></div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-clock"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total de teste</span>
									<span class="info-box-number"><?php echo number_format(getTrialClientsCount($logged_user), 0, ',', ','); ?></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3">
							<div class="info-box mb-3">
								<span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user-plus"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total de novos clientes</span>
									<span class="info-box-number"><?php echo number_format(getNewClientsCount($logged_user), 0, ',', ','); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Gerador de testes automático</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
							</div>
						</div>
						<div class="card-body" style="display: block;">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-link"></i>
									</span>
								</div>
								<input type="text" class="form-control" readonly="" id="testurl" value="<?php echo getTestUrl($logged_user['id']); ?>">
								<div class="input-group-append">
									<button type="button" class="btn btn-info copytesturl" data-clipboard-target="#testurl">Copiar</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Informações</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
							</div>
						</div>
						<div class="card-body" style="display: block;">
							<div class="col-12 col-sm-12">
								<div class="html-content">
									<?php echo $fixed_informations; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark"></aside>
		<!-- /.control-sidebar -->
		<!-- Main Footer -->
		<?php include_once('footer.php'); ?>
	</div>
	<!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
	<script src="plugins2/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="plugins2/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="plugins2/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist2/js/adminlte.js"></script>
	<!-- Clipboard -->
	<script src="bower_components/clipboard.min.js"></script>
	<!-- OPTIONAL SCRIPTS -->
	<script src="dist2/js/demo.js"></script>
	<!-- SweetAlert2 -->
	<script src="plugins2/sweetalert2/sweetalert2.min.js"></script>
	<!-- PAGE PLUGINS -->
	<!-- jQuery Mapael -->
	<script src="plugins2/jquery-mousewheel/jquery.mousewheel.js"></script>
	<script src="plugins2/raphael/raphael.min.js"></script>
	<script src="plugins2/jquery-mapael/jquery.mapael.min.js"></script>
	<script src="plugins2/jquery-mapael/maps/usa_states.min.js"></script>
	<!-- ChartJS -->
	<!--script src="plugins2/chart.js/Chart.min.js"></script-->
	<!-- PAGE SCRIPTS -->
	
	<script type="text/javascript">
		$(function() {
			new ClipboardJS('.copytesturl');
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});

			$('.copytesturl').click(function() {
				Toast.fire({
					type: 'success',
					title: 'Link de teste automático copiado!'
				})
			});
		});
	</script>
	<!--script src="dist2/js/pages/dashboard2.js"></script-->
</body>

</html>