<?php  
  
  


  $pageTitle = "صفحة انشاء فريق";
  $table = "published_teams";
  include 'init.php';
  if (empty($_SESSION['id'])) {
    $_SESSION['message'] = "You Need To Login First";
    $_SESSION['type'] = 'error';
    header('location: ' . BASE_URL . '/index.php' );

    exit(0);
}

  if (isset($_POST['team_create']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    global $errors;
    $checkArrays = [
        'team_name' => 'Team Name' , 
        'team_join_pass' => 'Team Join Code' ,
          
        ];
  // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
   $errors = validatePost($_POST , $checkArrays , "published_teams" , 'team_name' );
   $userId =  is_numeric($_SESSION['id']) ? intval($_SESSION['id']) : array_push($errors , "Not Valid Id");
   $checkAlready = selectAllOneCol("joinedteams" , 'user_id' , array(
       'user_id' => $userId
   ) );

   if (!empty($checkAlready)) {
    array_push($errors , "You Already Joined A Team");
   }
   if (count($errors) == 0) {
    global $conn;
    unset($_POST['team_create']);
   
    $_POST['team_join_pass'] = sha1($_POST['team_join_pass']);

    $_POST['team_author_id'] = $userId;
    //unset($_POST['post_status']);
   
//     $_POST['author_post'] = $_SESSION['username'];
//   //  $_POST['post_status'] = isset($_POST['post_status']) ? 1 : 0;
//     $_POST['title_post'] = htmlentities($_POST['title_post']);
//     $_POST['body_post'] = htmlentities($_POST['body_post']);
  
    $post_id = create($table, $_POST);
    if ($post_id) {
        $joinedTeamsArray = array(
            'user_id' => $userId,
            'user_name' => $_SESSION['username'],
            'joined_team_id' => $post_id,
            'joined_team_name' => $_POST['team_name'] 
        );
        $joinId = create("joinedteams" , $joinedTeamsArray );
        $updateUser = update("joinedusers" , $userId , array(
            "user_joined_team" => 1,
            'user_team_joined' => $_POST['team_name']
        ) );
    }
  
    $_SESSION['join_team_id'] = $joinId;
    $_SESSION['join_team_name'] = $_POST['team_name'];
    
    $_SESSION['message'] = "Team created successfully";
    $_SESSION['type'] = "success";
    header("location: " . BASE_URL . "/teams.php"); 
    exit();    
} else {
 // header("location: " . BASE_URL . "/index.php"); 
}

  }
  
  ?>


        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-05.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg"> صفحة انشاء فريق</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

       <div class="mt-5"></div>
                <!-----------------TEAMCREATE FORM-------------------->
                <div class="py-2">
                <?php  include  ROOT_PATH_MAIN . '/includes/templates/formErrors.php'  ?>
                    <div class="main--sinupform__div container-big">
                   
                        <div class="singupform__div">
                            <div class="d-grid grid-signupform">
                           
                                <div class="g-col-2">
    
                                    <div class="signupform__div">
                                        <div class="single-background__div" style="background: linear-gradient(rgba(255,255,255,0.9) , rgba(255,255,255,0.6)),url('./images/singup/flat-illustration-people-05.jpg')" >
                                        <div class="inside--singup__div flex-col">
                                            <h1 class="headline--main">مرحبا بك في نادي مهارات المستقبل </h1>
                                            <p class="mian--paragraph mt-1"> من خلال انشاء فريق يمكنك التفاعل في المسابقات واضافة اصدقائك للمشاركة وحل تحديات المسابقات </p>
                                        </div>
                                        </div>
                                    </div>
    
    
                                    <div class="info__div--singup py-2 flex-col">
                                 <h1 class="headline--main-2">  انشاء فريق </h1>
                               
                                 <p class="mian--paragraph-sm mt-1">تريد الانضمام بدلا من لك   ؟  <span class="gothought_a"> اضغط هنا </span>   </p>
    
                                 <div class="mt-5"></div>
                                 <form action="" method="POST" class="singup__form">
    
       
    
                                     <div class="signup__form--div">
                                         <div><label for="" class="singup__label">اسم الفريق </label></div>
                                         <input type="text" name="team_name" placeholder="ادخل اسم الفريق" class="singup__input">
                                     </div>
    
                                     <div class="signup__form--div">
                                         <div><label for="" class="singup__label"> كود الانضمام للفريق </label></div>
                                         <input type="password" name="team_join_pass" placeholder="ادخل كود الانضمام للفريق" class="singup__input" autocomplete="off" >
                                     </div>
                  <input type="submit" name="team_create" value="انشاء فريق" class="singup_btn" >
                                 </form>
                                    </div>
    
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-----------------END TEAMCREATE FORM-------------------->

              
<?php  
 include $templates . '/footer.php';
?>