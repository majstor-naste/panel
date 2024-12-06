<?php
include_once ('./sys/functions.php');
startSession();

if (isset($_SESSION['__l0gg3d_us3r__'])) {
	header('Location: ./dashboard.php');
	exit();
}

$server_name = getServerProperty('server_name');

if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$result = resetPassword($email);

	switch ($result) {
	case 1:
		header('location: ?result=success');
		exit();
	case 2:
		header('location: ?result=invalid_email');
		exit();
	case 3:
		header('location: ?result=email_not_found');
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
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<!--span class="login100-form-title p-b-26">
						Welcome
					</span-->
					<span class="login100-form-title p-b-48">
						<a href="index.php"><img src="dist/img/logo_giant.png" style="max-width: 100%;"></a>
					</span>
					<span class="login100-form-title p-b-36">
						Redefinir Senha
					</span>
					<div class="wrap-input100 validate-input" data-validate = "E-mail inválido">
						<input class="input100" type="text" name="email" autocomplete="off">
						<span class="focus-input100" data-placeholder="E-mail"></span>
					</div></br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Redefinir
							</button>
						</div>
					</div>
					<div class="text-center p-t-115">
						<a class="txt1">
							Enviaremos um email com instruções de como redefinir sua senha.
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
	$result_type = 'error';

	switch ($result) {
	case 'success':
	    $result_title = 'Feito!';
	    $result_type = 'success';
		$result_message = 'As instruções para você alterar sua senha foram enviadas ao seu e-mail!';
		break;
	case 'invalid_email':
	    $result_title = 'Erro!';
	    $result_type = 'error';
		$result_message = 'E-mail inválido, verifique se o email esta correto e tente novamente.';
		break;
	case 'email_not_found':
	    $result_title = 'Erro!';
		$result_type = 'error';
		$result_message = 'Não existe nenhum usuário cadastrado com este e-mail!';
		break;
	}
?>

    <script type="text/javascript">
        window.onload = function ErrorAlert(){
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