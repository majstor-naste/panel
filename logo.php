<?php
include "includes/header.php";
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
    margin-left: -55px;
    margin-top: -45px;
}
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
  
.card-body {
    min-height: 1px;
    border: 1px solid #838594;
    padding: 1.25rem;
    background-color: #252b3b;
    border-radius: 1.35rem;
    margin-left: 10px;
    margin-top: 10px;
    margin-right: 10px;
}
</style>




<div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
         
<div class="card-body">
		<center><br><img src="img/ibo1.png" alt="" height="100"><br><br> <a><p><span> 𝑳𝒐𝒈𝒐</span></p></a></center>
    </div>  







<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Custom codes -->
</div>
        <div class="card-body">
           <?php
						
						$jsonFilex = './a/rtx/logo_filenames.json';
        
                        // Read the JSON file contents
                         $jsonDatax = file_get_contents($jsonFilex);
                            
                        // Decode the JSON data
                        $imageDatax = json_decode($jsonDatax, true);
                            
                        // Extract the filename
                        $filenamex = $imageDatax[0]['ImageName'];
                            
                        $imageFilex = "./rtx/logo/" . "$filenamex";
						
						echo '<h3>Currently in use:</h3>';
                        echo '<img class="preview-image" src="' . $imageFilex . '" alt="Uploaded Image" width="600" height="300">';
                        
                        
                        if (isset($_POST['upload'])) {
                            // Handle the uploaded file
                            // Check if the form was submitted
                        
                                $selectedFiles = ['logo.png', 'index.php', 'iimg.json', 'filenames.json', 'binding_dark.webp', 'bg.jpg', 'api.php', 'favicon.ico', 'logo_ne.png' , '.htaccess']; // Example array of selected files
                                $folderPath = './rtx/logo/'; // Replace with the actual folder path
                                
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
                                    $uploadPath = './rtx/logo/';
                                    $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $destination = $uploadPath . $fileName;
                        
                                    // Move the uploaded file to the destination
                                    if (move_uploaded_file($fileTemp, $destination)) {
                                        echo "<script>window.location.href='mRTXBGlogo.php';</script>";
                                        
                                        $jsonFilePath = './a/rtx/logo_filenames.json';
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
                            <label for="image">Select an Image to upload:</label>
                            <hr>
                            <div class="input-group">
						      	<div class="custom-file">
					        	<input type="file" class="custom-file-input" name="image" id="intro" placeholder="Choose Intro" onchange="uploadintro(this)" aria-describedby="intro">
			<label class="custom-file-label" for="intro" placeholder="Choose Background Image"><span id="image-intro"></span></label>
				          	   </div>
			                </div>
                            <hr>
                            <button class="custom-button btn btn-success btn-icon-split" type="submit" name="upload">Upload</button>
                        </form>

        </div>
</div>
</div>
<?php

?>
</body>
</html>
