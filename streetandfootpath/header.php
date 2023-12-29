<?php


if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

if (isset($_SESSION['email'])) {
   $user_id = $_SESSION['user_id'];
}

?>

<header class="header2">

<div class="flex">

   <a href="index.php" class="logo">Street & Footpath<span>.</span></a>
   
</div>

</header>
<header class="header">

   <div class="flex">

      <nav class="navbar">
         <a href="index.php">หน้าหลัก</a>
         <?php if (!isset($_SESSION['email'])) {  ?>
            <a href="login.php">ปัญหาของฉัน</a>
            <a href="login.php" class="navbar">แจ้งปัญหา</a>
            <?php
            } else {
               ?>
               <a href="myproblem.php">ปัญหาของฉัน</a>
               <a href="contact.php" class="navbar">แจ้งปัญหา</a>
            <?php
            }
         ?>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         
      </div>

      <div class="profile">
      
         
         <?php if (!isset($_SESSION['email'])) {  ?>
               <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div>
            <?php
            } else {
               ?>
                  <?php
                  $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                  $select_profile->execute([$user_id]);
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
               <p><?= $fetch_profile['name']; ?></p>
               <a href="user_profile_update.php" class="btn">update profile</a>
               <a href="logout.php" class="delete-btn">logout</a>
            <?php
            }
         ?>
         
      </div>

   </div>

</header>