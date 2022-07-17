<?php  
 
 require_once 'init.php';
 adminOnly();
 include ROOT_PATH . "/controllers/users.php";

?>

<body>
    <div class="fluid-container">
             
       <div class="mt-5"></div>
       <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>
        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
            <h2 c lass="pb-3">Add New User</h2>
            <form  method="POST" enctype="multipart/form-data"  >
                <div class="form-group">
                    <label for="post-title">Username</label>
                   <input type="text" name="user_name"  class="form-control" id="post-title" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                <label for="post-title">User Email</label>
                <input type="email" name="user_email"  class="form-control" id="post-title" placeholder="Enter User Email">
                </div>
                <div class="form-group">
                <label for="post-title">Password</label>
                   <input type="password" name="user_password"  class="form-control" id="post-title" placeholder="Enter User Password">
                </div>
                <div class="form-group">
                    <label for="post-image">Upload User Image</label>
                    <input  accept="image/png, image/gif, image/jpeg" type="file" name="user_image" class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <label for="post-content">User Status</label>
                    <select name="user_status" id="" class="form-control">
                    <option value="notallowed">Not Allowed</option>
                        <option value="allowed">Allowed</option>
                      
                    </select>
                   
                </div>
                <div class="form-group">
                    <label for="post-content">User Role</label>
                    <select name="user_group_id" id="" class="form-control">
                    <option value="user">User</option>
                        <option value="admin">Admin</option>
                      
                    </select>
                   
                </div>
                <button type="submit" name="add_user" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
</body>
</html>