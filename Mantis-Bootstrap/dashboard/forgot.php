<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:49 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>Login | Mantis Bootstrap 5 Admin Template</title>
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
              
            </div>
          <form method="POST" action="">
            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email">
            </div>
           
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary" name="send">Send</button>
            </div><br>
          </form>
            <a href="login.php" class="link-primary">Back</a>
            
         
          </div>
        </div>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div>
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
  
    
 
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 06:40:54 GMT -->
</html>

<?php
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
  $email = $_POST['email'];

  $forgot_query = "SELECT * FROM newdata WHERE  email = ?";
  $stmt = mysqli_prepare($conn, $forgot_query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);


  if($row = mysqli_fetch_assoc($result)) {
    // Generate a unique token
    $token = bin2hex(random_bytes(50));

    // Store token in the database
    $updateQuery = "UPDATE newdata SET reset_token=? WHERE email=?";  
    $stmt = mysqli_prepare($conn, $updateQuery);
    
    if (!$stmt) {
        die("Update query preparation failed: " . mysqli_error($conn));
    }
      
   // $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
    mysqli_stmt_execute($stmt);

    $reset_link = "http://localhost:800/allfiles/Mantis-Bootstrap/Mantis-Bootstrap/dashboard/reset.php?token=$token";

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                  
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                       
        $mail->Username = 'anjaliraychura1@gmail.com';    
        $mail->Password = 'xafmqbwezcbozhyq';      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;                           

        // Recipients
        $mail->setFrom('anjaliraychura1@gmail.com', 'Admin');
        $mail->addAddress($email);                  

        // Content
        $mail->isHTML(true);                         
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click the link below to reset your password: <a href='$reset_link'>$reset_link</a>";

        // Send the email
        $mail->send();
        
        header("Location: login.php");
        exit;
       } 
       catch (Exception $e) {
        echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
    }
}
else{
  echo "email not found";
}
}
?>