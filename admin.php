<?php

require 'includes/check.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ifofuser = $_SESSION['id'];

if ($ifofuser != '2') {
	header('Location: dashboard.php');
}

$jsondata_admin = file_get_contents('./includes/eggzie.json');
$data_admin = json_decode($jsondata_admin, true);
$json_admin = $data_admin['info'];
$snoop_admin = $json_admin['mm'];
$snoop_admin = ($json_admin['mm'] == '0' ? 'selected' : '');
$snoop1_admin = ($json_admin['mm'] == '1' ? 'selected' : '');
$col_admin = $json_admin['oo'];
$user_admin = ($json_admin['oo'] == '0' ? 'selected' : '');
$user1_admin = ($json_admin['oo'] == '1' ? 'selected' : '');
$col3_admin = $json_admin['qq'];
$portalno = ($json_admin['qq'] == '0' ? 'selected' : '');
$portalyes = ($json_admin['qq'] == '1' ? 'selected' : '');
$col2_admin = $json_admin['ss'];
$user2_admin = ($json_admin['ss'] == '0' ? 'selected' : '');
$user12_admin = ($json_admin['ss'] == '1' ? 'selected' : '');
$newname2_admin = $json_admin['uu'];
$newlink2_admin = $json_admin['ww'];
$newicon2_admin = $json_admin['yy'];
$user_admin0 = ($json_admin['tt'] == '0' ? 'selected' : '');
$user_admin1 = ($json_admin['tt'] == '1' ? 'selected' : '');
$note_admin = ($json_admin['vv'] == '0' ? 'selected' : '');
$note_admin1 = ($json_admin['vv'] == '1' ? 'selected' : '');
$colinc5 = $json_admin['a5'];
$admin5achk = ($json_admin['a5'] == '0' ? 'selected' : '');
$admin5achk1 = ($json_admin['a5'] == '1' ? 'selected' : '');
$colinc10 = $json_admin['mm'];
$colinc11 = $json_admin['oo'];
$colinc14 = $json_admin['tt'];
$colinc15 = $json_admin['vv'];
$colinc16 = $json_admin['qq'];
$colinc17 = $json_admin['ss'];
$login1_admin = $json_admin['b1'];
$hiip = $json_admin['ip'];

if (isset($_POST['submit'])) {
	if (empty($_POST['ip'])) {
		$ipp = '####';
	}
	else {
		$ipp = $_POST['ip'];
	}

	$jsonData_admin = file_get_contents('./includes/eggzie.json');
	$arrayData_admin = json_decode($jsonData_admin, true);
	$replacementData_admin = [
		'info' => ['uu' => $_POST['uu'], 'ww' => $_POST['ww'], 'yy' => $_POST['yy'], 'b1' => $_POST['b1'], 'ip' => $ipp, 'a5' => $_POST['a5']]
	];
	$newArrayData_admin = array_replace_recursive($arrayData_admin, $replacementData_admin);
	$newJsonData_admin = json_encode($newArrayData_admin, JSON_UNESCAPED_UNICODE);
	file_put_contents('./includes/eggzie.json', $newJsonData_admin);
	header('Location: admin.php?updated');
}

if (isset($_POST['submit_two'])) {
	if (empty($_POST['ip'])) {
		$ipp = '####';
	}
	else {
		$ipp = $_POST['ip'];
	}

	$jsonData_admin = file_get_contents('./includes/eggzie.json');
	$arrayData_admin = json_decode($jsonData_admin, true);
	$replacementData_admin = [
		'info' => ['qq' => $_POST['qq'], 'mm' => $_POST['mm'], 'ss' => $_POST['ss'], 'oo' => $_POST['oo'], 'vv' => $_POST['vv'], 'tt' => $_POST['tt']]
	];
	$newArrayData_admin = array_replace_recursive($arrayData_admin, $replacementData_admin);
	$newJsonData_admin = json_encode($newArrayData_admin, JSON_UNESCAPED_UNICODE);
	file_put_contents('./includes/eggzie.json', $newJsonData_admin);
	header('Location: admin.php?updated');
}

include 'includes/header.php';

?>
<style>
p span {
    font: 700 2.5em/1 "Oswald", sans-serif;
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
    margin-top: -45px;
    margin-left: -58px;
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

.header1 {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    border: 1px solid #9c9c9c;
    border-radius: 1.35rem;
    background-color: #252b3b;
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 20px;
    margin-bottom: 20px;
}

input, button, select, optgroup, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    background-color: #5c5c5c;
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgb(131 133 148);
}
.col-lg-4 {
    flex: 0 0 33.33333%;
    max-width: 100%;
}
</style>

                <div class="header1">
						<center>
						    <br>
						     <img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑼𝒔𝒆𝒓𝒔
  </span>

</p></a>
						</center>

						</div>




<?php





echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['succes'])) {
	echo $msg_delete;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

if (isset($_GET['updated'])) {
	echo $msg_success;
}

echo '          <!-- Page Heading -->' . "\n";
echo '         ' . "\n";
echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";
echo '            <!-- First Column -->' . "\n";
echo '            <div class="col-lg-4">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo '                                <div class="form-group ">' . "\n";
echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-cogs"></i> Settings</h6>' . "\n";
echo '                        <hr class="sidebar-divider d-none d-md-block">' . "\n";
echo '                                    <label class="control-label" style="color:' . $colour_head_18 . ';" for="uu">' . "\n";
echo '                                        <strong>Navbar Name</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="uu" name="uu" placeholder="Name" type="text" value="' . $newname2_admin . '"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                <div class="form-group ">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="ww">' . "\n";
echo '                                        <strong>Navbar Link</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="ww" name="ww" placeholder="Link" type="text" value="' . $newlink2_admin . '"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                <div class="form-group ">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="yy">' . "\n";
echo '                                        <strong>Navbar Icon</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="yy" name="yy" placeholder="Icon" type="text" value="' . $newicon2_admin . '"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                <div class="form-group ">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="ip">' . "\n";
echo '                                        <strong>Hidden IP</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="ip" name="ip" placeholder="IP to hide" type="text" value="' . $hiip . '"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                <div class="form-group ">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="b1">' . "\n";
echo '                                        <strong>Login Title</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="b1" name="b1" placeholder="Icon" type="text" value="' . $login1_admin . '"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="a5" >' . "\n";
echo '                            <strong> Include Colour Changes</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="a5">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $admin5achk . '>No</option>' . "\n";
echo '                                <option value="1"' . $admin5achk1 . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t\t" . '                       <div class="form-group">' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                            </div>' . "\n";
echo '                            </form>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <br>' . "\n";
echo '            <!-- Second Column -->' . "\n";
echo '            <div class="col-lg-4">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-user"></i> Settings</h6>' . "\n";
echo '                        <hr class="sidebar-divider d-none d-md-block">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="qq" >' . "\n";
echo '                            <strong> Include Portals</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="qq">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $portalno . '>No</option>' . "\n";
echo '                                <option value="1"' . $portalyes . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="ss" >' . "\n";
echo '                            <strong> Include Sport</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="ss">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $user2_admin . '>No</option>' . "\n";
echo '                                <option value="1"' . $user12_admin . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="oo" >' . "\n";
echo '                            <strong> Include Settings</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="oo">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $user_admin . '>No</option>' . "\n";
echo '                                <option value="1"' . $user1_admin . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="tt" >' . "\n";
echo '                            <strong> Include Users</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="tt">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $user_admin0 . '>No</option>' . "\n";
echo '                                <option value="1"' . $user_admin1 . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="vv" >' . "\n";
echo '                            <strong> Include Notification</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="vv">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $note_admin . '>No</option>' . "\n";
echo '                                <option value="1"' . $note_admin1 . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="control-label" style="color:' . $colour_head_18 . ';" for="mm" >' . "\n";
echo '                            <strong> Include Snoop</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" id="select" name="mm">' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="0"' . $snoop_admin . '>No</option>' . "\n";
echo '                                <option value="1"' . $snoop1_admin . '>Yes</option>' . "\n";
echo '                            </select>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit_two" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            </div>' . "\n";
echo '            </div>' . "\n";
echo "\n";
include 'includes/footer.php';
require 'includes/egz.php';
echo '</body>' . "\n";

?>
