<?php
#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

$db = new SQLite3('./a/db/flash_ads.db');
//db call
//table name
$table_name = "flashads";
//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);
// file dir
$target_dir = 'banners/';

$file_path = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/'.$target_dir;

if (!file_exists($target_dir)) {
	mkdir($target_dir, 511, true);
}
$res = $db->query('SELECT * FROM flashads WHERE id=\'' . $_GET['update'] . '\'');
$row = $res->fetchArray();


if (isset($_POST['submit'])) {
	
	if ($_POST['type'] == '0') {
	    
	$target_file = $target_dir. $_FILES['image']['name'];
	

	$uploadOk = 1;
	
	$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
	$extensions = ['gif', 'GIF', 'png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'bmp', 'BMP'];



	if (file_exists($target_file)) {
		unlink($target_file);
	$msg = '?messageA=The file already exists and has been replaced.';
	}else { 
		$msg = '?messageS=Success, Image File uploaded.'; }

	$uploadOk = 1;

	if (5000000 < $_FILES['image']['size']) {
		$msg = '?messageE=Sorry, your file is too large.';
		//echo $msg;
		$uploadOk = 0;
	}
	if (in_array($file_ext, $extensions) === false) {
		//$errors[] = 'extension not allowed, please choose a JPEG or PNG or GIF or MP4 file.';
				$msg = '?messageE=Sorry, only JPEG or PNG or GIF files are allowed.';
		//echo $msg;
		
	
		$uploadOk = 0;
	}


	if ($uploadOk == 0) {
	    
	header("Location: {$base_file}".$msg);
	}
	else if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
		$flash_patch = '' . $file_path . $_FILES['image']['name']. '';
		
		
			$adsimg = $flash_patch;
		
	    $createdon = date('Y-m-d H:i:s');
    $extension = 'png';
    $adshv = $_POST['position'];
     
	$db->exec('UPDATE flashads SET 
	title=\'' . $_POST['title'] . '\', 
	type=\'' . $_POST['type'] . '\', 
	link=\'http://flash.apps.rebranded\', 
	description=\'flash Apks Rebrand\', 
	position=\'' . $adshv  . '\', 
	extension=\'' . $extension . '\', 
	createdon=\'' . $createdon . '\', 
	thumbpath=\'' . $adsimg . '\'
	WHERE   id=\'' . $_POST['id'] . '\'');

$urld= $row['thumbpath'];
$file_to_delete = basename(parse_url($urld, PHP_URL_PATH));
	$file_to_delete = 'banners/' . $file_to_delete;
	
//echo $file_to_delete;
	if (file_exists($file_to_delete)) {
		
	unlink($file_to_delete);
	}

	$db->close();
	header('Location: ads.php'.$msg);
	
	}
}else{
	$url = $_POST['url'];
    $target_file = $target_dir . basename($url);
    
		
	$file_ext = strtolower(end(explode('.', $url)));
	$extensions = ['jpeg', 'jpg', 'png', 'gif', 'JPEG', 'JPG', 'PNG', 'GIF'];
	
	if (in_array($file_ext, $extensions) === false) {
		//$errors[] = 'extension not allowed, please choose a JPEG or PNG or GIF or MP4 file.';
				$msg = '?messageE=Sorry, only JPG or PNG or GIF files are allowed.';
		//echo $msg;
		
		
	header("Location: {$base_file}".$msg);
	}else{
	
		$msg = '?messageS=Saved!, Url of updated Image file..';
		
		
$urld= $row['thumbpath'];
$file_to_delete = basename(parse_url($urld, PHP_URL_PATH));
	$file_to_delete = 'banners/' . $file_to_delete;
	
//echo $file_to_delete;
	if (file_exists($file_to_delete)) {
		
	unlink($file_to_delete);
	}
		
		//echo $adsimg;
		//die;
	    $createdon = date('Y-m-d H:i:s');
    $type = $_POST['type'];
    $adsimg = $url;
    $adshv = $_POST['position'];
	$extension = 'png';
	
	$db->exec('UPDATE flashads SET 
	title=\'' . $_POST['title'] . '\', 
	type=\'' . $_POST['type'] . '\', 
	link=\'http://flash.apps.rebranded\', 
	description=\'flash Apks Rebrand\', 
	position=\'' . $adshv  . '\', 
	extension=\'' . $extension . '\', 
	createdon=\'' . $createdon . '\', 
	thumbpath=\'' . $adsimg . '\'
	WHERE   id=\'' . $_POST['id'] . '\'');


	$db->close();
	header('Location: ads.php'.$msg);
	}
  }	

}
include ('includes/header.php');

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
    background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: aitf 80s linear infinite;
    -webkit-transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    margin-left: -118px;
    margin-top: -45px;
}



.card {
    flex: 1 1 auto;
    min-height: 1px;
    border: 1px solid #838594;
    padding: 1.25rem;
    background-color: #252b3b;
    border-radius: 1.35rem;
    margin-left: 22px;
    margin-right: 22px;
}


.form-group {
    margin-bottom: 0rem;
}

.custom-file-label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6e707e;
    background-color: #1d222e;
    border: 1px solid #d1d3e2;
    border-radius: 0.35rem;
}
</style>


<div class="card">
								<center><br><img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100"><br><br><br> <a><p><span>𝑨𝒅𝒗𝒆𝒓𝒕𝒊𝒔𝒊𝒏𝒈</span></p></a></center></div>	
							    
<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$id = $row['id'];
$title = $row['title'];
$thumbpath = $row['thumbpath'];
$createdon = $row['createdon'];

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";


if (isset($_GET['message'])) {
	echo '<div class="alert alert-danger bg-primary py-3" id="flash-msg"><h4 align="center" class="m-0 font-weight-bold text-white"><i class="icon fa fa-check"></i> '.$_GET['message'].'</h4></div>';
}
if (isset($_GET['messageA'])) {
	echo '<div class="alert alert-danger bg-primary py-3" id="flash-msg"><h4 align="center" class="m-0 font-weight-bold text-white"><i class="icon fa fa-check"></i> '.$_GET['messageA'].'</h4></div>';
}
if (isset($_GET['messageE'])) {
	echo '<div class="alert alert-danger bg-danger py-3" id="flash-msg"><h4 align="center" class="m-0 font-weight-bold text-white"><i class="icon fa fa-times"></i> '.$_GET['messageE'].'</h4></div>';
}
if (isset($_GET['messageS'])) {
	echo '<div class="alert alert-danger bg-success py-3" id="flash-msg"><h4 align="center" class="m-0 font-weight-bold text-white"><i class="icon fa fa-check"></i> '.$_GET['messageS'].'</h4></div>';
}


echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";
echo '            <!-- First Column -->' . "\n";
echo '            <div class="col-lg-12">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";


echo '                </div>' . "\n";

?>

                         <div class="card-body">
								<form method="post" enctype="multipart/form-data">
                        <div  type="hidden" class="form-group">
						   <input type="hidden" name="id" value="<?=$row['id'] ?>">
                          <input type="hidden" id="id" class="form-control text-primary" name="id" value="<?=$row['id'] ?>">
                        </div>
                         <div class="form-group">
                          <label class="bmd-label-floating"><strong>Banner Name</strong></label>

                          <input type="text" id="title" class="form-control text-primary" name="title" value="<?=$row['title'] ?>">

                        </div>
						                                <div class="form-group ">
                                   <label class="control-label " for="vpn_config">
                                       <strong>Select Banner Image File Type</strong>
                                  </label>
                                 <div class="input-group">
									  <select class="form-control type" id="type" name="type">
										  <option data-value="op0" value="0" <?=$row['type']=='0'?'selected':'' ?>>Upload Banner Image File
										  </option>
										  <option data-value="op1" value="1" <?=$row['type']=='1'?'selected':'' ?>>Enter Banner Image External URL
									  </select>
                                    </div>
                                </div>
							
						  
						    <div class="activeu">
							<div class="form-group ">
                             <label class="control-label"><strong> Enter Banner Image External Url</strong></label>
                                <div class="input-group">
                                 <input  class="form-control" type="text" name="url" value="<?=$row['thumbpath'] ?>" placeholder="Enter URL file.gif or file.png or file.jpg...">
                                </div>
                             </div>
                         </div>
						 
						                       <div class="actived">
                        <div class="form-group ">
                            <label class="control-label"> <strong> Upload Banner Image File</strong></label>
						      <div class="input-group">
						      	<div class="custom-file">
					        	<input type="file" class="custom-file-input" name="image" id="intro" placeholder="Choose Intro" onchange="uploadintro(this)" aria-describedby="intro">
			<label class="custom-file-label" for="intro" placeholder="Choose Background Image"><span id="image-intro"></span></label>
				          	   </div>
			                </div>
		        	     </div>
		    	       </div>
						
						
						
                         <div class="form-group">
                          <label class="bmd-label-floating"><strong>Banner Position</strong></label>

<select class="select form-control type" id="position" name="position">
                                        <option value="vertical" data-value="0" <?=$PHV == 'vertical' ? 'selected' : ''?>>Vertical</option> 
									    <option value="horizontal" data-value="1"  <?=$PHV == 'horizontal' ? 'selected' : ''?>>Horizontal</option>
                          </select>
                          
                        </div>
                        
                        
                        <div align="center" class="form-group mb-3">
									<br>
										<button class="btn btn-success btn-icon-split" name="submit" type="submit"><span class="icon text-white-50"><i class="fas fa-save"></i>&nbsp;&nbsp;</span><span class="text"> Save Settings</span></button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
//select activecode form
//var response = {};
//response.val = "op2";
//$("#codemode option[data-value='" + response.val +"']").attr("selected","selected");

//hide activecode form
$('.actived').show(); 

$('.activeu').hide(); 


//Show/hide activecode select
$(document).ready(function(){
  $('.type').change(function(){
    if($('.type').val() > 0) {
      $('.actived').hide(); 
      $('.activeu').show(); 
    } else {
      $('.activeu').hide(); 
      $('.actived').show(); 
     document.getElementById("activeu").value = ' ';
    } 
  });
  $('.type').ready(function(){
    if($('.type').val() > 0) {
      $('.actived').hide(); 
      $('.activeu').show(); 
    }else {
      $('.activeu').hide(); 
      $('.actived').show(); 
     document.getElementById("actived").value = ' ';
      
    } 
  });
});
</script>
<script>
function formSubmit(radioObj){
  if(radioObj.checked){
    document.getElementById("onoff").submit();

  }
}
</script>
<?php
// JAVA TARGET
echo '<script>';
echo 'function uploadintro(target) {' . "\n";
echo "\t" . 'document.getElementById("image-intro").innerHTML = target.files[0].name;' . "\n";
echo '}' . "\n";
echo "\n";
echo '$(document).ready(function() {' . "\n";
echo '    if (location.hash) {' . "\n";
echo '        $("a[href=\'" + location.hash + "\']").tab("show");' . "\n";
echo '    }' . "\n";
echo '    $(document.body).on("click", "a[data-toggle=\'tab\']", function(event) {' . "\n";
echo '        location.hash = this.getAttribute("href");' . "\n";
echo '    });' . "\n";
echo '});' . "\n";
echo '$(window).on("popstate", function() {' . "\n";
echo '    var anchor = location.hash || $("a[data-toggle=\'tab\']").first().attr("href");' . "\n";
echo '    $("a[href=\'" + anchor + "\']").tab("show");' . "\n";
echo '});' . "\n";
echo "\n";
echo '</script>';
//INCLUDE FUNCTIONS
echo '    <br><br><br>';
include 'includes/footer.php';
require 'includes/flash.php';
echo '      </body>' . "\n";

?>