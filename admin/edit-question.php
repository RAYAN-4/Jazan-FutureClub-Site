
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit Question";
 include ROOT_PATH . "/controllers/questions.php";

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $postid = isset($_GET['quesid']) && is_numeric($_GET['quesid']) ? intval($_GET['quesid']) : 0;
     
    $condections = array(
        'ques_id' => $postid 
    );
    $singlePost = selectOne('published_questions' ,  $condections );
    if ($singlePost) { ?>
<div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
         <h2 class="pb-3">Edit Question</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST" enctype="multipart/form-data"  >
             <input type="hidden" name="ques_id" value="<?php  echo $singlePost['ques_id'] ?>"  >
             <div class="form-group">
                 <label for="post-title">Question Name</label>
                 <input type="text" name="ques_name" class="form-control" value="<?php echo $singlePost['ques_name']  ?>" id="post-title" placeholder="Enter Question title">
             </div>
             <div class="form-group">
                <label for="post-title">Question Describition</label>
                    <textarea type="text" name="ques_desc"   class="form-control" id="post-title" placeholder="Enter Question Content" style="height: 10rem;" > <?php echo $singlePost['ques_desc']  ?> </textarea>
                </div>

                <div class="form-group">
                 <label for="post-title">Question Points</label>
                 <input type="number" name="ques_points" class="form-control" value="<?php echo $singlePost['ques_points']  ?>" id="post-title" placeholder="Enter Question Points">
             </div>

     
             <div class="form-group">
                 <label for="post-image">Uploaded Question Image</label>
                 <br>
                 <img class="img-fluid mt-1 mb-4" style="max-height: 14rem; max-width: 14rem;" src="<?php echo BASE_URL . '/admin/assets/images/' . $singlePost['ques_image']  ?>" alt="">
                
                 <input accept="image/png, image/gif, image/jpeg" type="file" name="ques_image" class="form-control-file" id="post-image">
             </div>

             <div class="form-group">
                    <label for="post-content">Question Related Competiton</label>
                    <select name="ques_rel_comp" id="" class="form-control">
                        
                       <?php  
                        $questionsArray = array(
                            'comp_title' => 'comp_title' ,'comp_id' => 'comp_id'
                        );
                         $compentionSingRel = selectAllMultiCol("published_competions" , $questionsArray , array(
                             'comp_id' => $singlePost['ques_rel_comp']
                         ) , '=' , true , 1 );

                        
                       ?>
                        <option value="<?php echo $compentionSingRel[0]['comp_id'] ?>"><?php echo $compentionSingRel[0]['comp_title'] ?></option>
                        <?php  
                      $questionsArray = array(
                          'comp_title' => 'comp_title' ,'comp_id' => 'comp_id'
                      );
                       $compentionRel = selectAllMultiCol("published_competions" , $questionsArray , array(
                           'comp_id' => $singlePost['ques_rel_comp']
                       ) , '!=' );
                      
                       foreach($compentionRel as $comRel) { ?>
        <option value="<?php echo $comRel['comp_id'] ?>"><?php echo $comRel['comp_title'] ?></option>
                <?php       }
                       ?>
                       
                    </select>
                   
                </div>

            
             <button name="edit_question" type="submit" class="btn btn-primary">Submit</button>
         </form>

         <a href="<?php echo BASE_URL . '/admin/index.php'  ?>">
             <button name="edit_comp" type="submit" class="btn mx-2" style="background: #e9e9e9;" >Cancel</button>
             </a>

             
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
   