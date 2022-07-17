<?php



$table = "joinedusers";

//$posts = selectAll($table);


    if (isset($_POST['add_user'])) {
        global $errors;
        $checkArrays = [
            'user_name' => 'User Name' , 
            'user_email' => 'User Email' ,
              'user_password' => 'User Password',
              'user_status' => 'User Status',
              'user_group_id' => 'User Role'
            ];
      // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
       $errors = validatePost($_POST , $checkArrays , $table , 'user_email' );
      
      $userStatus = $_POST['user_status'];
   $allowdValues = array('allowed', 'notallowed');
       if ( !in_array($userStatus , $allowdValues)  ) {
       array_push($errors , "Only Allowed Or Not Allowed Are Allowed");
       }

      $userRole = $_POST['user_group_id'];
   $allowdValues = array('user' , 'admin');
       if ( !in_array($userRole , $allowdValues)  ) {
       array_push($errors , "Only User Or Admin Are Allowed");
       }
    

    if (!empty($_FILES['user_image']['name'])) {
      $allowedTypes = array('image/gif','image/jpg','image/png');
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }
  
      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['image_post']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['image_post']['tmp_name'], $destination);
      }

        if ($result) {
           $_POST['user_image'] = $image_name;
        }
        //  else {
        //     array_push($errors, "Failed to upload image");
        // }
    }  else {
        unset($_POST['user_image']);
    }
    if (count($errors) == 0) {
        global $conn;
        unset($_POST['add_user']);
        if ($userStatus == 'allowed') {
        $userStatus = 1;
        }
        if ($userStatus == 'notallowed') {
        $userStatus = 0;
        }
        if ($userRole == 'user') {
        $userStatus = 0;
        }
        if ($userRole == 'admin') {
        $userStatus = 1;
        }

        $_POST['user_password'] = sha1($_POST['user_password']);
        //unset($_POST['post_status']);
       
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        // $_POST['title_post'] = htmlentities($_POST['title_post']);
        // $_POST['body_post'] = htmlentities($_POST['body_post']);
       
        $post_id = create($table, $_POST);
        $_SESSION['message'] = "User created successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/users.php?users&page=1"); 
        exit();    
    } else {
     header("location: " . BASE_URL . "/admin/index.php"); 
    }


    }



   if (isset($_POST['edit_user'])) {

    global $errors;
    $checkArrays = [
        'user_name' => 'User Name' , 
        'user_email' => 'User Email' ,
          'user_password' => 'User Password',
          'user_status' => 'User Status',
          'user_group_id' => 'User Role'
        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , 'user_email' );
 
        
  $userStatus = $_POST['user_status'];
  $allowdValues = array('allowed', 'notallowed');
      if ( !in_array($userStatus , $allowdValues)  ) {
      array_push($errors , "Only Allowed Or Not Allowed Are Allowed");
      }

     $userRole = $_POST['user_group_id'];
  $allowdValues = array('user' , 'admin');
      if ( !in_array($userRole , $allowdValues)  ) {
      array_push($errors , "Only User Or Admin Are Allowed");
      }

   if (!empty($_FILES['user_image']['name'])) {
    $uploadFile_type = $_FILES['user_image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');
    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['user_image']['name'];
   
      $destination = ROOT_PATH . "/assets/images/" . $image_name;
       
      $result = move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
    }
     
    if ($result) {
      //  delete('/assets/images/' . $_POST['prev_image'] );
       $_POST['user_image'] = $image_name;
    } 
    // else {
    //     array_push($errors, "Failed to upload image");
    // }
}  else {
    unset($_POST['user_image']);
}
 

 if (count($errors) == 0) {
    global $conn;
      //unset($_POST['prev_image']);
    $postId = $_POST['id']; 
    $postId = is_numeric($postId) ? intval($postId) : 0 ; 
    if ($postId > 0) {
      unset($_POST['id']);
        unset($_POST['edit_user']);
      
        if ($userStatus == 'allowed') {
          $_POST['user_status'] = 1;
          }
          if ($userStatus == 'notallowed') {
            $_POST['user_status'] = 0;
          }
          if ($userRole == 'user') {
            $_POST['user_group_id'] = 0;
          }
          if ($userRole == 'admin') {
          $_POST['user_group_id'] = 1;
          }
      
          $_POST['user_password'] = sha1($_POST['user_password']);
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        // $_POST['title_post'] = htmlentities($_POST['title_post']);
        // $_POST['body_post'] = htmlentities($_POST['body_post']);

        $post_id = update($table, $postId , $_POST , 'user_id'  );
       
      
        $_SESSION['message'] = "User updated successfully";
        $_SESSION['type'] = "success";
        // header("location: " . BASE_URL . "/admin/index.php"); 
        // exit(); 
    } else {
        $_SESSION['message'] = "Failed To Updated The Post";
        $_SESSION['type'] = "failed";
        // header("location: " . BASE_URL . "/admin/index.php"); 
        // exit(); 
    }
   
} else {
  // header("location: " . BASE_URL . "/admin/index.php"); 
}



   }
