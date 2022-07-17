<?php  
 
 require_once 'init.php';
 adminOnly();
 include ROOT_PATH . "/controllers/questions.php";

?>

<body>
    <div class="fluid-container">
             
       <div class="mt-5"></div>
       <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>
        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
            <h2 class="pb-3">Add New Question</h2>
            <form  method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                    <label for="post-title">Question Title</label>
                    <input type="text" name="ques_name"  class="form-control" id="post-title" placeholder="Enter Question Title">
                </div>
                <div class="form-group">
                <label for="post-title">Question Content</label>
                    <textarea type="text" name="ques_desc"  class="form-control" id="post-title" placeholder="Enter Question Content" style="height: 10rem;" > </textarea>
                </div>
                <div class="form-group">
                <label for="post-title">Question Points</label>
                    <input type="number" name="ques_points"  class="form-control" id="post-title" placeholder="Enter Question Points">
                </div>
                <div class="form-group">
                    <label for="post-image">Upload question image</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="ques_image" class="form-control-file" id="post-image">
                </div>
               
                <div class="form-group">
                    <label for="post-content">Question Related Competiton</label>
                    <select name="ques_rel_comp" id="" class="form-control">
                        
                        <option value="">...</option>
                        <?php  
                      $questionsArray = array(
                          'comp_title' => 'comp_title' ,'comp_id' => 'comp_id'
                      );
                       $compentionRel = selectAllMultiCol("published_competions" , $questionsArray , array() );
                      
                       foreach($compentionRel as $comRel) { ?>
        <option value="<?php echo $comRel['comp_id'] ?>"><?php echo $comRel['comp_title'] ?></option>
                <?php       }
                       ?>
                    </select>
                   
                </div>

                
                <button type="submit" name="add_question" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
</body>
</html>