<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $problem = $_POST['problem'];
   $problem = filter_var($problem, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

  
   $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, method, problem, address, image, placed_on) VALUES(?,?,?,?,?,?,?)");
   $insert_order->execute([$user_id, $name, $method, $problem, $address, $image, $placed_on]);
   
   if($insert_order){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'แจ้งเรื่องสำเร็จ';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>


<section class="contact" >

   <h1 class="title">แจ้งปัญหาที่พบเจอ</h1>

   <form action="" enctype="multipart/form-data" method="POST">
      <input type="text" name="name" class="box" required placeholder="ชื่อของคุณ">
      <div class="inputBox">
            <select name="method" class="box" required>
               <option value="street">ถนน</option>
               <option value="footpath">ทางเท้า</option>
            </select>
         </div>
      <input type="text" name="problem" class="box" required placeholder="ปัญหาที่ต้องการแจ้ง">
      <textarea name="address" class="box" required placeholder="รายละเอียดของสถานที่" cols="30" rows="10"></textarea>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="order" class="btn" value="ส่งข้อความ">
   </form>

</section>










<script src="js/script.js"></script>

</body>
</html>