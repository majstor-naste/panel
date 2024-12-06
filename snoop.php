<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ifofuser = $_SESSION['id'];
$jsondata_admin1 = file_get_contents('./includes/eggzie.json');
$data_admin1 = json_decode($jsondata_admin1, true);
$json_admin1 = $data_admin1['info'];
$col_admin1 = $json_admin1['mm'];
$hiideip1_admin1 = $json_admin1['ip'];

if ($col_admin1 == '0') {
	header('Location: dashboard.php');
}

$db1 = new SQLite3('a/.logs.db');
$db1->exec('CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date datetime, ipaddress TEXT)');
$res1 = $db1->query('SELECT * FROM logs');

if (isset($_GET['delete'])) {
	$db1->exec('DELETE FROM logs WHERE id=' . $_GET['delete']);
	$db1->close();
	header('Location: snoop.php?succes');
}

if (isset($_GET['delete_eggzie_style'])) {
	$db1->exec('DROP TABLE logs');
	header('Location: snoop.php?succes');
}

include 'includes/header.php';




?>
<style>
input, button, select, optgroup, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    background-color: #5c5c5c;
}


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
    margin-left: -64px;
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
</style>

                <div class="header1">
						<center>
						    <br>
						     <img src="img/ibo1.png" alt="" height="100">
						    <br><br><br>
													<a><p>
  <span>

    𝑺𝒏𝒐𝒐𝒑
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
echo '    <div class="container-fluid">' . "\n";

if (isset($_GET['succes'])) {
	echo $msg_delete;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}




echo '                    <div class="card-body">';
echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-clock"></i> Time Logs</h6>' . "\n";
if ($ifofuser == '2') {
	echo '                    <a button class="btn btn-danger btn-icon-split" href="./snoop.php?delete_eggzie_style">' . "\n";
	echo '                            <span class="icon text-white-50"><i class="fas fa-ban"></i></span><span class="text"> REMOVE ALL</span>' . "\n";
	echo '                            </button></a>' . "\n";
}

echo '    ' . "\t\t\t\t\t" . '<hr>';
echo "\t\t\t\t\t\t" . '<div class="table-responsive">';
echo "\t\t\t\t\t\t\t" . '<table id="Dtable" class="table" style="width:100%">';
echo "\t\t\t\t\t\t\t" . '<thead>';
echo "\t\t\t" . '<tr style = "color:' . $colour_head_12 . ';">';
echo "\t\t\t" . '<th style = "display:none" >Index</th>';
echo "\t\t\t\t" . '<th>IP Address</th>' . "\n";
echo "\t\t\t\t" . '<th>Date</th>' . "\n";
echo "\t\t\t\t" . '<th>Delete</th>' . "\n";
echo "\t\t\t\t" . '</tr>';
echo "\t\t\t\t" . '</thead>';
echo "\t\t\t\t" . '<tbody style="color:' . $colour_head_2 . ';">';

while ($row1 = $res1->fetchArray()) {
	$id = $row1['id'];
	$ipad = $row1['ipaddress'];
	$date = $row1['date'];
	$ipad = str_replace($hiideip1_admin1, '--ADMIN LOGIN--', $ipad);
	echo "\t\t\t\t\t" . ' <tr style="background-color:' . $colour_head_3 . ';color:' . $colour_head_2 . ';">';
	echo "\t\t\t\t\t" . ' <td style = "display:none">' . $id . '</td>';
	echo '                  <td>' . $ipad . '</td>' . "\n";
	echo '                  <td>' . $date . '</td>' . "\n";
	echo "\t\t\t" . ' <td style="overflow:hidden;max-width: 40px;"><a class="btn btn-icon" href="#" data-href="./snoop.php?delete=' . $id . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o" style="font-size:15px;color:red"></i></a></td>';
	echo "\t\t\t\t\t" . '</tr>';
}

echo "\t\t\t\t\t\t\t" . '</tbody>';
echo "\t\t\t\t\t\t\t" . '</table>';
echo "\t\t\t\t\t\t" . '</div>';
echo "\t\t\t\t\t" . '</div>';
echo "\t\t\t\t" . '</div>';

include 'includes/footer.php';
echo '</body>';
echo '</html>';
require 'includes/egz.php';

?>