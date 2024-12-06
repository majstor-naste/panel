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
  }
  else{

echo '
  <style>


    .wrap {
    }

    .slide {
    //height: 100vh;
    
    color: white;
    background-color: transparent;
      background-repeat: no-repeat;
  background-size: 100% 100%;
  background-attachment: fixed;
	  height: 100%;
	  width: 100%;"
      top: 0;
      left: 0;
      right: 0;
  margin: 0;
    padding: 0;
    border: 0;
    }

    .slide ul { overflow:hidden;
      //margin: 0 auto;
    background-color: transparent;
      background-repeat: no-repeat;
  background-size: 100% 100%;
  background-attachment: fixed;
	  height: 100%;
	  width: 100%;"
      top: 0;
      left: 0;
      right: 0;
  margin: 0;
    padding: 0;
    border: 0;
    }

    .slide ul li { overflow:hidden;
      list-style: none;
      position: absolute;
      z-index: 1;
      background-repeat: no-repeat;
  background-size: 100% 100%;
  background-attachment: fixed;
	  height: 100%;
	  width: 100%;"
      top: 0;
      left: 0;
      right: 0;
  margin: 0;
    padding: 0;
    border: 0;
    }

    .slide #dots {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 10px;
      height: 22px;
      z-index: 9999;
      font-size: 0;
      text-align: center;
      opacity: 0.7;
    }

    .slide #dots a {
      background: #333;
      margin: 0 6px;
      width: 10px;
      height: 10px;
      box-shadow: 0 0 1px 0 #333;
      border-radius: 100%;
      display: inline-block;
      cursor: pointer;
    }

    .slide #dots a.active {
      background: #FFF;
    }

    .slide .arrow {
      position: absolute;
      top: 50%;
      width: 60px;
      height: 40px;
      line-height: 40px;
      margin-top: -50px;
      //background: #FFF;
      z-index: 999;
      opacity: 0.4;
      color: #333;
      text-align: center;
      text-decoration: none;
    }

    .slide .arrow.prev {
      left: 0;
 // background: url("widgets/data/img/arrow-left.png");
  
    }

    .slide .arrow.next {
      right: 0;
  // background: url("widgets/data/img/arrow-right.png");
    }

    .slide .arrow:active {
      //background: #FAFAFA;
      opacity: 0.7;
    }
  </style>

    <div class="slide">
      <ul>
	  ';

		
	while ($rowads = $resads->fetchArray()) {
		
$imagepath = $rowads['thumbpath'].'?'.time();
      
	 echo '<li style="background-image:url('.$imagepath.')"></li>';
	  
					 	 //echo '<li>  <iframe allowtransparency="true" style="background: transparent; height: 100vh; width: 100vw;" src="'.$imagepath.'" frameborder="0" allowfullscreen></iframe></li>';
		
					 }
echo '
      </ul>
    </div>
	


<script type="text/javascript" src="widgets/data/js/jquery.js"></script>
<script type="text/javascript" src="widgets/data/js/jquery.fadeImg.js"></script>
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