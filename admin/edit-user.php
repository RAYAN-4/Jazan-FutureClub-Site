
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit User";
 include ROOT_PATH . "/controllers/users.php";

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
   
     
    $condections = array(
        'user_id' => $userId 
    );
    $singleUser = selectOne('joinedusers' ,  $condections );
    if ($singleUser) { ?>
<div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
         <h2 class="pb-3">Edit User</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST" enctype="multipart/form-data"  >
             <input type="hidden" name="id" value="<?php  echo $singleUser['user_id'] ?>"  >

             <div class="form-group">
                    <label for="post-title">Username</label>
                   <input type="text" name="user_name" value="<?php  echo $singleUser['user_name'] ?>"  class="form-control" id="post-title" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                <label for="post-title">User Email</label>
                <input type="email" name="user_email" value="<?php  echo $singleUser['user_email'] ?>" class="form-control" id="post-title" placeholder="Enter User Email">
                </div>
                <div class="form-group">
                <label for="post-title">Password</label>
                   <input type="password" name="user_password" value="<?php  echo $singleUser['user_password'] ?>" class="form-control" id="post-title" placeholder="Enter User Password">
                </div>
                <div class="form-group">
                    <label for="post-image">Upload User Image</label>
                    <br>

                    <img src="<?php  echo BASE_URL . '/admin/assets/images/' . $singleUser['user_image'] ?>" alt="">
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="user_image" class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <label for="post-content">User Status</label>
                    <select name="user_status" id="" class="form-control">
                                        <?php  
                                if ($singleUser['user_status'] == '0') { ?>
          <option value="notallowed">Not Allowed</option>
        <option value="allowed">Allowed</option>
                            <?php   }

                            else { ?>
                           <option value="allowed">Allowed</option>
                       
                           <option value="notallowed">Not Allowed</option>
                        <?php  }
                                ?>
                   
                      
                    </select>
                   
                </div>
                <div class="form-group">
                    <label for="post-content">User Role</label>
                    <select name="user_group_id" id="" class="form-control">
                    <?php  
                                if ($singleUser['user_group_id'] == '0') { ?>
          <option value="user">User</option>
          <option value="admin">Admin</option>
                            <?php   }

                            else { ?>
                           <option value="admin">Admin</option>
                       
                           <option value="user">User</option>
                        <?php  }
                                ?>

                   
                        
                      
                    </select>
                   
                </div>
                <button type="submit" name="edit_user" class="btn btn-primary">Submit</button>
            
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
   