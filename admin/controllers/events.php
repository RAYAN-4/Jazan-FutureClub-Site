<?php



$table = "published_events";

//$posts = selectAll($table);


    if (isset($_POST['add_event'])) {
        global $errors;
        $checkArrays = [
            'event_title' => 'Event Title' , 
            'event_body' => 'Event Body' ,
              'event_status' => 'Event Status',
              'event_location' => 'Event Location',
              'event_date' => 'Event Date',
              'event_publishers' => 'Event Publishers',
            ];
      // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
       $errors = validatePost($_POST , $checkArrays , $table , 'event_title' );
      $statusPost = $_POST['event_status'];
   $allowdValues = array('draft' , 'published');
       if ( !in_array($statusPost , $allowdValues)  ) {
       array_push($errors , "Only Publish Or Draft Are Allowed");
       }
    

    if (!empty($_FILES['event_image']['name'])) {
      $uploadFile_type = $_FILES['event_image']['type'];
      $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }
  
      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['event_image']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['event_image']['tmp_name'], $destination);
      }

        if ($result) {
           $_POST['event_image'] = $image_name;
        }
        //  else {
        //     array_push($errors, "Failed to upload image");
        // }
    }  else {
        unset($_POST['event_image']);
    }
    if (count($errors) == 0) {
        global $conn;
        unset($_POST['add_event']);
        //unset($_POST['post_status']);
       
        $_POST['event_author'] = $_SESSION['username'];
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['event_title'] = htmlentities($_POST['event_title']);
        $_POST['event_body'] = htmlentities($_POST['event_body']);
       
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
                  'img_rel_type' => 'event',
                  'img_rel_id' => $post_id  
                );
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }


        $_SESSION['message'] = "Event created successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/events.php?events&page=1"); 
        exit();    
    } else {
      header("location: " . BASE_URL . "/admin/index.php"); 
    }


    }



   if (isset($_POST['edit_event'])) {

    global $errors;
 
    $checkArrays = [
      'event_title' => 'Event Title' , 
      'event_body' => 'Event Body' ,
        'event_status' => 'Event Status',
        'event_location' => 'Event Location',
        'event_date' => 'Event Date',
        'event_publishers' => 'Event Publishers',
      ];
     
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , 'event_title' );

  
  $statusPost = $_POST['event_status'];
  
$allowdValues = array('draft' , 'published');
   if ( !in_array($statusPost , $allowdValues)  ) {
   array_push($errors , "Only Publish Or Draft Are Allowed");
   }

   if (!empty($_FILES['event_image']['name'])) {
  
    $uploadFile_type = $_FILES['event_image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png');
      if (!in_array($uploadFile_type,$allowedTypes)) {
        array_push($errors , "File Type Is Not Allowed");
         }
  
      if( count($errors) == 0 ) {
        $image_name = time() . '_' . $_FILES['event_image']['name'];
     
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
         
        $result = move_uploaded_file($_FILES['event_image']['tmp_name'], $destination);
      }
     
    if ($result) {
      //  delete('/assets/images/' . $_POST['prev_image'] );
       $_POST['event_image'] = $image_name;
    } 
    // else {
    //     array_push($errors, "Failed to upload image");
    // }
}  else {
    unset($_POST['event_image']);
}
 

 if (count($errors) == 0) {
  
    global $conn;
     // unset($_POST['prev_image']);
    $eventId = $_POST['event_id']; 
    
    $eventId = is_numeric($eventId) ? intval($eventId) : 0 ; 
  
    if ($eventId > 0) {
        unset($_POST['edit_event']);
      
       
      
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        $_POST['event_title'] = htmlentities($_POST['event_title']);
        $_POST['event_body'] = htmlentities($_POST['event_body']);
         
        $post_id = update($table, $eventId , $_POST , 'event_id');

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
                  'img_rel_type' => 'event',
                  'img_rel_id' => $eventId  
                );
                
               $albumId = create("publsihed_gallery" , $publishedArray);
       
              }
              // else {
              //     array_push($errors,"Failed To Upload");
              // }
          }
        }


     
        $_SESSION['message'] = "Event updated successfully";
        $_SESSION['type'] = "success";
      //  header("location: " . BASE_URL . "/admin/index.php"); 
      //  exit(); 
    } else {
        $_SESSION['message'] = "Failed To Updated The Event";
        $_SESSION['type'] = "failed";
        // header("location: " . BASE_URL . "/admin/index.php"); 
        // exit(); 
    }
   
} else {
//  header("location: " . BASE_URL . "/admin/index.php"); 
}



   }
