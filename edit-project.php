<?php
include "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/multi-select-styles.css">
<script type="text/javascript" src="js/jquery.multi-select.js"></script>

<?php
    $selectProject = mysqli_query($conn, "SELECT * FROM `projects` WHERE `id` = '" . $_GET['id'] . "';");
    $Project = mysqli_fetch_assoc($selectProject);
?>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit Project</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Project Name</label>
                            <div class="col-md-10">
                            <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $Project['project_name'];  ?>" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Project Details</label>
                            <div class="col-md-10">
                            <textarea name="project_details"  class="form-control" id="project_details" cols="30" rows="10" required=""><?php echo $Project['project_details'];  ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Project URL</label>
                            <div class="col-sm-8">
                            <input type="url" class="form-control" id="project_url" name="project_url" value="<?php echo $Project['project_url'];  ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status" required>
                                <option value="Active" <?php echo ($Project['status'] == 'Active') ?  "selected" : "" ;  ?>>Active</option>
                                <option value="In Active" <?php echo ($Project['status'] == 'In Active') ?  "selected" : "" ;  ?>>In Active</option>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Communication</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="communication" name="communication" value="<?php echo $Project['communication'];  ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Coordinator Information</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="coordinator_information" name="coordinator_information" value="<?php echo $Project['coordinator_information'];  ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Project Head</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="project_head" name="project_head" value="<?php echo $Project['project_head'];  ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Officer 1</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="officer_1" name="officer_1" value="<?php echo $Project['officer_1'];  ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Officer 2</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="officer_2" name="officer_2" value="<?php echo $Project['officer_2'];  ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">User Access</label>

                            <div class="col-sm-9">
                                <select id="user_access" class="form-control" name="user_access" multiple>
                                    <?php
                                        $projectAccessEmpIds = explode(',', $Project['user_access']);
                                        $getUsers = mysqli_query($conn, "SELECT emp_id, first_name FROM `employees`");

                                        while($row = mysqli_fetch_assoc($getUsers))
                                        {  
                                    ?>
                                        <option value="<?php echo $row['emp_id']; ?>"  <?php echo (in_array($row['emp_id'], $projectAccessEmpIds)) ? "selected" : ""; ?>><?php echo $row['first_name']; ?></option>
                                    <?php 
                                        }
                                    ?>
                            </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="emp_ids" id="emp_ids">
                      <input type="hidden" name="emp_names" id="emp_names">

                    <a href="projects.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                    <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-project-update-form">Submit</button>               
          </form>
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

<script type="text/javascript">
    $(function(){
        $('#user_access').multiSelect();
    });

    $(document).on('change', '#user_access', function() {
      $('#emp_ids').val($(this).val());
      $('#emp_names').val($('.multi-select-button').html());
    });
</script>

<?php
if(isset($_POST['submit-project-update-form']))
{
    if($_POST['emp_ids'] == '' && $_POST['emp_names'] == '')
    {
        $userAccessQuery = " ";
    }
    else
    {
        $userAccessQuery = " , `user_access`='".$_POST['emp_ids']."', `user_access_name`='".$_POST['emp_names']."'";
    }

    $updateQuery = "UPDATE `projects` SET `project_name`='".$_POST['project_name']."',`project_details`='".$_POST['project_details']."', `project_head`='".$_POST['project_head']."', `officer_1`='".$_POST['officer_1']."',`officer_2`='".$_POST['officer_2']."' ,`project_url`='".$_POST['project_url']."' ,`status`='".$_POST['status']."' ,`communication`='".$_POST['communication']."' ,`coordinator_information`='".$_POST['coordinator_information']."', `updated_by`='".$_SESSION['id']."' $userAccessQuery WHERE id='".$_GET['id']."'";
    
    $updateProject = mysqli_query($conn, $updateQuery);

    if($updateProject == 1)
    {
        $_SESSION["message"] = "Project Updated Successfully";
        header('Location: '.'projects.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
    }
}
?>