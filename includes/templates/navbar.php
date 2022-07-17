 <?php  


  if (isset($_POST['logout_user'])) {
    $sessionDestory = array(
    'id' => 'id',
    'username' => 'username',
    'admin' => 'admin',
    'message' => 'message',
    'type' => 'type',
    );
    logoutUser($sessionDestory );
  }
 ?>
 
 <!-----------------NAVBAR-------------------->
 <div class="container">
        <nav class="navbar--flex-sp">
            <div class="logo-box">
                <a href="index.php">
                <img src="./futureSkillsLogo.png" alt="">
                </a>
              
            </div>

            <ul class="ul-flexed-nav d-flex-c">
                <li> <a href="index.php">الصفحة الرئيسية</a>  <img src="./images/icons/home.png" alt="" class="navbar__small-icon"> </li>

                <li> <a href="blog.php">المدونة</a>  <img src="./images/icons/blog.png" alt="" class="navbar__small-icon"> </li>

                <li> <a href="events.php">الفعاليات</a>  <img src="./images/icons/calendar.png" alt="" class="navbar__small-icon"> </li>

                <li> <a href="challenges.php">المسابقات</a>  <img src="./images/icons/competition.png" alt="" class="navbar__small-icon"> </li>
                <li> <a href="teams.php">الفرق</a>  <img src="./images/icons/account.png" alt="" class="navbar__small-icon"> </li>
               
              <?php  
              if (is_user_logged_in_web()) { ?>

                 <div class="nav--logged_in__div mx-2">
           
                     <div class="d-flex-c" >
                   
                    <img src="<?php echo  isset($_SESSION['user_pic']) ? BASE_URL . '/admin/assets/images/' . $_SESSION['user_pic'] : './images/avatar/51362610.jpg'  ?>" alt="" class="user_loggedin_avatar" style="width: 30px; height: 30px" >
                    <h6 class="user_loggedin_headline"> <?php echo $_SESSION['username'] ?> </h6>
                    <div class="toggle_menu">
                        <img src="./images/icons/down-chevron.png" id="toggle_dropdown_navbar" class="navbar__small-icon"" alt="">
                    </div>
                     </div>
                    

                     <div class="dropdown_menu_navbar" id="nav_area_dropdown" >
                        <ul class="dropeddown_ul">
    
                        <li> <a href="profile.php">الملف الشخصي</a>  <img src="./images/icons/account.png" alt="" class="navbar__small-icon"> </li>
                        <form method="POST" >
                        <li> <a href="blog.php"> <input class="non_style_input" type="submit" name="logout_user" value="تسجيل الخروج" > </a>  <img src="./images/icons/logout.png" alt="" class="navbar__small-icon">  </li>
                        </form>
                       
                        </ul>
                     </div>
                    
                 </div>

             <?php } else { ?>
                <div class="nav--btns__div mx-2">
                    <a href="signup.php">
                    <button class="btn-signup_btn">انشاء حساب</button>
                    </a>
                   <a href="login.php">
                   <button class="btn-login_btn"> تسجيل الدخول</button>
                   </a>
                   
                </div>
            <?php  }
              ?>

            </ul>

            <div class="mobile--menu__div"  >
                <div class="sidebar__mobile" id="sidebar__mobile"  >
                    <div class="box__div"></div>
                    <div class="box__div"></div>
                    <div class="box__div"></div>
                </div>

                <div class="main--sidebar__div">
                    <div class="closing__sidebar">
                    <i class="far fa-times-circle closing_navbar_icon" style="cursor:pointer;" id="close_sidebar" ></i>
                    </div>
                    <ul class="sidebar__block">
                    <li> <a href="index.php">الصفحة الرئيسية</a>  <img src="./images/icons/home.png" alt="" class="navbar__small-icon"> </li>

<li> <a href="blog.php">المدونة</a>  <img src="./images/icons/blog.png" alt="" class="navbar__small-icon"> </li>

<li> <a href="events.php">الفعاليات</a>  <img src="./images/icons/calendar.png" alt="" class="navbar__small-icon"> </li>

<li> <a href="challenges.php">المسابقات</a>  <img src="./images/icons/competition.png" alt="" class="navbar__small-icon"> </li>


                    </ul>
                    <?php  
                      if (is_user_logged_in_web()) { ?>
               <ul class="sidebar__block">
               <li> <a href="profile.php">الملف الشخصي</a>  <img src="./images/icons/account.png" alt="" class="navbar__small-icon" style="cursor: pointer;" > </li>
                        <form method="POST" style="cursor:pointer;" >
                        <li  > <a style="color: #fff"  href="blog.php"> <input class="non_sty xle_input" type="submit" name="logout_user" value="تسجيل الخروج" > </a>  <img src="./images/icons/logout.png" alt="" class="navbar__small-icon">  </li>
                        </form>
               </ul>
                    <?php  } 
                    else {  ?>
  <div class="text-right">
                    <div style="cursor:pointer;" class="mt-1" >
                        <a   href="signup.php">
                        <button class="btn-signup_btn">انشاء حساب</button>
                        </a>
                   
                    </div>
               <div style="cursor:pointer;" class="mt-1" >
                <a  href="login.php">
                <button class="btn-login_btn"> تسجيل الدخول</button>
                </a>
             
               </div>
   
                </div>
                      <?php }
                    ?>
                 
   

                </div>
            </div>

            
        </nav>
    </div>

    
    <!-----------------END NAVBAR-------------------->