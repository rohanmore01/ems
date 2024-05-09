<?php
  ob_start();
  session_start();
  include "db.php";

  if(isset($_SESSION["id"]))
  {
    $getUserPreference = mysqli_query($conn,"SELECT * FROM user_preferences WHERE `user_id`='" .  $_SESSION["id"] . "' ");
    $getUserPreferenceData = mysqli_fetch_assoc($getUserPreference);    
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EMS</title>
    <link rel="shortcut icon" type="image/x-icon" href="Master_Images/favicon.ico"/>
    <?php
      include "links.php";
    ?>
  </head>
  <body onload="myFunction()" class="<?php echo $getUserPreferenceData['sidebar_skins']." ".$getUserPreferenceData['minimize_sidebar']; ?>">
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner"> 
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
          </div>
        </div>
      </div>

      <!-- loader -->
<?php
  $useragent=$_SERVER['HTTP_USER_AGENT'];
  if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
  { ?>
      <div id="pre_loader">
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </div>
<?php  
  } ?>
      <!-- loader end -->

      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row <?php echo $getUserPreferenceData['header_skins']; ?>">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="images/nic-logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/nic-logo1.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" title="Minimize Sidebar">
            <span class="mdi mdi-menu"></span>
          </button>
          <!-- <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
              </div>
            </form>
          </div> -->
          <ul class="navbar-nav navbar-nav-right">
            <?php
            if (isset($_SESSION['first_name'])) 
            {
            ?>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                <?php if(isset($_SESSION['encoded_photo']) && !empty($_SESSION['encoded_photo']))
                { ?>
                  <img src='data:image/gif;base64,<?php echo $_SESSION["encoded_photo"] ?>' alt="profile">
                <?php 
                }
                else
                { ?>
                  <img src="Master_Images/blank_pic.jpg" alt="profile">
                <?php } ?>
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name'] ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="view-profile.php">
                  <i class="mdi mdi-eye mr-2 text-success"></i>View Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="edit-employee.php?id=<?php echo $_SESSION['id'] ?>&action=updateProfile">
                  <i class="mdi mdi-pencil mr-2 text-primary"></i>Edit Profile</a>

                <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
                { ?>
                  <a class="dropdown-item" href="email-configuration.php">
                  <i class="mdi mdi-email mr-2 text-primary"></i>Email Configuration</a>
                <?php } ?>
              </div>
            </li>
            <?php 
            } ?>
            <!-- <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button" title="Fullscreen Button"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li> -->
            
            <!-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-cog"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li> -->
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="logout.php">
                <i class="mdi mdi-power" title="Log Out"></i>
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
            <div id="google_translate_element"></div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <div class="sidebar-toggler" id="settings-trigger"><i class="mdi mdi-palette" title="Navbar color setting"></i></div>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
              <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
              <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>       
        </div>
        
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="index.php" class="nav-link">
                <div class="nav-profile-image">
                <?php if(isset($_SESSION['encoded_photo']) && !empty($_SESSION['encoded_photo']))
                {?>
                  <img src='data:image/gif;base64,<?php echo $_SESSION["encoded_photo"] ?>' alt="profile">
                <?php 
                }
                else
                { ?>
                  <img src="Master_Images/blank_pic.jpg" alt="profile">
                <?php } ?>
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php if(isset( $_SESSION['first_name'])) { echo $_SESSION['first_name']." ".$_SESSION['last_name']; } else { echo "Guest User"; } ?></span>
                  <span class="text-secondary text-small"><?php if(isset( $_SESSION['designation'])) { echo $_SESSION['designation']; } ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Attendance</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cards-variant menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="mark-attendance.php">Mark Attendance</a></li>
                  <li class="nav-item"> <a class="nav-link" href="attendance.php">List</a></li>
                  <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
                  { ?>
                  <li class="nav-item"> <a class="nav-link" href="attendance-mark-in-cron-job-setting.php">Cron Job Setting</a></li>
                  <?php } ?>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <span class="menu-title">Leave Application</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-playlist-play menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                  <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'Normal User')
                  {
                  ?>
                  <li class="nav-item"> <a class="nav-link" href="leave-application-create.php">Create</a></li>
                  <?php 
                  } 
                  ?>
                  <li class="nav-item"> <a class="nav-link" href="leave-application.php">List</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="employees">
                <span class="menu-title">Employees</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="employees">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="employee-registration.php">Employee Registration</a></li>
                  <li class="nav-item"> <a class="nav-link" href="fms.php">FMS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="officers.php">Officers</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects">
                <span class="menu-title">Projects</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-developer-board menu-icon"></i>
              </a>
              <div class="collapse" id="projects">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="create-project.php">Create Project</a></li>
                  <li class="nav-item"> <a class="nav-link" href="projects.php">Projects List</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#typing_test" aria-expanded="false" aria-controls="typing_test">
                <span class="menu-title">Typing Test</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-more menu-icon"></i>
              </a>
              <div class="collapse" id="typing_test">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="create-typing-master.php">Create</a></li>
                  <li class="nav-item"> <a class="nav-link" href="typing-master.php">List</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#books" aria-expanded="false" aria-controls="books">
                <span class="menu-title">Books</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              </a>
              <div class="collapse" id="books">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-book.php">Add Book</a></li>
                  <li class="nav-item"> <a class="nav-link" href="books.php">Book List</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#stock_item" aria-expanded="false" aria-controls="stock_item">
                <span class="menu-title">Stock Items</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-palette-advanced menu-icon"></i>
              </a>
              <div class="collapse" id="stock_item">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="consumable-stock-items.php">Consumable</a></li>
                  <li class="nav-item"> <a class="nav-link" href="non-consumable-stock-items.php">Non - Consumable</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#inward_outward" aria-expanded="false" aria-controls="inward_outward">
                <span class="menu-title">Inward Outward</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-image-filter-black-white menu-icon"></i>
              </a>
              <div class="collapse" id="inward_outward">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="inwards.php">Inward</a></li>
                  <li class="nav-item"> <a class="nav-link" href="outwards.php">Outward</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#work_order" aria-expanded="false" aria-controls="work_order">
                <span class="menu-title">Work Order</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-security-network menu-icon"></i>
              </a>
              <div class="collapse" id="work_order">
                <ul class="nav flex-column sub-menu">
                <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
                { ?>
                  <li class="nav-item"> <a class="nav-link" href="work-order-create.php">Create</a></li>
                <?php } ?>
                  <li class="nav-item"> <a class="nav-link" href="work-orders.php">List</a></li>          
                </ul>
              </div>
            </li>

            <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
            { ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#dropdown_master" aria-expanded="false" aria-controls="dropdown_master">
                <span class="menu-title">Dropdown Master</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-dropbox menu-icon"></i>
              </a>
              <div class="collapse" id="dropdown_master">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="create-dropdown-master.php">Create</a></li>
                  <li class="nav-item"> <a class="nav-link" href="dropdown-master.php">Dropdown List</a></li>          
                </ul>
              </div>
            </li>
            <?php } ?>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#holidays" aria-expanded="false" aria-controls="holidays">
                <span class="menu-title">Holidays</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-kodi menu-icon"></i>
              </a>
              <div class="collapse" id="holidays">
                <ul class="nav flex-column sub-menu">
                  <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
                  { ?>
                  <li class="nav-item"> <a class="nav-link" href="create-holiday-master.php">Create</a></li>
                  <?php } ?>
                  <li class="nav-item"> <a class="nav-link" href="holidays.php">List</a></li>          
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-power menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>

<script>
  function myFunction()
  {
      $('#pre_loader').fadeOut();
  };
</script>
<script src="js/misc.js"></script>