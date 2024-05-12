<?php
ini_set('display_errors', '1');
include "header.php";
?>

<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Sub Dashboard
              </h3>
            </div>

            <div class="row">
                <?php
                if($_GET['urlRoute'] == 'employees.php')
                {
                  $getActiveUserQuery = $_GET['dashboardQuery']." WHERE status=1;";
                  $getActiveUserQueryResult = mysqli_query($conn,  $getActiveUserQuery);
                  $getActiveUserCount = mysqli_num_rows($getActiveUserQueryResult);

                  $getInactiveUserQuery = $_GET['dashboardQuery']." WHERE status=0;";
                  $getInactiveUserQueryResult = mysqli_query($conn,  $getInactiveUserQuery);
                  $getInactiveUserCount = mysqli_num_rows($getInactiveUserQueryResult);    
                  ?>
                  <div class="col-md-4 stretch-card grid-margin cardClick" data-query="<?php echo $getActiveUserQuery; ?>" date-route="<?php echo $_GET['urlRoute']; ?>">
                    <div class="card <?php echo $_GET['cardColor'];  ?> card-img-holder text-white">
                    <div class="card-body">
                        <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Active</h4>
                        <br>
                        <h2 class="mb-5 text-center totalEmp"><?php echo $getActiveUserCount; ?></h2>
                    </div>
                    </div>
                </div>

              <div class="col-md-4 stretch-card grid-margin cardClick" data-query="<?php echo $getInactiveUserQuery; ?>" date-route="<?php echo $_GET['urlRoute']; ?>">
                  <div class="card <?php echo $_GET['cardColor'];  ?> card-img-holder text-white">
                  <div class="card-body">
                      <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <h4 class="font-weight-normal mb-3">In Active</h4>
                      <br>
                      <h2 class="mb-5 text-center totalEmp"><?php echo $getInactiveUserCount; ?></h2>
                  </div>
                  </div>
              </div>

                <?php
                }
                else
                {
                  $getUserIdQuery = $_GET['dashboardQuery']." GROUP BY user_id;";
                  $userIdData = mysqli_query($conn, $getUserIdQuery);

                while ($getUserId = mysqli_fetch_array($userIdData))
                {
                    $getUserName = mysqli_query($conn, 'SELECT first_name, last_name from employees WHERE id="'.$getUserId['user_id'].'"');
                    $getUserName = mysqli_fetch_array($getUserName);

                    $userWiseCountQuery = $_GET['dashboardQuery']." AND user_id='".$getUserId['user_id']."'";
                    $getUserWiseCountQuery = mysqli_query($conn,  $userWiseCountQuery);
                    $userWiseCount = mysqli_num_rows($getUserWiseCountQuery);
                    
                ?>
                <div class="col-md-4 stretch-card grid-margin cardClick" data-query="<?php echo $userWiseCountQuery; ?>" date-route="<?php echo $_GET['urlRoute']; ?>">
                    <div class="card <?php echo $_GET['cardColor'];  ?> card-img-holder text-white">
                    <div class="card-body">
                        <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3"><?php echo $getUserName['first_name']." ".$getUserName['last_name']  ?>
                        </h4>
                        <br>
                        <h2 class="mb-5 text-center totalEmp"><?php echo $userWiseCount; ?></h2>
                    </div>
                    </div>
                </div>

                <?php 
                }
                } ?>
                
            </div>

</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
<div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022 <a href="https://www.nic.in/" target="_blank">National Informatics Centre</a>. All rights reserved.</span>
</div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->

<script src="js/dynamic-dashboard.js"></script>