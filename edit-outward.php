<?php
include "header.php";

$selectOutward = mysqli_query($conn, "SELECT * FROM `outwards` WHERE `id` = '" . $_GET['id'] . "';");
$selectOutward = mysqli_fetch_assoc($selectOutward);
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
        <h4 class="text-center">Edit Outward</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="subject" name="subject" required="" value="<?php echo $selectOutward['subject']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Outward Date</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="outward_date" name="outward_date" value="<?php echo $selectOutward['outward_date']; ?>">
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
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($row['value'] == $selectOutward['communication_type']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                                    <option value="Normal" <?php echo ($selectOutward['classification'] == 'Normal') ?  "selected" : "" ;  ?>>Normal</option>
                                    <option value="Confidential" <?php echo ($selectOutward['classification'] == 'Confidential') ?  "selected" : "" ;  ?>>Confidential</option>
                                    <option value="Secreat" <?php echo ($selectOutward['classification'] == 'Secreat') ?  "selected" : "" ;  ?>>Secreat</option>
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
                                    <option value="<?php echo $row['first_name']." ".$row['last_name']; ?>" <?php echo ($selectOutward['name_of_sender'] == $row['first_name']." ".$row['last_name']) ?  "selected" : "" ;  ?>><?php echo $row['first_name']." ".$row['last_name']; ?></option>
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
                                <input type="text" class="form-control" id="address_of_receiver" name="address_of_receiver" value="<?php echo $selectOutward['address_of_receiver']; ?>">
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
                                <option value="<?php echo $row['value']; ?>" <?php echo ($selectOutward['department'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                                <option value="<?php echo $row['value']; ?>" <?php echo ($selectOutward['state'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                                <input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $selectOutward['remarks']; ?>">
                                </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Doc.</label>
                                <div class="col-sm-9">
                                <input type="file" name="document" class="form-control d-none" id="document">                                
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" title="<?php echo $selectOutward['upload_name'] ?>"> <?php echo  substr($selectOutward['upload_name'], 0, 25); ?></i></button>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        </div>                    
                          <div class="col-md-6 ">
                              <a href="outwards.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                              <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-edit-outward-form">Submit</button>
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
if(isset($_POST['submit-edit-outward-form']))
{
    if(!empty($_FILES['document']['name']))
    {
        $fileName = $_FILES['document']['name'];
        $docData = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
        $documentQuery = " ,`upload_name`='".$fileName."', `upload`='".$docData."'";
    }
    else
    {
        $documentQuery = "";
    }

    $updateQuery = "UPDATE `outwards` SET `subject`='".$_POST['subject']."',`outward_date`='".$_POST['outward_date']."',`communication_type`='".$_POST['communication_type']."',`classification`='".$_POST['classification']."' ,`year`='".date('Y', strtotime($_POST['outward_date']))."' ,`department`='".$_POST['department']."',`remarks`='".$_POST['remarks']."',`name_of_sender`='".$_POST['name_of_sender']."',`address_of_receiver`='".$_POST['address_of_receiver']."',`state`='".$_POST['state']."' ,`updated_by`='".$_SESSION['id']."' $documentQuery WHERE id='".$_GET['id']."'";
    
    $upateOutwardEntry = mysqli_query($conn,$updateQuery);

    if($upateOutwardEntry == 1)
    {
        $_SESSION["message"] = "Outward Entry Updated Successfully";
        header('Location: '.'outwards.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'outwards.php');
    }
}
?>