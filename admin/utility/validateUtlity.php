<?php

 
function validatePost($post , $checkedConds = [] , $tablename , $checkFor ) {
    $errors = array();
    $i = 0;
    foreach($checkedConds as $key => $value) {
       if (empty($post[$key])) {
         array_push($errors , "Field $value Required");
       }
    }


    // // IF THERE IS NO ERRORS

    // CHECHK IF EMAIL ALREADY EXIST
    //selectOne($tablename , [$checkFor => $post[$checkFor] ])
    $existingPost = selectOne($tablename, [$checkFor => $post[$checkFor]]);
    if ($existingPost) {

      // CHECKING IS USER TRYING TO UPDATE OR CREATE NEW POST
      // CHECING ALSO IF THE POST IN THE DATABASE IS NOT THE POST TRYING TO UPDATE
      if ( isset($post['update-post']) &&  $existingPost['id'] != $post['id'] ) {
        array_push($errors , 'Post with that title is already exist');
      }

      if (isset($post['add-post'])) {
        array_push($errors , 'Post with that title is already exist');
      }
    
    }

    return $errors;
  } 

  function validateUser($user) {
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Password do not match');
    }

    // $existingUser = selectOne('users', ['email' => $user['email']]);
    // if ($existingUser) {
    //     array_push($errors, 'Email already exists');
    // }

    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
            array_push($errors, 'Email already exists');
        }

        if (isset($user['create-admin'])) {
            array_push($errors, 'Email already exists');
        }
    }

    return $errors;
  }

   // FUNCTION FOR VALIDATING USER LOGIN
  function validateLogin($user) {
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
  }

  function checkPasswordForUser($confirmVal , $passCol , $tablename , $whereCol ) {
    $email = $_SESSION['userLoggedIn'];
    $pws = $_POST["$confirmVal"];
    $query = mysqli_query($connection , "SELECT $passCol FROM $tablename WHERE $whereCol = '$email'");
    $record = mysqli_fetch_array($query);
    $hashPwd = md5($pws);
    $pwdFromDb = $record["$passCol"];
 
    if ($pwdFromDb == $hashPwd) {
    return true;
  } else {
    return false;
  }

  }

  
  function loginUser($user)
{
   

    $_SESSION['id'] = $user['user_id'];
    $_SESSION['email'] = $user['user_email'];
    $_SESSION['username'] = $user['user_name'];
    $_SESSION['user_pic'] = $user['user_image'];
    $getTeamInfo = selectOne("joinedteams" , array(
      'user_id' => $user['id'] 
    ) );
    $_SESSION['join_team_id'] = $getTeamInfo['joined_team_id'];
    $_SESSION['join_team_name'] = $getTeamInfo['joined_team_name'];
   
   
    $_SESSION['admin'] = $user['user_group_id'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';
 
    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . '/admin/index.php'); 
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

function signInUser($user , $checkedConds , $tablename , $checkFor) {
  unset($_POST['login_user']);
  global $errors;
  $errors = validatePost($user , $checkedConds , $tablename , $checkFor );


  if (count($errors) == 0) {
    $selectdUser = selectOne($tablename , [$checkFor => $user[$checkFor] ] );
   
    if ($selectdUser === null) {
    
      array_push($errors , "No Such Email");
    
    }
  

    if ($selectdUser && sha1($user['user_password']) == $selectdUser['user_password']  ) {
  
      loginUser($selectdUser);
    } else {
     
      array_push($errors , "Wrong Credentials");
     
    }
  }
}

function logoutUser($destroySessions , $redirect = 'index.php') {

  foreach($destroySessions as $key => $value) {
    unset($_SESSION[$value]);
  }

  session_destroy();
  header('location: ' . BASE_URL . "/$redirect");
   
}

function singUpUser($signupUser , $table) {
  unset($_POST['signup_user']);
  global $errors;

  $checkArrays = [
      'user_name' => 'User Name' , 
      'user_email' => 'User Email' ,
        'user_password' => 'User Password'
      ];
       // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
$errors = validatePost($signupUser , $checkArrays , $table , 'user_email');

if (count($errors) == 0) {
  $_POST['user_group_id'] = 0;
  $_POST['user_password'] = sha1($_POST['user_password']);
 
  $user_id = create($table , $_POST);
  $user = selectOne($table, ['user_id' => $user_id]);
  loginUser($user);
}
}