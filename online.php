<?php
include_once ('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();
$server_name = getServerProperty('server_name');
$fast_packages = json_decode(getServerProperty('fast_packages'), true);
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
								<h1>Usuários Online</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Usuários Online</li>
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
                <h3 class="card-title">Usuários Online</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btrefresh"><i class="fas fa-sync-alt"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Usuário</th>
                  <th>Canal</th>
                  <th>Tempo Online</th>
                  <th>IP</th>
                  <th>Local</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Usuário</th>
                  <th>Canal</th>
                  <th>Tempo Online</th>
                  <th>IP</th>
                  <th>Local</th>
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
    <script type="text/javascript">
        $(function () {
            var table = $('#table').DataTable({
                "ajax": "./sys/API.php?action=get_online_clients",
                "processing": false,
                "serverSide": true,
                "columns": [
                    {"data": "username"},
                    {"data": "stream_name"},
                    {"data": "time"},
                    {"data": "user_ip"},
                    {"data": "country"}
                ],
                columnDefs: [
                        {
                            "targets": [2,3,4],
                                "className": "text-center",
                        }],
                order: [[ 2, "asc" ]],
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                orderMulti: false,
                info: true,
                autoWidth: false,
                language: {
                    processing: "Processando...",
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "Não foram encontrados resultados",
                    info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando de 0 até 0 de 0 registros",
                    sInfoFiltered: "",
                    sInfoPostFix: "",
                    search: "Buscar:",
                    url: "",
                    loadingRecords: "Carregando...",
                    paginate: {
                        first: "Primeiro",
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>",
                        last: "Último"
                    }
                }, "drawCallback": function () {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
            function reloadUsers() {
                table.ajax.reload();
                setTimeout(reloadUsers, 10000);
            };
            reloadUsers();
            const Toast = Swal.mixin({
			         toast: true,
			         position: 'top-end',
			         showConfirmButton: false,
			         timer: 5000
			     }); 
			     $(document).on('click', '.btrefresh', function(e){ 
			         table.ajax.reload();
			         Toast.fire({
			             type: 'info',
			             title: 'Recarregando tabela'
			         })
			     });
        });
</script>
	</body>
</html>