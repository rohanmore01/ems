<?php
ini_set('display_errors', '1');
include "header.php";

if(isset($_SESSION["id"]) && isset($_SESSION["user_type"]))
{
    $getEmpDetails = mysqli_query($conn,"SELECT * FROM employees WHERE id='" . $_GET['id'] . "'");

    $row = mysqli_fetch_array($getEmpDetails);
?>

<div class="main-panel">
	<div class="content-wrapper">
    <div class=" grid-margin stretch-card m-auto">

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <?php
                  if(isset($_GET['action']) =='updateProfile')
                  {
                    echo '<h4 class="text-center">Profile Update</h4>';
                  }
                  else
                  {
                    echo '<h4 class="text-center">Employee Details Update</h4>';
                  }?>
                  <hr style="border-top: 1px solid rgb(229 16 16);">
                </div>
                <br>
                <form action=""  method="post" enctype="multipart/form-data" autocomplete="off">
                    
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>" required="">

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="gender" id="gender">
                                <option value="Male" <?php echo ($row['gender'] == 'Male') ?  "selected" : "" ;  ?>>Male</option>
                                <option value="Female" <?php echo ($row['gender'] == 'Female') ?  "selected" : "" ;  ?>>Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Qualification</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $row['qualification'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Experience</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="experience" name="experience" value="<?php echo $row['experience'] ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Designation</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="designation" name="designation" required="" value="<?php echo $row['designation'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Blood Group</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="blood_group" name="blood_group">
                                <option value=""></option>
                                <option value="O+ve" <?php echo ($row['blood_group'] == 'O+ve') ?  "selected" : "" ;  ?>>O+ve</option>
                                <option value="O-ve" <?php echo ($row['blood_group'] == 'O-ve') ?  "selected" : "" ;  ?>>O-ve</option>
                                <option value="A+ve" <?php echo ($row['blood_group'] == 'A+ve') ?  "selected" : "" ;  ?>>A+ve</option>
                                <option value="A-ve" <?php echo ($row['blood_group'] == 'A-ve') ?  "selected" : "" ;  ?>>A-ve</option>
                                <option value="B+ve" <?php echo ($row['blood_group'] == 'B+ve') ?  "selected" : "" ;  ?>>B+ve</option>
                                <option value="B-ve" <?php echo ($row['blood_group'] == 'B-ve') ?  "selected" : "" ;  ?>>B-ve</option>
                                <option value="AB+ve" <?php echo ($row['blood_group'] == 'AB+ve') ?  "selected" : "" ;  ?>>AB+ve</option>
                                <option value="AB-ve" <?php echo ($row['blood_group'] == 'AB-ve') ?  "selected" : "" ;  ?>>AB-ve</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="user_type" name="user_type" <?php echo ($_SESSION["user_type"] == 'admin') ?  "" : "disabled" ;?> required>
                                <option value="Normal User" <?php echo ($row['user_type'] == 'Normal User') ?  "selected" : "" ;  ?> >Normal User</option>
                                <option value="admin" <?php echo ($row['user_type'] == 'admin') ?  "selected" : "" ;  ?> >Admin</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Photo</label>
                            <div class="col-sm-9">
                            <input type="file" name="photo" class="form-control d-none" id="photo">
                            <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload photo-upload" aria-hidden="true" title="<?php echo $row['photo_name'] ?>">  <?php echo  substr($row['photo_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Emergency Contact No.</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="emergency_contact_no" name="emergency_contact_no" value="<?php echo $row['emergency_contact_no'] ?>" required="">
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class=" col-form-label col-md-3">Address</label>
                          <div class="col-md-9">
                          <textarea class="form-control" id="address" name="address"><?php echo $row['address'] ?></textarea>
                          </div>
                        </div>
                      </div>      
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                      <div class="form-group row">
                          <label class=" col-form-label col-md-3">Skills</label>
                          <div class="col-md-9">
                          <textarea class="form-control" id="skills" name="skills"><?php echo $row['skills'] ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group row">
                          <label class=" col-form-label col-md-3">Work Assign</label>
                          <div class="col-md-9">
                          <textarea class="form-control" id="work_assign" name="work_assign"><?php echo $row['work_assign'] ?></textarea>
                          </div>
                        </div>
                      </div>      
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Resume</label>
                            <div class="col-sm-9">
                            <input type="file" name="resume" class="form-control d-none" id="resume">
                            <button type="button" class="btn btn-outline-secondary btnResumeUpload"><i class="fa fa-upload resume-upload" aria-hidden="true" title="<?php echo $row['resume_name'] ?>">  <?php echo  substr($row['resume_name'], 0, 25); ?></i></button>
                            </div>
                          </div>                     
                      </div>
                      <div class="col-md-6">
                      <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Joining</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="<?php echo $row['date_of_joining'] ?>">
                            </div>
                          </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Exit</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date_of_exit" name="date_of_exit" value="<?php echo $row['date_of_exit'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-update-form">Submit</button>       
                        </div>
                      </div> 
                    </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
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
  header('Location: '.'login.php');
}

if(isset($_POST['submit-update-form']))
{
    if(!empty($_POST['password']))
    {
      $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
      $hashedPassword   = hash('sha256', $_POST['cpassword'] . $salt);
      $passwordQuery = ",`password`='".$hashedPassword."'";
    }
    else
    {
        $passwordQuery = "";
    }
    if(!empty($_FILES['photo']['name']))
    {
        $photoName = $_FILES['photo']['name'];
        $encodedImg = chunk_split(base64_encode(file_get_contents($_FILES['photo']['tmp_name'])));
        $photoQuery = ",`photo_name`='".$photoName."', `encoded_photo`='".$encodedImg."'";
    }
    else
    {
        $photoQuery = "";
    }

    if(!empty($_FILES['resume']['name']))
    {
        $resumeName = $_FILES['resume']['name'];
        $encodedResume = chunk_split(base64_encode(file_get_contents($_FILES['resume']['tmp_name'])));
        $resumeQuery = " ,`resume_name`='".$resumeName."', `encoded_resume`='".$encodedResume."'";
    }
    else
    {
        $resumeQuery = "";
    }
    
    if(!isset($_POST['user_type']))
    {
        $_POST['user_type'] = "Normal User";
    }
    $updateQuery = "UPDATE `employees` SET `first_name`='".$_POST['first_name']."',`last_name`='".$_POST['last_name']."',`dob`='".$_POST['dob']."',`gender`='".$_POST['gender']."',`qualification`='".$_POST['qualification']."',`experience`='".$_POST['experience']."',`designation`='".$_POST['designation']."',`blood_group`='".$_POST['blood_group']."',`user_type`='".$_POST['user_type']."',`address`='".$_POST['address']."' ,`date_of_joining`='".$_POST['date_of_joining']."',`date_of_exit`='".$_POST['date_of_exit']."' ,`skills`='".$_POST['skills']."' ,`work_assign`='".$_POST['work_assign']."', `updated_by`='".$_SESSION['id']."'  $passwordQuery $photoQuery $resumeQuery WHERE id='".$_POST['id']."'";
    
    $updateEmployee = mysqli_query($conn,$updateQuery);

    if($updateEmployee == 1)
    {
      if(isset($_GET['action']) =='updateProfile')
      {
        $_SESSION["message"] = "Profile Data Updated Successfully";
      }
      else if($_GET['emp_category'] =='FMS')
      {
        $_SESSION["message"] = "FMS Data Updated Successfully";
      }
      else if($_GET['emp_category'] =='Officer')
      {
        $_SESSION["message"] = "Officer Data Updated Successfully";
      }
      else
      {
        $_SESSION["message"] = "Employee Data Updated Successfully";
      }

        if(isset($_GET['action']) =='updateProfile')
        {
          header('Location: '.'index.php');
        }
        else if($_GET['emp_category'] =='FMS')
        {
          header('Location: '.'fms.php');
        }
        else if($_GET['emp_category'] =='Officer')
        {
          header('Location: '.'officers.php');
        }
        else
        {
          header('Location: '.'employees.php');
        }
    }
    else
    {
        $message = "<center><span style='color:red;position:relative;top:10px;'>Unable to Update Data...</span></center>";
        echo $message;
    }
}
?>

<script>
$(".btnFileUpload").click(function(){

  $('#photo').trigger('click');

  $('#photo').change(function(e) {

    var file = e.target.files[0].name;
    $('.photo-upload').html(" " + file.substr(0,25)).attr('title',file);
  });
});

$(".btnResumeUpload").click(function(){

$('#resume').trigger('click');

$('#resume').change(function(e) {

  var file = e.target.files[0].name;
  $('.resume-upload').html(" " + file.substr(0,25)).attr('title',file);
});
});
</script>