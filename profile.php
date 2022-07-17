<?php  


$pageTitle = "صفحة الملف الشخصي";
include 'init.php';

$userId = $_SESSION['id'];

$userId = isset($userId) && is_numeric($userId) ? intval($userId) : 0;

$selectedUser = selectOne("joinedusers" , array(
    'user_id' => $userId
) );
//unset($selectedUser['user_password']);
 
if (isset($_POST['update_user_profile'])) {

    global $errors;
  
   if (  !(sha1($_POST['user_oldpassword']) == $selectedUser['user_password'] )  ) {
        array_push($errors , "Wrong Password");
   }



   if (!empty($_FILES['user_image']['name'])) {
  
    $uploadFile_type = $_FILES['user_image']['type'];
    
    $allowedTypes = array('image/gif','image/jpg','image/png' , "image/jpeg");
    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['user_image']['name'];
   
      $destination = ROOT_PATH_MAIN . "/admin/assets/images/" . $image_name;
       
      $result = move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
      if ($result) {
        //  delete('/assets/images/' . $_POST['prev_image'] );
         $_POST['user_image'] = $image_name;
      } else {
          array_push($errors, "Failed to upload image");
      }
    }
     
   
}  else {
    unset($_POST['user_image']);
}
 

 if (count($errors) == 0) {
    global $conn;
    unset($_POST['user_oldpassword']);
      //unset($_POST['prev_image']);
    $userId = $_POST['id']; 
    $userId = is_numeric($userId) ? intval($userId) : 0 ; 
    if ($userId > 0) {

        unset($_POST['id']);
        if (!empty($_POST['user_password'])) {
        $_POST['user_password'] = sha1($_POST['user_password']);
        } else {
            unset($_POST['user_password']);
        }
        $tablename = "joinedusers";
        unset($_POST['update_user_profile']);
         
       $user_id = update("joinedusers", $userId , $_POST , 'user_id'  );
       $_SESSION['username'] = $_POST['user_name'];
       $_SESSION['email'] = $_POST['user_email'];
       $_SESSION['user_pic'] = $_POST['user_image'];
      
        $_SESSION['message'] = "User updated successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/index.php"); 
        exit(); 
    } else {
        $_SESSION['message'] = "Failed To Updated The Post";
        $_SESSION['type'] = "failed";
        header("location: " . BASE_URL . "/index.php"); 
        exit(); 
    }
} 
} 

?>



        <!----------------- HEROAREA-------------------->
        <section class="heroarea__main--div" style="background: linear-gradient(rgba(0,0,0,0.2) , rgba(0,0,0,0.3)) , url('./images/heroarea/pexels-matej-1074882.jpg') center / cover no-repeat;" >
            <div class="flex-col">
                <h1 class="headline--main-bg">صفحة الملف الشخصي</h1>
            </div>
        </section>
       <!-----------------END HEROAREA-------------------->

     <!----------------- BLOG PAGE-------------------->
     <div class="mt-5"></div>

     <div class="main--profile__page container">
     <?php  include  ROOT_PATH_MAIN . '/includes/templates/formErrors.php'  ?>
      <div class="d-grid grid-profile">
          <div class="g-col-2">
          <div class="image_profile--div">
            <img src="./images/blog/flat-illustration-people-04.jpg" class="profile_image_main" alt="">
             </div>
          <div class="info_profile--div">
             <div class="mt-4"></div>
      <h1 class="main--headline__heroarea text-right">المعلومات الشخصية</h1>
      <label  class="label_info text-right" >يرجى ادخال كلمة المرور لتعديل معلوماتك الشخصية  </label>
      <div class="mt-4"></div>
             <form method="POST" class="text-right"  enctype="multipart/form-data"  >
     <input type="hidden" name="id" value="<?php echo $selectedUser['user_id'] ?>" >
<div class="form-group__div ">
    <label for="username_user" class="label_profile" >اسم المستخدم</label>
    <input type="text" name="user_name" value="<?php echo $selectedUser['user_name'] ?>"  id="username_user" class="profile_input">
</div>

<div class="form-group__div ">
    <label for="email_user"  class="label_profile" > الايميل</label>
    <input type="text" name="user_email" value="<?php echo $selectedUser['user_email'] ?>"  id="email_user" class="profile_input">
</div>

<div class="form-group__div ">
    <label for="password_user"   class="label_profile" >  كلمة المرور القديمة </label>
    <input type="password" name="user_oldpassword"  id="password_user" class="profile_input">
</div>

<div class="form-group__div ">
    <label for="new_password_user"  class="label_profile" >  كلمة المرور الجديدة </label>
    <input type="password" name="user_password"  id="new_password_user" class="profile_input">
</div>

<div class="form-group__div ">
    <img src="<?php echo $selectedUser['user_image'] ? BASE_URL . '/admin/assets/images/' . $selectedUser['user_image'] : '' ?>" class="image_profile_user" alt="">
    <label for="image_user" class="label_profile" > الصورة</label>
    <input type="file"  name="user_image"  id="image_user" class="profile_input" >
</div>
 
     <input type="submit" name="update_user_profile" class="btn-heroarea-btn" value="تحديث">
</form>

<div class="general_information__div text-right">
<div class="mt-4"></div>
<h1 class="main--headline__heroarea ">المعلومات العامة</h1>
<div class="mt-4"></div>
<div class="form-group__div ">
  
    <label for="image_user" class="label_profile" > العضوية</label>
    <input type="text" readonly value="<?php echo $selectedUser['user_group_id'] == 1 ? 'مسئول' : 'مستخدم' ?>" class="profile_info">
</div>

<div class="form-group__div ">
  
    <label for="image_user" class="label_profile" > تاريخ الانضمام</label>
    <input type="text" readonly value="<?php echo $selectedUser['user_joined_date']  ?>" class="profile_info">
</div>

<div class="form-group__div ">
  
    <label for="image_user" class="label_profile" > الفريق </label>
    <input type="text" readonly value="<?php echo $selectedUser['user_team_joined']  ?>" class="profile_info">
</div>

</div>

             </div>

            
          </div>
      </div>
</div>
     

<?php  
 include $templates . '/footer.php';
?>