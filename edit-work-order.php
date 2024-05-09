<?php
include "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/multi-select-styles.css">
<script type="text/javascript" src="js/jquery.multi-select.js"></script>

<?php
    $selectWorkOrder = mysqli_query($conn, "SELECT * FROM `work_orders` WHERE `id` = '" . $_GET['id'] . "';");
    $workOrder = mysqli_fetch_assoc($selectWorkOrder);

    $getProjectList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '0bbb0b4e-760c-11ed-87f1-186024eca36c'");
?>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit Work Order</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="subject" name="subject" required="" value="<?php echo $workOrder['subject']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                <select class="form-control" id="project" name="project">
                                    <option value=""></option>
                                      <?php
                                        while ($row = mysqli_fetch_assoc($getProjectList)) 
                                        {
                                      ?>
                                        <option value="<?php echo $row['value']; ?>" <?php echo ($workOrder['project'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </div>
                           </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Work Order No.</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="work_order_no" name="work_order_no" required="" value="<?php echo $workOrder['work_order_no']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Received Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="received_date" name="received_date" required="" value="<?php echo $workOrder['received_date']; ?>">
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Work Order Period From</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="work_order_period_from" name="work_order_period_from" required="" value="<?php echo $workOrder['work_order_period_from']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Work Order Period To</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="work_order_period_to" name="work_order_period_to" value="<?php echo $workOrder['work_order_period_to']; ?>">
                                </div>
                           </div>
                        </div>
                      </div>

                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Doc.</label>
                                <div class="col-sm-9">
                                <input type="file" name="document" class="form-control d-none" id="document">
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" > <?php echo $workOrder['doc_name']; ?></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Users</label>

                            <div class="col-sm-9">
                                <select id="users" class="form-control" name="users" multiple>
                                    <?php
                                        $empIds = explode(',', $workOrder['users']);
                                        $getUsers = mysqli_query($conn, "SELECT emp_id, first_name FROM `employees`");

                                        while($row = mysqli_fetch_assoc($getUsers))
                                        {  
                                    ?>
                                        <option value="<?php echo $row['emp_id']; ?>"  <?php echo (in_array($row['emp_id'], $empIds)) ? "selected" : ""; ?>><?php echo $row['first_name']; ?></option>
                                    <?php 
                                        }
                                    ?>
                            </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="emp_ids" id="emp_ids" value="<?php echo $workOrder['users']; ?>">
                            <input type="hidden" name="emp_names" id="emp_names" value="<?php echo $workOrder['users_name']; ?>">
                        </div>
                        <div class="col-md-6 ">
                            <a href="work-orders.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-edit-work-order-form">Submit</button>
                        </div>
                      </div>           
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

    $(".btnFileUpload").click(function(){

        $('#document').trigger('click');

        $('#document').change(function(e) {

        var file = e.target.files[0].name;
        $('.fa-upload').html(" " + file.substr(0,25)).attr('title',file);
        });
    });

    $(function(){
        $('#users').multiSelect();
    });

    $(document).on('change', '#users', function() {
      $('#emp_ids').val($(this).val());
      $('#emp_names').val($('.multi-select-button').html());
    });
</script>

<?php
if(isset($_POST['submit-edit-work-order-form']))
{
    if(!empty($_FILES['document']['name']))
    {
        $fileName = $_FILES['document']['name'];
        $docData = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
        $documentQuery = " ,`doc_name`='".$fileName."', `document`='".$docData."'";
    }
    else
    {
        $documentQuery = "";
    }

    $updateQuery = "UPDATE `work_orders` SET `subject`='".$_POST['subject']."',`project`='".$_POST['project']."', `work_order_no`='".$_POST['work_order_no']."', `received_date`='".$_POST['received_date']."',`work_order_period_from`='".$_POST['work_order_period_from']."' ,`work_order_period_to`='".$_POST['work_order_period_to']."' ,`users`='".$_POST['emp_ids']."' ,`users_name`='".$_POST['emp_names']."', `updated_by`='".$_SESSION['id']."' $documentQuery WHERE id='".$_GET['id']."'";
    
    $updateWorkOrder = mysqli_query($conn, $updateQuery);

    if($updateWorkOrder == 1)
    {
        $_SESSION["message"] = "Work Order Updated Successfully";
        header('Location: '.'work-orders.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'work-orders.php');
    }
}
?>