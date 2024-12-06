<?php


function real_ip()
{
	$ip = 'undefined';

	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	else {
		$ip = getenv('REMOTE_ADDR');

		if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		else if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
	}

	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}

session_start();
unset($_SESSION['eggziesibonew3']);
$jsondata111 = file_get_contents('./includes/eggzie.json');
$json111 = json_decode($jsondata111, true);
$col1 = $json111['info'];
$collogname = $col1['b1'];
$collogwel = $col1['b2'];
$col3 = $json111['colours'];
$col4 = $col3['oo'];
$colour_login = $col3['rr'];
$message_fail = '<div class="alert alert-danger" id="success-alert"><center><h4 style="color:dark!important"><i class="icon fa fa-times"></i> Wrong Password!</h4></center></div>';
$message_invalid = '<div class="alert alert-danger" id="success-alert"><center><h4 style="color:dark!important"><i class="icon fa fa-times"></i> Invalid Details!</h4></center></div>';
$db_check1 = new SQLite3('./a/.eggziepanels.db');
$db_check1->exec('CREATE TABLE IF NOT EXISTS USERS(id INT PRIMARY KEY NOT NULL,NAME TEXT,USERNAME TEXT,PASSWORD TEXT,LOGO TEXT)');
$rows = $db_check1->query('SELECT COUNT(*) as count FROM USERS');
$row = $rows->fetchArray();
$numRows = $row['count'];

if ($numRows == 0) {
	$db_check1->exec('INSERT INTO USERS(id,NAME,USERNAME,PASSWORD,LOGO) VALUES(\'1\',\'Your Name\',\'admin\',\'admin\',\'img/ibo.png\')');
	$db_check1->exec('INSERT INTO USERS(id,NAME,USERNAME,PASSWORD,LOGO) VALUES(\'2\',\'ADMIN\',\'adminuser\',\'adminpass\',\'img/ibo.png\')');
}

$res_login = $db_check1->query('SELECT * ' . "\n\t\t\t\t" . '  FROM USERS ' . "\n\t\t\t\t" . '  WHERE id=\'1\'');
$row_login = $res_login->fetchArray();
$name_login = $row_login['NAME'];
$logo_login = $row_login['LOGO'];

if (isset($_POST['login'])) {
	if (!$db_check1) {
		echo $db_check1->lastErrorMsg();
	}

	$sql_check = 'SELECT * from USERS where USERNAME="' . $_POST['username'] . '"';
	$ret_check = $db_check1->query($sql_check);

	while ($row_check = $ret_check->fetchArray()) {
		$id_check = $row_check['id'];
		$NAME = $row_check['NAME'];
		$username_check = $row_check['USERNAME'];
		$password_check = $row_check['PASSWORD'];
		$LOGO_check = $row_check['LOGO'];
	}

	if (empty($id_check)) {
		header('Location: login.php?error');
	}
	else if ($password_check == $_POST['password']) {
		$_SESSION['eggziesibonew3'] = true;
		$_SESSION['N'] = $id_check;
		$_SESSION['id'] = $id_check;

		if ($id_check == '2') {
			header('Location: admin.php');
		}
		else {
			header('Location: dashboard.php');
		}
	}
	else {
		header('Location: login.php?erro');
	}

	$db_check1->close();
	exit();
}

$date = date('d-m-Y H:i:s');
$IPADDRESS = real_ip();
$db1 = new SQLite3('./a/.logs.db');
$db1->exec('CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date datetime, ipaddress TEXT)');
$db1->exec('INSERT INTO logs(date,ipaddress) VALUES(\'' . $date . '\',\'' . $IPADDRESS . '\')');
$db2 = new SQLite3('./a/.eggziedb.db');
$db2->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100),is_blocked VARCHAR(10))');
$db2->exec('CREATE TABLE IF NOT EXISTS portals(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, name VARCHAR(100), url VARCHAR(100))');
echo '<!DOCTYPE html>' . "\n";
echo "\n";
echo '<head>' . "\n";
echo '    <meta charset="utf-8">' . "\n";
echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
echo '    <title>Login</title>' . "\n";


echo '    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">' . "\n";
echo '    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "\n";
echo '    <link rel="icon" href="favicon.ico" type="image/x-icon">' . "\n";
echo '</head>' . "\n";
echo "\t" . '<body class="bg-egg">' . "\n";
echo '<html>' . "\n";
echo '  <div class="wrapper ">' . "\n";

if (isset($_GET['error'])) {
	echo $message_invalid;
}

if (isset($_GET['erro'])) {
	echo $message_fail;
}
?>

<?php

echo '      <body>' . "\n";

echo '      <!DOCTYPE html>' . "\n";

echo '      <html lang="en" >' . "\n";
echo '      <head>' . "\n";
echo '        <meta charset="UTF-8">' . "\n";
echo '        <title>Smarters V4 & CinemHD V2.6</title>' . "\n";
echo '        <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">' . "\n";
echo '        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">' . "\n";
echo '      </head>' . "\n";
echo '      <body>' . "\n";

echo '      <center><div class="container">' . "\n";
echo '        <div class="left-section">' . "\n";
echo '            <div class="card border-left-primary shadow h-100 card shadow mb-4">' . "\n";
echo '                <br>' . "\n";
echo '          <div class="header">' . "\n";
echo '              <br>' . "\n";
echo '              <center><img src="img/ibo1.png" width="200" height="100" class="center" alt=""></a></center>' . "\n";
echo '              <br>' . "\n";
echo '            <h3 class="text-center text-light">IBO V10</h3>' . "\n";
echo '            <h4 class="animation a2">PAINEL IBO V10</h4>' . "\n";
echo '          </div>' . "\n";
echo '              <form method="post">' . "\n";
echo '                             <input type="text" class="form-control text-primary" placeholder="Username" name="username" required autofocus><br><br>' . "\n";
echo '                             <input type="password" class="form-control text-primary" placeholder="Password" name="password" required><br><br>' . "\n";
echo '                             <button class="animation a6" name="login" type="submit">Sign in</button>' . "\n";
echo '          </form>' . "\n";
echo '          <br> <br>' . "\n";
echo '          </div>' . "\n";
    
echo '        </div>' . "\n";
echo '        <div class="right-section"></div>' . "\n";
echo '      </div></center>' . "\n";
  
echo '      </body>' . "\n";
echo '      </html>' . "\n";

  
echo '      </body>' . "\n";

?>

<!-- partial -->
  
</body>
<style>



h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    COLOR: #999999;
    margin-inline-end: 0px;
    font-weight: bold;
}

button, input, optgroup, select, textarea {
    font-family: sans-serif;
    font-size: 100%;
    line-height: 2.15;
    width: 160px;
    margin: 0;
    text-align: center;
    border-radius: 20px;
}

.card {
    margin-left: 40px;
    border-radius: 58px;
    margin-right: 40px;
    border: 1px solid #8c7e7d;
    background-image: url(img/bg.gif);
    background-size: cover;
}



* {
  box-sizing: border-box;
}
body {
  font-family: 'Rubik', sans-serif;
  margin: 0;
  padding: 0;
}
.container {
  display: flex;
  height: 100vh;
}
.left-section {
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
  background-image: url(img/nav.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
    flex-direction: column;
    justify-content: center;
    -webkit-animation-name: left-section;
    animation-name: left-section;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-delay: 1s;
    animation-delay: 1s;
}
.right-section {
  flex: 1;
  background: linear-gradient(to right, #f50629 0%, #fd9d08 100%);
  transition: 1s;
  background-image: url(img/loginright.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}


.form {
    max-width: 80%;
    display: flex;
    flex-direction: column;
    align-content: flex-end;
    flex-wrap: wrap;
}
.form > p {
  text-align: right;
}
.form > p > a {
  color: #000;
  font-size: 14px;
}
.form-field {
    height: 46px;
    padding: 0 16px;
    border: 2px solid #ddd;
    border-radius: 4px;
    font-family: 'Rubik', sans-serif;
    outline: 0;
    transition: .2s;
    margin-top: 20px;
    text-align: center;
}
.form-field:focus {
  border-color: #0f7ef1;
}
.form > button {
  padding: 12px 10px;
  border: 0;
  background: linear-gradient(to right, #f50629 0%, #fd9d08 100%);
  border-radius: 3px;
  margin-top: 10px;
  color: #fff;
  letter-spacing: 1px;
  font-family: 'Rubik', sans-serif;
}
.animation {
  -webkit-animation-name: move;
          animation-name: move;
  -webkit-animation-duration: .4s;
          animation-duration: .4s;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}

.a1 {
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}
.a2 {
  -webkit-animation-delay: 2.1s;
          animation-delay: 2.1s;
}
.a3 {
  -webkit-animation-delay: 2.2s;
          animation-delay: 2.2s;
}
.a4 {
  -webkit-animation-delay: 2.3s;
          animation-delay: 2.3s;
}
.a5 {
  -webkit-animation-delay: 2.4s;
          animation-delay: 2.4s;
}
.a6 {
  -webkit-animation-delay: 2.5s;
          animation-delay: 2.5s;
}
@keyframes move {
  0% {
    opacity: 0;
    visibility: hidden;
    -webkit-transform: translateY(-40px);
            transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
}
@keyframes left-section {
  0% {
    opacity: 0;
    width: 0;
  }
  100% {
    opacity: 1;
    padding: 20px 40px;
    width: 440px;
  }
}
</style>


<style>
* {
  box-sizing: border-box;
}
body {
  font-family: 'Rubik', sans-serif;
  margin: 0;
  padding: 0;
}
.container {
  display: flex;
  height: 100vh;
}
.left-section {
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
  background-image: url(img/bg26.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
    flex-direction: column;
    justify-content: center;
    -webkit-animation-name: left-section;
    animation-name: left-section;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-delay: 1s;
    animation-delay: 1s;
}
.right-section {
  flex: 1;
  background: linear-gradient(to right, #f50629 0%, #fd9d08 100%);
  transition: 1s;
  background-image: url(img/loginright.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

.header > h4 {
    margin-top: 10px;
    font-weight: normal;
    font-size: 15px;
    color: rgb(153 153 153);
}
.form {
    max-width: 80%;
    display: flex;
    flex-direction: column;
    align-content: flex-end;
    flex-wrap: wrap;
}
.form > p {
  text-align: right;
}
.form > p > a {
  color: #000;
  font-size: 14px;
}
.form-field {
    height: 46px;
    padding: 0 16px;
    border: 2px solid #ddd;
    border-radius: 4px;
    font-family: 'Rubik', sans-serif;
    outline: 0;
    transition: .2s;
    margin-top: 20px;
    text-align: center;
}
.form-field:focus {
  border-color: #0f7ef1;
}
.form > button {
  padding: 12px 10px;
  border: 0;
  background: linear-gradient(to right, #f50629 0%, #fd9d08 100%);
  border-radius: 3px;
  margin-top: 10px;
  color: #fff;
  letter-spacing: 1px;
  font-family: 'Rubik', sans-serif;
}
.animation {
  -webkit-animation-name: move;
          animation-name: move;
  -webkit-animation-duration: .4s;
          animation-duration: .4s;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}

.a1 {
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
}
.a2 {
  -webkit-animation-delay: 2.1s;
          animation-delay: 2.1s;
}
.a3 {
  -webkit-animation-delay: 2.2s;
          animation-delay: 2.2s;
}
.a4 {
  -webkit-animation-delay: 2.3s;
          animation-delay: 2.3s;
}
.a5 {
  -webkit-animation-delay: 2.4s;
          animation-delay: 2.4s;
}
.a6 {
  -webkit-animation-delay: 2.5s;
          animation-delay: 2.5s;
}
@keyframes move {
  0% {
    opacity: 0;
    visibility: hidden;
    -webkit-transform: translateY(-40px);
            transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
}
@keyframes left-section {
  0% {
    opacity: 0;
    width: 0;
  }
  100% {
    opacity: 1;
    padding: 20px 40px;
    width: 440px;
  }
}
</style>
</html>






<?php

require 'includes/egz.php';
echo '<script>' . "\n";
echo '    var freshTime = new Date(parseInt($(\'#current-time-now\').attr(\'data-start\'))*1000);' . "\n";
echo '    var func = function myFunc() {' . "\n";
echo '        $(\'#current-time-now\').text(freshTime.toLocaleTimeString());' . "\n";
echo '        freshTime.setSeconds(freshTime.getSeconds() + 1);' . "\n";
echo '        setTimeout(myFunc, 1000);' . "\n";
echo '    };' . "\n";
echo '    func();' . "\n";
echo '</script>';
echo '</body>' . "\n";
echo "\n";
echo '</html>' . "\n";

?>