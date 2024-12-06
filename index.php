<?php
include_once ('./sys/functions.php');
$server_name = getServerProperty('server_name');
startSession();

if (isset($_SESSION['__l0gg3d_us3r__'])) {
	header('Location: ./dashboard.php');
	exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = loginUser($username, $password);

	switch ($result) {
	case 1:
		header('location: ./dashboard.php');
		exit();
	case 2:
		header('location: ?result=cant_connect');
		exit();
	case 3:
		header('location: ?result=invalid_user_or_pass');
		exit();
	case 4:
		header('location: ?result=blocked');
		exit();
	case 5:
		header('location: ?result=insufficient_permission');
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $server_name;?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins2/sweetalert2/sweetalert2.min.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="padding-top: 0px;">
				<form class="login100-form validate-form" action="index.php" method="post">
					<!--span class="login100-form-title p-b-26">
						Welcome
					</span-->
					<span class="login100-form-title">
						<a href="index.php"><img src="dist/img/logo_giant.png" style="max-width: 100%;"></a>
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Digite o seu usuário!">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Usuário"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Digite a sua senha!">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div></br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Entrar
							</button>
						</div>
					</div>
					<div class="text-center p-t-40">
						<a class="txt1" href="forget_password.php">
							Esqueci minha senha!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login/vendor/select2/select2.min.js"></script>
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
	<script src="login/js/main.js"></script>
	<!-- SweetAlert2 -->
    <script src="plugins2/sweetalert2/sweetalert2.js"></script>
<?php
    if (isset($_GET['result'])) {
	$result = $_GET['result'];
	$result_title = 'Erro!';
	$result_message = 'Aconteceu um problema, tente novamente mais tarde!';
	$result_type = 'warning';

	switch ($result) {
	case 'cant_connect':
	    $result_title = 'Erro!';
	    $result_type = 'error';
		$result_message = 'Não é possível se conectar agora, tente novamente em alguns minutos!';
		break;
	case 'invalid_user_or_pass':
	    $result_title = 'Erro!';
	    $result_type = 'error';
		$result_message = 'Usuário ou/e senha incorreto(s).';
		break;
	case 'blocked':
	    $result_title = 'Erro!';
		$result_type = 'error';
		$result_message = 'Usuário bloqueado, contacte seu revendedor.';
		break;
	case 'insufficient_permission':
	    $result_title = 'Erro!';
		$result_type = 'error';
		$result_message = 'Você não tem permissão para acessar o painel office!';
		break;
	case 'password_changed':
	    $result_title = 'Feito!';
		$result_type = 'success';
		$result_message = 'Senha alterada com sucesso, conecte-se.';
		break;
	}
?>

    <script type="text/javascript">
    console.log("b")
        window.onload = function ErrorAlert(){
            console.log("a")
            Swal.fire(
                '<?php echo $result_title; ?>',
                '<?php echo $result_message; ?>',
                '<?php echo $result_type; ?>'
            )
        };
    </script>
    <?php } ?>
</body>
</html>