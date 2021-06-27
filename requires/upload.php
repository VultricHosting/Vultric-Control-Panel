<?php
   session_start();
   
   require_once "./requires/config.php";
   $str = "SELECT diskspace, diskused, diskrem FROM users WHERE id = '".$_SESSION['id']."'";
   $r = mysqli_query($link, $str);
   
   while($row = mysqli_fetch_array($r)) {
       $diskspace = $row['diskspace'];
       $diskused = $row['diskused'];
       $diskrem = $row['diskrem'];
   }
   
if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('mp3','mp4', 'png', 'jpg', 'jpeg', 'html', 'css', 'js', 'pdf', 'go', 'php', 'mysql', 'svg', 'txt', 'md');
    
    if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 1500000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
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

$sql = "";

if ($diskused == 0)
{
    $sql = "UPDATE users SET diskused='$fileSize' WHERE id = 1";
}elseif ($diskused > 0) 
{
  $disknow = $diskused + $fileSize;
  $sql = "UPDATE users SET diskused='$disknow' WHERE id = 1";
}

if ($link->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $link->error;
}

$link->close();
?>
