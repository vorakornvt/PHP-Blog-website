<?php 
require "./templates/header.php";

// B. Declare general variables initial states 
$directory = "uploads";
$uploadOk = 1;
$uploadMessage = "";
$uploadMessageError = "";

// F. Set PHP upload errors using superglobal error array within $_FILES
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
); 

// C. Save upload data to variables (using $_FILES superglobal)
if(isset($_POST['submit'])){
    // (1) Name of the uploaded file
    $fileName = $_FILES['fileToUpload']['name'];
    // (2) File name of the temporary copy of the file stored on the server
    $fileTempName = $_FILES['fileToUpload']['tmp_name'];
    // (3) Name of file type extension (converted to lower case for better handling) & BONUS - cleaner search method
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedFiles = array('jpg', 'jpeg', 'png', 'gif');
    // (4) Size of the file uploaded & our cap on file sizes
    $fileSize = $_FILES['fileToUpload']['size'];
    $maxSize = 1024 * 1024 * 2; // 2MB
    // (5) Stores our URL path to the uploaded image on the server
    $fileDownloadUrl = $directory . DIRECTORY_SEPARATOR . $fileName;

    // F.(2) Set additional error handler to pick up the PHP error number & pass back the custom message corresponding to the number
    $the_error = $_FILES['fileToUpload']['error'];
    if($the_error){
        $uploadMessageError = $phpFileUploadErrors[$the_error];
        $uploadOk = 0;
    }
  
    // D. Set custom error handlers
    // (1) File Already Exists
    if($uploadMessageError == "" && file_exists($fileDownloadUrl)){
        $uploadMessageError = "The file already exists.";
        $uploadOk = 0;
    }

    // (2) Incorrect File Extension
    if($uploadMessageError == "" && !in_array($fileExt, $allowedFiles)){
        $uploadMessageError = "File type is not allowed, please choose a jpg, png, jpeg, or gif file.";
        $uploadOk = 0;
    }

    // (3) Max File Size
    if($uploadMessageError == "" && $fileSize > $maxSize ){
        $uploadMessageError = "File is too large.";
        $uploadOk = 0;
    }

    // E. Set our main error capture & successful upload case 
    if($uploadOk == 0) {
        // (a) ERROR STATE
        $uploadMessage = "<p>Sorry, your file was not uploaded.</p>" . "<strong>Error: </strong>" . $uploadMessageError;
    } else {
        // (b) SUCCESS STATE: If all ok (remains value of 1) - try to upload file to permanent location
        if(move_uploaded_file($fileTempName, $directory . "/" . $fileName)){
            $uploadMessage = "<p>File Uploaded Successfully. " . 'Preview it: <a href="' . $fileDownloadUrl . '" target="_blank">' . $fileDownloadUrl . '</a></p>';
        }
    }
}
?>

<main class="container p-4 mt-3">
  <div>
    <div class="container mt-5">
      <div class="text-center mb-4">
        <h2 class="display-3 mb-2">
       Amplify Art
          <img src="./img/Asset5.png" alt="ArtifyLOGO" width="130">
        </h2>
        <p class="lead">Select Artwork to upload:</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-8">
          <!-- A. File Upload Form: START -->
          <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">     
              <!-- File Input -->
              <input type="file" class="form-control" id="inputGroupFile" name="fileToUpload">
              <!-- Submit Button -->
              <input type="submit" value="Upload" name="submit" class="btn btn-dark input-group-text"></input>
            </div>
          </form>
          <!-- File Upload Form: END -->

          <!-- Alert Message -->
          <?php 
            // F. Create Feedback to user in event of nothing, error or success
            if($uploadMessage == ""){
              echo null;
            } else if($uploadOk == 0){
              echo '<div class="alert text-center  alert-danger" role="alert">' . $uploadMessage . '</div>';
            } else {
              echo '<div class="alert text-center alert-secondary" role="alert">' . $uploadMessage . '</div>';
            }
          ?>
        </div>
      </div>
    </div>  


    
      </div>
    </div>
  </div>
</main>

<?php
require "./templates/footer.php";
?>
