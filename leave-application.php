<style>
    td#Requested  {
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

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "Normal User") 
{
  if(isset($_GET['dashboardQuery']))
  {
      $leaveApplicationQuery = $_GET['dashboardQuery'];
  }
  else
  {
    $leaveApplicationQuery = "SELECT * FROM `leave_application` WHERE  user_id='".$_SESSION['id']."' ORDER BY `leave_application`.`from_date` DESC";
  }
  $selectLeaveApplicationDetails = mysqli_query($conn, $leaveApplicationQuery);
  ?>

  <div class="main-panel">
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
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Leave Applications Details</h4>
          <hr style="border-top: 1px solid rgb(229 16 16);">
          <div class="table-responsive">
          <table class="table  table-bordered table-hover display nowrap data-table">
            <thead>
              <tr>
              <th>Subject</th>
              <th>Status</th>
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
  
            while($leaveAppDetails = mysqli_fetch_array($selectLeaveApplicationDetails)) 
            { 
            ?>
            
            <tr id="<?php echo $leaveAppDetails['id'] ?>">
            <td><?php echo $leaveAppDetails['subject'] ?></td>
            <td class="status" id="<?php echo $leaveAppDetails['status'] ?>"><?php echo $leaveAppDetails['status'] ?></td>
            <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['from_date'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['to_date'])); ?></td>
            <td><?php echo $leaveAppDetails['leave_type'] ?></td>
            <td><?php echo $leaveAppDetails['leave_duration'] ?></td>
            <td><?php echo $leaveAppDetails['no_of_days'] ?></td>
            <td>
                <a type="submit" class="badge badge-success" title="Edit" href="edit-leave-application.php?id=<?php echo $leaveAppDetails['id'] ?>" <?php echo ($leaveAppDetails['status'] == 'Approved' OR $leaveAppDetails['status'] == 'Rejected') ?  "disabled" : "" ;?>>
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                  </svg>
            </a>

                <a type="submit" class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" href="delete-leave-application.php?id=<?php echo $leaveAppDetails['id'] ?>" title="Delete" <?php echo ($leaveAppDetails['status'] == 'Approved' OR $leaveAppDetails['status'] == 'Rejected') ?  "disabled" : "" ;?>>
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
            </a>

                <a class="badge badge-info" href='leave-application-pdf.php?id=<?php echo $leaveAppDetails['id'] ?>' target="_blank" title="Uploads">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                </a>

            </td>
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
  </div>

  <!-- Header End Part -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  </body>

  </html>

<?php
} 
else if (isset($_SESSION["id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") 
{
  if(isset($_GET['dashboardQuery']))
  {
      $leaveApplicationQuery = $_GET['dashboardQuery'];
  }
  else
  {
    $leaveApplicationQuery = "SELECT * FROM `leave_application` ORDER BY `leave_application`.`from_date` DESC";
  }
  $selectLeaveApplicationDetails = mysqli_query($conn,$leaveApplicationQuery);
?>

    <div class="main-panel">
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
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Leave Application Details</h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
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
                while($leaveAppDetails = mysqli_fetch_array($selectLeaveApplicationDetails)) 
                { 
                    $getEmpDetails = mysqli_query($conn, "SELECT first_name, last_name FROM employees  WHERE emp_id='" .   $leaveAppDetails['emp_id'] . "'");
                    $empDetails = mysqli_fetch_array($getEmpDetails)
                ?>

                <tr id="<?php echo $leaveAppDetails['id'] ?>">
                <td><?php echo $empDetails['first_name'] . " " . $empDetails['last_name'] ?></td>
                <td><?php echo $leaveAppDetails['emp_id'] ?></td>
                <td><?php echo $leaveAppDetails['subject'] ?></td>
                <td class="status" id="<?php echo $leaveAppDetails['status'] ?>"><?php echo $leaveAppDetails['status'] ?></td>
                <td class="reason"><?php echo $leaveAppDetails['remark'] ?></td>
                <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['from_date'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($leaveAppDetails['to_date'])); ?></td>
                <td><?php echo $leaveAppDetails['leave_type'] ?></td>
                <td><?php echo $leaveAppDetails['leave_duration'] ?></td>
                <td><?php echo $leaveAppDetails['no_of_days'] ?></td>
                <td>

                <a class="badge badge-success btn-action" href="#" style=" border-radius:20%;" title="Approve" id="approved" data-id="<?php echo $leaveAppDetails['id'] ?>">Approved</a>

                <a class="badge badge-danger btn-action" href="#" style=" border-radius:20%;" title="Reject" id="reject" data-id="<?php echo $leaveAppDetails['id'] ?>"  data-toggle="modal" data-target="#rejectReasonModal">Reject</a>

                <a href="leave-application-pdf.php?id=<?php echo $leaveAppDetails['id'] ?>" class="badge badge-info" style=" border-radius:20%;" title="uploads" target="_blank">Uploads</a>

              </td>
            </tr>

              <?php
                }
              ?>
              </tbody>
            </table>
            </div>

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
                        <button type="button" class="btn btn-gradient-success mx-auto btn-rounded btn-fw mb-2" id="submit_reject_reason">Submit</button>
                    </div>
                </div>
            </div>
        </div>
	<!-- model end -->

          </div>
        </div>
      </div>

      </div>
    </div>

    <!-- Header End Part -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    </body>

    </html>

<?php
} 
else 
{
  header('Location: ' . 'login.php');
}
?>
<script src="js/leave-application-action.js"></script>

<script>
  $(".alert-section").delay(2000).fadeOut(800);
</script>