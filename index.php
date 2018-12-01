 <?php 
include "inc/dbconfig.php" ;
?>
<html>
    <head>
<title>Upload Script</title>


    <?php

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $target_dir = "uploads/";
    $newfilename= $target_dir . date('dmYHis').str_replace(" ", "",  basename($_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($newfilename)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Max file size is 5mb";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "mp4") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
        

            $update = date("Y-m-d H:i:s");
        $insert = mysqli_query($connect, "INSERT INTO `images` (imagepath, title, description,  datetime, category) VALUES ('$newfilename', '$title', '$description', '$update', '$category')");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}}
?>
                    
    <form action="" method="post" enctype="multipart/form-data">
    <i class="fas fa-pencil-alt"></i>   <input type="test" name="title" placeholder="Title" required><BR>
        <i class="fas fa-edit"></i>  <input type="test" name="description" placeholder="Description" required><BR>
<i class="fas fa-list-alt"></i>  <select name="category" required>
    <option value="Amateur">Amateur</option> 
</select> <BR>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><BR><BR>
    <input type="submit" value="Upload Image" name="submit">
</form><BR>
               
            <BR>
<i class="fas fa-exclamation-triangle"></i>  You must own the copyright for the content you upload

    </body>
</html>
<?php exit; ?>