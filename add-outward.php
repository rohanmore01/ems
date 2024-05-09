<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
  $getStates = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = 'b8962fd5-755c-11ed-87f1-186024eca36c'");
  $getDeptName = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = 'ca8dcb2b-75f2-11ed-87f1-186024eca36c'");
  $getCommunicationType = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '4356fc84-7600-11ed-87f1-186024eca36c'");
  $getEmployeeNames = mysqli_query($conn, "SELECT first_name, last_name FROM `employees` WHERE `status` = '1'");
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Add Outward</h4>
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
                                <label class="col-sm-3 col-form-label">Outward Date</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="outward_date" name="outward_date">
                                </div>
                           </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Communication Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="communication_type" name="communication_type" required>
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($getCommunicationType)) 
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Classification</label>
                                <div class="col-sm-9">
                                <select class="form-control" id="classification" name="classification">
                                    <option value=""></option>
                                    <option value="Normal">Normal</option>
                                    <option value="Confidential">Confidential</option>
                                    <option value="Secreat">Secreat</option>
                                </select>
                                </div>
                           </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name Of Sender</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="name_of_sender" name="name_of_sender" required>
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($getEmployeeNames)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['first_name']." ".$row['last_name']; ?>"><?php echo $row['first_name']." ".$row['last_name']; ?></option>
                                <?php
                                    }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Of Receiver</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="address_of_receiver" name="address_of_receiver">
                                </div>
                           </div>
                        </div>
                      </div>
                      
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="department" name="department" required>
                                <option value=""></option>
                              <?php
                                while ($row = mysqli_fetch_assoc($getDeptName)) 
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
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="state" name="state" required>
                                <option value=""></option>
                              <?php
                                while ($row = mysqli_fetch_assoc($getStates)) 
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
                                <label class="col-sm-3 col-form-label">Remarks</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="remarks" name="remarks">
                                </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Doc.</label>
                                <div class="col-sm-9">
                                <input type="file" name="document" class="form-control d-none" id="document">
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 ">
                            <a href="outwards.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-outward-form">Submit</button>
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
</script>

<?php
if(isset($_POST['submit-add-outward-form']))
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

  $insertQuery = "INSERT INTO outwards(id, subject, outward_date, communication_type, classification, year,department, remarks, name_of_sender, address_of_receiver, state, upload_name, upload, created_by) VALUES(UUID(),'" . $_POST['subject'] . "','" . $_POST['outward_date'] . "','" . $_POST['communication_type'] . "', '" . $_POST['classification'] . "', '" . date('Y', strtotime($_POST['outward_date'])) . "','" . $_POST['department'] . "', '" . $_POST['remarks'] . "','" . $_POST['name_of_sender'] . "','" . $_POST['address_of_receiver'] . "','" . $_POST['state'] . "','" . $fileName . "','" . $docData . "', '" . $_SESSION["id"] . "')";

  $addOutward = mysqli_query($conn, $insertQuery);

  if($addOutward == 1)
  {
      $_SESSION["message"] = "Outward Entry Added Successfully";
      header('Location: '.'outwards.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Insert Data";
      header('Location: '.'outwards.php');
  }
}
?>