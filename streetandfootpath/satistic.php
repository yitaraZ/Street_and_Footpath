<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/dashboard.css">

</head>

<body>

   <section class="dashboard">
      
      <div class="box-container">
         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount();
            ?>
            <p>ปัญหาทั้งหมด</p>
            <h3><?= $number_of_orders; ?></h3>
            <p>เรื่อง</p>
         </div>

        <div class="box">
            <?php
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
            $select_pendings->execute(['pending']);
            $number_of_pendings = $select_pendings->rowCount();
            ?>
            <p>ดำเนินการ</p>
            <h3><?= $number_of_pendings; ?></h3>
            <p>เรื่อง</p>

         </div>

         <div class="box">
            <?php
            $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
            $select_completed->execute(['completed']);
            $number_of_completed = $select_completed->rowCount();
            ?>
            <p>เสร็จสิ้น</p>
            <h3><?= $number_of_completed; ?></h3>
            <p>เรื่อง</p>

         </div>
         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE method = ?");
            $select_orders->execute(['street']);
            $number_of_orders = $select_orders->rowCount();
            ?>
            <p>ปัญหาท้องถนน</p>
            <h3><?= $number_of_orders; ?></h3>
            <p>เรื่อง</p>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE method = ?");
            $select_orders->execute(['footpath']);
            $number_of_orders = $select_orders->rowCount();
            ?>
            <p>ปัญหาทางเท้า</p>
            <h3><?= $number_of_orders; ?></h3>
            <p>เรื่อง</p>
         </div>


      </div>

   </section>













   <script src="js/script.js"></script>

</body>

</html>