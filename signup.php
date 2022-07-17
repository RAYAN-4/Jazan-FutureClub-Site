<?php  
  
 

  $pageTitle = "صفحة التسجيل";
  $table = "joinedusers";
  include 'init.php';
  guestsOnly();

  if (isset($_POST['signup_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    singUpUser($_POST , $table);

}


  ?>
             <div class="mt-5"></div>
                <!-----------------SIGNUP FORM-------------------->
                <div class="py-2">
                <?php  include  ROOT_PATH_MAIN . '/includes/templates/formErrors.php'  ?>
                    <div class="main--sinupform__div container-big">
                        <div class="singupform__div">
                            <div class="d-grid grid-signupform">
                                <div class="g-col-2"8>
    
                                    <div class="signupform__div">
                                        <div class="single-background__div" style="background: linear-gradient(rgba(255,255,255,0.9) , rgba(255,255,255,0.6)),url('./images/singup/flat-illustration-people-05.jpg')" >
                                        <div class="inside--singup__div flex-col">
                                            <h1 class="headline--main">مرحبا بك في نادي مهارات المستقبل </h1>
                                            <p class="mian--paragraph mt-1">من خلال انشاء حسابك فانك تقر بالشروط والاحكام الخاصة بالنادي والموقع</p>
                                        </div>
                                        </div>
                                    </div>
    
    
                                    <div class="info__div--singup py-2 flex-col">
                                 <h1 class="headline--main-2">سجل الان</h1>
                               
                                 <p class="mian--paragraph-sm mt-1">لديك حساب بالفعل ؟   <span class="gothought_a">سجل الدخول </span>   </p>
    
                                 <div class="mt-5"></div>
                                 <form action="" method="POST" class="singup__form">
    
                                     <div class="signup__form--div">
                                         <div><label for="" class="singup__label">اسم المستخدم</label></div>
                                         <input name="user_name" type="text" placeholder="ادخل اسم المستخدم" class="singup__input">
                                     </div>
    
                                     <div class="signup__form--div">
                                         <div><label for="" class="singup__label">الايميل </label></div>
                                         <input name="user_email" type="text" placeholder="ادخل الاميل الخاص بك" class="singup__input">
                                     </div>
    
                                     <div class="signup__form--div">
                                         <div><label for="" class="singup__label">كلمة المرور </label></div>
                                         <input name="user_password" type="password" placeholder="ادخل كلمة المرور الخاصة بك" class="singup__input">
                                     </div>
                  <input type="submit" name="signup_user" value="انشاء حساب" class="singup_btn" >
                                 </form>
                                    </div>
    
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-----------------END SIGNUP FORM-------------------->
                <?php  
 include $templates . '/footer.php';
?>