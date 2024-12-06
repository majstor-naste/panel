<?php


$jsondata_admin1 = file_get_contents('./includes/eggzie.json');
$data_admin1 = json_decode($jsondata_admin1, true);
$json_admin1 = $data_admin1['info'];
$col_admin1 = $json_admin1['oo'];

if ($col_admin1 == '0') {
	header('Location: users.php');
}

$file = './a/note.json';
$jsondata = file_get_contents($file);
$json = json_decode($jsondata, true);
$message = '<div class="alert alert-primary" id="flash-msg"><h4><i class="icon fa fa-check"></i>Items Updated!</h4></div>';

if (isset($_POST['text'])) {
	$file = './a/note.json';
	$jsondata = file_get_contents($file);
	$json = json_decode($jsondata, true);
	$replacementData = ['title' => $_POST['title'], 'content' => $_POST['content']];
	$newArrayData = array_replace_recursive($json, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_UNESCAPED_UNICODE);
	file_put_contents($file, $newJsonData);
	header('Location: note.php?success');
}

$title = $json['title'];
$content = $json['content'];
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
    margin-left: -141px;
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
						    <br><br> <br>
													<a><p>
  <span>

    𝑵𝒐𝒕𝒊𝒇𝒊𝒄𝒂𝒕𝒊𝒐𝒏𝒔
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
echo '                <div class="card-body">' . "\n";
echo '                            <form method="post">' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="title">' . "\n";
echo '                                <strong>Title</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" class="form-control " style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';"  name="title" id="title" value="' . $title . '">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group ">' . "\n";
echo '                            <label class="control-label " style="color:' . $colour_head_18 . ';" for="content">' . "\n";
echo '                                <strong>Message</strong>' . "\n";
echo '                            </label>' . "\n";
echo '                            <div class="input-group">' . "\n";
echo '                            <input type="text" class="form-control"  style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" name="content" id="content" value="' . $content . '">' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            <div class="form-group">' . "\n";
echo '                            <div>' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="text" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                            </div>' . "\n";
echo '                            </div>' . "\n";
echo '                            </form>' . "\n";
echo '                </div>' . "\n";
echo '              </div>' . "\n";
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