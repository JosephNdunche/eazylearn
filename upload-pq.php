<?php 
session_start();
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
require "database/connection.php";
require "header.php"; 
//require "backend/upload-pq.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
if($stmt->execute()){
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    }
}
?>
<body>
    <section class="container-fluid login-wrapper pt-3">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                <div class="login-form">
            <a href="javascript:history.back();" style="font-size: 1.4rem;"><i class="bi bi-arrow-left" style="margin-right: .5rem;"></i> Past Question</a>
            <img src="./assets/img/easylearn/ass.jpg" style="border-radius: 10px;" class="mt-4 pre-login-img img-responsive">
                <h2 class="pt-5" style="font-size: 2rem; line-height: 1.3;">Upload Past Question</h2>
                <a href="edit-pq.php" style="color:blue; font-weight: 500; font-size: 1.1rem;">Edit Past Question</a>
                <form id="p_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <?php
                        if(isset($error['file'])){
                            echo $error['file'];
                        }
                        ?>
                    <div class="input-group mb-4">
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php
                            $sql = "SELECT * FROM department";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while($school_rows = $result->fetch_assoc()){
                                        ?>
                                        <option value="<?= $school_rows['department_name']; ?>"><?= $school_rows['department_name']; ?></option>
                                        <?php
                                    }
                                }
                            }
                         ?>
                        </select>
                    </div>
                    <div class="input-group mb-4">
                       <input type="text" id="course_title" name="course_title" class="form-control" placeholder="Enter Course Title" required>
                    </div>

                    <div class="input-group mb-4">
                       <select id="ans" name="ans" class="form-control" required>
                        <option value="">Has the Past Question been answered?</option>
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                       </select>
                    </div>
  
                    <label for="">Past Question File</label>
                    <div class="input-group mb-4">
                       <input type="file" id="file" name="file" class="form-control" style="border: 2px solid rgba(0,0,0,.3);" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="pq-btn" id="p_btn" class="form-control getStarted-btn">Continue</button>
                    </div>
                </form>
               
            </div>
                </div>
            </div>
           
        </div>
    </section>
<?php require "footer.php"; ?>