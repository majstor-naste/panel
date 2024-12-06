<?php


$jsondata_admin1 = file_get_contents('./includes/eggzie.json');
$data_admin1 = json_decode($jsondata_admin1, true);
$json_admin1 = $data_admin1['info'];
$col_admin1 = $json_admin1['oo'];

if ($col_admin1 == '0') {
	header('Location: dashboard.php');
}

$jsondata = file_get_contents('./a/ibo.json');
$data = json_decode($jsondata, true);
$json = $data['app_info'];
$update_androidversioncode = $json['android_version_code'];
$update_apkurl = $json['apk_url'];
$update_pin_code = $json['pin_code'];
$message = '<div class="alert alert-primary" id="flash-msg"><h4><i class="icon fa fa-check"></i>Apk Details Updated!</h4></div>';

if (isset($_POST['submit'])) {
	$jsonData = file_get_contents('./a/ibo.json');
	$arrayData = json_decode($jsonData, true);
	$replacementData = [
		'app_info' => ['android_version_code' => $_POST['android_version_code'], 'apk_url' => $_POST['apk_url'], 'pin_code' => $_POST['pin_code']]
	];
	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
	file_put_contents('./a/ibo.json', $newJsonData);
	header('Location: update.php?success');
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
    margin-top: -29px;
    margin-left: -3px;
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
						    <br><br> 
													<a><p>
  <span>

    𝑺𝒆𝒕𝒕𝒊𝒏𝒈𝒔
  </span>

</p></a>
						</center>

						</div>
<?php



echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['success'])) {
	echo $msg_success;
}

echo '          <!-- Page Heading -->' . "\n";
echo '         ' . "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="card2 border-left-primary shadow h-100 card shadow mb-4">' . "\n";
echo '                <div class="card-header py-3">' . "\n";
echo '                <h6 class="m-0 font-weight-bold" style="color:' . $colour_head_11 . ';"><i class="fa fa-wrench"></i> Edit APK Settings</h6>' . "\n";
echo '                </div>' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="android_version_code">' . "\n";
echo '                                <strong>Version Code</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" class="form-control " style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';"  name="android_version_code" id="android_version_code" value="' . $update_androidversioncode . '" required>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="apk_url">' . "\n";
echo '                                <strong>Apk Url</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" class="form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" name="apk_url" id="apk_url" value="' . $update_apkurl . '" required>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="pin_code">' . "\n";
echo '                                <strong>Pin Code</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" class="form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" name="pin_code" id="pin_code" value="' . $update_pin_code . '" required>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group">' . "\n";
echo '                            <div>' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            </form>' . "\n";
echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo "\n";
echo '    <br><br><br>';


echo ' <style>
    
.card2 {
    text-align: center;
    border-radius: 26px;
    border-color: #9c9c9c;
    background-color: #252b3b;
    !important: ;
}
    
</style>' . "\n";

include 'includes/footer.php';
require 'includes/egz.php';
echo '</body>' . "\n";

?>