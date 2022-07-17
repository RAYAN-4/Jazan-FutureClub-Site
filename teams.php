<?php  
  
 

  $pageTitle = "صفحة الفرق";
  include 'init.php';
  
  ?>


        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/literary-05.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">صفحة الفرق</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

       <div class="mt-5"></div>
       <section class="main--teams__div container-sm">
           <div class="d-grid grid-teams py-3">
               <div class="g-col-2">
               <div class="team-welconme_image">
                       <img src="./images/blog/flat-illustration-people-04.jpg" class="welcome_team_thum" alt="">
                   </div>

                   <div class="team-welcome__info">
                     <h1 class="headline--main-2">مرحبا بك قم باخيتار احد الخيارات التالية</h1>
                     <div class="mt-4"></div>
                     <div class="option__team--div mt-1 text-center">
                         <a href="team-create.php">
                         <button class="option_team-btn"  >انشاء فريق</button>
                         </a>
                       
                        
                     </div>
                     <div class="option__team--div mt-1 text-center">
                         <a href="team-join.php">
                         <button class="option_team-btn join_btn">الانضمام لفريق</button>
                         </a>
                    
                        
                     </div>
                     <div class="option__team--div mt-1 text-center">
                         <a href="scoreboard.php">
                         <button class="option_team-btn score_btn"> Scoreboard صفحة</button>
                         </a>
                    
                        
                     </div>
                   </div>

                  
               </div>
           </div>


    <!-----------TEAM PAGE------------>
    <div class="mt-5"></div>
    <div class="py-5 team__area--div">
    <h1 class="headline--main-2 text-right">جميع الفريق المسجلة</h1>

    <div class="d-grid grid__joined-teams">
        <div class="mt-5"></div>
        <div class="g-col-4">
        <?php 
        $teams = selectAll("published_teams" );
        
        foreach($teams as $team) { ?>

        <!---------SIGNLE TEAM DIV--------->
          <div class="single--team__div text-center ">
              <h1 class="headline--team mb-1"><?php echo $team['team_name']    ?> :اسم الفريق </h1>
              <h1 class="subheadline--team mb-1"><?php echo $team['team_score']    ?> :نقاط الفريق</h1>

          </div>
            <!---------END SIGNLE TEAM DIV--------->


      <?php  }
        ?>
           
        </div>
    </div>
    </div>

    <!-----------END TEAM PAGE------------>
       </section>


       
<?php  
 include $templates . '/footer.php';
?>