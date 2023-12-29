<?php

@include 'config.php';

session_start();

//$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Street and footpath problem!</span>
         <h3>ทางเท้าและท้องถนนเป็นของทุกคน</h3>
         <p>แจ้งปัญหาได้เลยที่นี่</p>
      </div>

   </section>

</div>
<?php include 'satistic.php'; ?>
<section class="home-category">
   
   <h1 class="title">หมวดหมู่ปัญหา</h1>

   <div class="box-container">

      <div class="box">
         <h3>ถนน</h3>
         <a href="category.php?category=street" class="btn">Street</a>
      </div>

      <div class="box">

         <h3>ทางเท้า</h3>
         <a href="category.php?category=footpath" class="btn">Footpath</a>
      </div>

      

   </div>


<section class="placed-orders">

   <h1 class="title">ติดตามผลลัพธ์</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` ");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="">
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> problem : <span><?= $fetch_orders['problem']; ?></span> </p>
      <p> status : <span style="color:<?php if($fetch_orders['status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['status']; ?></span> </p>
      <a href="view_page.php?pid=<?= $fetch_orders['id']; ?>" class="option-btn">รายละเอียด</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">ยังไม่มีการแจ้งปัญหา</p>';
   }
   ?>

   </div>

</section>









<script src="js/script.js"></script>

</body>
</html>