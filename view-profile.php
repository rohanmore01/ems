<link rel="stylesheet" href="css/user-profile.css" />
<?php
ini_set('display_errors', '1');
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectEmpDetails = mysqli_query($conn,"SELECT * FROM employees WHERE id = '".$_SESSION['id']."' ");

    $row = mysqli_fetch_array($selectEmpDetails);
?>

    <div class="main-panel">
      <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
      <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-md-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"><?php if ($row['encoded_photo'] == '') { echo "<a href='Master_Images/blank_pic.jpg' target='_blank' title='view photo'> <img src='Master_Images/blank_pic.jpg' height='170' width='170' class='img-radius'></img> </a>"; } else {
                          echo "<img src='data:image/gif;base64,$row[encoded_photo]' height='170' width='170' class='img-radius'></img>" ?>
                        <?php } ?></div>
                                <h5 class="f-w-600"><?php echo $row['first_name']." ".$row['last_name'] ?></h5>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>User Type</td>
                                            <td><?php echo $row['user_type'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?php echo $row['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Emp. Code</td>
                                            <td><?php echo $row['emp_id'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-block">
                                <h5 class="m-b-20 p-b-5 b-b-default f-w-600 text-center">Your Details</h5>
                                <table class="table table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Status</td>
                                            <td><?php if($row['status']== 1){ echo "<span style='color:green'>Active</span>"; } ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td><?php echo date("d-m-Y", strtotime($row['dob'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $row['gender'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Qualification</td>
                                            <td><?php echo $row['qualification'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Experience</td>
                                            <td><?php echo $row['experience'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Designation</td>
                                            <td><?php echo $row['designation'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Blood Group</td>
                                            <td><?php echo $row['blood_group'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td class="text-wrap"><?php echo $row['address'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Joining</td>
                                            <td class="text-wrap"><?php echo date("d-m-Y", strtotime($row['date_of_joining'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Resume</td>
                                            <td><a href="view-resume.php?id=<?php echo $row['id'] ?>" title="View" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                                            </svg></a></td>
                                        </tr>
                                </table>
                            </div>
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