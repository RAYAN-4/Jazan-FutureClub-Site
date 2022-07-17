<?php



$table = "published_questions";

//$posts = selectAll($table);


    if (isset($_POST['add_question'])) {
        global $errors;
        $checkArrays = [
            'ques_name' => 'Question Name' , 
            'ques_desc' => 'Question Describtion' ,
              'ques_points' => 'Question Points',
              'ques_rel_comp' => 'Question Related Competion',
            ];
      // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
       $errors = validatePost($_POST , $checkArrays , "published_questions" , 'ques_name' );
      $questionRelComp = $_POST['ques_rel_comp'];
   //$allowdValues = array('draft' , 'published');
   $questionRelComp = is_numeric($questionRelComp) ? intval($questionRelComp) : array_push($errors , "Not Valid Related Competion") ; 
    //    if ( !in_array($statusPost , $allowdValues)  ) {
    //    array_push($errors , "Only Publish Or Draft Are Allowed");
    //    }
    

    if (!empty($_FILES['ques_image']['name'])) {
      $uploadFile_type = $_FILES['ques_image']['type'];
      $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }
  
      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['ques_image']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['ques_image']['tmp_name'], $destination);
      }

        if ($result) {
           $_POST['ques_image'] = $image_name;
        } 
        // else {
        //     array_push($errors, "Failed to upload image");
        // }
    }  else {
        unset($_POST['ques_image']);
    }
 
    if (count($errors) == 0) {
        global $conn;
        unset($_POST['add_question']);
        //unset($_POST['post_status']);
       
    //     $_POST['author_post'] = $_SESSION['username'];
    //    $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
         $_POST['ques_name'] = htmlentities($_POST['ques_name']);
        $_POST['ques_desc'] = htmlentities($_POST['ques_desc']);
  
        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";
       header("location: " . BASE_URL . "/admin/questions.php?questions&page=1"); 
       exit();    
    } else {
     header("location: " . BASE_URL . "/admin/index.php"); 
    }


    }



   if (isset($_POST['edit_question'])) {

    global $errors;
    $checkArrays = [
      'ques_name' => 'Question Name' , 
      'ques_desc' => 'Question Describtion' ,
        'ques_points' => 'Question Points',
        'ques_rel_comp' => 'Question Related Competion',
      ];
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
 $errors = validatePost($_POST , $checkArrays , "published_questions" , 'ques_name' );
 $questionRelComp = $_POST['ques_rel_comp'];
 //$allowdValues = array('draft' , 'published');
 $questionRelComp = is_numeric($questionRelComp) ? intval($questionRelComp) : array_push($errors , "Not Valid Related Competion") ; 

   if (!empty($_FILES['ques_image']['name'])) {
  
    $uploadFile_type = $_FILES['ques_image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');
    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['ques_image']['name'];
   
      $destination = ROOT_PATH . "/assets/images/" . $image_name;
       
      $result = move_uploaded_file($_FILES['ques_image']['tmp_name'], $destination);
    }
     
    if ($result) {
      //  delete('/assets/images/' . $_POST['prev_image'] );
       $_POST['ques_image'] = $image_name;
    } 
    // else {
    //     array_push($errors, "Failed to upload image");
    // }
}  else {
    unset($_POST['ques_image']);
}


 if (count($errors) == 0) {
    global $conn;
     // unset($_POST['prev_image']);
    $postId = $_POST['ques_id']; 
 
    $postId = is_numeric($postId) ? intval($postId) : 0 ; 
  
    if ($postId > 0) {
    
        unset($_POST['edit_question']);
      
       
      
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['ques_name'] = htmlentities($_POST['ques_name']);
        $_POST['ques_desc'] = htmlentities($_POST['ques_desc']);
 
        $post_id = update($table, $postId , $_POST , 'ques_id');
      
        $_SESSION['message'] = "Post updated successfully";
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
