
 <?php  
 require_once 'init.php';
 adminOnly();
 $pageTitle = "Edit Team";
  
 if (isset($_POST['edit_team'])) {
     $table = "published_teams";
    global $errors;
    $checkArrays = [
        'team_name' => 'Team Name' , 
        'team_join_pass' => 'Team Password' ,

        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , $table , 'team_name' );
 
        
  

 if (count($errors) == 0) {
    global $conn;
      //unset($_POST['prev_image']);
    $teamId = $_POST['team_id']; 
    $teamId = is_numeric($teamId) ? intval($teamId) : 0 ; 
    if ($teamId > 0) {
      unset($_POST['team_id']);
        unset($_POST['edit_team']);
      
          $_POST['team_join_pass'] = sha1($_POST['team_join_pass']);
      //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
        // $_POST['title_post'] = htmlentities($_POST['title_post']);
        // $_POST['body_post'] = htmlentities($_POST['body_post']);

        $post_id = update($table, $teamId , $_POST , 'team_id'  );
       
      
        $_SESSION['message'] = "Team updated successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/index.php"); 
        exit(); 
    } else {
        $_SESSION['message'] = "Failed To Updated The Post";
        $_SESSION['type'] = "failed";
        header("location: " . BASE_URL . "/admin/index.php"); 
        exit(); 
    }
   
} else {
  header("location: " . BASE_URL . "/admin/index.php"); 
}


 }

 ?>
 <?php  
 
  $func = isset($_GET['func']);
   if ( $func == 'Edit' ) {
    $teamId = isset($_GET['teamid']) && is_numeric($_GET['teamid']) ? intval($_GET['teamid']) : 0;
   
     
    $condections = array(
        'team_id' => $teamId 
    );
    $singleTeam = selectAllMultiCol('published_teams' , array('team_name' , 'team_join_pass' , "team_id") ,  $condections  , '=' , true , 1 );
    
    if ($singleTeam) {
       foreach($singleTeam as $team) {  ?>
          <div class="fluid-container">
     

     <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3 pb-5">
         <h2 class="pb-3">Edit Team</h2>
    <?php include ROOT_PATH . '/helpers/formErrors.php'  ?>

         <form method="POST"   >
             <input type="hidden" name="team_id" value="<?php  echo $team['team_id'] ?>"  >

             <div class="form-group">
                    <label for="post-title">Team Name</label>
                   <input type="text" name="team_name" value="<?php  echo $team['team_name'] ?>"  class="form-control" id="post-title" placeholder="Enter Team Name">
                </div>
               
                <div class="form-group">
                <label for="post-title">Team Join Password</label>
                   <input type="password" name="team_join_pass" value="<?php  echo $team['team_join_pass'] ?>" class="form-control" id="post-title" placeholder="Enter Team Password">
                </div>
                
                
                
                <button type="submit" name="edit_team" class="btn btn-primary">Submit</button>
            
         </form>
         <a href="<?php echo BASE_URL . '/admin/index.php'  ?>">
             <button name="edit_comp" type="submit" class="btn mx-2" style="background: #e9e9e9;" >Cancel</button>
             </a>
     </section>

 </div>
     <?php  }
       


 



   }
   else { ?>
   
   <div class="fluid-container">
       <div class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
           <h2 class="py-3 display-4">This Id Does Not Exist</h2>
       </div>
   </div>
  <?php }
   
    
    

   }
 ?>
   
   </body>
</html>