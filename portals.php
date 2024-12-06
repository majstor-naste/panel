<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'includes/check.php';
$ifofuser_check = $_SESSION['id'];

if (!$ifofuser_check) {
	header('Location: logout.php');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./a/.eggziedb.db');
$db->exec('CREATE TABLE IF NOT EXISTS portals(id INTEGER PRIMARY KEY NOT NULL, name VARCHAR(150), url VARCHAR(150))');
$res1 = $db->query('SELECT * FROM portals');
$rowscount = $db->query('SELECT COUNT(*) as count FROM portals');
$rowcount = $rowscount->fetchArray();
$numRowscount = $rowcount['count'];

if (4 < $numRowscount) {
	$allowed = false;
}
else {
	$allowed = true;
}

if (isset($_GET['delete'])) {
	$db->exec('DELETE FROM portals WHERE id=' . $_GET['delete']);
	$db->close();
	header('Location: portals.php?succes');
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
    margin-left: -76px;
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

    𝑷𝒐𝒓𝒕𝒂𝒍𝒔
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

if (isset($_GET['limit_error'])) {
	echo $msg_limit_error;
}


echo "\n";

echo '                    <div class="card-body">';

if ($allowed) {
	echo '                            <a button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" href="./portal_create.php">' . "\n";
	echo '                            <span class="icon text-white-50"><i class="fas fa-plus" style="color:' . $colour_head_10 . ';"></i></span><span class="text"> ADD Servidores</span>' . "\n";
	echo '                            </button></a>' . "\n";
}
else {
	echo '                            <button class="btn btn-warning btn-icon-split">' . "\n";
	echo '                            <span class="text"> PORTAL LIMIT REACHED</span>' . "\n";
	echo '                            </button>' . "\n";
}

echo '    ' . "\t\t\t\t\t" . '<hr>';
echo "\t\t\t\t\t\t" . '<div class="table-responsive">';
echo "\t\t\t\t\t\t\t" . '<table id="Dtable" class="table" style="width:100%">';
echo "\t\t\t\t\t\t\t" . '<thead>';
echo "\t\t\t" . '<tr style = "color:' . $colour_head_12 . ';">';
echo "\t\t\t" . '<th style = "display:none" >Index</th>';
echo '                  <th>Name</th>' . "\n";
echo '                  <th>Portal</th>' . "\n";
echo "\t\t\t\t" . '<th>Edit</th>' . "\n";
echo "\t\t\t\t" . '<th>Delete</th>' . "\n";
echo "\t\t\t\t" . '</tr>';
echo "\t\t\t\t" . '</thead>';
echo "\t\t\t\t" . '<tbody style="background-color:' . $colour_head_3 . ';color:' . $colour_head_2 . ';">';

while ($row = $res1->fetchArray()) {
	$id = $row['id'];
	$nname = $row['name'];
	$dns = $row['url'];
	echo "\t\t\t\t\t" . ' <tr style="background-color:' . $colour_head_3 . ';color:' . $colour_head_2 . ';">';
	echo "\t\t\t\t\t" . ' <td style = "display:none">' . $id . '</td>';
	echo "\t\t\t\t" . '<td>' . $nname . '</td>' . "\n";
	echo "\t\t\t\t" . '<td>' . $dns . '</td>' . "\n";
	echo "\t\t\t\t" . '  <td><a href="./portal_update.php?update=' . $id . '"><i class="fa fa-pencil" style="font-size:15px;color:blue"></i></a></td>' . "\n";
	echo "\t\t\t" . ' <td><a class="btn btn-icon" href="#" data-href="./portals.php?delete=' . $id . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash" style="font-size:15px;color:red"></i></a>';
	echo "\t\t\t\t\t" . '</td>';
	echo "\t\t\t\t\t" . '</tr>';
}

echo "\t\t\t\t\t\t\t" . '</tbody>';
echo "\t\t\t\t\t\t\t" . '</table>';
echo "\t\t\t\t\t\t" . '</div>';
echo "\t\t\t\t\t" . '</div>';
echo "\t\t\t\t" . '</div>';
echo "\t\t\t\t\t" . '</div>';
echo "\t\t\t\t" . '</div>';
include 'includes/footer.php';
echo '</body>';
echo '</html>';
require 'includes/egz.php';

?>