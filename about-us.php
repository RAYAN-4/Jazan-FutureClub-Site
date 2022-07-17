<?php  
  


  $pageTitle = "صفحة حول النادي";
  include 'init.php';
  include $functions . '/teamData.php';

  
  ?>


<div class="mt-5"></div>

  <div class="our_team__main--div container-sm mb-5 ">
      <div class="about_club_div">
          <div class="flex-col">
              <h1 class="headline--main-2">معلومات عن نادي مهارات المستقبل</h1>
              <p class="mt-1 mian--paragraph">نادي المستقبل احد اندية جامعة جازان يهدف لتنمية مهارات المتدربين في مختلف جوانب الحياة العملية و العلمية ننشر في مختلف مهارات بهدف تهئيل المتدربين لمختلف مهارات المستقبل</p>
          </div>
      </div>
      <div class="mt-3"></div>
      <h1 class="headline--main-2 text-center">اعضاء النادي</h1>
      <div class="mt-5"></div>
      <div class="d-grid grid-futeams">
          
          <div class="g-col-4">
              <?php  
              
              foreach($teamData as $key => $value) { ?>
                <!-----------SINGLE CARD TEAM---------->
                <div class="single--card__team">
                  <div class="flex-col card__main__futeams">
                  <img src="./images/avatar/<?php echo $value->img; ?>" alt="" class="team_card_thum">
                  <h1 class="headline--card mt-1 w-95"> <?php echo $value->name; ?> </h1>
                  <h1 class="subheadline--card mt-1">  <?php echo $value->role; ?>   </h1>
                  <p class=" w-75 mian--paragraph"><?php echo $value->desc; ?> </p>
                  <div class="d-flex-c f-sp">
                     <i class="fas fa-facebook"></i>
                     <i class="fas fa-facebook"></i>
                  </div>
                  </div>
               
              </div>

               <!-----------END SINGLE CARD TEAM---------->

            <?php  }

              ?>
            

            
          </div>
      </div>
  </div>


<?php  
 include $templates . '/footer.php';

  ?>