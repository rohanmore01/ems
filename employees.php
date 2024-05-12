<?php
ini_set('display_errors', '1');
include "header.php";

 
if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
  if(isset($_GET['dashboardQuery']))
  {
      $selectEmpDetails = mysqli_query($conn, $_GET['dashboardQuery']);
  }
  else
  {
    $selectEmpDetails = mysqli_query($conn,"SELECT * FROM employees WHERE 1");
  }
?>

    <div class="main-panel">
      <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

        <?php
        if(isset($_SESSION["message"]))
        {
          echo '<span id="success" class="alert-section">
          <p class="text-center">'.$_SESSION["message"].'</p>
          <i class="fa fa-times succ" aria-hidden="true"></i>
          </span>';
          unset($_SESSION["message"]);
        }
        ?>
        
          <div class="card-body">    
            <h4 class="card-title text-center">Employees Details</h4>  
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Employee</th>
                    <th>Employee ID</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Emergency Contact No.</th>
                    <th>Status</th>
                    <th>Date Of Birth</th>
                    <th>Designation</th>
                    <th>Experience</th>
                    <th>Skills</th>
                    <th>Work Assign</th>
                    <th>Joining Date</th>
                    <th>Exit Date</th>
                    <?php
                    if($_SESSION["user_type"] == "admin")
                    { 
                    ?>
                    <th>Action</th>
                    <?php 
                    } ?>
                </tr>
              </thead>
              <tbody>
              <?php 
          while($row = mysqli_fetch_array($selectEmpDetails)) 
          { 
            if($row['skills'] != NULL && $row['skills'] != "")
            {
              $skillsList = '';
              $skillsList  .= '<ol>';
              $skills = explode(',', $row['skills']);
                foreach ($skills as $skill) {
                  $skillsList  .='<li>'.$skill.'</li>';
                }
                '</ol>';
            }

            if($row['work_assign'] != NULL && $row['work_assign'] != "")
            {
              $workAssignList = '';
              $workAssignList  .= '<ol>';
              $workAssigns = explode(',', $row['work_assign']);
                foreach ($workAssigns as $workAssign) {
                  $workAssignList  .='<li>'.$workAssign.'</li>';
                }
                '</ol>';
            }
          ?>
            <tr>
            <td class="py-1"><?php if ($row['encoded_photo'] == '') { echo "<a href='Master_Images/blank_pic.jpg' target='_blank' title='view photo'> <img src='Master_Images/blank_pic.jpg' style='width:35px;border-radius:50%;margin-right:15px;'></img> </a>"; } else {
                          echo "<img src='data:image/gif;base64,$row[encoded_photo]' style='width:35px;border-radius:50%;margin-right:15px;'></img>" ?>
            <?php } ?> <?php echo $row['first_name']." ".$row['last_name'] ?></td>
              <td><?php echo $row['emp_id'] ?></td>
              <td><?php echo $row['phone'] ?></td>
              <td><?php echo $row['email'] ?></td>
              <td><?php echo $row['emergency_contact_no'] ?></td>
              <td><?php if($row['status']==1){echo "<span style='color:green'>Active</span>";} else {echo "<span style='color:red'>In Active</span>";} ?></td>
              <td><?php echo date("d-m-Y", strtotime($row['dob'])); ?></td>
              <td><?php echo $row['designation'] ?></td>
              <td><?php echo $row['experience'] ?></td>
              <td><span data-html="true" data-toggle="tooltip" data-placement="right" title='<?php echo isset($skillsList) ? $skillsList : "NA"; ?>'><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                  </svg></span>
              </td>
              <td><span data-html="true" data-toggle="tooltip" data-placement="right" title='<?php echo isset($workAssignList) ? $workAssignList : "NA"; ?>'><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                  </svg></span>
              </td>
              <td><?php if($row['date_of_joining']) { echo date("d-m-Y", strtotime($row['date_of_joining'])); } else { echo ''; } ?></td>
              <td><?php if($row['date_of_exit']) { echo date("d-m-Y", strtotime($row['date_of_exit'])); } else { echo ''; } ?></td>

             <?php
              if($_SESSION["user_type"] == "admin")
              { 
              ?>
              <td>
                <a type="submit" class="badge badge-success" href="edit-employee.php?id=<?php echo $row['id'] ?>&emp_category=<?php echo $row['emp_category'] ?>" title="Edit Employee">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                  </svg>
               </a>

                <a type="submit" class="badge badge-danger" onclick="return confirm('Are You Sure Want To Delete ?');" href="delete-employee.php?id=<?php echo $row['id'] ?>&emp_category=<?php echo $row['emp_category'] ?>" title="Delete Employee">
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
               </a>

               <a type="submit" class="badge badge-info" href="print-id-card.php?id=<?php echo $row['id'] ?>" title="Print ID Card" target="_blank">
               <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
               </a>

               <a type="submit" class="badge badge-primary" href="view-resume.php?id=<?php echo $row['id'] ?>" title="View Resume" target="_blank">
               <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
               </a>
            </td>
              <?php
              }
              ?>
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
<script>
  $(".alert-section").delay(2000).fadeOut(800);

  $('[data-toggle="tooltip"]').tooltip();
</script>