<?php  
 
 require_once 'init.php';
 adminOnly();
 include ROOT_PATH . "/controllers/competions.php";

?>

<body>
    <div class="fluid-container">
       <div class="mt-5"></div>
       
       <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>
        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
            <h2 class="pb-3">Add New Competion</h2>
            <form  method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                    <label for="post-title">Competion Title</label>
                    <input type="text" name="comp_title"  class="form-control" id="post-title" placeholder="Enter Competion Title">
                </div>
                <div class="form-group">
                <label for="post-title">Competion Content</label>
                    <textarea type="text" name="comp_content"  class="form-control" id="post-title" placeholder="Enter Event Competion" style="height: 10rem;" > </textarea>
                </div>
             
                <div class="form-group">
                    <label for="post-image">Upload Competion Thumbnail</label>
                    <input type="file" accept="image/png, image/gif, image/jpeg" name="comp_image" class="form-control-file" id="post-image">
                </div>

                <div class="form-group">
                    <label for="post-image">Upload Competion Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>

                <div class="form-group">
                    <label for="post-title">Competion Location</label>
                    <input type="text" name="comp_location"  class="form-control" id="post-title" placeholder="Enter Competion Location">
                </div>
                <div class="form-group">
                    <label for="post-title">Competion Publishers</label>
                    <input type="text" name="comp_publishers"  class="form-control" id="post-title" placeholder="Enter Competion Publishers">
                </div>
                <div class="form-group">
                    <label for="post-title">Competion Date</label>
                    <input type="datetime-local" name="comp_date"  class="form-control" id="post-title" placeholder="Enter Competion Date">
                </div>

                <div class="form-group">
                    <label for="post-content">Competion Status</label>
                    <select name="comp_status" id="" class="form-control">
                        
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                   
                </div>
                <button type="submit" name="add_comp" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
</body>
</html>