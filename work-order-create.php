<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
  $getProjectList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '0bbb0b4e-760c-11ed-87f1-186024eca36c'");
?>
<link rel="stylesheet" type="text/css" href="css/multi-select-styles.css">
<script type="text/javascript" src="js/jquery.multi-select.js"></script>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Create Work Order</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="subject" name="subject" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Project</label>
                                <div class="col-sm-9">
                                <select class="form-control" id="project" name="project" required>
                                  <option value=""></option>
                                    <?php
                                      while ($row = mysqli_fetch_assoc($getProjectList)) 
                                      {
                                    ?>
                                      <option value="<?php echo $row['value']; ?>"><?php echo $row['name']; ?></option>
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
                            <input type="text" class="form-control" id="work_order_no" name="work_order_no" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Received Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="received_date" name="received_date" required="">
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Work Order Period From</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="work_order_period_from" name="work_order_period_from" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Work Order Period To</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="work_order_period_to" name="work_order_period_to">
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
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Users</label>
                            <div class="col-sm-9">
                                <select id="users" class="form-control" name="users" multiple required="">
                                    <?php 
                                        $getUsers = mysqli_query($conn, "SELECT emp_id, first_name FROM `employees`");
                                        while($row = mysqli_fetch_assoc($getUsers))
                                        { 
                                    ?>
                                            <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['first_name']; ?></option>
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
                            <input type="hidden" name="emp_ids" id="emp_ids">
                            <input type="hidden" name="emp_names" id="emp_names">
                        </div>
                        <div class="col-md-6 ">
                            <a href="work-orders.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-work-order-form">Submit</button>
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

<?php
} 
else 
{
  header('Location: ' . 'login.php');
}
?>

<script>
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
if(isset($_POST['submit-add-work-order-form']))
{
    if($_FILES['document']['name'] != '')
    {
        $fileName = $_FILES['document']['name'];
        $docData = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
    }
    else
    {
      $fileName = '';
      $docData = '';
    }

  $insertQuery = "INSERT INTO work_orders(id, subject, project, work_order_no, received_date, work_order_period_from, work_order_period_to, doc_name, document, users_name, users, created_by) VALUES(UUID(),'" . $_POST['subject'] . "','" . $_POST['project'] . "','" . $_POST['work_order_no'] . "', '" . $_POST['received_date'] . "', '" . $_POST['work_order_period_from'] . "','" . $_POST['work_order_period_to'] . "', '" . $fileName . "','" . $docData . "','" . $_POST['emp_names'] . "','" .$_POST['emp_ids'] . "','" . $_SESSION["id"] . "')";

  $addWorkOrder = mysqli_query($conn, $insertQuery);

  if($addWorkOrder == 1)
  {
      $_SESSION["message"] = "Work Order Created Successfully";
      header('Location: '.'work-orders.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Insert Data";
      header('Location: '.'work-orders.php');
  }
}
?>