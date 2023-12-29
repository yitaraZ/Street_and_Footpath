<?php

@include 'config.php';

session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>
   <section class="placed-orders">
    <div class="flex-btn">
         <a href="index.php" class="option-btn">go back</a>
      </div>
      <h1 class="title">รายละเอียด</h1>
      <div class="box-container">
         <?php
         $pid = $_GET['pid'];
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
         $select_orders->execute([$pid]);
         
         
         //$select_complete->execute([$pid]);
         if ($select_orders->rowCount() > 0) {
            $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
            $status = $fetch_orders['status'];

            if ($status == 'pending') {
         ?>
               <div class="box">

                  <img src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="">
                  <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                  
                  <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
                  <p> method : <span><?= $fetch_orders['method']; ?></span> </p>
                  <p> problem : <span><?= $fetch_orders['problem']; ?></span> </p>
                  <p> status : <span style="color:<?php if ($status == 'pending') {
                                                      echo 'red';
                                                   } else {
                                                      echo 'green';
                                                   }; ?>"><?= $status; ?></span> </p>
               </div>
              
               
            
            <?php
            } else if ($status == 'completed') {
               $select_complete = $conn->prepare("SELECT * FROM `cm_problems` JOIN `orders` ON `cm_problems`.`pid` = `orders`.`id` WHERE `orders`.`id` = ?
               ");
               $select_complete->execute([$pid]); 
               $fetch_complete = $select_complete->fetch(PDO::FETCH_ASSOC);
            ?>
               <div class="box">
                  <p> Before </span> </p>
                  <img src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="">
                  <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                  <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
                  <p> method : <span><?= $fetch_orders['method']; ?></span> </p>
                  <p> problem : <span><?= $fetch_orders['problem']; ?></span> </p>
                  <p> status : <span style="color:<?php if ($status == 'pending') {
                                                      echo 'red';
                                                   } else {
                                                      echo 'green';
                                                   }; ?>"><?= $status; ?></span> </p>
               </div>
               <div class="box">
                  <p> After </span> </p>
                  <img src="uploaded_img/<?= $fetch_complete['c_image']; ?>" alt="">
                  <p> fix date : <span><?= $fetch_complete['c_place_on']; ?></span> </p>
                  <p> name : <span><?= $fetch_complete['name']; ?></span> </p>
                  
                  <p> address : <span><?= $fetch_complete['address']; ?></span> </p>
                  <p> method : <span><?= $fetch_complete['method']; ?></span> </p>
                  <p> problem : <span><?= $fetch_complete['problem']; ?></span> </p>
                  <p> status : <span style="color:<?php if ($status == 'pending') {
                                                      echo 'red';
                                                   } else {
                                                      echo 'green';
                                                   }; ?>"><?= $status; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">ยังไม่ได้แจ้งปัญหาใด ๆ</p>';
         }
         ?>


      </div>


   </section>








   <script src="js/script.js"></script>

</body>

</html>