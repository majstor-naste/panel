<?php
	include_once ('./sys/functions.php');
isLogged();
$logged_user = getLoggedUser();
$server_name = getServerProperty('server_name');
$allowed_bouquets = json_decode(getServerProperty('allowed_bouquets'), true);
$fast_packages = json_decode(getServerProperty('fast_packages'), true);

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['reseller_notes']) && isset($_POST['bouquet'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$reseller_notes = $_POST['reseller_notes'];
	$bouquet = $_POST['bouquet'];
	$email = (isset($_POST['email']) ? $_POST['email'] : '');
	$send_email = isset($_POST['send_email']);

	if (is_array($bouquet)) {
		foreach ($bouquet as $a => $b) {
			if (!in_array($b, $allowed_bouquets)) {
				header('location: ?result=invalid_bouquet');
				exit();
			}
		}

		if ((strlen($username) < 6) || (255 < strlen($username))) {
			header('location: ?result=invalid_username');
			exit();
		}

		if ((strlen($password) < 6) || (255 < strlen($password))) {
			header('location: ?result=invalid_password');
			exit();
		}

		if (500 < strlen($reseller_notes)) {
			header('location: ?result=invalid_notes');
			exit();
		}

		$bouquet = json_encode($bouquet);
		if ($send_email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('location: ?key=' . $key . '&result=invalid_email');
			exit();
		}

		if (addOrRemoveCredits($logged_user['id'], -1)) {
			if (createClient($logged_user['id'], $username, $password, '1 months', $bouquet, $reseller_notes, 0)) {
				$old_credits = $logged_user['credits'];
				$logged_user = getLoggedUser();
				$now_credits = $logged_user['credits'];
				insertRegUserLog($logged_user['id'], $username, $password, '[<b>UserPanel</b> -> <u>New Line</u>] with Package [Custom Package], Credits: <font color="green">' . $old_credits . '</font> -> <font color="red">' . $now_credits . '</font>');

				if ($send_email) {
					$list_link = GetList($username, $password);
					$email_messages = json_decode(getServerProperty('email_messages'), true);
					$whatsapp = getUserProperty($logged_user['id'], 'whatsapp');
					$telegram = getUserProperty($logged_user['id'], 'telegram');
					$auto_test_subject = str_replace(array('{USERNAME}', '{PASSWORD}', '{SERVER_NAME}'), array($username, $password, $server_name), $email_messages['auto_test_subject']);
					$auto_test_message = str_replace(array('{USERNAME}', '{PASSWORD}', '{LIST_LINK}', '{SERVER_NAME}', '{RESELLER_EMAIL}', '{WHATSAPP}', '{TELEGRAM}'), array($username, $password, $list_link, $server_name, $logged_user['email'], $whatsapp, $telegram), $email_messages['auto_test_message']);

					if (smtpmailer($email, $auto_test_subject, $auto_test_message)) {
						header('location: ?key=' . $key . '&result=success');
						exit();
					}

					header('location: ?result=cant_send_email');
					exit();
				}

				header('location: ?result=success');
				exit();
			}
			else {
				addOrRemoveCredits($logged_user['id'], 1);
				header('location: ?result=exist_client');
				exit();
			}
		}
		else {
			header('location: ?result=insufficient_credits');
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
		$result_message = 'O usuário foi criado com sucesso.';
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
	case 'invalid_email':
		$result_message = 'O e-mail escolhido é invalido!';
		break;
	case 'insufficient_credits':
		$result_message = 'Você não tem créditos suficiente, recarregue seu painel.';
		break;
	case 'exist_client':
		$result_message = 'Já existe um usuário com este nome de usuário, escolha outro.';
		break;
	case 'cant_send_email':
		$result_message = 'O usuário foi criado com sucesso, mas não foi possível enviar o e-mail com os dados de acesso.';
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
								<h1>Criar Cliente</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Criar Cliente</li>
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
								<div class="card-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Usuário</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-user"></i></span>
												</div>
												<input type="text" required="" autocomplete="off" name="username" data-minlength="6" minlength="6" class="form-control" placeholder="Usuário">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Senha</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-lock"></i></span>
												</div>
												<input type="text" required="" autocomplete="off" name="password" data-minlength="6" minlength="6" class="form-control" placeholder="Senha">
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>E-mail</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-at"></i></span>
												</div>
												<input type="email" autocomplete="off" value="" name="email" class="form-control" placeholder="E-mail">
											</div>
											<div class="custom-control custom-switch">
												<input type="checkbox" name="send_email" class="custom-control-input" id="customSwitch1">
												<label class="custom-control-label" for="customSwitch1">Enviar dados do teste via e-mail</label>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Notas</label>
											<textarea class="form-control" rows="3" name="reseller_notes" placeholder="Informações..."></textarea>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Definir Pacotes</label>
												<select name="bouquet[]" id="multiselect" size="10" required="" style="overflow: auto" class="duallistbox form-control" multiple="multiple">
													<?php $bouquets = getBouquets();
														foreach ($bouquets as $bouquet) {
														                                  if (in_array($bouquet['id'], $allowed_bouquets)) { ?>
													<option value="<?php echo $bouquet['id'];?>"><?php echo $bouquet['bouquet_name'];?></option>
													<?php } } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Criar Usuário</button>
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