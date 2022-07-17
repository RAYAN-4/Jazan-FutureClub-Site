  <?php  
  


  $pageTitle = "الصفحة الرئيسية";
  include 'init.php';
  
  
  ?>

   


     <!----------------- HEROAREA-------------------->
     <div class="mt-2"></div>
     <section class="heroarea__main-div">
        <div class="container-sm">
            <div class="main-heroarea__div d-grid grid-heroarea">
                   <div class="g-col-2">
                    <div class="icons__heroarea--div d-flex-c">
                        <img src="./images/heroarea/globalization.png" alt="" class="heroarea__img">
                        <img src="./images/heroarea/predictive-chart.png" alt="" class="heroarea__img">
                    </div>
            
                       <div class="info__heroarea--div">
                           <h1 class="main--headline__heroarea"> مرحبا بك في نادي مهارات المستقبل </h1>
                           <p class="mian--paragraph mt-2">اكتشف وحسن من مهاراتك من خلال التدريبات التي نقدمها </p>
                           <?php  
                           if (is_user_logged_in_web(  )) { ?>
                           <a href="blog.php">
                           <button class="mt-1 btn-heroarea-btn">اكتشف المزيد</button>
                           </a>
           
                          <?php } else { ?>
                            <a href="signup.php">
                            <button class="mt-1 btn-heroarea-btn">انشئ حسابك الان</button>
                            </a>
                           
                        <?php  }
                           ?>
                         
                       </div>
            
                       
                   </div>
            </div>
                </div>
     </section>
   
    
      <!-----------------END HEROAREA-------------------->

      
     <!-----------------PRESENTAION------------------>

     <!---------------PRESENTAION AREA------------------>
     <div class="mt-4">
        <section class="pt-5 presentaion__section">
            <div class="main--presentaion__div">
        <div class="d-grid presentation__grid">
        <div class="g-col-2">
            <div class="gallery--img__div" data-aos="fade-left"  data-aos-duration="600" >
                <img src="./images/presentation/ball-glass-01.jpg" alt="" class="main--presntation__img">
                <img src="./images/presentation/circuit-board-01.jpg" alt="" class="secondary--presntation__img">
                <img src="./images/presentation/circuit-board-04.jpg"" alt="" class="thirdly--presntation__img">
            </div>
        <div class="info--presnt__div" data-aos="fade-right"  data-aos-duration="900">
            <h1 class="headline--main">نهدف لتنمية مهارات الطلبة في مختلف جوانب الحياة</h1>
           
            <p class="mian--paragraph mt-1"> نادي المستقبل احد اندية جامعة جازان يهدف لتنمية مهارات المتدربين في مختلف جوانب الحياة العملية و العلمية ننشر في مختلف مهارات بهدف تهئيل المتدربين لمختلف مهارات المستقبل  </p>
            <a href="about-us.php">
            <button class="mt-2 btn-heroarea-btn">تعرف على المزيد عنا</button>
            </a>
           
        </div>
        
        </div>
        </div>
            </div>

                <!---------------END PRESENTAION AREA------------------>
        </section>
       <!-----------------END PRESENTAION------------------>


       
<!----------------- MENU OF SERVICES------------------>
 <div class="mt-fixed"></div>
 <section class="mt-5 menu-services__section">
     <div class="text-center main-service__headlines">
        <h1 class="headline--main-2" data-aos="flip-right" >مهارات نادي المستقبل </h1>
       
     </div>
   
     <div class="serrvice--menu__div mt-5 ">
         <div class="d-grid grid--services">
      <div class="g-col-5"  data-aos="zoom-in-down">

          <div class="single--services__div flex-col">
            <i class="fas fa-tools"></i>
            <h1 class="mt-2 service--title__single">مهارة حل المشكلات</h1>
          </div>

          <div class="single--services__div flex-col">
            <i class="far fa-circle"></i>
            <h1 class="mt-2 service--title__single">مهارة التفكير التحليلي</h1>
          </div>

          <div class="single--services__div flex-col">
            <i class="fas fa-circle"></i>
            <h1 class="mt-2 service--title__single">مهارة التفكير الناقد</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-video"></i>
            <h1 class="mt-2 service--title__single">مهارة التفكير الابداعي</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-street-view"></i>
            <h1 class="mt-2 service--title__single">التربية الاخلاقية والقيمية</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-users"></i>
            <h1 class="mt-2 service--title__single">مهارة التواصل الفعال والذكاء العاطفي</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-user-graduate"></i>
            <h1 class="mt-2 service--title__single">مهارة التربية الاعلامية والرقمية</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-people-carry"></i>
            <h1 class="mt-2 service--title__single">مهارة القدة على ممارسة العمل الجامعي</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="far fa-file-code"></i>
            <h1 class="mt-2 service--title__single">برمجة المواقع الالكترونية</h1>
          </div>

          <div class="single--services__div flex-col">
          <i class="fas fa-project-diagram"></i>
            <h1 class="mt-2 service--title__single">مهارة ادارة المشاريع</h1>
          </div>

          


      </div>
      <a href="about-us.php" class="text-center" >
      <button class="mt-5 btn-heroarea-btn  w-50 mx-auto"  data-aos="flip-right" >اكتشف المزيد</button>
      </a>
     
         </div>
     </div>


 </section>


 <!-----------------END MENU OF SERVICES------------------>



  <!-----------------BANNER SECTION------------------>

  <div class="mt-fixed"></div>
  
    <section class="banner-preview__section pt-5">
        
        <div class="">
            <h1 class="headline--main-2 text-center">اخر الفعاليات</h1>
            <div class="d-grid grid-banner container-sm">
        <div class="main--banner--first__div  mt-4 " data-aos="fade-down"  data-aos-duration="400" >
        
         <?php  
          $events = selectAll("published_events" ,array() , true, 2 );
          if (!empty($events)) {
             
          $randomPostNum = array_rand($events);

         ?>
                <div class="f-sv single--banner__area mt-3">
                    <img src="<?php echo $events[$randomPostNum]['event_image'] ? BASE_URL . '/admin/assets/images/' . $events[$randomPostNum]['event_image'] : '' ?>" class="banner--img__single h-auto" alt="">
                    <div class="main--banner--info__div">
                        <h1 class="headline--banner__hero"> <?php echo $events[$randomPostNum]['event_title'];  ?> </h1>
                        <h1 class="mt-2 headline--main-banner__hero"> <?php echo substr( $events[$randomPostNum]['event_body']  , 0 , 20);  ?> </h1>
                        <a style="cursor:pointer" href="single-event.php?eventId=<?php echo $events[$randomPostNum]['event_id']  ?>">
                        <button class="mt-4 banner-btn"> لرؤية المزيد <i class="fas fa-chevron-right banner-icon-right"></i> </button>
                        </a>
                       
       
                    </div>
               </div>
           

        </div>
        <div class="container--unocal">
        <div class="g-col-2">
           <?php  
           foreach($events as $event) { ?>
  <div class="main--banner--second__div mt-4 "  >
        
        <div class="f-sv single--banner__area mt-3">
            <img src="<?php echo $event['event_image'] ? BASE_URL . '/admin/assets/images/' . $event['event_image'] : '' ?>" class="banner--img__single" alt="">
            <div class="main--banner--info__div flex-col">
                <h1 class="headline--banner__hero"> <?php echo $event['event_title']  ?> </h1>
                <h1 class="mt-2 headline--main-banner__hero"> <?php echo substr( $event['event_body']  , 0 , 100 ) ?> </h1>
                <a style="cursor:pointer" href="single-event.php?eventId=<?php echo $event['event_id']  ?>">
                <button class="mt-4 banner-btn">لرؤية المزيد  <i class="fas fa-chevron-right banner-icon-right"></i> </button>
           </a>

            </div>
       </div>
</div>
          <?php }

           }
           ?>
           
           
            


            </div>

            </div>
        </div>
    </section>

    <!-----------------END BANNER SECTION------------------>
  <!-----------------BANNER SECTION------------------>

  <div class="mt-fixed"></div>
  
    <section class="banner-preview__section pt-5">
        
        <div class="main--banner__div">
            <h1 class="headline--main-2 text-center">اخر المسابقات</h1>
            <div class="d-grid grid-banner container-sm">
        <div class="main--banner--first__div  mt-4 " data-aos="fade-down"  data-aos-duration="400" >
        
         <?php  
          $competions = selectAll("published_competions" ,array() , true, 2 );
          if (!empty($competions)) {

          
          $randomPostNum = array_rand($competions);

         ?>
                <div class="f-sv single--banner__area mt-3">
                    <img src="<?php echo $competions[$randomPostNum]['comp_image'] ? BASE_URL . '/admin/assets/images/' . $competions[$randomPostNum]['comp_image'] : '' ?>" class="banner--img__single h-auto" alt="">
                    <div class="main--banner--info__div">
                        <h1 class="headline--banner__hero"> <?php echo substr($competions[$randomPostNum]['comp_title'] , 0 , 100);  ?> </h1>
                        <h1 class="mt-2 headline--main-banner__hero">  <?php echo substr($competions[$randomPostNum]['comp_content'] , 0 , 100);  ?> </h1>
                        <a style="cursor:pointer" href="single-challenge.php?compId=<?php echo $competions[$randomPostNum]['comp_id']  ?>">
                        <button class="mt-4 banner-btn"> لرؤية المزيد <i class="fas fa-chevron-right banner-icon-right"></i> </button>
           </a>
       
                    </div>
               </div>
           

        </div>
        <div class="container--unocal">
        <div class="g-col-2">
           <?php  
           foreach($competions as $comp) { ?>
  <div class="main--banner--second__div mt-4 "  >
        
        <div class="f-sv single--banner__area mt-3">
            <img src="<?php echo $comp['comp_image'] ? BASE_URL . '/admin/assets/images/' . $comp['comp_image'] : '' ?>" class="banner--img__single" alt="">
            <div class="main--banner--info__div">
                <h1 class="headline--banner__hero"> <?php echo substr( $comp['comp_title'] , 0 , 100 ) ?> </h1>
                <h1 class="mt-2 headline--main-banner__hero"> <?php echo substr( $comp['comp_content'] , 0 , 100 ) ?> </h1>
                <a style="cursor:pointer" href="single-challenge.php?compId=<?php echo $comp['comp_id']  ?>">
                <button class="mt-4 banner-btn">لرؤية المزيد  <i class="fas fa-chevron-right banner-icon-right"></i> </button>
           </a>

            </div>
       </div>
</div>
          <?php }
          }
           ?>
           
           
            


            </div>

            </div>
        </div>
    </section>

    <!-----------------END BANNER SECTION------------------>

      <!-----------------CONNECT WITH US----------------->
      <div class="mt-5"></div>
      <section class="connect-with-us  pt-5">
      <div class="coonect-with__div">
          <div class="text-center main--info__connect pt-5"  data-aos="fade-up"  data-aos-duration="400" >
              <h1 class="headline--main-2">تواصل معنا</h1>
             <div class="my-2"></div>
              <!-- <p class="mian--paragraph my-1 text-center d-block">@JazanUC</p> -->
          </div>
<div class="container--unocal">
  <div class="d-grid connect-grid">
      <div class="g-col-2"  data-aos="fade-down"  data-aos-duration="700"  >

        <div class="single--connect__div">
            <div class="flex-col single--content__main">
                <img src="./img/raphael-lovaski-pxax5WuM7eY-unsplash.jpg" alt="" class="connect--img__single">
                <div class="hover--content__img--connect">
           <div class="flex-col">
           <i class="fab fa-twitter icon_socail twitter_icon_social"  ></i>
               <a href="https://twitter.com/ju_skills?lang=ar">
                <h1 class="hedaline--connect__hoverd ">@Ju Skills</h1>
               </a>
             
           </div>
                </div>
            </div>     
        </div>

        <div class="single--connect__div">
            <div class="flex-col single--content__main">
                <img src="./img/freestocks-AFvUO61NlOU-unsplash.jpg" alt="" class="connect--img__single">
                <div class="hover--content__img--connect">
                  <div class="flex-col">
                  <i class="fab fa-instagram icon_socail insta_icon_social"  ></i> 
                  
                      <a href="https://instagram.com/sklis.club1?utm_medium=copy_link">
                      <h1 class="hedaline--connect__hoverd ">@Skills Club 1</h1>
                      </a>
                     
                   </div>
                      </div>
            </div>     
        </div>



      </div>
        </div>
</div>
          

      </div>
      </section>


      <!-----------------END CONNECT WITH US----------------->


    <!-----------------SKILLS REQUIRED-------------------->
   <section class="skills-required__section">
    <div class="container-sm">
      
    </div>
   </section>
    <!-----------------END SKILLS REQUIRED-------------------->

           <!-----------------FROM OUR BLOG-------------------->
         
           <!-----------------END FROM OUR BLOG-------------------->

<?php  
 include $templates . '/footer.php';

  ?>