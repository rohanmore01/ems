<style>
  td#P {
    color: green;
  }

  td#A {
    color: red;
  }

  td#Requested {
    color: blue;
  }

  td#Approved {
    color: green;
  }

  td#Rejected {
    color: red;
  }
</style>

<?php
ini_set('display_errors', '1');
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Normal User") {
?>
  <!-- partial -->
  <div class="main-panel" user-type="user" user-id="<?php echo $_SESSION['id'] ?>">
    <div class="content-wrapper">
    <?php
      if (isset($_SESSION["message"])) {
        echo '<span id="success" class="alert-section">
          <p class="text-center">'.$_SESSION["message"].'</p>
          <i class="fa fa-times succ" aria-hidden="true"></i>
          </span>';
          unset($_SESSION["message"]);
      }
    ?>
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
          </span> Dashboard
        </h3>

        <i>
          <select class="form-control date_selection" name="date_selection">
            <option value="Today" class="Today" data-id='<?php echo date("Y-m-d"); ?>'>Today</option>
            <option value="Yesterday" class="Yesterday" data-id='<?php echo date("Y-m-d", strtotime("-1 days")); ?>'>Yesterday</option>
            <option value="this_month" class="this_month" from-date='<?php echo date('Y-m-01'); ?>' to-date='<?php echo date('Y-m-t'); ?>'>This Month</option>
            <option value="this_year" class="this_year" from-date='<?php echo date('Y-01-01'); ?>' to-date='<?php echo date('Y-12-31'); ?>'>This Year</option>
            <option value="custom_date" data-toggle="modal" data-target="#custom_date">Custom Date</option>
          </select>
        </i>

        <!--Modal for custom date-->
        <div class="modal fade" id="custom_date" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Custom Date</h5>
                <button type="button" class="close closeCustomDateModal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">From Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="from_date" name="from_date" required="">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">To Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="to_date" name="to_date" required="">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success mx-auto text-white" id="submit_custom_date">submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- model end -->

      </div>
      <div class="row">
        <div class="col-md-4 stretch-card grid-margin cardClick totalEmpCard" data-query="" date-route="employees.php">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Employees<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center totalEmp"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick presentEmpCard" data-query="" date-route="attendance.php">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Present<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center presentEmpCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick absentEmpCard" data-query="" date-route="attendance.php">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Absent<i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center absentEmpCount"></h2>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 stretch-card grid-margin cardClick leaveRequestCard" data-query="" date-route="leave-application.php">
          <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Request<i class="mdi mdi-gauge mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveRequestCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick leaveApprovedCard" data-query="" date-route="leave-application.php">
          <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Approved<i class="mdi mdi-flower mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveApprovedCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick leaveRejectedCard" data-query="" date-route="leave-application.php">
          <div class="card bg-gradient-dark card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Rejected<i class="mdi mdi-cursor-move mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveRejectedCount"></h2>
            </div>
          </div>
        </div>
      </div>

      <?php
      $todayDate = date("Y-m-d");
      $getAttendanceRecords = mysqli_query($conn, "SELECT * FROM attendance WHERE `date`= '" . $todayDate . "' AND `user_id`= '" . $_SESSION['id'] . "'");

      $row = mysqli_num_rows($getAttendanceRecords);

      if ($row > 0) {
      ?>
        <div class="row">
          <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-body p-0 d-flex">
                <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Today's Attendance</h4>
                <div class="table-responsive table-bordered">
                  <table class="table table-hover">

                    <tbody>
                      <?php
                      while ($row = mysqli_fetch_array($getAttendanceRecords)) {

                        if ($row['out_time'] != '') {
                          $inDateTime = new DateTime($row['date'] . "" . $row['in_time']);
                          $outDateTime = new DateTime($row['date'] . "" . $row['out_time']);
                          $dateTimeDiff  = $inDateTime->diff($outDateTime);
                          $totalDuration = $dateTimeDiff->format("%H hrs %I min %S sec");
                        } else {
                          $totalDuration = "-";
                        }

                        $getEmpDetails = mysqli_query($conn, "SELECT first_name, last_name, encoded_photo FROM employees  WHERE emp_id='" .  $row['emp_id'] . "'");
                        $empDetails = mysqli_fetch_array($getEmpDetails)
                      ?>
                        <tr>
                          <td>Employee</td>
                          <td class="py-1"><?php if ($empDetails['encoded_photo'] == '') {
                                              echo "<a href='Master_Images/blank_pic.jpg' target='_blank' title='view photo'> <img src='Master_Images/blank_pic.jpg' style='width:35px;border-radius:50%;margin-right:15px;'></img> </a>";
                                            } else {
                                              echo "<img src='data:image/gif;base64,$empDetails[encoded_photo]' style='width:35px;border-radius:50%;margin-right:15px;'></img>" ?>
                            <?php } ?> <?php echo $empDetails['first_name'] . " " . $empDetails['last_name'] ?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td id="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></td>
                        </tr>
                        <tr>
                          <td>In Time</td>
                          <td><?php echo $row['in_time'] ?></td>
                        </tr>
                        <tr>
                          <td>Out Time</td>
                          <td><?php echo $row['out_time'] ?></td>
                        </tr>
                        <tr>
                          <td>Duration</td>
                          <td><?php echo $totalDuration ?></td>
                        </tr>

                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
         } else {
          echo '';
        }

        $selectLeaveApplicationDetails = mysqli_query($conn, "SELECT * FROM `leave_application` WHERE `user_id`= '" . $_SESSION['id'] . "' ORDER BY `leave_application`.`from_date` DESC LIMIT 5");

        $leaveAppDetailsRows = mysqli_num_rows($selectLeaveApplicationDetails);

        if ($leaveAppDetailsRows > 0) {
        ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Leave Applications Status</h4>
                  <div class="table-responsive table-bordered">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Status</th>
                          <th>Remark</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Leave Type</th>
                          <th>Leave Duration</th>
                          <th>No of Days</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($leaveAppDetails = mysqli_fetch_array($selectLeaveApplicationDetails)) {
                        ?>

                          <td><?php echo $leaveAppDetails['subject'] ?></td>
                          <td class="status" id="<?php echo $leaveAppDetails['status'] ?>"><?php echo $leaveAppDetails['status'] ?></td>
                          <td class="reason"><?php echo $leaveAppDetails['remark'] ?></td>
                          <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['from_date'])); ?></td>
                          <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['to_date'])); ?></td>
                          <td><?php echo $leaveAppDetails['leave_type'] ?></td>
                          <td><?php echo $leaveAppDetails['leave_duration'] ?></td>
                          <td><?php echo $leaveAppDetails['no_of_days'] ?></td>
                          </tr>

                      <?php
                        }
                      ?>
                      </tbody>

                      <!--Modal-->
                      <div class="modal fade" id="rejectReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Reason for Reject</h5>
                              <button type="button" class="close closeLeaveApplicationModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <input type="text" class="form-control" id="reject_reason" name="reject_reason" required="" autocomplete="off">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-gradient-success mx-auto btn-rounded btn-fw mb-2 float-right mr-5" id="submit_reject_reason">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
        } 
        else 
        {
          echo '';
        }
        ?>
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
<?php
} else if (isset($_SESSION["id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
?>
  <!-- partial -->
  <div class="main-panel" user-type="admin">
    <div class="content-wrapper">
    <?php
        if (isset($_SESSION["message"])) {
          echo '<span id="success" class="alert-section">
            <p class="text-center">'.$_SESSION["message"].'</p>
            <i class="fa fa-times succ" aria-hidden="true"></i>
            </span>';
            unset($_SESSION["message"]);
        }
      ?>
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
          </span> Dashboard
        </h3>

        <i>
          <select class="form-control date_selection" name="date_selection">
            <option value="Today" class="Today" data-id='<?php echo date("Y-m-d"); ?>'>Today</option>
            <option value="Yesterday" class="Yesterday" data-id='<?php echo date("Y-m-d", strtotime("-1 days")); ?>'>Yesterday</option>
            <option value="this_month" class="this_month" from-date='<?php echo date('Y-m-01'); ?>' to-date='<?php echo date('Y-m-t'); ?>'>This Month</option>
            <option value="this_year" class="this_year" from-date='<?php echo date('Y-01-01'); ?>' to-date='<?php echo date('Y-12-31'); ?>'>This Year</option>
            <option value="custom_date" data-toggle="modal" data-target="#custom_date">Custom Date</option>
          </select>
        </i>

        <!--Modal for custom date-->
        <div class="modal fade" id="custom_date" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Custom Date</h5>
                <button type="button" class="close closeCustomDateModal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">From Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="from_date" name="from_date" required="">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">To Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="to_date" name="to_date" required="">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success mx-auto text-white" id="submit_custom_date">submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- model end -->

      </div>
      <div class="row">
        <div class="col-md-4 stretch-card grid-margin cardClick totalEmpCard" data-query="" date-route="employees.php" card-color="bg-gradient-danger">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Employees<i class="mdi mdi-diamond mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center totalEmp"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick presentEmpCard" data-query="" date-route="attendance.php" card-color="bg-gradient-info">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Present Employees <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center presentEmpCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick absentEmpCard" data-query="" date-route="attendance.php" card-color="bg-gradient-success">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Absent Employees<i class="mdi mdi-chart-line mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center absentEmpCount"></h2>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 stretch-card grid-margin cardClick leaveRequestCard" data-query="" date-route="leave-application.php" card-color="bg-gradient-warning">
          <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Request<i class="mdi mdi-gauge mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveRequestCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick leaveApprovedCard" data-query="" date-route="leave-application.php" card-color="bg-gradient-primary">
          <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Approved<i class="mdi mdi-flower mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveApprovedCount"></h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin cardClick leaveRejectedCard" data-query="" date-route="leave-application.php" card-color="bg-gradient-dark">
          <div class="card bg-gradient-dark card-img-holder text-white">
            <div class="card-body">
              <img src="images/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Leave Rejected<i class="mdi mdi-cursor-move mdi-24px float-right"></i>
              </h4>
              <br>
              <h2 class="mb-5 text-center leaveRejectedCount"></h2>
            </div>
          </div>
        </div>
      </div>

      <?php
      $todayDate = date("Y-m-d");
      $getAttendanceRecords = mysqli_query($conn, "SELECT * FROM attendance WHERE `date`= '" . $todayDate . "'");

      $row = mysqli_num_rows($getAttendanceRecords);

      if ($row > 0) {
      ?>
        <div class="row">
          <!-- <div class="col-lg-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body p-0 d-flex">
                    <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                  </div>
                </div>
              </div> -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title text-center">Today's Attendance</h4>
                <div class="table-responsive table-bordered">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>Duration</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row = mysqli_fetch_array($getAttendanceRecords)) {

                        if ($row['out_time'] != '') {
                          $inDateTime = new DateTime($row['date'] . "" . $row['in_time']);
                          $outDateTime = new DateTime($row['date'] . "" . $row['out_time']);
                          $dateTimeDiff  = $inDateTime->diff($outDateTime);
                          $totalDuration = $dateTimeDiff->format("%H hrs %I min %S sec");
                        } else {
                          $totalDuration = "-";
                        }

                        $getEmpDetails = mysqli_query($conn, "SELECT first_name, last_name, encoded_photo FROM employees  WHERE emp_id='" .  $row['emp_id'] . "'");
                        $empDetails = mysqli_fetch_array($getEmpDetails)
                      ?>
                        <tr>
                          <td class="py-1"><?php if ($empDetails['encoded_photo'] == '') {
                                              echo "<img src='Master_Images/blank_pic.jpg' style='width:35px;border-radius:50%;margin-right:15px;'></img>";
                                            } else {
                                              echo "<img src='data:image/gif;base64,$empDetails[encoded_photo]' style='width:35px;border-radius:50%;margin-right:15px;'></img>" ?>
                            <?php } ?> <?php echo $empDetails['first_name'] . " " . $empDetails['last_name'] ?></td>

                          <td id="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></td>
                          <td><?php echo $row['in_time'] ?></td>
                          <td><?php echo $row['out_time'] ?></td>
                          <td><?php echo $totalDuration ?></td>
                        </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php 
          } else 
          {
              echo '';
          }
        ?>

        <?php
        $selectLeaveApplicationDetails = mysqli_query($conn, "SELECT * FROM `leave_application` WHERE `status`='Requested' ORDER BY `leave_application`.`from_date` DESC");

        $leaveAppDetailsRows = mysqli_num_rows($selectLeaveApplicationDetails);

        if ($leaveAppDetailsRows > 0) {
        ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Leave Applications Request</h4>
                  <div class="table-responsive table-bordered">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Employee ID</th>
                          <th>Subject</th>
                          <th>Status</th>
                          <th>Remark</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Leave Type</th>
                          <th>Leave Duration</th>
                          <th>No of Days</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($leaveAppDetails = mysqli_fetch_array($selectLeaveApplicationDetails)) {
                          $getEmpDetails = mysqli_query($conn, "SELECT first_name, last_name FROM employees  WHERE emp_id='" .   $leaveAppDetails['emp_id'] . "'");
                          $empDetails = mysqli_fetch_array($getEmpDetails)
                        ?>

                          <tr id="<?php echo $leaveAppDetails['id'] ?>">
                            <td><?php echo $empDetails['first_name'] . " " . $empDetails['last_name'] ?></td>
                            <td><?php echo $leaveAppDetails['emp_id'] ?></td>
                            <td><?php echo $leaveAppDetails['subject'] ?></td>
                            <td class="status" id="<?php echo $leaveAppDetails['status'] ?>" style="color:blue"><?php echo $leaveAppDetails['status'] ?></td>
                            <td class="reason"><?php echo $leaveAppDetails['remark'] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['from_date'])); ?></td>
                            <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['to_date'])); ?></td>
                            <td><?php echo $leaveAppDetails['leave_type'] ?></td>
                            <td><?php echo $leaveAppDetails['leave_duration'] ?></td>
                            <td><?php echo $leaveAppDetails['no_of_days'] ?></td>
                            <td>

                              <label class="badge badge-gradient-success btn-action" title="Approve" id="approved" data-id="<?php echo $leaveAppDetails['id'] ?>">Approve</label>

                              <label class="badge badge-gradient-danger btn-action" title="Reject" id="reject" data-id="<?php echo $leaveAppDetails['id'] ?>" data-toggle="modal" data-target="#rejectReasonModal">Reject</label>

                              <a href='leave-application-pdf.php?id=<?php echo $leaveAppDetails['id'] ?>' target="_blank"><label class="badge badge-gradient-info" title="Uploads">uploads</label></a>

                            </td>
                          </tr>

                      <?php
                        }
                      ?>
                      </tbody>

                      <!--Modal-->
                      <div class="modal fade" id="rejectReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Reason for Reject</h5>
                              <button type="button" class="close closeLeaveApplicationModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <input type="text" class="form-control" id="reject_reason" name="reject_reason" required="" autocomplete="off">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-gradient-success mx-auto btn-rounded btn-fw mb-2 float-right mr-5" id="submit_reject_reason">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- model end -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php 
        } 
        else 
        {
           echo '';
        }
      ?>
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
<?php
} else {
  header('Location: ' . 'login.php');
}
?>

<!-- Header End Part -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
</body>

</html>
<script src="js/leave-application-action.js"></script>
<script src="js/dynamic-dashboard.js"></script>
<script src="js/mark-attendance-notification.js"></script>

<script>
  $(".alert-section").delay(2000).fadeOut(800);
</script>