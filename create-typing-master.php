<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
  $getDeptName = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = 'ca8dcb2b-75f2-11ed-87f1-186024eca36c'");
?>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Typing Master Entry</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" enctype="multipart/form-data" autocomplete="off">
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
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date" name="date" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Time</label>
                            <div class="col-sm-9">
                            <input type="time" class="form-control" id="time" name="time" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">                
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Conduct By</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="conducted_by" name="conducted_by" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Doc.</label>
                            <div class="col-sm-9">
                            <input type="file" name="doc" class="form-control d-none" id="doc">
                            <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <a href="typing-master.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                      <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-create-typing-master-form">Submit</button>
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

  $('#doc').trigger('click');

  $('#doc').change(function(e) {

    var file = e.target.files[0].name;
    $('.fa-upload').html(" " + file.substr(0,25)).attr('title',file);
  });
});
</script>

<?php

if(isset($_POST['submit-create-typing-master-form'])) 
{
    if(isset($_FILES['doc']) && $_FILES['doc']['name'] != '')
    {
        $fileName = $_FILES['doc']['name'];
        $encodedDoc = chunk_split(base64_encode(file_get_contents($_FILES['doc']['tmp_name'])));
    }

    $insertQuery = "INSERT INTO typing_master(id, subject, department, date, time, conducted_by, encoded_file, file_name,created_by) VALUES(UUID(),'" . $_POST['subject'] . "','" . $_POST['department'] . "','" . $_POST['date'] . "', '" . $_POST['time'] . "','" . $_POST['conducted_by'] . "','" . $encodedDoc . "', '" . $fileName . "','" . $_SESSION['id'] . "')";
    
    $insertTypingMater = mysqli_query($conn, $insertQuery);

    if($insertTypingMater == 1)
    {
        $_SESSION["message"] = "Typing Master Created Successfully";
        header('Location: '.'typing-master.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Insert Data";
        header('Location: '.'typing-master.php');
    }
}
?>