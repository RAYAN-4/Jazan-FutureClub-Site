
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark px-md-5">
        <a class="navbar-brand" href="index.php">
        نادي مهارات المستقبل
    
        </a>
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item mr-2">
              <a class="nav-link" href="<?php echo BASE_URL . '/index.php' ?>">الصفحة الرئيسية</a>
            </li>
            <li class="nav-item mr-2 <?php echo isset($_GET['posts']) ? 'active' : '' ?>">
              <a class="nav-link" href="posts.php?posts&page=1">المنشورات</a>
            </li>
            <li class="nav-item <?php echo isset($_GET['users']) ? 'active' : '' ?>" >
              <a class="nav-link" href="users.php?users&page=1">المستخدمين</a>
            </li>

            <li class="nav-item <?php echo isset($_GET['events']) ? 'active' : '' ?>">
              <a class="nav-link" href="events.php?events&page=1">الفعاليات</a>
            </li>
            <li class="nav-item <?php echo isset($_GET['competions']) ? 'active' : '' ?>">
              <a class="nav-link" href="competion.php?competions&page=1">المسابقات</a>
            </li>
            <li class="nav-item <?php echo isset($_GET['questions']) ? 'active' : '' ?>">
              <a class="nav-link" href="questions.php?questions&page=1">الاسئلة</a>
            </li>
            <li class="nav-item <?php echo isset($_GET['teams']) ? 'active' : '' ?>">
              <a class="nav-link" href="teams.php?teams&page=1">الفرق</a>
            </li>

            <li class="nav-item <?php echo isset($_GET['answers']) ? 'active' : '' ?>">
              <a class="nav-link" href="answers.php?answers">الاجابات</a>
            </li>
            
          </ul>
      </nav> <!--End nav-->