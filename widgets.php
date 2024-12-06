<?php 

	
#######################CHECK ERROR ###################################
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

$jsondata = file_get_contents('./a/json/flash_data.json');
$data = json_decode($jsondata, true);
$json = $data['app'];
$widget_1 = ($json['widget'] == '1' ? 'selected' : '');
$widget_2 = ($json['widget'] == '2' ? 'selected' : '');
$widget_3 = ($json['widget'] == '3' ? 'selected' : '');
$widget_4 = ($json['widget'] == '4' ? 'selected' : '');
$widget_5 = ($json['widget'] == '5' ? 'selected' : '');
$widget_6 = ($json['widget'] == '6' ? 'selected' : '');

$active_1 = ($json['widget'] == '1' ? 'warning' : 'primary');
$active_2 = ($json['widget'] == '2' ? 'warning' : 'primary');
$active_3 = ($json['widget'] == '3' ? 'warning' : 'primary');
$active_4 = ($json['widget'] == '4' ? 'warning' : 'primary');
$active_5 = ($json['widget'] == '5' ? 'warning' : 'primary');
$active_6 = ($json['widget'] == '6' ? 'warning' : 'primary');

$message = '<div class="alert alert-primary" id="flash-msg"><h4><i class="icon fa fa-check"></i>Items Updated!</h4></div>';

if (isset($_REQUEST['submit'])) {
	$jsonData = file_get_contents('./a/json/flash_data.json');
	$arrayData = json_decode($jsonData, true);


	$replacementData = [
		'app' => ['widget' => $_REQUEST['widget']]
	];
	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_UNESCAPED_UNICODE);
	file_put_contents('./a/json/flash_data.json', $newJsonData);
	header('Location: widgets.php?message=' . $message);
}

include 'includes/header.php';

echo '  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "\n";



?>


<div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
<style>

.card {
    margin-left: 20px;
    margin-right: 20px;
        border: 1px solid #0857cd;
        background-image: url(img/bgcinema.jpg);
}    

.border-left-primary {
    border-left: 0.1rem solid #0857cd !important;
}
    
</style>            
                     <div class="">
                                                
							<div class="">
							    <div class="card border-left-primary shadow h-100 card shadow mb-4">
                    

                <hr class="mt-0">
                
                <center><br><img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100"><br><br><br> <a><p><span>𝑾𝑰𝑫𝑮𝑬𝑻 𝑻𝑯𝑬𝑴𝑬</span></p></a></center><br>
					
					</div>


<!-- Theme -->
       <div class="card border-left-primary shadow h-100 card shadow mb-4">


               <div class="col mr-2">
                <center><a><z><span>𝑷𝒓𝒆𝒗𝒊𝒆𝒘</span></z></a></center>
                 <div class="h5 mb-0 font-weight-bold text-gray-800"><iframe id="iframe_preview" style="width: 65%;height: 500px;margin-bottom: 20px;" src="./a/FlashBanner.php?tag=banner"></iframe></div>

           </div>
         </div>


                			</div>
                			<div class="card border-left-primary shadow h-100 card shadow mb-4">
                			    <center>
        <form name="" id="onoff" method="post" enctype="multipart/form-data">
							    
<?php





echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['message'])) {
	echo $_GET['message'];
}

echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";
echo '            <!-- First Column -->' . "\n";
echo '            <div class="col-lg-12">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";
echo '                <div class="text-text-primary">' . "\n";
echo '                <div class="">' . "\n";






echo '            </div>' . "\n";
echo '                <div class="">' . "\n";
echo '                            <form method="post">' . "\n";
echo "\t\t\t\t\t\t\t" . '<div class="form-group ">' . "\n";
echo '                            <label class="text-primary control-label requiredField" for="aa" >' . "\n";
echo '  <br>' . "\n";
echo '                      <h5><center><a><z><span>𝙎𝙚𝙡𝙚𝙘𝙩 𝙮𝙤𝙪𝙧 𝙒𝙞𝙙𝙜𝙚𝙩</span></z></a></center></h5>' . "\n";
echo '                            </label>' . "\n";
echo '                            <select class="select form-control text-primary" id="select" name="widget">' . "\n";

echo "\t\t\t\t\t\t\t\t" . '<option value="1"' . $widget_1 . '>Widget 1</option>' . "\n";
//echo "\t\t\t\t\t\t\t\t" . '<option value="2"' . $widget_2 . '>Widget 2</option>' . "\n";
echo "\t\t\t\t\t\t\t\t" . '<option value="3"' . $widget_3 . '>Widget 2</option>' . "\n";
//echo "\t\t\t\t\t\t\t\t" . '<option value="4"' . $widget_4 . '>Widget 4</option>' . "\n";
//echo "\t\t\t\t\t\t\t\t" . '<option value="5"' . $widget_5 . '>Widget 5</option>' . "\n";
//echo "\t\t\t\t\t\t\t\t" . '<option value="6"' . $widget_6 . '>Widget 6</option>' . "\n";
echo '                            </select>' . "\n";
echo '  <br><br>' . "\n";
echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '                <div class="">' . "\n";
echo '            </div>' . "\n";
echo '            </div>' . "\n";
echo '  <br><br>' . "\n";
echo "\n";
echo '            <!-- Theme -->' . "\n";
echo '            <div class="col-xl-4 col-md-6 mb-6">' . "\n";
echo '              <div class="card border-left-' . $active_1 . ' shadow py-2">' . "\n";

echo '                    <div class="col mr-2">' . "\n";
echo '                      <div class="text-xs text-xs animate-charcter font-weight-bold text-' . $active_1 . ' text-uppercase mb-1"><h6><center><a><z><span>𝑾𝒊𝒅𝒈𝒆𝒕 1</span></z></a></center></h6></div>' . "\n";
echo '                      <div class="h5 mb-0 font-weight-bold text-gray-800"><img class="card-img-bottom" src="https://i.imgur.com/t0cR0yJ.gif" alt="Card image" style="width:100%"></div>' . "\n";

echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            ' . "\n";
echo '            <!-- Theme -->' . "\n";
echo '            <div class="col-xl-4 col-md-6 mb-6">' . "\n";
echo '              <div class="card border-left-' . $active_3 . ' shadow py-2">' . "\n";

echo '                    <div class="col mr-2">' . "\n";
echo '                      <div class="text-xs text-xs animate-charcter font-weight-bold text-' . $active_3 . ' text-uppercase mb-1"><h6><center><a><z><span>𝑾𝒊𝒅𝒈𝒆𝒕 2</span></z></a></center></h6></div>' . "\n";
echo '                      <div class="h5 mb-0 font-weight-bold text-gray-800"><img class="card-img-bottom" src="https://i.imgur.com/mruGsEx.gif" alt="Card image" style="width:100%"></div>' . "\n";

echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            ' . "\n";

echo "\t\t\t\t\t\t\t" . '</div>' . "\n";
echo '  <br>' . "\n";
echo '                            <div class="form-group">' . "\n";
echo '                        <button class="btn btn-success btn-icon-split" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";

echo '                            </div>' . "\n";
echo '                            </form>' . "\n";
echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '                <div class="">' . "\n";
echo '            </div>' . "\n";
echo '            </div>' . "\n";
echo '  <br>' . "\n";
echo "\n";
/*
echo '            <!-- Theme -->' . "\n";
echo '            <div class="col-xl-4 col-md-6 mb-6">' . "\n";
echo '              <div class="card border-left-' . $active_4 . ' shadow py-2">' . "\n";

echo '                    <div class="col mr-2">' . "\n";
echo '                      <div class="text-xs font-weight-bold text-' . $active_4 . 'text-uppercase mb-1">Widget 4</div>' . "\n";
echo '                      <div class="h5 mb-0 font-weight-bold text-gray-800"><img class="card-img-bottom" src="./img/widgets/widget4.jpg" alt="Card image" style="width:100%"></div>' . "\n";

echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            ' . "\n";
echo '            <!-- Theme -->' . "\n";
echo '            <div class="col-xl-4 col-md-6 mb-6">' . "\n";
echo '              <div class="card border-left-' . $active_5 . ' shadow py-2">' . "\n";

echo '                    <div class="col mr-2">' . "\n";
echo '                      <div class="text-xs font-weight-bold text-' . $active_5 . ' text-uppercase mb-1">Widget 5</div>' . "\n";
echo '                      <div class="h5 mb-0 font-weight-bold text-gray-800"><img class="card-img-bottom" src="./img/widgets/widgets/widget5.jpg?" alt="Card image" style="width:100%"></div>' . "\n";

echo '                </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            ' . "\n";
echo '            <!-- Theme -->' . "\n";
echo '            <div class="col-xl-4 col-md-6 mb-6">' . "\n";
echo '              <div class="card border-left-' . $active_6 . ' shadow py-2">' . "\n";
echo '                    <div class="col mr-2">' . "\n";
echo '                      <div class="text-xs font-weight-bold text-' . $active_6 . ' text-uppercase mb-1">Widget 6</div>' . "\n";
echo '                      <div class="h5 mb-0 font-weight-bold text-gray-800"><img class="card-img-bottom" src="./img/widgets/widget6.jpg?" alt="Card image" style="width:100%"></div>' . "\n";
echo '                    </div>' . "\n";
echo '              </div>' . "\n";
echo '            </div>' . "\n";
echo '            ' . "\n";
*/
echo '            </div>' . "\n";
echo '            </div>' . "\n";

echo "\n";


echo "\n";
require 'includes/flash.php';
echo '</body>' . "\n";

?>

<style>
.col-xl-4 {
    position: relative;
    width: 100%;
    padding-right: 0.75rem;
    padding-left: 0.75rem;
    margin-bottom: 1.75rem;
}

.border-left-primary {
    border-left: 0.1rem solid #838594 !important;
}

.border-left-warning {
    border-left: 0.25rem solid #838594 !important;
}

.text-primary {
    color: #78787a !important;
    text-align: center;
}


.col-xl-4 {
    flex: 50%;
    max-width: 100%;
}

.row {
    display: flex;
    margin-right: -0.75rem;
    margin-left: -0.75rem;
}

.card {
    position: initial;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #252b3b;
    background-clip: border-box;
    border: 1px solid #838594;
    border-radius: 1.35rem;
}


.text-xs {
    font-size: 1.9rem;
    text-align: center;
}


.sidebar-dark .nav-item.active .nav-link {
    color: #778294;
}

.sidebar-dark .nav-item.active .nav-link i {
    color: #778294;
}

.form-control {
    display: block;
    width: 22%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #a9aab0;
    background-color: #343740;
    background-clip: padding-box;
    border: 1px solid #838594;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
    
    
element.style {
    width: 80%;
    height: 500px;
    margin-bottom: 45px;
    margin-top: 30px;
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
    margin-left: -162px;
    margin-top: -45px;
} 

z span {
    font: 700 2.5em/1 "Oswald", sans-serif;
    letter-spacing: 0;
    padding: 0.25em 0 0.325em;
    display: block;
    margin: 0 auto;
    text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
    background: url(img/animated-text-fill.png) repeat-y;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: aitf 80s linear infinite;
    -webkit-transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    margin-left: 17px;
}
</style>