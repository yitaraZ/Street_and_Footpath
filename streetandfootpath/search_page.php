<?php

@include 'config.php';

session_start();

if (isset($_SESSION['email'])) {
   $user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="search-form">

   <form action="" method="POST">
      <input type="text" class="box" name="search_box" placeholder="ค้นหา...">
      <input type="submit" name="search_btn" value="search" class="btn">
   </form>

</section>

<?php



?>

<section class="placed-orders" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
      if(isset($_POST['search_btn'])){
      $search_box = $_POST['search_box'];
      $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE problem LIKE '%{$search_box}%' OR method LIKE '%{$search_box}%'");
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
         echo '<p class="empty">no result found!</p>';
      }
      
   };
   ?>

   </div>

</section>







<script src="js/script.js"></script>

</body>
</html>