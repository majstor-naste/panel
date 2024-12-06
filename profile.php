<?php
include_once ('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();

if (!isAdmin($logged_user) && !isUltra($logged_user) && !isMaster($logged_user) && !isReseller($logged_user)) {
	header('Location: ./index.php');
	exit();
}

$server_name = getServerProperty('server_name');
$fast_packages = json_decode(getServerProperty('fast_packages'), true);
$whatsapp = getUserProperty($logged_user['id'], 'whatsapp');
$telegram = getUserProperty($logged_user['id'], 'telegram');

if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['whatsapp']) && isset($_POST['telegram'])) {
	$password = $_POST['password'];
	$email = $_POST['email'];
	$whatsapp = $_POST['whatsapp'];
	$telegram = $_POST['telegram'];

	if (!empty($passowrd) && ((strlen($password) < 6) || (255 < strlen($password)))) {
		header('location: ?result=invalid_password');
		exit();
	}

	if (updateUser($logged_user['id'], $logged_user['username'], $password, $email, $logged_user['member_group_id'], $logged_user['notes'])) {
		deleteUserProperty($logged_user['id'], 'whatsapp');
		deleteUserProperty($logged_user['id'], 'telegram');
		$result1 = addUserProperty($logged_user['id'], 'whatsapp', $whatsapp);
		$result2 = addUserProperty($logged_user['id'], 'telegram', $telegram);
		if ($result1 && $result2) {
			header('location: ?result=success');
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
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins2/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="plugins2/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="plugins2/select2/css/select2.min.css">
		<link rel="stylesheet" href="plugins2/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
		$result_message = 'Os dados foram alterados com sucesso.';
		$result_type = 'success';
		break;
	case 'invalid_password':
		$result_message = 'A senha escolhida é invalida!, deve ter no mínimo 6 caracteres.';
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
								<h1>Perfil</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Perfil</li>
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
								<h3 class="card-title">Meus Dados</h3>
							</div>
							<!-- /.card-header -->
							<form autocomplete="off" action="#" method="post" name="frm1">
								<div class="card-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Usuário</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" readonly="" autocomplete="off" name="username" class="form-control" placeholder="Usuário" value="<?php echo $logged_user['username']; ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Senha</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-lock"></i></span>
												</div>
												<input type="text" autocomplete="off" name="password" data-minlength="6" minlength="6" class="form-control" placeholder="*********">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>E-mail</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-at"></i></span>
												</div>
												<input type="email" autocomplete="off" required="" name="email" class="form-control" placeholder="E-mail" value="<?php echo $logged_user['email']; ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Criado</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
												</div>
												<input type="text" autocomplete="off" readonly="" name="date_registered" class="form-control" value="<?php echo date('d/m/Y H:i', $logged_user['date_registered']); ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>WhatsApp</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
												</div>
												<input type="text" autocomplete="off" name="whatsapp" class="form-control" placeholder="WhatsApp" data-inputmask="'mask': ['(99) [9]9999-9999', '+099 99 99 9999[9]-9999']" data-mask="" im-insert="true" value="<?php echo $whatsapp ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Telegram</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fab fa-telegram-plane"></i></span>
												</div>
												<input type="text" autocomplete="off" name="telegram" class="form-control" placeholder="Telegram" value="<?php echo $telegram ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
			<?php include_once ('footer.php'); ?>
		</div>
		<!-- jQuery -->
		<script src="plugins2/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins2/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Select2 -->
        <script src="plugins2/select2/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins2/moment/moment.min.js"></script>
        <script src="plugins2/inputmask/min/jquery.inputmask.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist2/js/adminlte.min.js"></script>
		<!-- Page script -->
		<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Initialize InputMask Elements
    $('[data-mask]').inputmask()
  })
</script>
	</body>
</html>