<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 10px 20px;
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

p span {
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
    margin-left: -118px;
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

<div class="container-fluid">

    <!-- Custom codes -->
    
    
    <div class="card-body">
						<center>
						    <br>
						     <img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100">
						    <br>
													<a><p><span> 𝑾𝒂𝒍𝒍𝒑𝒂𝒑𝒑𝒆𝒓</span></p></a>
						</center>
<br><br><br><br>					</div>

<br>
   

        <div class="card-body">
           <?php
						
						$jsonFilex = './a/rtx/image_filenames.json';
        
                        // Read the JSON file contents
                         $jsonDatax = file_get_contents($jsonFilex);
                            
                        // Decode the JSON data
                        $imageDatax = json_decode($jsonDatax, true);
                            
                        // Extract the filename
                        $filenamex = $imageDatax[0]['ImageName'];
                            
                        $imageFilex = "./rtx/Img/" . "$filenamex";
						
						echo '<a><z><span> 𝑪𝒖𝒓𝒓𝒆𝒏𝒕𝒍𝒚 𝒊𝒏 𝒖𝒔𝒆:</span></z></a><br>';
                        echo '<img class="preview-image" src="' . $imageFilex . '" alt="Uploaded Image" width="600" height="300">';
                        
                        
                        if (isset($_POST['upload'])) {
                            // Handle the uploaded file
                            // Check if the form was submitted
                        
                                $selectedFiles = ['logo.png', 'index.php', 'iimg.json', 'filenames.json', 'binding_dark.webp', 'bg.jpg', 'api.php', 'favicon.ico', 'logo_ne.png' , '.htaccess']; // Example array of selected files
                                $folderPath = './rtx/Img/'; // Replace with the actual folder path
                                
                                $files = scandir($folderPath);
                                
                                foreach ($files as $file) {
                                    if ($file !== '.' && $file !== '..') {
                                        $filePath = $folderPath . $file;
                                
                                        // Check if the file is selected
                                        if (in_array($file, $selectedFiles)) {
                                            // File is selected, do nothing
                                        } else {
                                            // Delete the file
                                            unlink($filePath);
                                        }
                                    }
                                }
                                
                            if (isset($_FILES['image'])) {
                                $file = $_FILES['image'];
                                $fileType = $file['type'];
                                $fileTemp = $file['tmp_name'];
                        
                                // Validate the file type
                                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                if (in_array($fileType, $allowedTypes)) {
                                    // Define the path to store the uploaded image
                                    $uploadPath = './rtx/Img/';
                                    $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $destination = $uploadPath . $fileName;
                        
                                    // Move the uploaded file to the destination
                                    if (move_uploaded_file($fileTemp, $destination)) {
                                        echo "<script>window.location.href='mRTXBGImage.php';</script>";
                                        
                                        $jsonFilePath = './a/rtx/image_filenames.json';
                                        $jsonData = json_encode([["ImageName" => $fileName]]);
                                        file_put_contents($jsonFilePath, $jsonData);
                                    } else {
                                        echo 'Failed to move the uploaded file.';
                                    }
                                } else {
                                    echo 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.';
                                }
                            }
                        }
                        ?>
                        
                        <form method="post" enctype="multipart/form-data">
                            <br>
                            <div class="form-group ">
                            <label class="control-label"> <strong> Upload Background Image File</strong></label>
                            <br><br>
						      <div class="input-group">
						      	<div class="custom-file">
					        	<input type="file" class="custom-file-input" name="image" id="intro" placeholder="Choose Intro" onchange="uploadintro(this)" aria-describedby="intro">
			<label class="custom-file-label" for="intro" placeholder="Choose Background Image"><span id="image-intro"></span></label>
				          	   </div>
			                </div>
		        	     </div>
                            <br>
                            <button class="custom-button btn btn-success btn-icon-split" type="submit" name="upload">Upload</button>
                        </form>

        </div>
</div>

<?php
include "includes/footer.php";
?>
</body>

</html>
