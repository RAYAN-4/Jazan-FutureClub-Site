
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit Competion";
 include ROOT_PATH . "/controllers/competions.php";

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $compId = isset($_GET['compid']) && is_numeric($_GET['compid']) ? intval($_GET['compid']) : 0;
   
     
    $condections = array(
        'comp_id' => $compId 
    );
    $singleCompteion = selectOne('published_competions' ,  $condections );

    if (isset($_POST['submit_delete_thum'])) {
      
        $thumId =  isset($_POST['gallery_thum_id']) && is_numeric($_POST['gallery_thum_id']) ? intval($_POST['gallery_thum_id']) : 0;

        $tablename = "publsihed_gallery";
   
    $delete_id = deleteFromDb($tablename , $thumId  , 'img_id');


    }


    if ($singleCompteion) { ?>
<div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
         <h2 class="pb-3">Edit Competion</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST" enctype="multipart/form-data"  >
             <input type="hidden" name="comp_id" value="<?php  echo $singleCompteion['comp_id'] ?>"  >
             <div class="form-group">
                 <label for="post-title">Competion Title</label>
                 <input type="text" name="comp_title" class="form-control" value="<?php echo $singleCompteion['comp_title']  ?>" id="post-title" placeholder="Enter event title">
             </div>
             <div class="form-group">
                <label for="post-title">Competion Content</label>
                    <textarea type="text" name="comp_content"   class="form-control" id="post-title" placeholder="Enter event Body" style="height: 10rem;" > <?php echo $singleCompteion['comp_content']  ?> </textarea>
                </div>
                <div class="form-group">
                    <label for="post-content">Competion Status</label>
                    <select name="comp_status" id="" class="form-control">
                        <?php  
                        if ($singleCompteion['comp_status'] == 'draft') { ?>
  <option value="<?php echo $singleCompteion['comp_status']  ?>"><?php echo  $singleCompteion['comp_status']  ?> </option>
  <option value="published">Published</option> 
                     <?php   }

                    else { ?>
                    <option value="<?php echo $singleCompteion['comp_status']  ?>"><?php echo  $singleCompteion['comp_status']  ?> </option>
                       <option value="draft">Draft</option>
 
                  <?php  }
                        ?>
                      
                     
                    
                    </select>
                   
                </div>
             <div class="form-group">
                 <label for="post-image">Uploaded Competion Image</label>
                 <br>
                 <img class="img-fluid mt-1 mb-4" style="max-height: 14rem; max-width: 14rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $singleCompteion['comp_image']  ?>" alt="">
              
                 <input type="file" accept="image/png, image/gif, image/jpeg" name="comp_image" class="form-control-file" id="post-image">
             </div>

             <div class="form-group">
                 <label for="post-title">Competion Location</label>
                 <input type="text" name="comp_location" class="form-control" value="<?php echo $singleCompteion['comp_location']  ?>" id="post-title" placeholder="Enter event location">
             </div>

             
             <div class="form-group">
                 <label for="post-title">Competion Publishers</label>
                 <input type="text" name="comp_publishers" class="form-control" value="<?php echo $singleCompteion['comp_publishers']  ?>" id="post-title" placeholder="Enter event publishers">
             </div>

             <div class="form-group">
                 <label for="post-title">Current Date</label>
                 <input type="text"   readonly value="<?php echo $singleCompteion['comp_date']  ?>" class="form-control">
                 <label for="post-title mt-1">Competion Date</label>
                 <input type="datetime-local"  name="comp_date" class="form-control" value="<?php echo $singleCompteion['comp_date']  ?>" id="date_field" placeholder="Enter event date">
             </div>

             <div class="form-group">
                    <label for="post-image">Upload Competion Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>

            
             
             <button name="edit_comp" class="btn mx-2 btn-primary">Submit</button>
            
         </form>
         <a href="<?php echo BASE_URL . '/admin/index.php'  ?>">
             <button name="edit_comp" type="submit" class="btn mx-2" style="background: #e9e9e9;" >Cancel</button>
             </a>

         <div class="form-group">
                 <label for=""> Uploaded Images Gallery </label>
                 <br>
                 
                     <?php  
                   $relatedPostGallery  = selectAllMultiCol("publsihed_gallery" ,  array("img_link" , "img_id") ,array(
                    'img_rel_id' => $compId,
                    'img_rel_type' => 'competion'
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
   