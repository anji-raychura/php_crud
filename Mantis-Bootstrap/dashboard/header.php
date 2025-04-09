
<?php
include('connection.php');

$userImage = 'logooo.jpg'; // fallback image
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT image_source FROM newdata WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['image_source'])) {
            $userImage = $row['image_source'];
        }
    }
}
?>

<header class="pc-header">
  <div class="header-wrapper">
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="dropdown pc-h-item d-inline-flex d-md-none">
          <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="ti ti-search"></i>     
          </a>
          <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3"> 
              <div class="form-group mb-0 d-flex align-items-center">
                <i data-feather="search"></i>
                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
              </div>

            </form>  

          </div>
        </li>
        <li class="pc-h-item d-none d-md-inline-flex">
          <form class="header-search">
            <i data-feather="search" class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Search here. . .">
          </form>
        </li>
      </ul>
    </div>
    <div class="ms-auto">
      <ul class="list-unstyled">

      <li class="dropdown pc-h-item">
          <?php
           if (isset($_SESSION['username'])) {
                echo "<span> Welcome  ".$_SESSION['username']."</span>";}
              else {
                echo "<span>Guest</span>"; // Default text if the user is not logged in
                    } ?>
      </li>      
         
      
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
          <img src="<?php echo $userImage; ?>" alt="user-image" class="user-avtar">
          
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
              <div class="d-flex mb-1">
                <div class="flex-shrink-0">
                <img src="<?php echo $userImage; ?>" alt="user-image" class="user-avtar wid-35">

                </div>     
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1"><?php
                            if (isset($_SESSION['username'])) {
                              echo "<span>" . $_SESSION['username'] . "</span>";
                            } else {
                              echo "<span>Guest</span>";
                            }
                          ?></h6>
                  </div>
                <!-- <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>  logout Button  -->
              </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1" type="button" role="tab" aria-controls="drp-tab-1" aria-selected="true"><i class="ti ti-user"></i> Profile</button>
              </li>
              <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="drp-t2" data-bs-toggle="tab" data-bs-target="#drp-tab-2" type="button" role="tab" aria-controls="drp-tab-2" aria-selected="false"><i class="ti ti-settings"></i> Setting</button>
              </li> -->
            </ul>
            <div class="tab-content" id="mysrpTabContent">
              <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                
                <a href="logout.php" class="dropdown-item">
                  <i class="ti ti-power"></i>
                  <span>Logout</span>
                </a>
              </div>
            
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>