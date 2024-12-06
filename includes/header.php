<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'check.php';

if (!isset($_SESSION['eggziesibonew3'])) {
	header('location:index.php');
	exit();
}

$ifofuser = $_SESSION['id'];
$db_header = new SQLite3('./a/.eggziepanels.db');
$res_header = $db_header->query('SELECT * ' . "\n\t\t\t\t" . '  FROM USERS ' . "\n\t\t\t\t" . '  WHERE id=\'' . $ifofuser . '\'');
$row_header = $res_header->fetchArray();
$name_header = $row_header['NAME'];
$logo_header = $row_header['LOGO'];
$jsondata111 = file_get_contents('./includes/eggzie.json');
$json111 = json_decode($jsondata111, true);
$col1 = $json111['info'];
$panel_name = $col1['a'];
$headerfav_icon = $col1['c'];
$colname = $col1['uu'];
$collink = $col1['ww'];
$colicon = $col1['yy'];
$colinc5 = $col1['a5'];
$colinc10 = $col1['mm'];
$colinc11 = $col1['oo'];
$colinc12 = $col1['qq'];
$colinc13 = $col1['ss'];
$colinc14 = $col1['tt'];
$colinc15 = $col1['vv'];
$json_colour = $json111['colours'];
$colour_head_2 = $json_colour['bb'];
$colour_head_3 = $json_colour['cc'];
$colour_head_4 = $json_colour['dd'];
$colour_head_5 = $json_colour['ee'];
$colour_head_6 = $json_colour['ff'];
$colour_head_7 = $json_colour['gg'];
$colour_head_8 = $json_colour['hh'];
$colour_head_9 = $json_colour['ii'];
$colour_head_10 = $json_colour['jj'];
$colour_head_11 = $json_colour['kk'];
$colour_head_12 = $json_colour['ll'];
$colour_head_13 = $json_colour['mm'];
$colour_head_14 = $json_colour['nn'];
$colour_head_15 = $json_colour['oo'];
$colour_head_16 = $json_colour['pp'];
$colour_head_17 = $json_colour['qq'];
$colour_head_18 = $json_colour['rr'];
$colour_head_btn = $json_colour['ss'];
$colour_switch_on = $json_colour['tt'];
$colour_switch_off = $json_colour['uu'];
echo '<!DOCTYPE html>' . "\n";
echo '<!DOCTYPE html>' . "\n";
echo '<html lang="en">' . "\n";
echo "\n";
echo '<head>' . "\n";
echo "\n";
$jsondata111 = file_get_contents('./includes/eggzie.json');
$json111 = json_decode($jsondata111, true);
$col1 = $json111['info'];
$col2 = $col1['aa'];
echo '  <meta charset="utf-8">' . "\n";
echo '  <meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
echo '  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "\n";
echo '  <meta name="description" content="">' . "\n";
echo '  <meta name="author" content="">' . "\n";
echo '  <meta name="google" content="notranslate">' . "\n";
echo '  <script src="https://kit.fontawesome.com/3794d2f89f.js" crossorigin="anonymous"></script>' . "\n";
echo '  <title>IBO V10</title>' . "\n";
echo '  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "\n";
echo '  <link rel="icon" href="favicon.ico" type="image/x-icon">' . "\n";

echo '  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">' . "\n";
echo '  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>' . "\n";


echo '  <!-- Custom styles for this template-->' . "\n";
echo '  <link href="css/sb-admin-' . $col2 . '.css" rel="stylesheet">' . "\n";
echo '  <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>' . "\n";
echo '  <!-- Custom fonts for this template-->' . "\n";
echo '  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' . "\n";
echo '  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' . "\n";
echo ' ' . "\n";
echo '</head> ' . "\n";
echo '<body id="page-top">' . "\n";
echo "\n";
echo '  <!-- Page Wrapper -->' . "\n";
echo '  <div id="wrapper">' . "\n";
echo "\n";
echo '    <!-- Sidebar -->' . "\n";
echo '    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">' . "\n";
echo "\n";

if ($logo_header != NULL) {
	echo '      <!-- Sidebar - Brand -->' . "\n";
	echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="colour.php">' . "\n";
	echo '        <div class="sidebar-brand-icon">' . "\n";
	echo '          <img class="img-profile" width="65px" src="' . $logo_header . '">' . "\n";
	echo '        </div>' . "\n";
}
else {
	echo '      <!-- Sidebar - Brand -->' . "\n";
	echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="colour.php">' . "\n";
	echo '        <div class="sidebar-brand-icon">' . "\n";
	echo '          <img class="img-profile" width="65px" src="img/logo.png">' . "\n";
	echo '        </div>' . "\n";
}

echo "\n";
echo '      </a>' . "\n";
echo "\n";
echo '      <!-- Divider -->' . "\n";
echo '      <hr class="sidebar-divider my-0">' . "\n";
echo "\n";
echo '      <br>' . "\n";
echo '      <div class="flash rounded">' . "\n";
echo '      <!-- Nav Item -->' . "\n";
echo '      <li class="nav-item"><br>' . "\n";
echo '            <z1><span1><center><h4 style="color:#6e7485" class="collapse-header2">Main</h4></center></span1></z1>' . "\n";
echo '            <hr class="sidebar-divider d-none d-md-block">' . "\n";
echo '        <a class="nav-link" href="dashboard.php">' . "\n";
echo '          <i class="fa fa-home"></i>' . "\n";
echo '          <span>Painel</span></a>' . "\n";
echo '      </li>' . "\n";
echo '      <!-- Nav Item -->' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '        <a class="nav-link" href="users.php">' . "\n";
echo '          <i class="fas fa-fw fa-user-plus"></i>' . "\n";
echo '          <span>Usuarios</span></a>' . "\n";
echo '      </li>' . "\n";
echo '      <!-- Nav Item -->' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '        <a class="nav-link" href="portals.php">' . "\n";
echo '          <i class="fas fa-fw fa fa-server"></i>' . "\n";
echo '          <span>Servidores</span></a>' . "\n";
echo '      </li>' . "\n";
echo '      <!-- Nav Item -->' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '        <a class="nav-link" href="note.php">' . "\n";
echo '          <i class="fas fa-fw fa fa-newspaper"></i>' . "\n";
echo '          <span>Notificações</span></a>' . "\n";
echo '      </li>' . "\n";
echo '        </div>' . "\n";
echo '      <br>' . "\n";
echo '      <div class="flash rounded">' . "\n";
echo '      <!-- Nav Item -->' . "\n";
echo '      ' . "\n";

echo '        </div>' . "\n";
echo '      <br>' . "\n";
echo '      <div class="flash rounded"><br>' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '            <z1><span1><center><h4 style="color:#6e7485" class="collapse-header2">Extras</h4></center></span1></z1>' . "\n";
echo '            <hr class="sidebar-divider d-none d-md-block">' . "\n";
echo '        <a class="nav-link" href="snoop.php">' . "\n";
echo '          <i class="fas fa-fw fa-eye"></i>' . "\n";
echo '          <span>Conectado</span></a>' . "\n";
echo '      </li>' . "\n";
echo '      ' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '        <a class="nav-link" href="profile.php">' . "\n";
echo '          <i class="fas fa-fw fa-user"></i>' . "\n";
echo '          <span>ADM</span></a>' . "\n";
echo '      </li>' . "\n";
echo '      ' . "\n";
echo '    ' . "\n";
echo '      <li class="nav-item">' . "\n";
echo '        <a class="nav-link" href="logout.php">' . "\n";
echo '          <i class="fas fa-fw fa fa-sign-out"></i>' . "\n";
echo '          <span>Deslogar</span></a>' . "\n";
echo '      </li>' . "\n";
echo '        </div>' . "\n";
echo '      <br>' . "\n";
echo '      <!-- Sidebar Toggler (Sidebar) -->' . "\n";
echo "\n";
echo '    </ul>' . "\n";
echo '    <!-- End of Sidebar -->' . "\n";
echo "\n";
echo '    <!-- Content Wrapper -->' . "\n";
echo '    <div id="content-wrapper" class="d-flex flex-column">' . "\n";
echo "\n";
echo '      <!-- Main Content -->' . "\n";
echo '      <div id="content">' . "\n";
echo "\n";
echo '        <!-- Topbar -->' . "\n";
echo '        <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow">' . "\n";
echo "\n";
echo '          <!-- Sidebar Toggle (Topbar) -->' . "\n";
echo '          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">' . "\n";
echo '            <i class="fa fa-bars"></i>' . "\n";
echo '          </button>' . "\n";
echo '<z1><span1>𝑰𝑩𝑶 𝑷𝒍𝒂𝒚𝒆𝒓 𝑷𝒓𝒐 𝑽10</span1></z1>' . "\n";
echo "\n";
echo '          <!-- Topbar Navbar -->' . "\n";
echo '          <ul class="navbar-nav ml-auto">' . "\n";
echo "\n";
echo "\n";
echo '            <div class="topbar-divider d-none d-sm-block"></div>' . "\n";
echo "\n";
echo '            <!-- Nav Item - Logout -->' . "\n";
echo '            <li class="nav-item dropdown no-arrow mx-1">' . "\n";
echo '              <a class="nav-link dropdown-toggle" href="logout.php"><span class="badge badge-danger">Logout</span>' . "\n";
echo '                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-red-400"></i>' . "\n";
echo '              </a>' . "\n";
echo '            </li>' . "\n";
echo "\n";
echo '          </ul>' . "\n";
echo "\n";
echo '        </nav>' . "\n";
echo '        <!-- End of Topbar -->' . "\n";
echo "\n";
include './includes/config.php';
?>

<style>


.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    text-align: center;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6e707e;
    background-color: #1d222e;
    background-clip: padding-box;
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-group > .form-control, .input-group > .form-control-plaintext, .input-group > .custom-select, .input-group > .custom-file {
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
    text-align: center;
    margin-bottom: 0;
}

body {
    margin: 0;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #858796;
    text-align: center;
    background-color: #fff;
}

.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
    justify-content: center;
}

.row {
    display: inline;
    margin-right: -0.75rem;
    margin-left: -0.75rem;
}


.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    border: 1px solid #838594;
    padding: 1.25rem;
    background-color: #252b3b;
    border-radius: 1.35rem;
}



.sidebar-dark .nav-item .nav-link i {
    color: #838594;
}

.sidebar-dark .nav-item .nav-link {
    color: #838594;
}

a {
    color: #838594;
    text-decoration: none;
    background-color: transparent;
}

.text-primary {
    color: #838594 !important;
}



.border-left-primary {
    border-left: 0.25rem solid #838594 !important;
}


.sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar .nav-item .collapsing .collapse-inner .collapse-item {
    padding: 0.5rem 1rem;
    margin: 0 0.5rem;
    display: block;
    color: #898a8a;
    text-align-last: left;
    text-decoration: none;
    border-radius: 0.35rem;
    white-space: nowrap;
}


#wrapper #content-wrapper {
    background-color: #1d222e;
    width: 100%;
    overflow-x: hidden;
}


.topbar {
    height: 4.375rem;
    background-color: #252b3b;
}

.bg-gradient-primary {
    background-color: #252b3b;
    background-image: linear-gradient(180deg, #252b3b 10%, #252b3b 100%);
    background-size: cover;
}
</style>



<style>
    p {
  text-transform: uppercase;
  letter-spacing: 0.5em;
  display: inline-block;



  position: absolute;
  top: auto;



}
p span {
  font: 700 2.5em/1 "Oswald", sans-serif;
  letter-spacing: 0;
  padding: 0.25em 0 0.325em;
  display: block;
  margin: 0 auto;
  text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
  /* Clip Background Image */
  background: url(img/animated-text-fill.png) repeat-y;
  -webkit-background-clip: text;
  background-clip: text;
  /* Animate Background Image */
  -webkit-text-fill-color: transparent;
  -webkit-animation: aitf 80s linear infinite;
  /* Activate hardware acceleration for smoother animations */
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-backface-visibility: hidden;
}

/* Animate Background Image */
@-webkit-keyframes aitf {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}

.bg-white {
    background-color: #1d222e !important;
}

</style>


<style>

.flash {
    background-color: #1d222e !important;
    margin-left: 15px;
    margin-right: 17px;
}

.rounded {
    border-radius: 1.35rem !important;
}


    
</style>
	<style>
	
	z1 span1 {
    font: 700 1.8em/1 "Oswald", sans-serif;
    letter-spacing: 0;
    padding: 0.25em 0 0.325em;
    display: block;
    text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
    background: url(img/animated-text-fill.png) repeat-y;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: aitf 80s linear infinite;
    -webkit-transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    margin-left: 8px;
    margin-top: 9px;
}
	
.sidebar-dark .nav-item.active .nav-link {
    color: #778294;
}
	
	
	
/* width */
::-webkit-scrollbar {
  width: 10px;
    height: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #aec2d1; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #beceda; 
}

.flash {
  //background-color: tranparent;
  transition: transform .2s;
  //background-image: linear-gradient(to bottom right, #171515, tranparent);
  color: white;
  text-shadow: 2px 2px 4px #000000;
  border: 1px solid #9c9c9c;
  border-radius: 1px;
}



.flash:hover {
  color: white;
  text-shadow: 2px 3px 4px #000000;
  background-image: linear-gradient(to bottom right, #434445, black);
  transition: transform .2s;
  border: 1px solid #9c9c9c;
  border-radius: 1px;
}

.sidebar .nav-item .nav-link span {
    font-size: 1.19rem;
    display: inline;
}

.sidebar .nav-item {
    position: relative;
    margin-top: -22px;
}
</style>


