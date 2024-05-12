<?php
include "header.php";

$getTypingTestDetail = mysqli_query($conn,"SELECT * FROM `typing_test` WHERE `id` = '".$_GET['id']."' ");
$getTypingTestDetail = mysqli_fetch_assoc($getTypingTestDetail);
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit Typing Test</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Roll. No.</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="roll_no" name="roll_no" required="" value="<?php echo $getTypingTestDetail['roll_no'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" required="" value="<?php echo $getTypingTestDetail['name'] ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile No.</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="mobile_no" name="mobile_no" required="" value="<?php echo $getTypingTestDetail['mobile_no'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" required="" value="<?php echo $getTypingTestDetail['address'] ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gross Speed</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="gross_speed" name="gross_speed" required="" value="<?php echo $getTypingTestDetail['gross_speed'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Net Speed</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="net_speed" name="net_speed" required="" value="<?php echo $getTypingTestDetail['net_speed'] ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Accuracy</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="accuracy" name="accuracy" required="" value="<?php echo $getTypingTestDetail['accuracy'] ?>">    
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <a href="typing-test.php?id=<?php echo $_GET['department_id'] ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-edit-typing-test-form">Submit</button>                 
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

if(isset($_POST['submit-edit-typing-test-form']))
{
    $updateQuery = "UPDATE `typing_test` SET `roll_no`='".$_POST['roll_no']."',`name`='".$_POST['name']."',`mobile_no`='".$_POST['mobile_no']."',`address`='".$_POST['address']."', `gross_speed`='".$_POST['gross_speed']."',`net_speed`='".$_POST['net_speed']."', `accuracy`='".$_POST['accuracy']."' WHERE id='".$_GET['id']."'";
    
    $updateTypingTest = mysqli_query($conn,$updateQuery);

    if($updateTypingTest == 1)
    {
        $_SESSION["message"] = "Typing Test Updated Successfully";
        header('Location: '.'typing-test.php?id='.$_GET['department_id']);
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'typing-test.php');
    }
}
?>