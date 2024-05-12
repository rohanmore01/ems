<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
?>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Holiday Master Create</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Upload Circular</label>
                                <div class="col-sm-8">
                                <input type="file" name="document" class="form-control d-none" id="document">
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2  mr-5" name="submit-create-holiday-master-form">Submit</button>
                      <a href="holidays.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2  mr-5">Cancel</a>
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

if(isset($_POST['submit-create-holiday-master-form'])) 
{
    if($_FILES['document']['name'] != '')
    {
        $fileName = $_FILES['document']['name'];
        $encodedDoc = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
    }
    else
    {
      $fileName = '';
      $encodedDoc = '';
    }

    $insertQuery = "INSERT INTO holiday_master(id, name,document_name, encoded_document, created_by) VALUES(UUID(),'" . $_POST['name'] . "','" . $fileName . "','" . $encodedDoc . "','" . $_SESSION['id'] . "')";
    
    $insertHolidayMaster = mysqli_query($conn, $insertQuery);

    if($insertHolidayMaster == 1)
    {
        $_SESSION["message"] = "Holiday Master Created Successfully";
        header('Location: '.'Holidays.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Insert Data";
        header('Location: '.'Holidays.php');
    }
}
?>