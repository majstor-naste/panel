<?php
if (!isset($_GET['client_id'])) {
	exit();
}

include_once ('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();
$server_name = getServerProperty('server_name');
$allowed_bouquets = json_decode(getServerProperty('allowed_bouquets'), true);
$fast_packages = json_decode(getServerProperty('fast_packages'), true);
$client_id = intval($_GET['client_id']);
$client = getClientByID($client_id);

if (!$client) {
	exit();
}

if (!hasPermission($logged_user['id'], $client['id'])) {
	exit();
}

$user_bouquets = json_decode($client['bouquet'], true);
$server_dns = getServerDNS();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['reseller_notes']) && isset($_POST['bouquet'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$reseller_notes = $_POST['reseller_notes'];
	$bouquet = $_POST['bouquet'];

	if (is_array($bouquet)) {
		foreach ($bouquet as $a => $b) {
			if (!in_array($b, $allowed_bouquets)) {
				header('location: ?client_id=' . $client_id . '&result=invalid_bouquet');
				exit();
			}
		}

		if ((strlen($username) < 6) || (255 < strlen($username))) {
			header('location: ?client_id=' . $client_id . '&result=invalid_username');
			exit();
		}

		if ((strlen($password) < 6) || (255 < strlen($password))) {
			header('location: ?client_id=' . $client_id . '&result=invalid_password');
			exit();
		}

		if (500 < strlen($reseller_notes)) {
			header('location: ?client_id=' . $client_id . '&result=invalid_notes');
			exit();
		}

		$bouquet = json_encode($bouquet);

		if (updateClient($client_id, $username, $password, $reseller_notes, $bouquet)) {
			insertRegUserLog($logged_user['id'], $username, $password, '[UserPanel -> Line Edit]');
			header('location: ?client_id=' . $client_id . '&result=success');
			exit();
		}
	}
}
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
		<!-- Bootstrap4 Duallistbox -->
		<link rel="stylesheet" href="plugins2/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
				    
<?php
if (isset($_GET['result'])) {
	$result = $_GET['result'];
	$result_message = 'Aconteceu um problema, tente novamente mais tarde!';
	$result_type = 'warning';

	switch ($result) {
	case 'success':
		$result_message = 'As alterações foram salvas com sucesso.';
		$result_type = 'success';
		break;
	case 'invalid_username':
		$result_message = 'O nome de usuário escolhido é invalido!, deve ter no mínimo 6 caracteres.';
		break;
	case 'invalid_password':
		$result_message = 'A senha escolhida é invalida!, deve ter no mínimo 6 caracteres.';
		break;
	case 'invalid_notes':
		$result_message = 'A observação escolhida é invalida!, deve ter no máximo 500 caracteres.';
		break;
	case 'invalid_bouquet':
		$result_message = 'Os pacotes escolhidos são inválidos.';
		break;
	}?>

	<div class="alert alert-<?php echo $result_type; ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <i class="icon fa fa-check"></i>
              <?php echo $result_message; ?>
            </div>
         
<?php } ?>
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Editar Cliente</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Editar Cliente</li>
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
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Dados do Cliente</h3>
							</div>
							<!-- /.card-header -->
							<form autocomplete="off" action="#" method="post" name="frm1">
							    <input type="hidden" name="action" value="create_custom_test">
								<div class="card-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Usuário</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" required="" autocomplete="off" name="username" data-minlength="6" minlength="6" value="<?php echo $client['username']; ?>" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Senha</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-lock"></i></span>
												</div>
												<input type="text" required="" autocomplete="off" name="password" data-minlength="6" minlength="6" value="<?php echo $client['password']; ?>" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Vencimento</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" readonly="" autocomplete="off" name="exp_date" value="<?php echo date('d/m/Y H:i', $client['exp_date']); ?>" class="form-control" >
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Conexões</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" readonly="" name="max_connections" value="<?php echo $client['max_connections']; ?>" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Notas</label>
											<textarea class="form-control" rows="3" name="reseller_notes" placeholder="Informações..."><?php echo $client['reseller_notes']; ?></textarea>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Definir Pacotes</label>
												<select name="bouquet[]" id="multiselect" size="10" required="" style="overflow: auto" class="duallistbox form-control" multiple="multiple">
													<?php
													    $bouquets = getBouquets();
														foreach ($bouquets as $bouquet) {
														    if (in_array($bouquet['id'], $allowed_bouquets)) {
														        if (in_array($bouquet['id'], $user_bouquets)) { ?>
														            <option value="<?php echo $bouquet['id']; ?>" selected ><?php echo $bouquet['bouquet_name'];?></option>
														        <?php } else { ?>
														            <option value="<?php echo $bouquet['id']; ?>"><?php echo $bouquet['bouquet_name']; ?></option>
														      <?php } } } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Editar Usuário</button>
								</div>
							</form>
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
		<!-- Bootstrap4 Duallistbox -->
		<script src="plugins2/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
		<!-- InputMask -->
		<script src="plugins2/moment/moment.min.js"></script>
		<script src="plugins2/inputmask/min/jquery.inputmask.bundle.min.js"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="plugins2/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
		<!-- Bootstrap Switch -->
		<script src="plugins2/bootstrap-switch/js/bootstrap-switch.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist2/js/adminlte.min.js"></script>
		<!-- Page script -->
		<script>
			$(function () {
			  //Bootstrap Duallistbox
			  $('.duallistbox').bootstrapDualListbox()
			  $("input[data-bootstrap-switch]").each(function(){
			    $(this).bootstrapSwitch('state', $(this).prop('checked'));
			  });
			
			})
		</script>
	</body>
</html>