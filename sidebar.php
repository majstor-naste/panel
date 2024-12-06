<?php
	include_once ('./sys/functions.php');
	isLogged();
	$logged_user = getLoggedUser();
	$server_name = getServerProperty('server_name');
	$fast_packages = json_decode(getServerProperty('fast_packages'), true);
	$fixed_informations = getServerProperty('fixed_informations');
?>
<style>
    .nav-item.dropdown:hover .dropdown-menu{ display:block !important; }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item">
			<spam class="badge badge-info">Créditos: <?php echo getCreditsByUser($logged_user); ?></spam>
		</li>
		<?php if (isAdmin($logged_user)) { ?>
		
		
		<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="fas fa-cogs"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Configurações</span>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?geral" class="dropdown-item">
            Geral
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?info" class="dropdown-item">
            Informações Dashboard
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?grupos" class="dropdown-item">
            Segurança
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?buques" class="dropdown-item">
            Buquês
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?testemanual" class="dropdown-item">
            Teste Manual
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?geradorteste" class="dropdown-item">
            Gerador de Teste
          </a>
          <div class="dropdown-divider"></div>
          <a href="settings2.php?email" class="dropdown-item">
            E-mail
          </a>
          
          
        </div>
      </li>
		<?php } ?>
	</ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link">
	    <img src="dist/img/logo_small.png" alt="<?php echo $server_name;?>" class="brand-image img-circle elevation-3"
		    style="opacity: .8">
	    <span class="brand-text font-weight-light"><?php echo $server_name;?></span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
			    <li class="nav-header">Menu Principal</li>
				<li class="nav-item <?php if( $_SERVER["REQUEST_URI"] == "/dashboard.php" ){ echo 'menu-open'; };  ?>">
					<a href="dashboard.php" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item has-treeview <?php if( $_SERVER["REQUEST_URI"] == "/create_test.php" ){ echo 'menu-open'; };  ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-user-clock"></i>
						<p>Criar Teste<i class="fas fa-angle-left right"></i>
							<!--span class="badge badge-info right">6</span-->
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="create_test.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/create_test.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Personalizado</p>
							</a>
						</li>
						<?php $packages = getPackages();
							foreach ($fast_packages as $package_id) {
								$package_key = array_search($package_id, array_column($packages, 'id'));
							
								if ($package_key !== false) {
									$current_package = $packages[$package_key];
							
									if ($current_package['is_trial'] == 1) {
										echo '<li class="nav-item"><a href="./sys/API.php?action=create_test&package_id=';
										echo $current_package['id'];
										echo '" class="nav-link" ><i class="far fa-circle nav-icon"></i> ';
										echo $current_package['package_name'];
										echo '</a></li>
							                  ';
									}
								}
							}
							?>
					</ul>
				</li>
				<li class="nav-item has-treeview <?php if( ($_SERVER["REQUEST_URI"] == "/online.php") or ($_SERVER["REQUEST_URI"] == "/clients.php") or ($_SERVER["REQUEST_URI"] == "/create_client.php") ){ echo 'menu-open'; };  ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>Usuários<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="online.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/online.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Usuários Online</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="clients.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/clients.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Gerir Usuários</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="create_client.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/create_client.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Criar Usuário</p>
							</a>
						</li>
					</ul>
				</li>
				<?php if (isAdmin($logged_user) || isUltra($logged_user) || isMaster($logged_user)) { ?>
				<li class="nav-item has-treeview <?php if( ($_SERVER["REQUEST_URI"] == "/resellers.php") or ($_SERVER["REQUEST_URI"] == "/create_reseller.php") ){ echo 'menu-open'; };  ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>Revendedores<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="resellers.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/resellers.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Gerir Revendas</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="create_reseller.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/create_reseller.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Criar Revenda</p>
							</a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<li class="nav-item">
					<a href="tools.php" class="nav-link">
						<i class="nav-icon fas fa-braille"></i>
						<p>Ferramentas</p>
					</a>
				</li>
				<li class="nav-item has-treeview <?php if( ($_SERVER["REQUEST_URI"] == "/new_channels.php") or ($_SERVER["REQUEST_URI"] == "/new_movies.php") or ($_SERVER["REQUEST_URI"] == "/new_series.php") ){ echo 'menu-open'; };  ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-film"></i>
						<p>Conteúdo Novo<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="new_channels.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/new_channels.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Novos Canais</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="new_movies.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/new_movies.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Novos Filmes</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="new_series.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/new_series.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Novos Series</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview <?php if( ($_SERVER["REQUEST_URI"] == "/create_ticket.php") or ($_SERVER["REQUEST_URI"] == "/manage_tickets.php") ){ echo 'menu-open'; };  ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-ticket-alt"></i>
						<p>Tickets de Suporte<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="create_ticket.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/create_ticket.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Criar Ticket</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="manage_tickets.php" class="nav-link <?php if( $_SERVER["REQUEST_URI"] == "/manage_tickets.php" ){ echo 'active'; };  ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Gerenciar Tickets</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">Configurações</li>
				<li class="nav-item <?php if( $_SERVER["REQUEST_URI"] == "/profile.php" ){ echo 'menu-open'; };  ?>">
					<a href="profile.php" class="nav-link">
						<i class="nav-icon far fa-user-circle"></i>
						<p>Perfil</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="logout.php" class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>Sair</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>