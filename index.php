<?php 
$page_id='login';
include('include/config.php');
if(isset($_SESSION['is_verify_logged_in']))
{  
      header("location:home?page_name=home");   
      die;
      exit();
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= site_name ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">ERP</h1>
            </div>
            <h3>Welcome to <?= site_name ?></h3>          
            <p>Sign In.</p>
            <form class="m-t"  method="POST" action="login.php">
                <div class="form-group">
                    <input type="text" name="username" id='username' class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id='passsword' class="form-control" placeholder="Password" required="">
                </div>
                <input type="submit" id='submit' value="Login" style="background-color: #20ABB5;" class="btn btn-primary block full-width m-b"></button>
            </form>
            <p class="m-t"> <small><?= site_name ?> &copy; <?= date('Y')?></small> </p>
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>



</body>
</html>
