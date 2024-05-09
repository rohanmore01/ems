<style>
  td#P {
    color: green;
  }

  td#A {
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
      $attendanceQuery = $_GET['dashboardQuery'];
  }
  else
  {
    $attendanceQuery = "SELECT * FROM attendance WHERE `user_id`='" .  $_SESSION["id"] . "' ORDER BY `attendance`.`date` DESC";
  }
  $getAttendanceRecords = mysqli_query($conn, $attendanceQuery);
 ?>

    <div class="main-panel">
      <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Attendance Details</h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                  <th> Date </th>
                  <th> In Time </th>
                  <th> Out Time </th>
                  <th> Total Duration </th>
                  <th> Status </th>
                  <th> In Photo </th>
                  <th> Out Photo </th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row = mysqli_fetch_array($getAttendanceRecords)) {

                  if($row['out_time'] != '')
                  {
                    $inDateTime = new DateTime($row['date'] . "" . $row['in_time']);
                    $outDateTime = new DateTime($row['date'] . "" . $row['out_time']);
                    $dateTimeDiff  = $inDateTime->diff($outDateTime);
                    $totalDuration = $dateTimeDiff->format("%H hrs %I min %S sec");
                  }
                  else
                  {
                    $totalDuration ="-";
                  }
                  
                ?>
                  <tr>
                    <td data-sort="<?php echo $row['date'] ?>"><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
                    <td><?php echo $row['in_time'] ?></td>
                    <td><?php echo $row['out_time'] ?></td>
                    <td><?php echo $totalDuration ?></td>
                    <td id="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></td>
                    <td class="py-1"><?php if ($row['in_photo'] == '') { echo "NA"; } else {
                          echo "<form method='POST' action='view-attendance-pic.php' target='_blank'><input type='hidden' value='$row[in_photo]' name='encoded_photo'><img src='data:image/gif;base64," . $row['in_photo'] . "' style='width:35px;border-radius:50%;margin-right:15px;' onclick='this.parentNode.submit();' title='view photo'></img></form>";
                    } ?></td>

                    <td class="py-1"><?php if ($row['out_photo'] == '') { echo "NA"; } else {
                        echo "<form method='POST' action='view-attendance-pic.php' target='_blank'><input type='hidden' value='$row[out_photo]' name='encoded_photo'><img src='data:image/gif;base64," . $row['out_photo'] . "' style='width:35px;border-radius:50%;margin-right:15px;' onclick='this.parentNode.submit();' title='view photo'></img></form>";
                    } ?></td>
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
      $attendanceQuery = $_GET['dashboardQuery'];
  }
  else
  {
    $attendanceQuery ="SELECT * FROM attendance WHERE 1 ORDER BY `attendance`.`date` DESC";
  }
  $getAttendanceRecords = mysqli_query($conn, $attendanceQuery);
?>

    <div class="main-panel">
      <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Attendance Details</h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                  <th> Employee</th>
                  <th> Employee ID </th>
                  <th> Date </th>
                  <th> In Time </th>
                  <th> Out Time </th>
                  <th> Total Duration </th>
                  <th> Status </th>
                  <th> In Photo </th>
                  <th> Out Photo </th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($getAttendanceRecords)) 
                {

                  if ($row['out_time'] != '') 
                  {
                    $inDateTime = new DateTime($row['date'] . "" . $row['in_time']);
                    $outDateTime = new DateTime($row['date'] . "" . $row['out_time']);
                    $dateTimeDiff  = $inDateTime->diff($outDateTime);
                    $totalDuration = $dateTimeDiff->format("%H hrs %I min %S sec");
                  } 
                  else 
                  {
                    $totalDuration = "-";
                  }

                  $getEmpDetails = mysqli_query($conn, "SELECT first_name, last_name FROM employees  WHERE emp_id='" .  $row['emp_id'] . "'");
                  $empDetails = mysqli_fetch_array($getEmpDetails)
                ?>
                  <tr>
                    <td><?php echo $empDetails['first_name'] . " " . $empDetails['last_name'] ?></td>
                    <td><?php echo $row['emp_id'] ?></td>
                    <td data-sort="<?php echo $row['date'] ?>"><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
                    <td><?php echo $row['in_time'] ?></td>
                    <td><?php echo $row['out_time'] ?></td>
                    <td><?php echo $totalDuration ?></td>
                    <td id="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></td>
                    <td class="py-1"><?php if ($row['in_photo'] == '') { echo "NA"; } else {
                          echo "<form method='POST' action='view-attendance-pic.php' target='_blank'><input type='hidden' value='$row[in_photo]' name='encoded_photo'><img src='data:image/gif;base64," . $row['in_photo'] . "' style='width:35px;border-radius:50%;margin-right:15px;' onclick='this.parentNode.submit();' title='view photo'></img></form>" ?>
                          <?php } ?></td>

                    <td class="py-1"><?php if ($row['out_photo'] == '') { echo "NA"; } else {
                        echo "<form method='POST' action='view-attendance-pic.php' target='_blank'><input type='hidden' value='$row[out_photo]' name='encoded_photo'><img src='data:image/gif;base64," . $row['out_photo'] . "' style='width:35px;border-radius:50%;margin-right:15px;' onclick='this.parentNode.submit();' title='view photo'></img></form>" ?>
                    <?php } ?></td>
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
else 
{
  header('Location: ' . 'login.php');
}
?>