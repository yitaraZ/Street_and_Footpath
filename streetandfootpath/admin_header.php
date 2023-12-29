<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
<header class="header2">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
   </div>
</header>
<header class="header">
   <div class="flex">
      <nav class="navbar">
         <a href="admin_page.php">หน้าหลัก</a>
         <a href="admin_orders.php">ปัญหาที่แจ้ง</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         <p><?= $fetch_profile['name']; ?></p>
         <a href="admin_update_profile.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         
      </div>

   </div>

</header>