<?php

$db = new SQLite3('./a/.eggziedb.db');
$db2 = new SQLite3('./a/catch.db');
$db->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100))');
$res = $db->query('SELECT * FROM ibo');

if (isset($_POST['submit'])) {
	$we = strtotime('+ 5years');
	$ne = date('Y-m-d', $we);
	$start = date('Y-m-d');
	$end = date('h:m:s');
	$full = $start . 'T' . $end . '.000000Z';
	$db->exec('INSERT INTO ibo(mac_address, username, password, expire_date, url, title, created_at) VALUES(\'' . strtoupper($_POST['mac_address']) . '\', \'' . $_POST['username'] . '\', \'' . $_POST['password'] . '\', \'' . $ne . '\', \'' . $_POST['dns'] . '\', \'' . $_POST['title'] . '\',\'' . $full . '\')');
	$db->close();
	header('Location: users.php');
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
						     <img src="img/ibo1.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑼𝒔𝒆𝒓 𝑴𝒂𝒏𝒂𝒈𝒆𝒎𝒆𝒏𝒕
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

echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                        <form method="post">' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="mac_address"><strong>' . "\n";
echo '                                        Mac Address</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="mac_address" name="mac_address" placeholder="Enter Mac Address" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="title"><strong>' . "\n";
echo '                                        Nome Cliente</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="title" name="title" placeholder="Enter Server Name" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                <label class="control-label" style="color:' . $colour_head_18 . ';"' . "\n" . 'for="dns"><strong>Servidor</strong></label>' . "\n";
echo '                                <select class="select form-control" id="select" name="dns" >' . "\n";
echo '<option value="">--Select--</option>';
$hostres = $db->query('SELECT * FROM portals');

while ($hostrow = $hostres->fetchArray()) {
	echo "\n" . '<option value="' . $hostrow['id'] . '">' . $hostrow['name'] . '</option>';
}

echo '</select>' . "\n";
echo '                                ' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="username"><strong>' . "\n";
echo '                                        Username</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="username" name="username" placeholder="Enter Username" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="password"><strong>' . "\n";
echo '                                        Password</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="password" name="password" placeholder="Enter Password" type="text"/>' . "\n";
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