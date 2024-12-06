<?php 
#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

$dbflasha = new SQLite3('./a/db/flash_ads.db');
$dbflasha->exec('CREATE TABLE IF NOT EXISTS flashads(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL,title VARCHAR(100), type VARCHAR(100), link VARCHAR(100), description VARCHAR(100), position VARCHAR(100), extension VARCHAR(100),createdon VARCHAR(100),thumbpath VARCHAR(100))');

$res = $dbflasha->query('SELECT * FROM flashads');
$rows = $dbflasha->query('SELECT COUNT(*) as count FROM flashads');
$row = $rows->fetchArray();
$numRows = $row['count'];
$HOSTa = $lurl = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/banner/demo.png';
$date = date('Y-m-d H:i:s');
if ($numRows == 0) {
	$dbflasha->exec('INSERT INTO flashads(title, type, link, description, position, extension, createdon, thumbpath) VALUES(\'Sample\',\'image\',\'http://flash.k6.com.br\',\'flash Apks Rebrand\',\'vertical\',\'png\',\'' . $date . '\',\'' . $HOSTa . '\')');
}
	if(isset($_GET['delete'])){

$resd = $dbflasha->query('SELECT * FROM  flashads WHERE id=' . $_GET['delete']);
$rowd = $resd->fetchArray();

$url= $rowd['thumbpath'];
$file_to_delete = basename(parse_url($url, PHP_URL_PATH));
	$file_to_delete = 'banners/' . $file_to_delete;
	
//echo $file_to_delete;
	if (file_exists($file_to_delete)) {
		
	unlink($file_to_delete);
	}
	$dbflasha->exec('DELETE FROM flashads WHERE id=' . $_GET['delete']);
		header("Location: ads.php");
	}

include 'includes/header.php';

echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";



?>

<div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
         
<div class="card-body">
		<center><br><img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100"><br><br><br> <a><p><span>𝑨𝒅𝒗𝒆𝒓𝒕𝒊𝒔𝒊𝒏𝒈</span></p></a></center>
    </div>     
							    
<?php


echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";





 echo '                                       <div class="card-body">
<a button class="btn btn-success btn-icon-split" href="./ads_create.php">
    <span class="icon text-white-50"><i class="fas fa-plus" ></i></span><span class="text"> Add A ADS</span></button></a>
<hr>
						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead align="center" class="text-primary">
								<tr>
								<th><strong>Banner Preview</strong></th>
								<th><strong>Banner Name / Date Add</strong></th>
								<th><strong>Banner Type</strong></th>
								<th><strong>Banner URL</strong></th>
								<th><strong>Banner Position H/V</strong></th>
								<th><strong>Edit</strong></th>
								<th><strong>Delete</strong></th>
								</tr>
							</thead>' . "\n";
							
 while ($row = $res->fetchArray()) {
	 
	  echo '  
							<tbody align="center">
								<tr class="text-primary">
								
								<td><img src="'.$row['thumbpath'].'" alt="" border=3 height=80 width=160></img></td>
								<td>'.$row['title'].'<br>'.$row['createdon'].'</td>
								<td>'.$row['type'].'</td>
								<td title="'.$row['thumbpath'].'">Mouse over to show</td>
								<td>'.$row['position'].'</td>
								
								<td><a class="btn btn-success btn-icon" href="./ads_update.php?update='.$row['id'].'"><i class="fas fa-edit"></i></a></td>

								<td><a class="btn btn-danger btn-icon" href="./ads.php?delete='.$row['id'].'"><i class="fas fa-trash"></i></a></td>


								</tr>
							</tbody>
							' . "\n";  }

	 echo ' 						</table>
						</div>
                            </div>
                        </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

    <br><br><br>';

require 'includes/flash.php';
echo '      </body>' . "\n";

?>
<style>
.table-sm th, .table-sm td {
    padding: 1.3rem;
}

.table th, .table td {
    vertical-align: middle;
    border-top: 1px solid #e3e6f0;
}

p span {
    font: 700 2.5em/1 "Oswald", sans-serif;
    letter-spacing: 0;
    padding: 0.25em 0 0.325em;
    display: block;
    text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
    background: url(img/animated-text-fill.png) repeat-y;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: aitf 80s linear infinite;
    -webkit-transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    margin-left: -118px;
    margin-top: -45px;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    border: 1px solid #838594;
    padding: 1.25rem;
    background-color: #252b3b;
    border-radius: 1.35rem;
    margin-top: -9px;
    margin-left: -19px;
    margin-right: -19px;
}
    
</style>
