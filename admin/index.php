<?php  
 
 require_once 'init.php';
adminOnly();
$pageTitle = "Dashboard";
?>

<section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
 
   
<div class="my-5"></div>
    <div class="main__dashbaord__div">
        <h1 class="text-center headline__main">لوحة المعلومات</h1></h1>
        <p class="lead mt-1 text-center">تفقد جميع ما يحصل على الموقع هنا</p>
        <div class="mt-5"></div>
        <!-----START ROW----->
        <div class="row">
            
            <!--COL START-->
            <div class="col-lg-6">
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > المنشورات</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/types-of-instagram-posts.jpg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('id_post' , 'published_posts');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > الفعاليات</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/istockphoto-1191395009-612x612.jpg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('event_id' , 'published_events');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
            </div>
            <!--COL END-->

            
        </div>
        <!-----END ROW----->
        <div class="mt-5"></div>
        <!-----START ROW----->
        <div class="row">
            
            <!--COL START-->
            <div class="col-lg-6">
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > المسابقات</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/pexels-photo-129742.jpeg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('comp_id' , 'published_competions');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > المستخدمين</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/Active-users.jpg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('user_id' , 'joinedusers');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
            </div>
            <!--COL END-->

            
        </div>
        <!-----END ROW----->
        <div class="mt-5"></div>
        <!-----START ROW----->
        <div class="row">
            
            <!--COL START-->
            <div class="col-lg-6">
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > الفرق</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/flat-illustration-people-05.jpg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('joined_team_id' , 'joinedteams');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
                    <!-------CARD AREA------->
        <div class="card">
          <div class="card-header">
            <h1 class="text-center" > الاسئلة</h1>
          </div>
          <div class="card-body">
            <div class="text-center">
            <img src="../images/admin/d-man-standing-question-mark-illustration-person-big-human-person-character-white-people-47148583.jpg" style="margin-bottom: 1rem;" alt="">
            <h1 class="dispaly-5"> <?php echo countItems('ques_id' , 'published_questions');  ?> </h1>
            </div>
               
             
          </div>
            
        </div>

   
      </div>
        <!-------END CARD AREA-------> 
            </div>
            <!--COL END-->

            
        </div>
        <!-----END ROW----->

        <div class="mt-5"></div>
        <div class="row">
            <div class="col-lg-6">
                <div class="single__question__card">
                    <h1 class="headline__team ">المستخدمين الجدد المنضمين</h1>
                    <?php  
                    $newlyUsers = selectAllOneCol("joinedusers" , "user_name" , array() , true , 5 , true , 'user_id' , 'DESC' );
                    
                    foreach($newlyUsers as $newUser) { ?>
                    <div class="single_new_div">
                        <h6 class="headline__latest"><?php echo $newUser['user_name'] ?></h6>
                    </div>
                 <?php   }
                    ?>
                   
                </div>
            </div>
            <div class="col-lg-6">
            <div class="single__question__card">
                    <h1 class="headline__team ">الفرق الجديدة المنضمة</h1>
                    <?php  
                    $newlyTeams = selectAllOneCol("published_teams" , "team_name" , array() , true , 5 , true , 'team_id' , 'DESC' );
                    
                    foreach($newlyTeams as $newTeam) { ?>
                    <div class="single_new_div">
                        <h6 class="headline__latest"><?php echo $newTeam['team_name'] ?></h6>
                    </div>
                 <?php   }
                    ?>
                   
                </div>
            </div>
        </div>
    </div>
   
</section>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>