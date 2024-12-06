<?php
include_once ('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();
$server_name = getServerProperty('server_name');
$fast_packages = json_decode(getServerProperty('fast_packages'), true);
?>
<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $server_name;?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins2/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins2/datatables-bs4/css/dataTables.bootstrap4.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="plugins2/daterangepicker/daterangepicker.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins2/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="plugins2/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
		<!-- Tempusdominus Bbootstrap 4 -->
		<link rel="stylesheet" href="plugins2/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="plugins2/select2/css/select2.min.css">
		<link rel="stylesheet" href="plugins2/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		<!-- SweetAlert2 -->
		<link rel="stylesheet" href="plugins2/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist2/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>
	<body class="hold-transition sidebar-mini text-sm">
		<div class="wrapper">
			<?php include_once ('sidebar.php');?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Novos Canais</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Novos Canais</li>
								</ol>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<!-- SELECT2 EXAMPLE -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Novos Canais</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btrefresh"><i class="fas fa-sync-alt"></i></button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="table" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Categoria</th>
											<th>Adicionado</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$last_channels = getLastChannels(28);
											foreach($last_channels as $current_channel) {
											$current_channel['added'] = !empty($current_channel['added']) ? date('d/m/Y', $current_channel['added']) : '';
											?>
										<tr>
											<td><?php echo $current_channel['stream_display_name'];?></td>
											<td><?php echo getCategorieByID($current_channel['category_id']);?></td>
											<td><?php echo $current_channel['added'];?></td>
										</tr>
										<?php }; ?>
									</tbody>
									<tfoot>
										<tr>
											<th>Nome</th>
											<th>Categoria</th>
											<th>Adicionado</th>
										</tr>
									</tfoot>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				</section>
			</div>
			<?php include_once ('footer.php'); ?>
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="plugins2/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins2/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- DataTables -->
		<script src="plugins2/datatables/jquery.dataTables.js"></script>
		<script src="plugins2/datatables-bs4/js/dataTables.bootstrap4.js"></script>
		<!-- SweetAlert2 -->
		<script src="plugins2/sweetalert2/sweetalert2.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist2/js/adminlte.js"></script>
		<script>
			$(function () {
			  $('#table').DataTable({
			    "paging": true,
			    "lengthChange": false,
			    "searching": true,
			    "ordering": false,
			    "info": true,
			    "autoWidth": false,
			  });
			});
		</script>
	</body>
</html>