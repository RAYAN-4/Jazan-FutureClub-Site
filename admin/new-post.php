<?php  
 
 require_once 'init.php';
 adminOnly();
 include ROOT_PATH . "/controllers/posts.php";

?>

<body>
    <div class="fluid-container">
             
       <div class="mt-5"></div>
       <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>
        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
            <h2 class="pb-3">Add New Post</h2>
            <form  method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                    <label for="post-title">Post Title</label>
                    <input type="text" name="title_post"  class="form-control" id="post-title" placeholder="Enter Post Title">
                </div>
                <div class="form-group">
                <label for="post-title">Post Body</label>
                    <textarea type="text" name="body_post"  class="form-control" id="post-title" placeholder="Enter Post Body" style="height: 10rem;" > </textarea>
                </div>
                <div class="form-group">
                   
                </div>
                <div class="form-group">
                    <label for="post-image">Upload Post Thumbnail</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="image_post" class="form-control-file" id="post-image">
                </div>

                <div class="form-group">
                    <label for="post-image">Upload Post Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <label for="post-content">Post Status</label>
                    <select name="status_post" id="" class="form-control">
                        
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                   
                </div>

                <button type="submit" name="add_post" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
</body>
</html>