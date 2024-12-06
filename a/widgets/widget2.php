<?php
#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

// SETTINGS
$folder_name = 'img/';

$videoban = 'no';

if ($Tag == 'banner'){

					 
if ($videoban == 'yes') {
echo '      <div class="show video-container">
    <a target="_blank" href="'.$bg_img.'">
    <video autoplay muted loop id="video" controls="" preload="none" poster="../img/corp.png" style="width:100%; height:100%">
    <source src="../intro/intro.mp4?'.time().'" type="video/mp4" />
  </video>
    </a>
  </div> ';
  }else{

echo '
  <style>
ul, li { list-style: none; }

.gg_btn {
  overflow: hidden;
  cursor: pointer;
  position: absolute;
}

.gg_left { background: url(../img/btn_l.png) no-repeat center center; left: 0px;}

.gg_right {
  background: url(../img/btn_r.png) no-repeat center center;
  right: 0px;
}

.wrap {
  width: 600px;
  height: 400px;
  position: relative;
  margin: 0px auto;
  overflow: hidden;
}

.wrap ul {
  width: 400px;
  height: 300px;
}

.wrap ul li { position: absolute; }

/*# sourceMappingURL=css.css.map */


  </style>

   
     	<div class="wrap" id="wrap" data-setting=\'{
											"width":580,
										 	"heihgt":300,
										 	"firstPicWidth":380,
									 		"firstPicHeight":300,
										 	"scale":0.9,
										 	"speed":3500
												}\'>
		<div class="gg_left gg_btn"></div>
		<div class="gg_right gg_btn"></div>
		<ul class="wrap_ul">
	  ';

		
	while ($rowads = $resads->fetchArray()) {
		
$imagepath = $rowads['thumbpath'].'?'.time();
      
	 echo '<li class="li_item"><a href=""><img src="'.$imagepath.'" width="100%"  height="100%"  alt=""></a></li>';
	  
					 	 //echo '<li>  <iframe allowtransparency="true" style="background: transparent; height: 100vh; width: 100vw;" src="'.$imagepath.'" frameborder="0" allowfullscreen></iframe></li>';
		
					 }
echo '
		</ul>
	</div>
	<script>
		$(function(){
			Carrousel.init($(\'#wrap\'));
		})
	</script>
	


<script type="text/javascript" src="widgets/data/js/jquery.js"></script>
<script type="text/javascript" src="widgets/data/js/js.js"></script>
<script>
  $(document).ready(function($) {
    $(".slide").fadeImages({
      time:3000,
            fade: 1000, 
            dots: true, 
            arrows: true,
      complete: function() {
        console.log("Fade Images Complete");
      }
    });

  });
</script>';
  }
}

?>