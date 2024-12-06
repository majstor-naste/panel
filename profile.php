<?php

session_start();
$ifofuser = $_SESSION['id'];

if (!$ifofuser) {
	header('Location: logout.php');
	exit();
}

$db = new SQLite3('./a/.eggziepanels.db');
$res = $db->query('SELECT * ' . "\n\t\t\t\t" . '  FROM USERS ' . "\n\t\t\t\t" . '  WHERE id=\'' . $ifofuser . '\'');
$row = $res->fetchArray();

if (isset($_POST['submit'])) {
	$message = 'Profile Updated!';
	$db->exec('UPDATE USERS ' . "\n\t\t\t" . 'SET' . "\t" . 'NAME=\'' . $_POST['name'] . '\',' . "\n\t\t\t" . '    USERNAME=\'' . $_POST['username'] . '\', ' . "\n\t\t\t\t" . 'PASSWORD=\'' . $_POST['password'] . '\',' . "\n\t\t\t\t" . 'LOGO=\'' . $_POST['logo'] . '\'' . "\n\t\t\t" . 'WHERE ' . "\n\t\t\t\t" . 'id=\'' . $ifofuser . '\'');
	header('Location: profile.php?success');
}

if (isset($_POST['submit_admin'])) {
	if ($ifofuser == '2') {
		$db->exec('UPDATE USERS ' . "\n\t\t\t" . 'SET' . "\t" . 'NAME=\'' . $_POST['name_admin'] . '\',' . "\n\t\t\t" . '    USERNAME=\'' . $_POST['username_admin'] . '\', ' . "\n\t\t\t\t" . 'PASSWORD=\'' . $_POST['password_admin'] . '\',' . "\n\t\t\t\t" . 'LOGO=\'' . $_POST['logo_admin'] . '\'' . "\n\t\t\t" . 'WHERE ' . "\n\t\t\t\t" . 'id=\'1\'');
		header('Location: profile.php?admin_success');
	}
	else {
		header('Location: profile.php?admin_fail');
	}
}

$name = $row['NAME'];
$user = $row['USERNAME'];
$pass = $row['PASSWORD'];
$logo = $row['LOGO'];
$resuser = $db->query('SELECT * ' . "\n\t\t\t\t" . '  FROM USERS ' . "\n\t\t\t\t" . '  WHERE id=\'1\'');
$rowuser = $resuser->fetchArray();
$name1 = $rowuser['NAME'];
$user1 = $rowuser['USERNAME'];
$pass1 = $rowuser['PASSWORD'];
$logo1 = $rowuser['LOGO'];
include 'includes/header.php';



?>
<style>
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
    margin-left: -75px;
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

                <div class="header1">
						<center>
						    <br>
						     <img src="img/ibo1.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑷𝒓𝒐𝒇𝒊𝒍𝒆
  </span>

</p></a>
						</center>

						</div>

<?php




echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['admin_success'])) {
	echo $msg_success_admin;
}

if (isset($_GET['admin_fail'])) {
	echo $msg_error;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

echo '         ' . "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="name">' . "\n";
echo '                            <strong>Name</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="name" value="' . $name . '" placeholder="Enter Name">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="username">' . "\n";
echo '                            <strong>Username</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="username" value="' . $user . '" placeholder="Enter Username">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="password">' . "\n";
echo '                            <strong>Password</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="password" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="password" value="' . $pass . '" id="myInput" placeholder="Enter Password">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo ' <input type="checkbox" onclick="myFunction()">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="password">' . "\n";
echo '                            <strong>Show Password</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " for="logo">' . "\n";
echo '                            <strong>Logo</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="logo" value="' . $logo . '" placeholder="Enter Image URL">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group">' . "\n";
echo '                            <img type="image" width="100px" src="' . $logo . '" alt="image" />' . "\n";
echo '                            </div>' . "\n";
echo "\t\t\t\t\t\t\t\t" . '                       <div class="form-group">' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                            </div>' . "\n";
echo '                            </form>' . "\n";



if ($ifofuser == '2') {
	echo '            <!-- Second Column -->' . "\n";
	echo '            <div class="col-lg-2">' . "\n";
	echo "\n";
	echo '              <!-- Custom codes -->' . "\n";
	echo '                <div class="card border-left-primary shadow h-100 card shadow mb-4">' . "\n";
	echo '                <div class="card-header py-3">' . "\n";
	echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-user"></i> Update User Profile</h6>' . "\n";
	echo '                </div>' . "\n";
	echo '                <div class="card-body">' . "\n";
	echo '                            <form method="post">' . "\n";
	echo '                            <div class="form-group ">' . "\n";
	echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="name_admin">' . "\n";
	echo '                            <strong>Name</strong>' . "\n";
	echo '                            </label>' . "\n";
	echo '                            <div class="input-group">' . "\n";
	echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="name_admin" value="' . $name1 . '" placeholder="Enter Name">' . "\n";
	echo '                            </div>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            <div class="form-group ">' . "\n";
	echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="username_admin">' . "\n";
	echo '                            <strong>Username</strong>' . "\n";
	echo '                            </label>' . "\n";
	echo '                            <div class="input-group">' . "\n";
	echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="username_admin" value="' . $user1 . '" placeholder="Enter Username">' . "\n";
	echo '                            </div>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            <div class="form-group ">' . "\n";
	echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="password">' . "\n";
	echo '                            <strong>Password</strong>' . "\n";
	echo '                            </label>' . "\n";
	echo '                            <div class="input-group">' . "\n";
	echo '                            <input type="password" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="password_admin" value="' . $pass1 . '"';
	echo ' id="myInput1" placeholder="Enter Password">' . "\n";
	echo '                            </div>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            <div class="form-group ">' . "\n";
	echo ' <input type="checkbox" onclick="myFunction1()">' . "\n";
	echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="password_admin">' . "\n";
	echo '                            <strong>Show Password</strong>' . "\n";
	echo '                            </label>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            <div class="form-group ">' . "\n";
	echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="logo_admin">' . "\n";
	echo '                            <strong>Logo</strong>' . "\n";
	echo '                            </label>' . "\n";
	echo '                            <div class="input-group">' . "\n";
	echo '                            <input type="text" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" name="logo_admin" value="' . $logo1 . '" placeholder="Enter Image URL">' . "\n";
	echo '                            </div>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            <div class="form-group">' . "\n";
	echo '                            <img type="image" width="100px" src="' . $logo1 . '" alt="image" />' . "\n";
	echo '                            </div>' . "\n";
	echo "\t\t\t\t\t\t\t" . '<div class="form-group">' . "\n";
	echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit_admin" type="submit">' . "\n";
	echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
	echo '                        </button>' . "\n";
	echo '                            </div>' . "\n";
	echo '                            </form>' . "\n";
	echo '                            </div>' . "\n";
	echo '                </div>' . "\n";
	echo '                            </div>' . "\n";
}

echo '            </div>' . "\n";
echo '                </div>' . "\n";
include 'includes/footer.php';
require 'includes/egz.php';
echo '<script>' . "\n";
echo 'function myFunction() {' . "\n";
echo '  var x = document.getElementById(\'myInput\');' . "\n";
echo '  if (x.type === \'password\') {' . "\n";
echo '    x.type = \'text\';' . "\n";
echo '  } else {' . "\n";
echo '    x.type = \'password\';' . "\n";
echo '  }' . "\n";
echo '}';
echo '</script>' . "\n";
echo '<script>' . "\n";
echo 'function myFunction1() {' . "\n";
echo '  var x = document.getElementById(\'myInput1\');' . "\n";
echo '  if (x.type === \'password\') {' . "\n";
echo '    x.type = \'text\';' . "\n";
echo '  } else {' . "\n";
echo '    x.type = \'password\';' . "\n";
echo '  }' . "\n";
echo '}';
echo '</script>' . "\n";
echo '</body>' . "\n";

?>

<style>


    
    .card {
    text-align: center;
    border-radius: 26px;
    border-color: #9c9c9c;
    background-color: #252b3b;
    !important: ;
}
</style>