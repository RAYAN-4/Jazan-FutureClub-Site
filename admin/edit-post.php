
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit Post";
 include ROOT_PATH . "/controllers/posts.php";

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;
     
    $condections = array(
        'id_post' => $postid 
    );
    $singlePost = selectOne('published_posts' ,  $condections );

    if (isset($_POST['submit_delete_thum'])) {
      
        $thumId =  isset($_POST['gallery_thum_id']) && is_numeric($_POST['gallery_thum_id']) ? intval($_POST['gallery_thum_id']) : 0;

        $tablename = "publsihed_gallery";
   
    $delete_id = deleteFromDb($tablename , $thumId  , 'img_id');


    }

    if ($singlePost) { ?>
<div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
         <h2 class="pb-3">Edit Post</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST" enctype="multipart/form-data"  >
             <input type="hidden" name="id_post" value="<?php  echo $singlePost['id_post'] ?>"  >
             <div class="form-group">
                 <label for="post-title">Post Title</label>
                 <input type="text" name="title_post" class="form-control" value="<?php echo $singlePost['title_post']  ?>" id="post-title" placeholder="Enter post title">
             </div>
             <div class="form-group">
                <label for="post-title">Post Body</label>
                    <textarea type="text" name="body_post"   class="form-control" id="post-title" placeholder="Enter Post Body" style="height: 10rem;" > <?php echo $singlePost['body_post']  ?> </textarea>
                </div>
                <div class="form-group">
                    <label for="post-content">Post Status</label>
                    <select name="status_post" id="" class="form-control">
                        <?php  
                        if ($singlePost['status_post'] == 'draft') { ?>
  <option value="<?php echo $singlePost['status_post']  ?>"><?php echo  $singlePost['status_post']  ?> </option>
  <option value="published">Published</option> 
                     <?php   }

                    else { ?>
                    <option value="<?php echo $singlePost['status_post']  ?>"><?php echo  $singlePost['status_post']  ?> </option>
                       <option value="draft">Draft</option>
 
                  <?php  }
                        ?>
                      
                     
                    
                    </select>
                   
                </div>
             <div class="form-group">
                 <label for="post-image">Uploaded Post Image</label>
                 <br>
                 <img class="img-fluid mt-1 mb-4" style="max-height: 14rem; max-width: 14rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $singlePost['image_post']  ?>" alt="">
                 <input type="hidden" name="prev_image" value="<?php $singlePost['image_post'] ?>" >  
                 <input accept="image/png, image/gif, image/jpeg" type="file" name="image_post" class="form-control-file" id="post-image">
             </div>

            
             <div class="form-group">
                    <label for="post-image">Upload Post Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>
               
            <input type="submit" name="edit_post" class="btn btn-primary">
            
         </form>
         <a href="<?php echo BASE_URL . '/admin/index.php'  ?>">
             <button name="edit_comp" type="submit" class="btn mx-2" style="background: #e9e9e9;" >Cancel</button>
             </a>

         <div class="form-group">
                 <label for=""> Uploaded Images Gallery </label>
                 <br>
                 
                     <?php  
                   $relatedPostGallery  = selectAllMultiCol("publsihed_gallery" ,  array("img_link" , "img_id") ,array(
                    'img_rel_id' => $postid,
                    'img_rel_type' => 'post'
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
   