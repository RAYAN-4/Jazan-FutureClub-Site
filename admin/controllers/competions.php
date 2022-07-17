<?php



$table = "published_competions";

//$posts = selectAll($table);


    if (isset($_POST['add_comp'])) {
        global $errors;
        $checkArrays = [
            'comp_title' => 'Competion Title' , 
            'comp_content' => 'Competion Content' ,
              'comp_status' => 'Competion Status',
              'comp_location' => 'Competion Location',
              'comp_date' => 'Competion Date',
              'comp_publishers' => 'Competion Publishers',
            ];
      // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
       $errors = validatePost($_POST , $checkArrays , $table , 'comp_title' );
      $statusPost = $_POST['comp_status'];
   $allowdValues = array('draft' , 'published');
       if ( !in_array($statusPost , $allowdValues)  ) {
       array_push($errors , "Only Publish Or Draft Are Allowed");
       }
    

    if (!empty($_FILES['comp_image']['name'])) {
   
      $uploadFile_type = $_FILES['comp_image']['type'];
      $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }

      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['comp_image']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['comp_image']['tmp_name'], $destination);
      }

        if ($result) {
           $_POST['comp_image'] = $image_name;
        } 
        // else {
        //     array_push($errors, "Failed to upload image");
        // }
    }  else {
        unset($_POST['comp_image']);
    }
    if (count($errors) == 0) {
        global $conn;
        unset($_POST['add_comp']);
        //unset($_POST['post_status']);
       
        $_POST['comp_author'] = $_SESSION['username'];
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['comp_title'] = htmlentities($_POST['comp_title']);
        $_POST['comp_content'] = htmlentities($_POST['comp_content']);
       
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
                  'img_rel_type' => 'competion',
                  'img_rel_id' => $post_id  
                );
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }


        $_SESSION['message'] = "Competion created successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/competion.php?competions&page=1"); 
        exit();    
    } else {
      header("location: " . BASE_URL . "/admin/index.php"); 
    }


    }



   if (isset($_POST['edit_comp'])) {
   
    global $errors;
    $checkArrays = [
        'comp_title' => 'Competion Title' , 
        'comp_content' => 'Competion Content' ,
          'comp_status' => 'Competion Status',
          'comp_location' => 'Competion Location',
          'comp_date' => 'Competion Date',
          'comp_publishers' => 'Competion Publishers',
        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , 'comp_title' );
  $statusPost = $_POST['comp_status'];
  
$allowdValues = array('draft' , 'published');
   if ( !in_array($statusPost , $allowdValues)  ) {
   array_push($errors , "Only Publish Or Draft Are Allowed");
   }
   
   if (!empty($_FILES['comp_image']['name'])) {
    $uploadFile_type = $_FILES['comp_image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png');
    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['comp_image']['name'];
   
      $destination = ROOT_PATH . "/assets/images/" . $image_name;
       
      $result = move_uploaded_file($_FILES['comp_image']['tmp_name'], $destination);
    }
     
    if ($result) {
      //  delete('/assets/images/' . $_POST['prev_image'] );
       $_POST['comp_image'] = $image_name;
    } 
    // else {
    //     array_push($errors, "Failed to upload image");
    // }
}  else {
    unset($_POST['comp_image']);
}
 

 if (count($errors) == 0) {
  
    global $conn;
     // unset($_POST['prev_image']);
    $compId = $_POST['comp_id']; 
    
    $compId = is_numeric($compId) ? intval($compId) : 0 ; 
  
    if ($compId > 0) {
        unset($_POST['edit_comp']);
       
       
      
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['comp_title'] = htmlentities($_POST['comp_title']);
        $_POST['comp_content'] = htmlentities($_POST['comp_content']);
        
        $post_id = update($table, $compId , $_POST , 'comp_id');

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
                  'img_rel_type' => 'competion',
                  'img_rel_id' => $compId  
                );
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }


       
        $_SESSION['message'] = "Competion updated successfully";
        $_SESSION['type'] = "success";
        // header("location: " . BASE_URL . "/admin/index.php"); 
        // exit(); 
    } else {
        $_SESSION['message'] = "Failed To Updated The Event";
        $_SESSION['type'] = "failed";
        // header("location: " . BASE_URL . "/admin/index.php"); 
        // exit(); 
    }
   
} else {
  // header("location: " . BASE_URL . "/admin/index.php"); 
}



   }
