<?php
#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

### Sports Guide

if ($_GET['tag'] == 'banner' ) {


$db = new SQLite3('./db/flash_sports.db');
$res = $db->query('SELECT * FROM flashsports'); 
$row = $res->fetchArray(SQLITE3_ASSOC);

if ( $row['type'] == '0') {
$_1 = $row['header_n'];
$_2 = str_replace("#", "", $row['border_c']);
$_3 = str_replace("#", "", $row['background_c']);
$_4 = str_replace("#", "", $row['text_c']);
$_5 = $row['days'];
$_6 = $row['auto_s'];
$api = "5cc316f797659";
$url = "https:\/\/www.tvsportguide.com\/widget\/$api?filter_mode=all&filter_value=&days=$_5&heading=$_1&border_color=custom&autoscroll=$_6&prev_nonce=a7242d2019&custom_colors=$_2,$_3,$_4";
}else {
    $url = $row['url'];
}
echo '
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,text/html,charset=utf-8">
	<style>
	body {
	background: black;
		margin: 0;
		/* Reset default margin */
	}
	iframe {
		display: block;
		background: transparent;
		border: none;
		height: 100vh;
		width: 100vw;
	}
	div {

    background: transparent;

    width: 70vw;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    margin: 0 auto;
    padding: 30px 30px 10px;
display: none;
    z-index: 3;
}

	</style>
</head>
<body>
<iframe  allowtransparency="true" style="background: transparent;" id="iframe" src="'.$url.'" frameborder="0"></iframe>
</body>
</html> ';
}
?>