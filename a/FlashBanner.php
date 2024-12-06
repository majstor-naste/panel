<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); 
// HTTP 1.1.
header("Pragma: no-cache"); 
// HTTP 1.0.
header("Expires: 0"); 
// Proxies.

#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
/**/
####################### CHECKS ###################################

function sanitize($data) {
	return $data;
}

$jsondata = file_get_contents('./json/flash_data.json');
$data = json_decode($jsondata, true);
$json = $data['app'];
$widget = $json['widget'];



	
###################################### START API #############################################
if (isset($_GET['tag'])) {
	$LASTTIME = date('d-m-Y H:i:s');
	$Tag = $_GET['tag'];


		
	
	


#############################################33
if ($Tag == 'introplay') { 
    echo '{"intro":"no"}';
}

if ($Tag == 'banner') {
	
// HTML BG Color
$bg_color = 'transparent';

// START HTML
echo ' 
	<!DOCTYPE html>
<html lang="en">
<head>
  <title>flash Dashboard Widget</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>

body {
       // background-image: url(\'\');
    height: 100vh;
  margin: 0;
    padding: 0;
    border: 0;
     overflow:hidden;
    color: white;
    background-color: transparent;
  background-size: 100% 100%;
  background-attachment: fixed;
  background-position: center;
  
  background-repeat: no-repeat;}
  

.container {
  overflow: hidden;
  margin: 0;
    padding: 0;
    border: 0;
width: 100%;
  height: 100%;
  }
  
  .video-container {

  //border: solid green;

  position: fixed;
  
  width: 100%;
  height: 90%;
  z-index: -1;
  overflow: hidden;
  position: relative;
}

.video-container video {
  min-width: 100%;
  min-height: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translateX(-50%) translateY(-50%);
}

/* Just styling the content of the div, the *magic* in the previous rules */
.video-container .caption {
  z-index: 1;
  position: relative;
  text-align: center;
  color: #dc0000;
  padding: 10px;
}

  
  </style>
  
</head>
<body bgcolor="'.$bg_color.'">';

$dbflash = new SQLite3('./db/flash_ads.db');
$dbflash->exec('CREATE TABLE IF NOT EXISTS flashads(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL,
title VARCHAR(100), 
    type VARCHAR(100), 
    link VARCHAR(100), 
    description VARCHAR(100), 
    position VARCHAR(100), 
    extension VARCHAR(100), 
    createdon VARCHAR(100), 
    thumbpath VARCHAR(100)
)');

$resads = $dbflash->query('SELECT * FROM flashads');

include ("./widgets/widget".$widget.".php");



echo '
</body>
</html>
';
	}
	
##################################### WEBVIEW ###################################################
if ($_GET['tag'] == 'webs' || $_GET['tag'] == 'webspt' || $_GET['tag'] == 'sports' ) {

include ("./packs/sports.php");

   }
   
}else {
       header("Location: index.php");
}

?>