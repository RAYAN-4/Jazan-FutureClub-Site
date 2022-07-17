<?php



$table = "published_posts";

//$posts = selectAll($table);


    if (isset($_POST['add_post'])) {
        global $errors;
        $checkArrays = [
            'title_post' => 'Post Title' , 
            'body_post' => 'Post Body' ,
              'status_post' => 'Post Status'
            ];
      // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
       $errors = validatePost($_POST , $checkArrays , "published_posts" , 'title_post' );
      $statusPost = $_POST['status_post'];
   $allowdValues = array('draft' , 'published');
       if ( !in_array($statusPost , $allowdValues)  ) {
       array_push($errors , "Only Publish Or Draft Are Allowed");
       }
    

    if (!empty($_FILES['image_post']['name'])) {
       
      $uploadFile_type = $_FILES['image_post']['type'];
    
      $allowedTypes = array('image/gif','image/jpg','image/png' , "image/jpeg");
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }
  
      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['image_post']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['image_post']['tmp_name'], $destination);
      }

      
        if ($result) {
           $_POST['image_post'] = $image_name;
        } 
        // else {
        //     array_push($errors, "Failed to upload image");
        // }
    }  else {
        unset($_POST['image_post']);
    }
   
 ;
  
    
    if (count($errors) == 0) {
        global $conn;
        unset($_POST['add_post']);
        //unset($_POST['post_status']);
       
        $_POST['author_post'] = $_SESSION['username'];
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['title_post'] = htmlentities($_POST['title_post']);
        $_POST['body_post'] = htmlentities($_POST['body_post']);
        
        $post_id = create($table, $_POST);
        if (!empty($_FILES['files'] )  ) {
          extract($_POST);
          $extension=array("jpeg","jpg","png","gif");
          foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
              $file_name=$_FILES["files"]["name"][$key];
              $file_tmp=$_FILES["files"]["tmp_name"][$key];
              $ext=pathinfo($file_name,PATHINFO_EXTENSION);
          
              if(in_array($ext,$extension)) {
               
                $image_name = time() . '_' . $_FILES['files']['name'][$key];
         
                $destination = ROOT_PATH . "/assets/images/" . $image_name;
                 
                $result = move_uploaded_file($_FILES['files']['tmp_name'][$key], $destination);
                $publishedArray = array(
                  'img_link' => $image_name,
                  'img_rel_type' => 'post',
                  'img_rel_id' => $post_id  
                );
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }

        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts.php?posts&page=1"); 
        exit();    
    } else {
     header("location: " . BASE_URL . "/admin/index.php"); 
    }


    }



   if (isset($_POST['edit_post'])) {

    global $errors;
 
    $checkArrays = [
        'title_post' => 'Post Title' , 
        'body_post' => 'Post Body' ,
          'status_post' => 'Post Status'
        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , "published_posts" , 'title_post' );

  $statusPost = $_POST['status_post'];
  
$allowdValues = array('draft' , 'published');
   if ( !in_array($statusPost , $allowdValues)  ) {
   array_push($errors , "Only Publish Or Draft Are Allowed");
   }

   if (!empty($_FILES['image_post']['name'])) {
     $uploadFile_type = $_FILES['image_post']['type'];
    
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
      //  delete('/assets/images/' . $_POST['prev_image'] );
       $_POST['image_post'] = $image_name;
    } 
    // else {
    //     array_push($errors, "Failed to upload image");
    // }
}  else {
    unset($_POST['image_post']);
}
 

 if (count($errors) == 0) {
    global $conn;
      unset($_POST['prev_image']);
    $postId = $_POST['id_post']; 
    $postId = is_numeric($postId) ? intval($postId) : 0 ; 
    if ($postId > 0) {
        unset($_POST['edit_post']);
      
       
      
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['title_post'] = htmlentities($_POST['title_post']);
        $_POST['body_post'] = htmlentities($_POST['body_post']);
        
        $post_id = update($table, $postId , $_POST , 'id_post');

        if (!empty($_FILES['files'] )  ) {
          extract($_POST);
          $extension=array("jpeg","jpg","png","gif");
          foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
              $file_name=$_FILES["files"]["name"][$key];
              $file_tmp=$_FILES["files"]["tmp_name"][$key];
              $ext=pathinfo($file_name,PATHINFO_EXTENSION);
          
              if(in_array($ext,$extension)) {
               
                $image_name = time() . '_' . $_FILES['files']['name'][$key];
         
                $destination = ROOT_PATH . "/assets/images/" . $image_name;
                 
                $result = move_uploaded_file($_FILES['files']['tmp_name'][$key], $destination);
                $publishedArray = array(
                  'img_link' => $image_name,
                  'img_rel_type' => 'post',
                  'img_rel_id' => $postId  
                );
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }
      
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
