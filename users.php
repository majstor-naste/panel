<?php


require 'includes/check.php';
$ifofuser_check = $_SESSION['id'];
$jsondata_admin = file_get_contents('./includes/eggzie.json');
$data_admin = json_decode($jsondata_admin, true);
$json_admin = $data_admin['info'];
$col_admin = $json_admin['oo'];

if ($col_admin == '0') {
	header('Location: dashboard.php');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./a/.eggziedb.db');
$res1 = $db->query('SELECT * FROM ibo');

if (isset($_GET['delete'])) {
	$db->exec('DELETE FROM ibo WHERE id=' . $_GET['delete']);
	$db->close();
	header('Location: users.php?succes');
}

if (isset($_GET['block'])) {
	$db->exec('UPDATE ibo SET is_blocked=\'1\' WHERE mac_address=\'' . $_GET['block'] . '\'');
	$db->close();
	header('Location: users.php?succes_block');
}

if (isset($_GET['unblock'])) {
	$db->exec('UPDATE ibo SET is_blocked=\'0\' WHERE mac_address=\'' . $_GET['unblock'] . '\'');
	$db->close();
	header('Location: users.php?succes_unblock');
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
</style>

                <div class="header1">
						<center>
						    <br>
						     <img src="img/ibo1.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑼𝒔𝒆𝒓𝒔
  </span>

</p></a>
						</center>

						</div>




<?php



echo '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' . "\n";
echo '    <div class="modal-dialog">' . "\n";
echo '        <div class="modal-content">' . "\n";
echo '            <div class="modal-header">' . "\n";
echo '                <h2>Confirm</h2>' . "\n";
echo '            </div>' . "\n";
echo '            <div class="modal-body">' . "\n";
echo '                Do you really want to delete?' . "\n";
echo '            </div>' . "\n";
echo '            <div class="modal-footer">' . "\n";
echo '                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>' . "\n";
echo '                <a class="btn btn-danger btn-ok">Delete</a>' . "\n";
echo '            </div>' . "\n";
echo '        </div>' . "\n";
echo '    </div>' . "\n";
echo '</div>' . "\n";
echo '        <div>';
echo '    <div class="container-fluid">' . "\n";

if (isset($_GET['succes'])) {
	echo $msg_delete;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

if (isset($_GET['succes_block'])) {
	echo $msg_succes_block;
}

if (isset($_GET['succes_unblock'])) {
	echo $msg_succes_unblock;
}





echo '                    <div class="card-body">';
echo '                            <a button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" href="./users_create.php">' . "\n";
echo '                            <span class="icon text-white-50"><i class="fas fa-plus" style="color:' . $colour_head_10 . ';"></i></span><span class="text"> ADD User</span>' . "\n";
echo '                            </button></a>' . "\n";
echo '    ' . "\t\t\t\t\t" . '<hr>';
echo "\t\t\t\t\t\t" . '<div class="table-responsive">';
echo "\t\t\t\t\t\t\t" . '<table id="Dtable" class="table" style="width:100%">';
echo "\t\t\t\t\t\t\t" . '<thead>';
echo "\t\t\t" . '<tr style = "color:' . $colour_head_12 . ';">';
echo "\t\t\t" . '<th style = "display:none" >Index</th>';
echo '                  <th>Title</th>' . "\n";
echo "\t\t\t\t" . '  <th>Mac Address</th>' . "\n";
echo '                  <th>Username</th>' . "\n";

if ($ifofuser_check != '2') {
	echo '                  <th>Server ID / Title</th>' . "\n";
}
else {
	echo '                  <th>DNS</th>' . "\n";
}

echo "\t\t\t\t" . '  <th>Blocked</th>' . "\n";
echo "\t\t\t\t" . '  <th>Edit</th>' . "\n";
echo "\t\t\t\t" . '  <th>Delete</th>';
echo "\t\t\t\t" . '</tr>';
echo "\t\t\t\t" . '</thead>';
echo "\t\t\t\t" . '<tbody style="background-color:' . $colour_head_3 . ';color:' . $colour_head_2 . ';">';

while ($row1 = $res1->fetchArray()) {
	$users_id = $row1['id'];
	$user_mac = $row1['mac_address'];
	$user_username = $row1['username'];
	$user_url = $row1['url'];
	$user_title = $row1['title'];
	$user_block = $row1['is_blocked'];
	$new_dns_name = '';
	$new_dns_url = '';
	$hostres = $db->query('SELECT * FROM portals WHERE id=\'' . $user_url . '\'');

	while ($hostrow = $hostres->fetchArray()) {
		$new_dns_name = $hostrow['name'];
		$new_dns_url = $hostrow['url'];
	}

	echo "\t\t\t\t\t" . ' <tr style="background-color:' . $colour_head_3 . ';color:' . $colour_head_2 . ';">';
	echo "\t\t\t\t\t" . ' <td style = "display:none">' . $users_id . '</td>';
	echo '                  <td>' . $user_title . '</td>' . "\n";
	echo '                  <td>' . $user_mac . '</td>' . "\n";
	echo '                  <td>' . $user_username . '</td>' . "\n";

	if ($ifofuser_check != '2') {
		echo '                  <td>' . $user_url . ' / ' . $new_dns_name . '</td>' . "\n";
	}
	else {
		echo '                  <td>' . $new_dns_url . '</td>' . "\n";
	}

	if ($user_block == '1') {
		echo "\t\t\t\t" . '  <td><a href="./users.php?unblock=' . $user_mac . '"><i class="fa fa-toggle-on" style="color:red"></i></a></td>' . "\n";
	}
	else {
		echo "\t\t\t\t" . '  <td><a href="./users.php?block=' . $user_mac . '"><i class="fa fa-toggle-off"  style="color:grey"></i></a></td>' . "\n";
	}

	echo "\t\t\t\t" . '  <td><a href="./users_update.php?update=' . $users_id . '"><i class="fa fa-pencil" style="font-size:15px;color:blue"></i></a></td>' . "\n";
	echo "\t\t\t" . ' <td><a class="btn btn-icon" href="#" data-href="./users.php?delete=' . $users_id . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" style="font-size:15px;color:red"></i></a>';
	echo "\t\t\t\t\t" . '</td>';
	echo "\t\t\t\t\t" . '</tr>';
}

echo "\t\t\t\t\t\t\t" . '</tbody>';
echo "\t\t\t\t\t\t\t" . '</table>';
echo "\t\t\t\t\t\t" . '</div>';
echo "\t\t\t\t\t" . '</div>';
echo "\t\t\t\t" . '</div>';
echo "\t\t\t\t\t" . '</div>';

include 'includes/footer.php';
echo '</body>';
echo '</html>';
require 'includes/egz.php';

?>