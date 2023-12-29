<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

/*if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'status has been updated!';

};*/



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/adminstyle.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="home-category">


   <div class="box-container">

      <div class="box">
      <h3>ถนน</h3>
         <a href="admin_category.php?category=street" class="btn">Street</a>
      </div>

      <div class="box">
      <h3>ทางเท้า</h3>
         <a href="admin_category.php?category=footpath" class="btn">Footpath</a>
      </div>

      

   </div>

</section>

<section class="placed-orders">

   <h1 class="title">ปัญหาที่แจ้งเข้ามา</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="" style="width:100%">
         <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
         <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
         <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
         <p> problem method : <span><?= $fetch_orders['method']; ?></span> </p>
         <p> status : <span style="color:<?php if($fetch_orders['status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['status']; ?></span> </p>
         <a href="admin_update.php?update=<?= $fetch_orders['id']; ?>" class="option-btn">update</a>
         
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">ยังไม่ได้แจ้งปัญหาใด ๆ</p>';
      }
      ?>

   </div>

</section>












<script src="js/script.js"></script>

</body>
</html>