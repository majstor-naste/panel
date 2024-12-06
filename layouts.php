<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 10px 20px;
  }
  

  
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
    margin-left: -75px;
}
</style>
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- Custom codes -->

  <style>
.image-row {
    display: flex;
    justify-content: space-evenly;
    margin-bottom: 60px;
    flex-wrap: wrap;
}
    
    .image-container {
      margin: 0 10px;
      max-width: 100%;
      height: auto;
    }
    .horizontal-space {
      margin-right: 20px;
    }
    label, select, input {
            margin-left: 10px;
        }

.container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    text-align: center;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    margin-top: 10px;
    text-align: center;
    word-wrap: break-word;
    background-color: #252b3b;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
    border-radius: 1.35rem;
}

.card-header {
    margin-bottom: 0;
    background-color: #252b3b;
    border: 1px solid #838594;
    border-radius: 1.35rem;
    margin-left: -8px;
    margin-right: -6px;
    margin-top: 21px;
}

.col-md-8 {
    display: unset;
    flex-wrap: wrap;
    align-content: center;
    flex-direction: row;
    justify-content: center;
}

.text-primary {
    color: #ecedf2 !important;
}



.card border-left-primary col-sm-4 {
    flex: 0 0 50%;
    max-width: 50%;
    margin-top: 30px;
}
.row {
    display: flex;
    margin-right: -0.75rem;
    margin-left: -0.75rem;
    margin-top: -16px;
}

.card-header:first-child {
    border-radius: calc(1.35rem - 1px) calc(1.35rem - 1px) 0 0;
    margin-left: 3px;
    margin-right: 3px;
    margin-bottom: -9px;
}


form {
    display: flex;
    justify-content: center;
    margin-top: 21px;
    margin-bottom: 21px;
}

body {
    margin: 0;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #858796;
    text-align: center;
    background-color: #1d222e;
}


#wrapper #content-wrapper {
    background-color: #1d222e;
    width: 100%;
    overflow-x: unset;
}
  </style>
  
  
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedOption = $_POST['options'];
        echo "Vilhao: " . $selectedOption;

        // Read existing JSON data from file
        $jsonData = file_get_contents('./a/rtx/Setting.json');
        $data = json_decode($jsonData, true);

        // Update first record in JSON data
        $data[0]["RTXSetting"] = "mLayout";
        $data[0]["PanalData"] = $selectedOption;

        // Encode the updated data back to JSON
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Write the updated JSON data to file
        file_put_contents('./a/rtx/Setting.json', $jsonData);
    }
    ?>
    
    
      <?php  
    
    ?>


                <div class="card-header py-3">
						<center>
						    <br>
						     <img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100">
						    <br><br> <br>
													<a><p>
  <span>

    𝑻𝒉𝒆𝒎𝒆𝒔
  </span>

</p></a>
						</center>

						</div>   
    
    
    
    

        	  <div class="col-md-8 mx-auto">
		 <div class="row">
						<div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Default</h4>
							  </div>
							 <br> <img class="card-img-bottom" src="https://i.imgur.com/WjUNKoS.png" alt="Card image" style="width:100%">
                    	<div class="col-md-8 mx-auto">
                 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <select hidden="hidden" name="options" width="300" id="options">
                        <option value="theme_d">Selected</option>
                        <!-- Add more options here if needed -->
                        </select>
                        <br>
                        <br>
                     <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
                  </form>
            </div>
</div>
						
						<div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Theme 1</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/8RbfXjU.png" alt="Card image" style="width:100%">
<div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="theme_1">theme_1</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
    </form>
</div>
</div>
						<div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Theme 2</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/s2pxDGO.png" alt="Card image" style="width:100%">
							  <div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="theme_2">theme_2</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
    </form>
</div>
</div>
						<div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Theme 3</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/ssByInN.png" alt="Card image" style="width:100%">
							  <div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="theme_3">theme_3</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
    </form>
</div>
</div>
						    <div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Theme 4</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/eKdDmE6.png" alt="Card image" style="width:100%">
							  <div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="theme_4">theme_4</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
    </form>
</div>
</div>

							<div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Theme 5</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/ZCaaz6z.png" alt="Card image" style="width:100%">
							  <div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="theme_5">theme_5</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
    </form>
</div>
</div>
												    <div class="card border-left-primary col-sm-4">
							  <div class="card-block">
								 <h4 class="card-header card-header-warning">Random</h4>
							  </div>
							  <br><img class="card-img-bottom" src="https://i.imgur.com/o1WtV5O.png" alt="Card image" style="width:100%">
							  <div class="col-md-8 mx-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select hidden="hidden" name="options" width="300" id="options">
            <option value="random">Random</option>
            <!-- Add more options here if needed -->
        </select>
        <br>
        <br>
        <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value=" Submit ">
        <br><br>
    </form>
</div>
</div>
					 </div>
				  </div>
			  </div>
		  </div>
	  </div>
</div>
</div>
</div>
<?php
include "includes/footer.php";
?>
</body>
</html>
