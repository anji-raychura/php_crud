<?php
session_start();
include("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verify CAPTCHA first
  $recaptchaSecret = '6LeboBcrAAAAAPyGTrt-IqcL6JVwYdaaBZQc2pY6';
  $recaptchaResponse = $_POST['g-recaptcha-response'];
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
  $responseKeys = json_decode($response, true);

  if (!$responseKeys["success"]) {
      die("CAPTCHA failed. Please try again.");
  }



if(isset($_POST['login']))
{
  $email = trim($_POST['email']);    
  $password = trim($_POST['Pswd']);
  

  $query = "SELECT username, Pswd FROM newdata WHERE email = ?";
  $stmt = mysqli_prepare($conn, $query);
    
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);     
  //$row = mysqli_fetch_assoc($result);

  //print_r($row);
  if  ($row = mysqli_fetch_assoc($result))
    {      
        $hashedpwd= $row['Pswd']; // Hashed password from DB
        // echo "Entered Password: $password<br>";
        // echo "Stored Hashed Password: $hashedpwd<br>";
        // Verify password
        // $verify = password_verify($password, $hashedpwd);
        // echo "Entered Password: " . $password . "<br>";
        // echo "Stored Hashed Password: " . $hashedpwd . "<br>";
        // echo "Length: " . strlen($hashedpwd) . "<br>";
        if (password_verify($password, $hashedpwd))
        {
        //  echo " Password matched!";
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $email;

            header("Location: index.php");
            exit();   
        } 
        else
         {
            echo "incorrect Password";
            // exit();
         }
    } 
    else
     {
        echo "<script>alert('No user found with this email!'); window.location.href='login.php';</script>";
        echo "Query executed: " . $query . " with email: " . $email;
        // exit();
     }

}

}
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:49 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>Login</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="https://themewagon.github.io/Mantis-Bootstrap/assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="../assets/css/style-preset.css" >

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="#"><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/logo-dark.svg" alt="img"></a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="register.php" class="link-primary">Don't have an account?</a>
            </div>
            <form action="" method="POST" autocomplete="off">
            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="Pswd" placeholder="Password" required>
            </div>

            <div class="g-recaptcha" data-sitekey="6LeboBcrAAAAAFGY-5h3A5xNXzpECSAx_yXZJPwN" required>
            </div>

            <div class="d-flex mt-1 justify-content-between">
              <!-- <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
              </div> -->
             <a href="forgot.php"><h5 class="link-primary">Forgot Password?</h5></a>
            </div>
            <div class="d-grid mt-4">
              <input type="submit" class="btn btn-primary" name="login"></button>
            </div>
            </form>   
          </div>
        </div>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <!-- <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div> -->
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
 
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:54 GMT -->
</html>

