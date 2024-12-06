<?php
	include_once ('./sys/functions.php');
	isLogged();
	$logged_user = getLoggedUser();
	$server_name = getServerProperty('server_name');
	$server_dns = getServerDNS();
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
								<h1>Clientes </h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Clientes </li>
								</ol>
							</div>
						</div>
					</div>
				</section>
				<section class="content">
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Clientes </h3>
								<div class="card-tools">
                                    <button type="button" class="btn btn-tool btrefresh"><i class="fas fa-sync-alt"></i></button>
                                </div>
							</div>
							<div class="card-body table-responsive">
								<table id="table" class="table table-bordered table-striped" style="width: 100%!important">
									<thead>
										<tr>
											<th>Id</th>
											<th>Usuário</th>
											<th>Senha</th>
											<th>Adicionado</th>
											<th>Vencimento</th>
											<th>Revendedor</th>
											<th>Conexões</th>
											<th>Status</th>
											<th>Ações</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<tr>
											<th>Id</th>
											<th>Usuário</th>
											<th>Senha</th>
											<th>Adicionado</th>
											<th>Vencimento</th>
											<th>Revendedor</th>
											<th>Conexões</th>
											<th>Status</th>
											<th>Ações</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php include_once ('footer.php'); ?>
		</div>
		<!-- jQuery -->
		<script src="plugins2/jquery/jquery.min.js"></script>
		<!-- Bootbox -->
		<script src="bower_components/bootbox.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins2/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- DataTables -->
		<script src="plugins2/datatables/jquery.dataTables.js"></script>
		<script src="plugins2/datatables-bs4/js/dataTables.bootstrap4.js"></script>
		<!-- Clipboard -->
		<script src="bower_components/clipboard.min.js"></script>
		<!-- SweetAlert2 -->
		<script src="plugins2/sweetalert2/sweetalert2.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist2/js/adminlte.js"></script>
		<script type="text/javascript">
			$(function () {
			    var table = $('#table').DataTable({
			        "ajax": "./sys/API.php?action=get_clients",
			        "processing": true,
			        "serverSide": true,
			        "columns": [
			            {"data": "id"},
			            {"data": "display_username"},
			            {"data": "password"},
			            {"data": "created_at"},
			            {"data": "exp_date"},
			            {"data": "reseller_name"},
			            {"data": "max_connections"},
			            {"data": "status"},
			            {"data": "action"}
			        ],
			        columnDefs: [
                        {
                            "targets": 7,
                                "className": "text-center",
                        }],
			        order: [[ 0, "desc" ]],
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
			        },
			        searchDelay: 5000
			    });
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
			    /* ADICIONAR TELA */
			    $(document).on('click', '.bttela', function(e){ 
			        e.preventDefault();
			        const id = $(this).data("id");
			
			        bootbox.dialog({
			        title: "Tem certeza que deseja adicionar mais uma tela ?",
			        message: "<p>" + $(this).data("text") + "</p>",
			        buttons: {
			           cancel: {
			               label: "Cancelar",
			               className: 'btn-secondary',
			               callback: function() {}
			           },
			           noclose: {
			               label: "Confirmar",
			               className: 'btn-info btnaddscreen',
			               callback: function() {
			                 $('.btnaddscreen').hide();
			                 
			                 $.get('./sys/API.php?action=add_screen&client_id='+id, function( data ) {
			                     if (data.result === 'success') {
			                             table.ajax.reload();
			                             Toast.fire({
			                                 type: 'success',
			                                 title: 'Máximo de conexões aumentada com sucesso!'
			                             })
			                         } else {
			                             Toast.fire({
			                                 type: 'error',
			                                 title: 'Não foi possível aumentar o máximo de conexões do cliente.'
			                             })
			                         }
			                 }, "json");
			               }
			           },
			       }
			   });
			 });
			
			 /* RENOVAR CLIENTE */
			 $(document).on('click', '.btrenew', function(e){ 
			   e.preventDefault();
			   const id = $(this).data("id");
			
			   bootbox.dialog({
			       title: "Tem certeza que deseja renovar este cliente ?",
			       message: "<p>" + $(this).data("text") + "</p>",
			       buttons: {
			           cancel: {
			               label: "Cancelar",
			               className: 'btn-secondary',
			               callback: function() {}
			           },
			           noclose: {
			               label: "Confirmar",
			               className: 'btn-info btnrenew',
			               callback: function() {
			                 $('.btnrenew').hide();
			                 
			                 $.get('./sys/API.php?action=renew_client&client_id='+id, function( data ) {
			                     if (data.result === 'success') {
			                             table.ajax.reload();
			                             Toast.fire({
			                                 type: 'success',
			                                 title: 'Cliente renovado com sucesso!'
			                             })
			                         } else {
			                             Toast.fire({
			                                 type: 'error',
			                                 title: 'Não foi possível renovar o cliente.'
			                             })
			                         }
			                 }, "json");
			               }
			           },
			       }
			   });
			 });
			
			 /* RENOVAR VARIOS MESES CLIENTE */
			 $(document).on('click', '.btrenewplus', function(e){ 
			   e.preventDefault();
			   const id = $(this).data("id");
			
			   bootbox.dialog({
			       title: "Tem certeza que deseja renovar este cliente ?",
			       message: '<p>'+$(this).data("text")+'</p><form class="form-horizontal">' + '<div class="form-group col-md-6"><label class="form-control-label">Quantidade de meses</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span><input type="number" class="form-control" required="" value="0" autocomplete="off" id="months" name="months"></div></div>' + '<div class="form-group row">' + '<div class="col-md-12"><span class="text-blue">Escolha a quantidade de meses.<br><b>*Fique atento, caso seja um usuario de 2 telas irá cobrar o dobro de créditos equivalente a quantidade de meses.</b></span></div>' + '</div></form>',
			       buttons: {
			           cancel: {
			               label: "Cancelar",
			               className: 'btn-secondary',
			               callback: function() {}
			           },
			           noclose: {
			               label: "Confirmar",
			               className: 'btn-info btnrenewplus',
			               callback: function() {
			                 $('.btnrenewplus').hide();
			
			                 const months = $('#months').val();
			                 if(months > 0){
			                   $.get('./sys/API.php?action=renew_client_plus&client_id=' + id + '&months=' + months, function (data) {
			                       if (data.result === 'success') {
			                             table.ajax.reload();
			                             Toast.fire({
			                                 type: 'success',
			                                 title: 'Cliente renovado com sucesso!'
			                             })
			                         } else {
			                             Toast.fire({
			                                 type: 'error',
			                                 title: 'Não foi possível renovar o cliente.'
			                             })
			                         }
			                   }, "json");
			                 }
			                 else {
			                    Toast.fire({
			                        type: 'warning',
			                        title: 'Quantidade de meses inválida.'
			                    })
			                 }
			               }
			           },
			       }
			   });
			 });
			
			 /* BLOQUEAR/DESBLOQUEAR */
			 $(document).on('click', '.btblock', function (e) {
			     e.preventDefault();
			     const id = $(this).data("id");
			     
			     bootbox.dialog({
			         title: "Tem certeza que deseja bloquear/desbloquear este usuário ?",
			         message: "<p>" + $(this).data("text") + "</p>",
			         buttons: {
			             cancel: {
			                 label: "Cancelar",
			                 className: 'btn-secondary',
			                 callback: function () {
			                 }
			             },
			             noclose: {
			                 label: "Confirmar",
			                 className: 'btn-warning btnblock',
			                 callback: function () {
			                     $('.btnblock').hide();
			                     $.get('./sys/API.php?action=toggle_block_client&user_id=' + id, function (data) {
			                         if (data.result === 'success') {
			                             table.ajax.reload();
			                             Toast.fire({
			                                 type: 'success',
			                                 title: 'Usuário bloqueado/desbloqueado com sucesso!'
			                             })
			                         } else {
			                             Toast.fire({
			                                 type: 'error',
			                                 title: 'Não foi possível bloquear/desbloquear este usuário.'
			                             })
			                         }
			                     }, "json");
			                 }
			             },
			         }
			     });
			 });
			
			 /* DELETAR */
			 $(document).on('click', '.btdelete', function (e) {
			     e.preventDefault();
			     const id = $(this).data("id");
			     bootbox.dialog({
			         title: "Tem certeza que deseja deletar este usuário ?",
			         message: "<p>" + $(this).data("text") + "</p>",
			         buttons: {
			             cancel: {
			                 label: "Cancelar",
			                 className: 'btn-secondary',
			                 callback: function () {
			                 }
			             },
			             noclose: {
			                 label: "Confirmar",
			                 className: 'btn-danger btndelete',
			                 callback: function () {
			                     $('.btndelete').hide();
			                     $.get('./sys/API.php?action=delete_client&user_id=' + id, function (data) {
			                         if (data.result === 'success') {
			                             table.ajax.reload();
			                             Toast.fire({
			                                 type: 'success',
			                                 title: 'Usuário deletado com sucesso!'
			                             })
			                         } else {
			                             Toast.fire({
			                                 type: 'error',
			                                 title: 'Não foi possível deletar este usuário.'
			                             })
			                         }
			                     }, "json");
			                 }
			             },
			         }
			     });
			 });
			
			 const server_dns = "<?php echo getServerDNS(); ?>";
			 const reseller_id = "<?php echo $logged_user['id'];?>";
			
			 /* GERAR LINK */
			 $(document).on('click', '.btlink', function(e){
			   e.preventDefault();
			   //var id = $(this).data("id");
			   const user = $(this).data("user");
			   const pass = $(this).data("pass");
			
			   const mpegts_link = server_dns + "/get.php?username=" + user + "&password=" + pass + "&type=m3u_plus&output=mpegts";
			   const hls_link = server_dns + "/get.php?username=" + user + "&password=" + pass + "&type=m3u_plus&output=m3u8";
			   
			   bootbox.dialog({
			     size: 'large',
			     title: "Encurtar Link",
			
			     message: '<p><strong>Link (MPEGTS)</strong></p> <div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div><input type="text" class="form-control" readonly="" id="copy_mpegts_link" value="'+mpegts_link+'"></div></br>' +
			              '<p><strong>Link (HLS)</strong></p> <div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-link"></i></span></div><input type="text" class="form-control" readonly="" id="copy_hls_link" value="'+ hls_link + '"></div>',
			     buttons: {
			       noclose: {
			         label: "Copiar (MPEGTS)",
			         className: 'btn btn-info btm3u',
			         callback: function() {
			             $("#copy_mpegts_link").select();
			                 document.execCommand("copy");
			                 Toast.fire({
			                     type: 'success',
			                     title: 'Link MPEGTS Copiado!'
			                 })
			           return false;
			         }
			       },
			       noclose2: {
			         label: "Copiar (HLS)",
			         className: 'btn btn-info bthls',
			         callback: function() {
			            $("#copy_hls_link").select();
			            document.execCommand("copy");
			            Toast.fire({
			                type: 'success',
			                title: 'Link HLS Copiado!'
			            })
			           return false;
			         }
			       },
			       cancel: {
			         label: "Fechar",
			         className: 'btn btn-secondary',
			         callback: function () {}
			       }
			     }
			   });
			 });
			});
		</script>
	</body>
</html>