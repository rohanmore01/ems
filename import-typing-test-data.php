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
        <h4 class="text-center">Import Typing Test Data</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" enctype="multipart/form-data" autocomplete="off">          
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Upload Excel Sheet</label>
                        <div class="col-md-7">
                        <input type="file" name="document" class="form-control d-none" id="document" accept=".xls,.xlsx,.csv" required>
                        <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <span style="color:red;font-size:13px;">Please download and upload csv sheet in this format only <a href="uploads/typing_test_sample.csv"  style="font-size:13px;" download>Click Here</a></span>  
                </div>
                <br>
                <div class="col-md-6">
                <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2  mr-5" name="submit-upload-doc-form">Submit</button>
                <a href="typing-master.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2  mr-5">Cancel</a>
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

if(isset($_POST['submit-upload-doc-form']))
{
    $file  = $_FILES["document"]["tmp_name"];

    if($_FILES["document"]["size"] > 0)
    {
        $file = fopen($file, "r");

        fgetcsv($file, 10000, ",");
      
        $counter = 1;
        $result;
        while (($fileData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
          if(!empty($fileData[0]) && !empty($fileData[1]) && !empty($fileData[2]))
          {
              if($counter == 1)
              {
                $truncateQuery = "DELETE FROM `typing_test` WHERE department_id='$_GET[id]'";
                mysqli_query($conn, $truncateQuery);
              }
              $counter = 0;
              //$time = strtotime($fileData[8]);
              // $newFormatDate = date('Y-m-d',$time);

              $query = "INSERT into typing_test (`id`,`department_id`, `roll_no`, `name`, `mobile_no`, `address`, `gross_speed`,`net_speed`,`accuracy`) values(UUID(),'$_GET[id]','$fileData[0]','$fileData[1]','$fileData[2]','$fileData[3]','$fileData[4]','$fileData[5]','$fileData[6]')";

              $result = mysqli_query($conn, $query);
          }   
        }

        if($result == 1)
        {
          fclose($file);
          echo "<script type=\"text/javascript\">
          alert(\"File Data has been Imported Successfully\");
          window.location = \"typing-test.php?id=".$_GET['id']."\"
          </script>";
        }
        else
        {
          echo "<script type=\"text/javascript\">
          alert(\"Invalid Or Empty File Please Check\");
          window.location = \"typing-test.php?id=".$_GET['id']."\"
          </script>";
        }        
    }
}
?>