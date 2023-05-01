
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/easylearn/logo4.png" rel="icon">
    <link href="./assets/img/easylearn/logo4.png" rel="apple-touch-icon">

    <title>Eazy Learn</title>
    <link rel="stylesheet" href="vendors/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/query.css">
    <link rel="stylesheet" href="./assets/css/sweetalert.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>

    <section class="container-fluid index-wrapper" style="padding-top: 9rem;">
       <?php require_once "includes/nav.php"; ?>
        <!-- ================= Navigation ================== -->
        <?php require_once "includes/footer-nav.php"; ?>
        <!-- End Navigation -->

        <!-- ================= Feeds ================== -->
        <div class="feed-wrapper" style="padding-top: 3.5rem;">

       
        <!-- End Feeds -->
    </section>

   <?php require_once "includes/dashboard-footer.php"; ?>

   <script>
    
    $(document).ready(function(){
    
        fetch_user();

        $(document).on('click', '.feed-text', function(){
            location.href = 'create-post.php';
        });

        setInterval(function(){
            fetch_user();
        }, 5000);

        function fetch_user(){
            $.ajax({
                url:"backend/blog.php",
                method: "POST",
                success: function(data){
                    $(".feed-wrapper").html(data);
                }
            });
        }

       
    });
   </script>
