<?php
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectHolidayMaster = mysqli_query($conn, "SELECT * FROM `holiday_master` WHERE `id` = '" . $_GET['id'] . "';");
    $holiday = mysqli_fetch_assoc($selectHolidayMaster);
?>

<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Edit Holiday Master</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $holiday['name'] ?>" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Upload Circular</label>
                                <div class="col-sm-8">
                                <input type="file" name="document" class="form-control d-none" id="document">
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" title="<?php echo $holiday['document_name'] ?>"> <?php echo  substr($holiday['document_name'], 0, 25); ?></i></button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2  mr-5" name="submit-edit-holiday-master-form">Submit</button>
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

if(isset($_POST['submit-edit-holiday-master-form'])) 
{
    if(!empty($_FILES['document']['name']))
    {
        $fileName = $_FILES['document']['name'];
        $encodedDoc = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
        $documentQuery = " ,`document_name`='".$fileName."', `encoded_document`='".$encodedDoc."'";
    }
    else
    {
        $documentQuery = "";
    }

    $updateQuery = "UPDATE `holiday_master` SET `name`='".$_POST['name']."', `updated_by`='".$_SESSION['id']."' $documentQuery WHERE id='".$_GET['id']."'";
    
    $updateHolidayMaster = mysqli_query($conn,$updateQuery);

    if($updateHolidayMaster == 1)
    {
        $_SESSION["message"] = "Holiday Master Updated Successfully";
        header('Location: '.'Holidays.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'Holidays.php');
    }
}
?>