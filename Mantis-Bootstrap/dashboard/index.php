<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('connection.php');
include('slidebar.php');
include('header.php');

$query = "SELECT * FROM newdata";

$data = mysqli_query($conn,$query);

$total = mysqli_num_rows($data);
// $result = mysqli_fetch_assoc($data)

?>

<!DOCTYPE html>
<html lang="en">
  <!-- [Head] start -->
  
          
  <!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 13:10:11 GMT -->
  <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
  <head>
    <title>Home | Mantis Bootstrap 5 Admin Template</title>
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
  <link rel="stylesheet" href="stylelogin.css">

  
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">     
      <!-- [ Main Content ] start -->
       
<div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Home</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
              </ul>
            </div>
          </div>
        </div>
</div>
<?php
if($total != 0)
{
?>
      <table class="table table-bordered">
  <thead>
    <tr>
      <th>Id</th>
      <th>IMAGE</th>
      <th>Username</th>
      <th>Email</th>
      <!-- <th>password</th>
      <th>Confirm password</th> -->
      <th>Phone No</th>
      <th>Registration Date</th>
      <th>Action</th>    
    </tr>
  </thead>

   <?php
    while($result = mysqli_fetch_assoc($data))
    {
      echo "<tr>
                <td>".$result['ID']."</td>
                <td><img src = '".$result['image_source']."' width='50px' height='50px'></td>
                <td>".$result['username']."</td>
                <td>".$result['email']."</td>
                <td>".$result['phone_no']."</td>
                <td>".$result['signup_date']."</td>
                
           <td> <a href='update.php?id=$result[ID]'>
           <button class='button'> UPDATE </button></a> 

            <a href='delete.php?id=$result[ID]'>
             <button class='button2' onclick = 'return checkdate()'> DELETE </button></a> 
        </td>
       
      ";
    }
  }
  else{
    echo "there is no record";
 } 
   
   ?>

</table>


<!-- echo $result['fname']." ".$result['lname']." ".$result['email']." ".$result['pswd']." ".$result['confirm_pswd']." ".$result['gender']." ".$result['ph_no']." ".$result['adress']."<br>";    -->
<script>

    function checkdate()
    {
        return confirm('Are Youy sure want to delete ?');
    }
</script>   
    </div>     <!-- [ PC-Content ] end -->
  </div>      <!-- [ PC-CONTAINER ] end -->
  <!-- [ Main Content ] end -->                            
  
  
  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
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

<?php
//include('footer.php');

?>
  
</body>
<!-- [Body] end -->


<!-- Mirrored from themewagon.github.io/Mantis-Bootstrap/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 13:10:17 GMT -->
</html>