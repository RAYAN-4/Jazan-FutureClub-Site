<?php  
 
 require_once 'init.php';
 adminOnly();
 include ROOT_PATH . "/controllers/events.php";

?>

<body>
    <div class="fluid-container">
       <div class="mt-5"></div>
       
       <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>
        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
            <h2 class="pb-3">Add New Event</h2>
            <form  method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                    <label for="post-title">Event Title</label>
                    <input type="text" name="event_title"  class="form-control" id="post-title" placeholder="Enter Event Title">
                </div>
                <div class="form-group">
                <label for="post-title">Event Body</label>
                    <textarea type="text" name="event_body"  class="form-control" id="post-title" placeholder="Enter Event Body" style="height: 10rem;" > </textarea>
                </div>
             
                <div class="form-group">
                    <label for="post-image">Upload Event Thumbnail</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="event_image" class="form-control-file" id="post-image">
                </div>

                <div class="form-group">
                    <label for="post-image">Upload Event Image's</label>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="files[]" multiple class="form-control-file" id="post-image">
                </div>

                <div class="form-group">
                    <label for="post-title">Event Location</label>
                    <input type="text" name="event_location"  class="form-control" id="post-title" placeholder="Enter Event Location">
                </div>
                <div class="form-group">
                    <label for="post-title">Event Publishers</label>
                    <input type="text" name="event_publishers"  class="form-control" id="post-title" placeholder="Enter Event Publishers">
                </div>
                <div class="form-group">
                    <label for="post-title">Event Date</label>
                    <input type="datetime-local" name="event_date"  class="form-control" id="post-title" placeholder="Enter Event Date">
                </div>

                <div class="form-group">
                    <label for="post-content">Event Status</label>
                    <select name="event_status" id="" class="form-control">
                        
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                   
                </div>
                <button type="submit" name="add_event" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
</body>
</html>