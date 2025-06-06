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





if(isset($_POST['Sign_in']))
{
  $allowed_extensions = ['jpg', 'jpeg', 'png'];
$filename =  $_FILES["uploadfile"]["name"];
$tempname =  $_FILES["uploadfile"]["tmp_name"];
$file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (in_array($file_ext, $allowed_extensions)) {
    $folder = "imagess/" . $filename;
    if (!move_uploaded_file($tempname, $folder)) {
        die("File upload failed!");
    }
} else {
    die("Only JPG, JPEG, and PNG files are allowed.<br>");
}

 $username = $_POST['username'];
 $email = $_POST['email'];
 $Pswd = $_POST['Pswd'];       
 $confirm_pswd= $_POST['confirm_pswd'];
 $phone_no = $_POST['phone_no'];
 $signup = $_POST['date'];

 if (strlen($Pswd) < 5) {
  die("Error: Password must be at least 5 characters long.");
}
if ($Pswd !== $confirm_pswd) {
  die("Error: Passwords do not match.");

}

if (strlen($phone_no) != 10) {
  die("Enter valid phone number");
}

if (strlen($username) < 3) {
  die("<p style='color:red;'>Username must be at least 3 characters long.</p>");
}

 $hashed_password = password_hash($Pswd, PASSWORD_BCRYPT);


 $check_query = "SELECT * FROM newdata WHERE username = ? OR email = ? OR phone_no = ?" ;
 $stmt_check = mysqli_prepare($conn, $check_query);
 mysqli_stmt_bind_param($stmt_check, "sss", $username, $email, $phone_no);
 mysqli_stmt_execute($stmt_check);
 $result = mysqli_stmt_get_result($stmt_check);

 // If the username already exists, show an error message
 if (mysqli_num_rows($result) > 0) {
     die("Error: Username or Email or phone number already exists. Please choose a different one.");
 }

//  $check_email_query = "SELECT * FROM newdata WHERE email = ?";
//  $smtp_check = mysqli_prepare($conn, $check_email_query);
//  mysqli_stmt_bind_param($stmt_check, "s", $email);
//  mysqli_stmt_execute($stmt_check);
//  $result = mysqli_stmt_get_result($stmt_check);

//  if (mysqli_num_rows($result) > 0) {
//   die("Error: email already exists.");
// }



$query = "INSERT INTO newdata(image_source, username, email, Pswd, confirm_pswd, phone_no, signup_date)
VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssssss", $folder, $username, $email, $hashed_password, $confirm_pswd, $phone_no, $signup);


if (mysqli_stmt_execute($stmt)) {
    echo "Data inserted successfully!";
    header('Location: login.php');    
} else {
    die("Error: " . mysqli_error($conn));  // Show MySQL error
}
}
}
?>




<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 07:03:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <title>Sign up </title>
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
<link rel="stylesheet" href="../assets/css/style-preset.css">

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
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="card my-8">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-5"><b>Sign up</b></h3><br>
              <a href="login.php" class="link-primary">Already have an account?</a>
            </div>
            <div class="row">            
              <div class="col-md-">


              <div class="form-group mb-3">
                  <label class="form-label">image</label>
                  <input type="file" class="form-control" name="uploadfile" style="width:100%;" required>
                </div>


                <div class="form-group mb-3">
                  <label class="form-label">Username*</label>
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Email*</label>
              <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Password*</label>
              <input type="password" class="form-control" name="Pswd" placeholder="Password" required>
            </div> 
            <div class="form-group mb-3">
              <label class="form-label">Confirm Password*</label>
              <input type="password" class="form-control" name="confirm_pswd" placeholder="Password" required>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Phone No*</label>
              <input type="text" class="form-control" name="phone_no" placeholder="Mobile No">
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Signup date</label>
              <input type="date" class="form-control" name="date" placeholder="date" required>
            </div>

            <div class="g-recaptcha" data-sitekey="6LeboBcrAAAAAFGY-5h3A5xNXzpECSAx_yXZJPwN" required>
            </div>


            <div class="d-grid mt-3">
              <input type="submit" class="btn btn-primary" name="Sign_in" value="Create Account"></button>
            </div>

            
            <!-- <button type="submit">Submit</button> -->
            </div>
        </div>
      </form>

      
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
    
 <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
  <div class="offcanvas-header bg-primary">
    <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="pct-body" style="height: calc(100% - 60px)">
    <div class="offcanvas-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-layout-sidebar f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Layout</h6>
                <span>Choose your layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse1">
            <div class="pct-content">
              <div class="pc-rtl">
                <p class="mb-1">Direction</p>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                  <label class="form-check-label" for="layoutmodertl">RTL</label>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-brush f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Mode</h6>
                <span>Choose light or dark mode</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse2">
            <div class="pct-content">
              <div class="theme-color themepreset-color theme-layout">
                <a href="#!" class="active" onclick="layout_change('light')" data-value="false"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/default.svg" alt="img"></span><span>Light</span></a
                >
                <a href="#!" class="" onclick="layout_change('dark')" data-value="true"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-color-swatch f-18"></i>
                </div>
              </div>        
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Color Sche          v      me</h6>
                <span>Choose your primary theme color</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse3">
            <div class="pct-content">
              <div class="theme-color preset-color">
                <a href="#!" class="active" data-value="preset-1"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a
                >
                <a href="#!" class="" data-value="preset-2"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a
                >
                <a href="#!" class="" data-value="preset-3"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a
                >
                <a href="#!" class="" data-value="preset-4"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a
                >
                <a href="#!" class="" data-value="preset-5"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a
                >
                <a href="#!" class="" data-value="preset-6"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a
                >
                <a href="#!" class="" data-value="preset-7"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a
                >
                <a href="#!" class="" data-value="preset-8"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a
                >
                <a href="#!" class="" data-value="preset-9"
                  ><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-boxcontainer">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-border-inner f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Layout Width</h6>
                <span>Choose fluid or container layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse4">
            <div class="pct-content">
              <div class="theme-color themepreset-color boxwidthpreset theme-container">
                <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="https://themewagon.github.io/Mantis-Bootstrap/assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-typography f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Font Family</h6>
                <span>Choose your font family.</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse5">
            <div class="pct-content">
              <div class="theme-color fontpreset-color">
                <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"
                  ><span>Aa</span><span>Public Sans</span></a
                >
                <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="collapse show">
            <div class="pct-content">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</body>
<!-- [Body] end -->>


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/pages/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Mar 2025 07:03:19 GMT -->
</html>
