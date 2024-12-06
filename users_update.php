<?php


$db = new SQLite3('./a/.eggziedb.db');
$res = $db->query('SELECT * ' . "\n\t\t\t\t" . '  FROM ibo ' . "\n\t\t\t\t" . '  WHERE id=\'' . $_GET['update'] . '\'');
$row = $res->fetchArray();
$id = $row['id'];
$mac_address = $row['mac_address'];
$expire_date = $row['expire_date'];
$username = $row['username'];
$password = $row['password'];

if (isset($_POST['submit'])) {
	$we = strtotime('+ 5years');
	$ne = date('Y-m-d', $we);
	$start = date('Y-m-d');
	$end = date('h:m:s');
	$full = $start . 'T' . $end . '.000000Z';
	$created_at = date('yyyy-MM-dd\'T\'hh:mm:ss.SSSSSS\'Z\'');
	$db->exec('UPDATE ibo SET mac_address=\'' . $_POST['mac_address'] . '\',' . "\n\t\t\t\t\t\t\t\t" . 'expire_date=\'' . $ne . '\',' . "\n\t\t\t\t\t\t\t\t" . 'username=\'' . $_POST['username'] . '\',' . "\n\t\t\t\t\t\t\t\t" . 'url=\'' . $_POST['url'] . '\',' . "\n\t\t\t\t\t\t\t\t" . 'title=\'' . $_POST['title'] . '\',' . "\n\t\t\t\t\t\t\t\t" . 'password=\'' . $_POST['password'] . '\',' . "\n\t\t\t\t\t\t\t\t" . 'created_at=\'' . $full . '\'' . "\n\t\t\t\t\t\t" . '  WHERE ' . "\n\t\t\t\t\t\t\t" . '  id=\'' . $_POST['id'] . '\'');
	$db->close();
	header('Location: users.php?success');
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
    margin-left: -200px;
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
						     <img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑼𝒔𝒆𝒓 𝑴𝒂𝒏𝒂𝒈𝒆𝒎𝒆𝒏𝒕
  </span>

</p></a>
						</center>

						</div>




<?php

$userupdate_id = $row['id'];
$userupdate_mac_address = $row['mac_address'];
$userupdate_expire_date = $row['expire_date'];
$userupdate_username = $row['username'];
$userupdate_password = $row['password'];
$userupdate_url = $row['url'];
$userupdate_title = $row['title'];
echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['succes'])) {
	echo $msg_delete;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

echo '              <!-- Custom codes -->' . "\n";

echo '                <div class="card-body">' . "\n";
echo '                        <form method="post">' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="mac_address"><strong>' . "\n";
echo '                                        Mac Address</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input type="hidden" name="id" value="' . $userupdate_id . '">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="mac_address" name="mac_address"  value="' . $userupdate_mac_address . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="username"><strong>' . "\n";
echo '                                        Username</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="username" name="username" value="' . $userupdate_username . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="password"><strong>' . "\n";
echo '                                        Password</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="password" name="password"  value="' . $userupdate_password . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                            <div class="form-group">' . "\n";
echo '                                <label class="control-label" style="color:' . $colour_head_18 . ';"' . "\n" . 'for="dns"><strong>Url</strong></label>' . "\n";
echo '                                <select class="select form-control" id="select" name="url">' . "\n";
echo '<option value="">--Select--</option>';
$hostres = $db->query('SELECT * FROM portals');

while ($hostrow = $hostres->fetchArray()) {
	$selected = ($hostrow['id'] == $userupdate_url ? ' selected' : '');
	echo "\n" . '<option value="' . $hostrow['id'] . '"' . $selected . '>' . $hostrow['name'] . '</option>';
}

echo '</select>' . "\n";
echo '                                ' . "\n";
echo '        </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="title"><strong>' . "\n";
echo '                                        Title</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="title" name="title" value="' . $userupdate_title . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    ' . "\n";
echo '                                <div class="form-group">' . "\n";
echo '                                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                                    </div>' . "\n";
echo "\n";
echo '                                </div>' . "\n";
echo '                            </form>' . "\n";
require 'includes/egz.php';
echo '</body>' . "\n";

?>