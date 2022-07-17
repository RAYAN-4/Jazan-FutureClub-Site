<?php  

function updateUserImage($fileInput , $tablename , $updatedCol , $pathDir , $whereCol) {
    if (isset($_FILES[$fileInput]) &&  $_FILES[$fileInput]['name'] != '' ) {
      $email = $_SESSION['userLoggedIn'];
      // /users/profile_pic
      $dir = $pathDir;
      $fileName = $_FILES["$fileInput"]['name'];
      $fileSize = $_FILES["$fileInput"]['size'];
      $fileTmpName = $_FILES["$fileInput"]['tmp_name'];
      // allowed exestion
      $allowed = ['png' , 'jpg' ,'jpeg' ,'gif'];
      // checking if supported extesnion
      $fileExist = explode('.' , $fileName);
      $fileActualExt = strtolower(end($fileExist));
    
          // IMAGE NAME -> UNIEQ ID FOR EACH IMAGE
          $newImage = uniqid('progHSDub' , true) . "." . "$fileActualExt";
          $target = $dir . basename($newImage);
          // IF MOVING IMAGE HAPPEND SUCCESFULLY
          if (move_uploaded_file($fileTmpName , $target)) {
              $query = mysqli_query($connection , "UPDATE $tablename SET $updatedCol =  '$target' WHERE $whereCol = '$email'");
              if ($query) {
            //      header("Location: profile.php");
              }
          }
      
} 
  }

  

function uploadPostImage($fileInput , $pathDir) {
    $post_image = $_FILES["$fileInput"]['name'];

    if (isset($_FILES["$fileInput"]) &&  $post_image !== '' ) {
      // "./images/";
      $dir = "$pathDir";
      $fileName = $_FILES["$fileInput"]['name'];
      $fileSize = $_FILES["$fileInput"]['size'];
      $fileTmpName = $_FILES["$fileInput"]['tmp_name'];
      // allowed exestion
      $allowed = ['png' , 'jpg' ,'jpeg' ,'gif'];
      // checking if supported extesnion
      $fileExist = explode('.' , $fileName);
      $fileActualExt = strtolower(end($fileExist));
      // CHECK IF IMAGE EXTESION IS ALLOWED
      if (!in_array($fileActualExt , $allowed)) {
          echo '<script> alert("File type is not allowed") </script>';
      }
      // CECKING FILE SIZE
      else if ($fileSize > 10000000) {
       echo '<script> alert("File is too large") </script>';
      } else {
          // IMAGE NAME -> UNIEQ ID FOR EACH IMAGE
          $newImage = uniqid('progHub' , true) . "." . "$fileActualExt";
          $target = $dir . basename($newImage);
          // IF MOVING IMAGE HAPPEND SUCCESFULLY
          if (move_uploaded_file($fileTmpName , $target)) {
              $image = $target;
          }
      }

      return $image;
}
  }
