<?php

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('mp3','mp4', 'png', 'jpg', 'jpeg', 'html', 'css', 'js', 'pdf', 'go', 'php', 'mysql');
    
    if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 9999999999999999) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: https://sharevideos.ga/uploads/".$fileNameNew);
            } else {
                echo "your file is too big";
            }
        }else {
            echo "there was an error uploading the file";
        }
    }else {
        echo "you cant upload files of this type";
    }
}
?>
