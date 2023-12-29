<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $pid = $_POST['pid'];
   $cplaced_on = date('d-M-Y');
   

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
 

   if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $update_product = $conn->prepare("INSERT INTO `cm_problems`(pid,c_image,c_place_on) VALUES(?,?,?)");
      $update_product->execute([$pid,$image,$cplaced_on]);
  
      $order_id = $_POST['order_id'];
      $update_status = $_POST['update_payment'];
      $update_status = filter_var($update_status, FILTER_SANITIZE_STRING);
      $update_orders = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
      $update_orders->execute([$update_status, $order_id]);
  
      $message[] = 'report updated successfully!';
  } else {
      $message[] = 'Error uploading the image file.';
  }
  
  
  
  
  
  
  
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/adminstyle.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update report</h1>   

   <?php
      $update_id = $_GET['update'];
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
      $select_orders->execute([$update_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_orders['id']; ?>">
      <img src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="" style="width:100%">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <div class="box">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="update_payment" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['status']; ?></option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
         </select>
         </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="update status" name="update_product">
         <a href="admin_orders.php" class="option-btn">go back</a>
      </div>
      
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>













<script src="js/script.js"></script>

</body>
</html>