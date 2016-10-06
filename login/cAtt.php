<?php
$fnama = $_FILES['sAtt']["name"];//nama ini masuk kedatabase
$target_dir = "upload/";
$target_file = $target_dir.$fnama;
$nama = $noid;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$target_file = $target_dir .$nama.".$imageFileType";  //diubah ke nama idteks
//saveAtt($nama, $fnama); //simpan ke database

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["sAtt"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("$target_file");
    $uploadOk = 1;
}
// Check file size
if ($_FILES["sAtt"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" && $imageFileType != "xls" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "zip" && $imageFileType != "rar" && $imageFileType != "pdf"  && $imageFileType != "jpg"  && $imageFileType != "png"  && $imageFileType != "jpeg") {
    echo "Sorry, only ZIP, RAR, & PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["sAtt"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["sAtt"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

sleep(3);
?> 

