
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit Event";
 include ROOT_PATH . "/controllers/events.php";

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $eventId = isset($_GET['eventid']) && is_numeric($_GET['eventid']) ? intval($_GET['eventid']) : 0;
     
    $condections = array(
        'event_id' => $eventId 
    );
    $singleEvent = selectOne('published_events' ,  $condections );
    if (isset($_POST['submit_delete_thum'])) {
      
        $thumId =  isset($_POST['gallery_thum_id']) && is_numeric($_POST['gallery_thum_id']) ? intval($_POST['gallery_thum_id']) : 0;

        $tablename = "publsihed_gallery";
   
    $delete_id = deleteFromDb($tablename , $thumId  , 'img_id');


    }


    if ($singleEvent) { ?>
<div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
         <h2 class="pb-3">Edit Event</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST" enctype="multipart/form-data"  >
             <input type="hidden" name="event_id" value="<?php  echo $singleEvent['event_id'] ?>"  >
             <div class="form-group">
                 <label for="post-title">Event Title</label>
                 <input type="text" name="event_title" class="form-control" value="<?php echo $singleEvent['event_title']  ?>" id="post-title" placeholder="Enter event title">
             </div>
             <div class="form-group">
                <label for="post-title">Event Body</label>
                    <textarea type="text" name="event_body"   class="form-control" id="post-title" placeholder="Enter event Body" style="height: 10rem;" > <?php echo $singleEvent['event_body']  ?> </textarea>
                </div>
                <div class="form-group">
                    <label for="post-content">Event Status</label>
                    <select name="event_status" id="" class="form-control">
                        <?php  
                        if ($singleEvent['event_status'] == 'draft') { ?>
  <option value="<?php echo $singleEvent['event_status']  ?>"><?php echo  $singleEvent['event_status']  ?> </option>
  <option value="published">Published</option> 
                     <?php   }


                    else { ?>
                     <option value="<?php echo $singleEvent['event_status']  ?>"><?php echo  $singleEvent['event_status']  ?> </option>
                       <option value="draft">Draft</option>

                  <?php  }
                        ?>
                      
                     
                    
                    </select>
                   
                </div>
             <div class="form-group">
                 <label for="post-image">Uploaded Event Image</label>
                 <br>
                 <img class="img-fluid mt-1 mb-4" style="max-height: 14rem; max-width: 14rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $singleEvent['event_image']  ?>" alt="">
              
                 <input accept="image/png, image/gif, image/jpeg" type="file" name="event_image" class="form-control-file" id="post-image">
             </div>

             <div class="form-group">
                 <label for="post-title">Event Location</label>
                 <input type="text" name="event_location" class="form-control" value="<?php echo $singleEvent['event_location']  ?>" id="post-title" placeholder="Enter event location">
             </div>

             
             <div class="form-group">
                 <label for="post-title">Event Publishers</label>
                 <input type="text" name="event_publishers" class="form-control" value="<?php echo $singleEvent['event_publishers']  ?>" id="post-title" placeholder="Enter event publishers">
             </div>

             <div class="form-group">
                 <label for="post-title">Current Date</label>
                 <input type="text" readonly value="<?php echo $singleEvent['event_date']  ?>" class="form-control">
                 <label for="post-title mt-1">Event Date</label>
                 <input type="datetime-local"  name="event_date" class="form-control" value="<?php echo $singleEvent['event_date']  ?>" id="date_field" placeholder="Enter event date">
             </div>

             <div class="form-group">
                    <label for="post-image">Upload Event Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>
             

             <button name="edit_event" type="submit" class="btn btn-primary">Submit</button>
         </form>
         <a href="<?php echo BASE_URL . '/admin/index.php'  ?>">
             <button name="edit_comp" type="submit" class="btn mx-2" style="background: #e9e9e9;" >Cancel</button>
             </a>
         <div class="form-group">
                 <label for=""> Uploaded Images Gallery </label>
                 <br>
                 
                     <?php  
                   $relatedPostGallery  = selectAllMultiCol("publsihed_gallery" ,  array("img_link" , "img_id") ,array(
                    'img_rel_id' => $eventId,
                    'img_rel_type' => 'event'
                ));
               foreach($relatedPostGallery as $galleryImg) { ?>
              
              <div class="gallery_main_div d-flex-c ">
                   <form method="POST" >
               <input type="hidden" name="gallery_thum_id" value="<?php echo $galleryImg['img_id']  ?>"  >    
               <div class="closing_div">
                   <button type="submit" class="non_style_btn" name="submit_delete_thum" >
                       <img src="./assets/icons/error.png" style="height: 1.5rem; width: 1.5rem; cursor:pointer;" alt="">
                   </button>
                  
                 
                   </div>
                      
                   
               <img src="<?php echo BASE_URL . '/admin/assets/images/' . $galleryImg['img_link']  ?>" alt="" class="gallery_img_thum">
               </div>    
               </form>
                  
              <?php }
                     ?>
                 
             </div>


     </section>

 </div>

 


</body>
</html>
   <?php }
   else { ?>
   
   <div class="fluid-container">
       <div class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
           <h2 class="py-3 display-4">This Id Does Not Exist</h2>
       </div>
   </div>
  <?php }
   
    
    

   }
 ?>
   