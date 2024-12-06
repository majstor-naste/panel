<?php
	include_once ('./sys/functions.php');
	isLogged();
	$logged_user = getLoggedUser();
	$server_name = getServerProperty('server_name');
	
	if (!isAdmin($logged_user)) {
		exit();
	}
	
	if (isset($_POST['save_geral']) && isset($_POST['theme_color'])) {
		$theme_color = $_POST['theme_color'];
		updateServerProperty('theme_color', $theme_color);
		header('location: ?result=geral_settings_saved');
		exit();
	}
	
	if (isset($_POST['save_info']) && isset($_POST['fixed_informations'])) {
		$fixed_informations = $_POST['fixed_informations'];
		$result1 = updateServerProperty('fixed_informations', $fixed_informations);
	
		if ($result1) {
			header('location: ?info&result=fixed_informations_saved');
			exit();
		}
	
		header('location: ?info&result=failed');
		exit();
	}
	
	if (isset($_POST['save_allowed_groups']) && isset($_POST['allowed_groups'])) {
		$allowed_groups = json_encode($_POST['allowed_groups']);
		$result1 = updateServerProperty('allowed_groups', $allowed_groups);
	
		if ($result1) {
			header('location: ?grupos&result=allowed_groups_saved');
			exit();
		}
	
		header('location: ?grupos&esult=failed');
		exit();
	}
	
	if (isset($_POST['save_allowed_bouquets']) && isset($_POST['allowed_bouquets'])) {
		$allowed_bouquets = json_encode($_POST['allowed_bouquets']);
		$result1 = updateServerProperty('allowed_bouquets', $allowed_bouquets);
	
		if ($result1) {
			header('location: ?buques&result=allowed_bouquets_saved');
			exit();
		}
	
		header('location: ?buques&result=failed');
		exit();
	}
	
	if (isset($_POST['save_manual_test']) && isset($_POST['fast_packages']) && isset($_POST['test_time']) && isset($_POST['min_credits'])) {
		$fast_packages = json_encode($_POST['fast_packages']);
		updateServerProperty('fast_packages', $fast_packages);
		$test_time = intval($_POST['test_time']);
		updateServerProperty('test_time', $test_time);
		$min_credits = intval($_POST['min_credits']);
		updateServerProperty('test_min_credits', $min_credits);
		header('location: ?testemanual&result=manual_test_saved');
		exit();
	}
	
	if (isset($_POST['save_automatic_test']) && isset($_POST['disabled_days_automatic_test']) && isset($_POST['automatic_test_packages']) && isset($_POST['automatic_test_min_credits'])) {
		$automatic_test = (isset($_POST['automatic_test']) ? 1 : 0);
		updateServerProperty('automatic_test', $automatic_test);
		$random_name_automatic_test = (isset($_POST['random_name_automatic_test']) ? 1 : 0);
		updateServerProperty('random_name_automatic_test', $random_name_automatic_test);
		$only_valid_emails_automatic_test = (isset($_POST['only_valid_emails_automatic_test']) ? 1 : 0);
		updateServerProperty('only_valid_emails_automatic_test', $only_valid_emails_automatic_test);
		$disabled_days_automatic_test = $_POST['disabled_days_automatic_test'];
		updateServerProperty('disabled_days_automatic_test', $disabled_days_automatic_test);
		$automatic_test_packages = json_encode($_POST['automatic_test_packages']);
		updateServerProperty('automatic_test_packages', $automatic_test_packages);
		$automatic_test_min_credits = intval($_POST['automatic_test_min_credits']);
		updateServerProperty('automatic_test_min_credits', $automatic_test_min_credits);
		header('location: ?geradorteste&result=automatic_test_saved');
		exit();
	}
	
	if (isset($_POST['change_resellers']) && isset($_POST['selected_resellers']) && isset($_POST['new_owner']) && isset($_POST['new_group_name'])) {
		$selected_resellers = $_POST['selected_resellers'];
		$new_owner = intval($_POST['new_owner']);
		$new_group = $_POST['new_group_name'];
	
		if (is_array($selected_resellers)) {
			$group_settings = json_decode(getServerProperty('group_settings'), true);
			$group_id = (isset($group_settings[$new_group]) ? $group_settings[$new_group] : 0);
	
			if (transferResellers($selected_resellers, $new_owner, $group_id)) {
				header('location: ?result=resellers_changed');
				exit();
			}
		}
	
		header('location: ?result=failed');
		exit();
	}
	
	if (isset($_POST['save_email_settings']) && isset($_POST['encryption_type']) && isset($_POST['sender_name']) && isset($_POST['sender_email']) && isset($_POST['use_smtp']) && isset($_POST['smtp_server']) && isset($_POST['smtp_port']) && isset($_POST['smtp_username']) && isset($_POST['smtp_password'])) {
		$email_settings = $_POST;
		unset($email_settings['save_email_settings']);
		$email_settings = json_encode($email_settings);
		$result1 = updateServerProperty('email_settings', $email_settings);
	
		if ($result1) {
			header('location: ?result=email_settings_saved');
			exit();
		}
	
		header('location: ?result=failed');
		exit();
	}
	
	if (isset($_POST['save_email_messages']) && isset($_POST['auto_test_subject']) && isset($_POST['auto_test_message']) && isset($_POST['pass_recovery_subject']) && isset($_POST['pass_recovery_message'])) {
		$email_messages = $_POST;
		unset($email_messages['save_email_messages']);
		$email_messages = json_encode($email_messages);
		$result1 = updateServerProperty('email_messages', $email_messages);
	
		if ($result1) {
			header('location: ?result=email_messages_saved');
			exit();
		}
	
		header('location: ?result=failed');
		exit();
	}
	
	$settings = getServerProperties();
	$fixed_informations = $settings['fixed_informations'];
	$allowed_groups = (isset($settings['allowed_groups']) ? json_decode($settings['allowed_groups'], true) : array());
	$allowed_bouquets = (isset($settings['allowed_bouquets']) ? json_decode($settings['allowed_bouquets'], true) : array());
	$fast_packages = (isset($settings['fast_packages']) ? json_decode($settings['fast_packages'], true) : array());
	$automatic_test_packages = (isset($settings['automatic_test_packages']) ? json_decode($settings['automatic_test_packages'], true) : array());
	$email_settings = json_decode($settings['email_settings'], true);
	$email_messages = json_decode($settings['email_messages'], true);
	
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
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins2/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="plugins2/select2/css/select2.min.css">
		<!-- summernote -->
		<link rel="stylesheet" href="plugins2/summernote/summernote-bs4.css">
		<!-- Bootstrap Switch -->
		<script src="plugins2/bootstrap-switch/js/bootstrap-switch.min.js"></script>
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
							case 'geral_settings_saved':
								$result_message = 'Configurações gerais salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'fixed_informations_saved':
								$result_message = 'Informações Fixas salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'allowed_groups_saved':
								$result_message = 'Grupos permitidos salvados com sucesso.';
								$result_type = 'success';
								break;
							case 'allowed_bouquets_saved':
								$result_message = 'Listas permitidas salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'manual_test_saved':
								$result_message = 'As configurações de teste manual foram salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'automatic_test_saved':
								$result_message = 'As configurações do gerador de teste automático foram salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'resellers_changed':
								$result_message = 'Os revendedores foram transferidos com sucesso.';
								$result_type = 'success';
								break;
							case 'email_messages_saved':
								$result_message = 'Mensagens de email salvadas com sucesso.';
								$result_type = 'success';
								break;
							case 'email_settings_saved':
								$result_message = 'Configurações de email salvadas com sucesso.';
								$result_type = 'success';
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
								<h1>Configurações</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Configurações</li>
								</ol>
							</div>
						</div>
					</div>
				</section>
				<section class="content">
					<div class="container-fluid">
						<?php if (isset($_GET['geral'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Geral</h3>
							</div>
							<form role="form" method="POST" id="remove-lists">
								<div class="card-footer">
									<button type="submit" class="btn btn-danger">Excluir Listas</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['info'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Informações Dashboard</h3>
							</div>
							<form autocomplete="off" action="#" method="post">
								<div class="card-body pad">
									<p class="text-sm mb-0">
										Escreva informações importantes e úteis para serem exibidas na Dashboad do painel
									</p>
									<br>
									<div class="mb-3">
										<textarea class="textarea" id="fixed_informations" name="fixed_informations" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
										<?php echo $fixed_informations; ?>
										</textarea>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="save_info" class="btn btn-primary">Salvar informações</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['grupos'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Grupos Permitidos</h3>
							</div>
							<form autocomplete="off" action="#" method="post">
								<div class="card-body pad">
									<p class="text-sm mb-0">
										Selecione os grupos que tem permissão para acessar o painel office.
									</p>
									<br>
									<div class="col-md-6">
										<div class="form-group">
											<select class="select2" multiple="multiple" id="allowed_groups" name="allowed_groups[]" data-placeholder="Selecione os Grupos" style="width: 100%;">
												<?php
													foreach (getAllGroups() as $group) {
													    if (in_array($group['group_id'], $allowed_groups)) { ?>
												<option value="<?php echo $group['group_id'];?>" selected><?php echo $group['group_name'];?></option>
												<? } else { ?>
												<option value="<?php echo $group['group_id'];?>"><?php echo $group['group_name']; ?></option>
												<?php } }?>
											</select>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="save_allowed_groups" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['buques'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Buques Permitidos</h3>
							</div>
							<form autocomplete="off" action="#" method="post">
								<div class="card-body pad">
									<p class="text-sm mb-0">
										Selecione os buquês permitidos para o painel office.
									</p>
									<br>
									<div class="col-md-6">
										<div class="form-group">
											<select class="select2" multiple="multiple" id="allowed_bouquets" name="allowed_bouquets[]" data-placeholder="Selecione os Buquês" style="width: 100%;">
												<?php
													foreach (getBouquets() as $bouquet) {
													 if (in_array($bouquet['id'], $allowed_bouquets)) { ?>
												<option value="<?php echo $bouquet['id'];?>" selected><?php echo $bouquet['bouquet_name'];?></option>
												<? } else { ?>
												<option value="<?php echo $bouquet['id'];?>"><?php echo $bouquet['bouquet_name']; ?></option>
												<?php } }?>
											</select>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="save_allowed_bouquets" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['testemanual'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">Teste Manual</h3>
							</div>
							<form autocomplete="off" action="#" method="post">
								<div class="card-body pad">
									<div class="col-md-6">
										<label>Selecione os pacotes para criação de teste rápido.</label>
										<div class="form-group">
											<select class="select2" multiple="multiple" id="fast_packages" name="fast_packages[]" data-placeholder="Selecione os Pacotes" style="width: 100%;">
												<?php
													foreach (getPackages() as $package) {
													 if ($package['is_trial']) { ?>
												<option value="<?php echo $package['id'];?>" selected><?php echo $package['package_name'];?></option>
												<? } else { ?>
												<option value="<?php echo $package['id'];?>"><?php echo $package['package_name']; ?></option>
												<?php } }?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<label>Defina o tempo em horas do teste customizado.</label>
										<div class="form-group">
											<input type="number" class="form-control" required="" value="<?php echo getServerProperty('test_time', 1);?>" data-minlength="0" minlength="0" autocomplete="off" id="test_time" name="test_time">
										</div>
									</div>
									<div class="col-md-6">
										<label>Defina o mínimo de créditos para a criação de testes.</label>
										<div class="form-group">
											<input type="number" class="form-control" required="" value="<?php echo getServerProperty('test_min_credits', 0);?>" data-minlength="0" minlength="0" autocomplete="off" id="min_credits" name="min_credits">
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="save_manual_test" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['geradorteste'])){ ?>
						<div class="card card-default">
							<form autocomplete="off" action="#" method="post">
								<div class="card-header">
									<h3 class="card-title">Gerador Teste</h3>
									<div class="card-tools">
										<input type="checkbox" name="automatic_test" <?php  if (getServerProperty('automatic_test', 0)){ echo 'checked';} ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
									</div>
								</div>
								<div class="card-body pad">
									<div class="col-md-6">
										<label>Selecione os pacotes para o gerador de teste automático.</label>
										<div class="form-group">
											<select class="select2" multiple="multiple" id="automatic_test_packages" name="automatic_test_packages[]" data-placeholder="Selecione os Pacotes" style="width: 100%;">
												<?php
													foreach (getPackages() as $package) {
													 if ($package['is_trial']) {
													 	if (in_array($package['id'], $automatic_test_packages)) {?>
												<option value="<?php echo $package['id'];?>" selected><?php echo $package['package_name'];?></option>
												<? } else { ?>
												<option value="<?php echo $package['id'];?>"><?php echo $package['package_name']; ?></option>
												<?php } } }?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<label>Defina o minimo de créditos para a utilização do gerador de teste automático.</label>
										<div class="form-group">
											<input type="number" class="form-control" required="" value="<?php echo getServerProperty('test_min_credits', 0);?>" data-minlength="0" minlength="0" autocomplete="off" id="automatic_test_min_credits" name="automatic_test_min_credits">
										</div>
									</div>
									<label>Selecione dias para deixar o gerador de teste desativado.</label>
									<div class="input-group col-md-6">
										<div class="input-group-prepend">
											<span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="text" class="form-control float-right" id="datepicker" name="disabled_days_automatic_test" value="<?php echo getServerProperty('disabled_days_automatic_test', '');?>">
									</div>
									<br>
									<div class="input-group col-md-6">
										<div class="form-group">
										    <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="random_name_automatic_test" type="checkbox" id="random_name_automatic_test" <?php if (getServerProperty('random_name_automatic_test', 0)) { echo 'checked'; } ?>>
                                                <label for="random_name_automatic_test" class="custom-control-label">Gerar nome de usuário aleatório.</label>
                                            </div>
										</div>
									</div>
									<div class="input-group col-md-6">
										<div class="form-group">
										    <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="only_valid_emails_automatic_test" type="checkbox" id="only_valid_emails_automatic_test" <?php if (getServerProperty('only_valid_emails_automatic_test', 0)) { echo 'checked'; } ?>>
                                                <label for="only_valid_emails_automatic_test" class="custom-control-label">Permitir apenas e-mails válidos.</label>
                                            </div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" name="save_automatic_test" class="btn btn-primary">Salvar</button>
								</div>
							</form>
						</div>
						<?php } elseif (isset($_GET['email'])){ ?>
						<div class="card card-default">
							<div class="card-header">
								<h3 class="card-title">E-mail</h3>
							</div>
							<form role="form" method="POST" id="remove-lists">
								<div class="card-footer">
									<button type="submit" class="btn btn-danger">Excluir Listas</button>
								</div>
							</form>
						</div>
						<?php } ?>
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
		<!-- bootstrap datepicker -->
		<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist2/js/adminlte.min.js"></script>
		<!-- Bootstrap Switch -->
		<script src="plugins2/bootstrap-switch/js/bootstrap-switch.min.js"></script>
		<!-- Summernote -->
		<script src="plugins2/summernote/summernote-bs4.min.js"></script>
		<script src="plugins2/summernote/lang/summernote-pt-BR.js"></script>
		<script>
			$(function () {
			  //Initialize Bootstrap Datepicker
			  $("#datepicker").datepicker({
			      multidate: true,
			      showOtherMonths: true,
			      selectOtherMonths: true
			  });
			  //Initialize Bootstrap Switch
			  $("input[data-bootstrap-switch]").each(function(){
			      $(this).bootstrapSwitch('state', $(this).prop('checked'));
			  });
			  //Initialize Select2 Elements
			  $('.select2').select2()
			
			  //Initialize Summernote
			  $('.textarea').summernote({ lang: 'pt-BR' })
			})
		</script>
		<script type="text/javascript">
			$(".alert").delay(3000).slideUp(200, function() {
			  $(this).alert('close');
			});
			
			$('.use_smtp').on('ifChecked', function(event){
			  if($('.use_smtp:checked').val() === '0'){
			    $(".smtp_form :input").attr("readonly", true);
			  } else {
			    $(".smtp_form :input").removeAttr("readonly");
			  }
			});
		</script>
	</body>
</html>