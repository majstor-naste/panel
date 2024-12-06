<?php



#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
######################################################################

//db call
$db = new SQLite3('./a/db/flash_sports.db');
//table name
$table_name = "flashsports";
//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, header_n TEXT, border_c TEXT, background_c TEXT, text_c TEXT, days TEXT, auto_s TEXT, url VARCHAR(100), type TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM {$table_name}");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0)
{
	$db->exec("INSERT INTO {$table_name}(id, header_n, border_c, background_c, text_c, days, auto_s, url, type) VALUES('1', 'Event', '#000000', '#000000', '#ffffff', '3', '1', 'https://www.tvsportguide.com/widget/5cc316f797659?filter_mode=all&filter_value=&days=3&heading=Event&border_color=custom&autoscroll=1&prev_nonce=a7242d2019&custom_colors=000000,000000,ffffff', '0')");
}

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='1'");
@$rowU=$resU->fetchArray();
$new_url = str_replace(' ', '', $rowU['url']);
if(isset($_POST['submit'])){
    $new_url = str_replace(' ', '', $_POST['url']);
    
	$db->exec("UPDATE {$table_name} SET header_n='".$_POST['header_n']."',
										border_c='".$_POST['border_c']."', 
										background_c='".$_POST['background_c']."', 
										text_c='".$_POST['text_c']."',
										days='".$_POST['days']."',
										auto_s='".$_POST['auto_s']."',
										url='".$new_url."',
										type='".$_POST['type']."'
									WHERE 
										id='1'");
	$db->close();
	header("Location: {$base_file}");
}

include ('includes/header.php');


?>


<div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
         
<div class="card-body">
		<center><br><img src="img/ibo1.png" alt="" height="100"><br><br><br> <a><p><span>𝑺𝒑𝒐𝒓𝒕𝒔 𝑾𝒊𝒅𝒈𝒆𝒕</span></p></a></center>
    </div>     
<br>
    <div class="flex-container">
		<div class="col-md-6 ">
			<div class="card-body2">
				<div class="">
					<div class="">
						<center>
						    	<a><z>
  <span>

    𝑷𝒓𝒆𝒗𝒊𝒆𝒘 𝑬𝒗𝒆𝒏𝒕𝒔
  </span>

</z></a>
							<br><br>
						</center>
					</div>
					<div class="">
					    <br>
														
								<iframe id="iframe_preview" style="width: 100%; height: 820px;" src="./a/FlashBanner.php?tag=sports"></iframe>						
														
						</div>
					</div>
				</div>
		</div>
     <div class="flex-container">
		<div class="col-md-6 mx-auto">
			<div class="card-body">
				<div class=""><br>

						<center>
						    						    	<a><z>
  <span>

    𝑾𝒊𝒅𝒈𝒆𝒕
  </span>

</z></a>
							<br><br>

						</center>
					</div>
					     <hr>
														<form method="post">
				  
								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg text-white">Sports Widget Type:
									  </label>  

									  <select class="form-control type" id="type" name="type">
										  <option data-value="op0" value="0" <?=$rowU['type']=='0'?'selected':'' ?>>Default Dashboard Widget										  </option>
										  <option data-value="op1" value="1" <?=$rowU['type']=='1'?'selected':'' ?>>Enter External URL Widget
										  </option>
										  <option data-value="op2" value="2" <?=$rowU['type']=='2'?'selected':'' ?>>Enter External JS Widget
										  </option>
									  </select>
									</div>
								</div>
								<div class="activeu">		  
								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg text-white">Sports URL</label>
									  <input type="text" class="form-control text-primary" style="text-align:center;"
									  name="url" value="<?=$new_url?>" placeholder="Enter Sports URL">
									</div>
								</div>
								</div>
								<div class="activej">		  
								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg text-white">Sports Widget JS</label>
									  
									  <textarea  rows="6" id="urls" name="urljs"  class="form-control text-primary" style="text-align:center;"><?php echo $new_js;?></textarea>
									</div>
								</div>
								</div>
								
								<div class="actived">
								    

								
								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg text-white">Border</label>
										<input class="form-control" name="border_c" value="<?=$rowU['border_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg text-white">Background Color</label>
										<input class="form-control" name="background_c" value="<?=$rowU['background_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg text-white">Text Color</label>
										<input class="form-control" name="text_c" value="<?=$rowU['text_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg text-white">Days</label>
									  <select class="form-control" id="select" name="days">
										  <option value="1" <?=$rowU['days']=='1'?'selected':'' ?>>1</option>
										  <option value="3" <?=$rowU['days']=='3'?'selected':'' ?>>3</option>
										  <option value="7" <?=$rowU['days']=='7'?'selected':'' ?>>7</option>
									  </select>
									</div>
								</div>
				  
								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg text-white">Auto Scroll</label>
									  <select class="form-control" id="select" name="auto_s">
										  <option value="0" <?=$rowU['auto_s']=='0'?'selected':'' ?>>No</option>
										  <option value="1" <?=$rowU['auto_s']=='1'?'selected':'' ?>>Yes</option>
									  </select>
									</div>
								</div>
								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg text-white">Header Name</label>
										<input class="form-control" name="header_n" value="<?=$rowU['header_n']?>" type="text"/>
									</div>
								</div>

								
</div>
								<hr>

								<div class="form-group">
									<center>
									<br><button class="btn btn-info" name="submit" type="submit">
											<i class="icon icon-check"></i> Update Status
										</button><br><br>
									</center>
								</div>
							</form>	 
						</div>

				<br>
		</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
//select activecode form
//var response = {};
//response.val = "op2";
//$("#codemode option[data-value='" + response.val +"']").attr("selected","selected");

//hide activecode form
//$('.actived').show(); 
//$('.activeu').hide(); 
//$('.activej').hide(); 


//Show/hide activecode select
$(document).ready(function(){
  $('.type').change(function(){
    if($('.type').val() == '2') {
      $('.activej').show(); 
      $('.activeu').hide(); 
      $('.actived').hide(); 
    }
    if($('.type').val() == '1') {
      $('.activej').hide(); 
      $('.activeu').show(); 
      $('.actived').hide(); 
    }
    if($('.type').val() == '0') {
      $('.activej').hide(); 
      $('.activeu').hide(); 
      $('.actived').show(); 
     //document.getElementById("activeu").value = ' ';
     //document.getElementById("activej").value = ' ';
    } 
  });
  $('.type').ready(function(){
    if($('.type').val() == '2') {
      $('.activeu').hide(); 
      $('.actived').hide(); 
      $('.activej').show(); 
    }
    if($('.type').val() == '1') {
      $('.activej').hide(); 
      $('.activeu').show(); 
      $('.actived').hide(); 
    }
    if($('.type').val() == '0') {
      $('.activej').hide(); 
      $('.activeu').hide(); 
      $('.actived').show(); 
    // document.getElementById("actived").value = ' ';
      
    } 
  });
});
</script>
<style>

.bg-primary {
    background-color: #2e2e4c!important;
}

body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    background-color: #fff;
}

</style>		



<style>

.col-md-6 {
    flex: 1 0 50%;
    max-width: 100%;
}


.sidebar-dark .nav-item.active .nav-link {
    color: #778294;
}

.sidebar-dark .nav-item.active .nav-link i {
    color: #77776f;
}

.flex-container {
    display: flex;
    flex-direction: row-reverse;
}

.flex-child {
    flex: 1;
    border: 2px solid yellow;
}  

.flex-child:first-child {
    margin-right: 20px;
} 

</style>

<style>
    z {
  text-transform: uppercase;
  letter-spacing: 0.5em;
  display: inline-block;


  padding: 1.5em 0em;
  position: absolute;
  top: -1%;

  width: 40em;
  margin: 0 0 0 -20em;
}
z span {
  font: 700 2.5em/1 "Oswald", sans-serif;
  letter-spacing: 0;
  padding: 0.25em 0 0.325em;
  display: block;
  margin: 0 auto;
  text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
  /* Clip Background Image */
  background: url(img/animated-text-fill.png) repeat-y;
  -webkit-background-clip: text;
  background-clip: text;
  /* Animate Background Image */
  -webkit-text-fill-color: transparent;
  -webkit-animation: aitf 80s linear infinite;
  /* Activate hardware acceleration for smoother animations */
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-backface-visibility: hidden;
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
    margin-left: -145px;
    margin-top: -45px;
}

.card-body2 {
    flex: 1 1 auto;
    min-height: 1px;
    border: 1px solid #838594;
    padding: 1.25rem;
    background-color: #252b3b;
    border-radius: 1.35rem;
    margin-top: auto;
}
</style>





</body>
</html>