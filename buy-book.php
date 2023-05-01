
<?php require "includes/dashboard-header.php"; ?>
<?php

if(isset($_GET['item_id'])){
    $item_id = $_GET['item_id'];
}

$sql = "SELECT * FROM tutorial WHERE tutorial_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $item_id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $rows = $result->fetch_assoc();
        $user_id = $rows['teacher_id'];
        $course_title = $rows['course_title'];
        $price = $rows['amount'];
        $sql1 = "SELECT * FROM users WHERE user_id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $user_id);
        if($stmt1->execute()){
            $result1 = $stmt1->get_result();
            if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
        
?>
<style>
.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 20px;
}

.teacher {
  border: 1px solid #ccc;
  padding: 20px;
  margin-bottom: 50px;
  text-align: center;
  position: relative;
}

.teacher-img {
  margin-bottom: 20px;
 
}
.teacher-img img{
    max-width: 100%;
    border-radius: 50%;
    height: 12rem;
}

.teacher-info {
  padding: 10px;
}

.teacher-info h3 {
  margin-top: 0;
}

.teacher-info p {
  margin-bottom: 5px;
}

.enroll-btn {
  position: absolute;
  bottom: -30px;
  left: 50%;
  transform: translateX(-50%);
  transition: all 0.3s ease-in-out;
}

.enroll-btn:hover {
  bottom: -20px;
}

.contact_agent{
  background-color: rgba(0,0,0,.5);
  color: #fff;
}
</style>
<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem; background-color: #fff;">
        <?php require "includes/nav.php"; ?>

        <div class="col-md-4">
      <div class="teacher">
        <div class="teacher-img">
          <img src="uploads/<?= $row1['image']; ?>">
        </div>
        <div class="teacher-info">
          <h3><?= $course_title; ?></h3>
          <p><?= $row1['school']; ?></p>
          <p class="text-success"><?= $price; ?></p>
          <?php 

          if($price != ""){
            ?>
             <a href="#" class="btn enroll-btn" style="background: blue; color: #fff; font-weight: 700;">Pay Now</a>
             <?php
          } else {
            ?>
            <a href="download.php?path=uploads/<?= $rows['container']; ?>" class="btn enroll-btn" style="background: blue; color: #fff; font-weight: 700;">Download Book</a>
            <?php
          }
?>
         
        </div>
      </div>
    </div>

    <div class="card" style="padding-top: 2rem;">
            <div class="card-body">
              <h3 class="card-title text-center" style="padding-bottom: 1rem;">Break Down</h3>

              <!-- Dark Table -->
              <table class="table table-dark table-striped table-hover table-bordered">
                <tbody class="text-center">
                  <tr>
                    <td>Price</td>
                    <td><?= $price; ?></td>
                  </tr>
                  <tr>
                    <td>Availability</td>
                    <td>In Stock</td>
                  </tr>
                  <tr>
                    <td>School</td>
                    <td><?= $row1['school']; ?></td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td>Books</td>
                  </tr>
                  <tr>
                    <td>Posted</td>
                    <td><?= $rows['timestamp']; ?></td>
                  </tr>
                </tbody>
              </table>
              <!-- End Dark Table -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">

              <!-- List group with Advanced Contents -->
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" style="background-color: blue; color: #fff;" aria-current="true">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Book Description</h5>
                  </div>
                  
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                  <p class="mb-1"><?= $rows['description'] ?></p>
                </a>
               
              </div><!-- End List group Advanced Content -->

            </div>
          </div>

          <div class="mt-5">
          
          <h3 class="mb-5">Sellers Info</h3>
  
          <a class="contact_agent form-control text-center"><?= $row1['email']; ?></a><br />
          <a class="contact_agent form-control text-center"><?= $row1['telephone']; ?></a><br />
          <a href="connect-seller.php?id=<?= $row1['user_id']; ?>" class="contact_agent form-control text-center">Chat Seller</a><br />
          </div>


          <?php
  }
}
}
}

?>


  <?php require "includes/dashboard-footer.php"; ?>