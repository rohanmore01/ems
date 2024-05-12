<?php
include "header.php";
ini_set('display_errors',0);

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectCronJob = mysqli_query($conn, "SELECT * FROM `cron_job_setting` WHERE `id` = '1';");
    $selectCronJob = mysqli_fetch_assoc($selectCronJob);

    if(isset($selectCronJob))
    {
        $week = explode(",",$selectCronJob['week']);
    }
?>
<div class="main-panel">
  <div class="content-wrapper">
  <?php
        if(isset($_SESSION["message"]))
        {
            echo '<span id="success" class="alert-section">
            <p class="text-center">'.$_SESSION["message"].'</p>
            <i class="fa fa-times succ" aria-hidden="true"></i>
            </span>';
            unset($_SESSION["message"]);
        }
    ?>
  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Attendance Mark In Cron Job Setting</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" autocomplete="off"> 
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 col-form-label" style="font-size:15px;font-weight:bold;">Week</label>
                    <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="monday" id="monday" name="week[]" <?php echo (in_array("monday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="monday">
                        Monday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="tuesday" id="tuesday" name="week[]" <?php echo (in_array("tuesday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="tuesday">
                        Tuesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="wednesday" id="wednesday" name="week[]" <?php echo (in_array("wednesday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="wednesday">
                        Wednesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="thursday" id="thursday" name="week[]" <?php echo (in_array("thursday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="thursday">
                        Thursday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="friday" id="friday" name="week[]" <?php echo (in_array("friday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="friday">
                        Friday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="saturday" id="saturday" name="week[]" <?php echo (in_array("saturday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="saturday">
                        Saturday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sunday" id="sunday" name="week[]" <?php echo (in_array("sunday", $week)) ?  "checked" : "" ;  ?>>
                    <label class="form-check-label" for="sunday">
                        Sunday
                    </label>
                </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="col-sm-7 col-form-label" style="font-size:15px;font-weight:bold;">Whether run on Holiday ?</label>
                    <div class="col-sm-5">
                    <input type="checkbox" value="yes" id="holiday" name="holiday" <?php echo ($selectCronJob['whether_run_on_holiday']=="yes") ?  "checked" : "" ;  ?>>
                    </div>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6">
                    <a href="index.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                    <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-add-cron-job-setting">Submit</button>
                </div>
                <div class="col-md-6">        
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

<?php
if(isset($_POST['submit-add-cron-job-setting']))
{
    $_POST['week'] = implode(",", $_POST['week']);
   
    $truncateQuery = "DELETE FROM `cron_job_setting`";
    mysqli_query($conn, $truncateQuery);

    $insertQuery = "INSERT INTO cron_job_setting(id, week, whether_run_on_holiday) VALUES(1,'" . $_POST['week'] . "','" . $_POST['holiday'] . "')";

    $cronJobSetting = mysqli_query($conn, $insertQuery);

  if($cronJobSetting == 1)
  {
      $_SESSION["message"] = "Cron Job Setting Saved Successfully";
      header('Location: '.'attendance-mark-in-cron-job-setting.php');
  }
  else
  {
      $_SESSION["message"] = "Unable to Save Cron Job Setting";
      header('Location: '.'attendance-mark-in-cron-job-setting.php');
  }
}
?>

<script>
  $(".alert-section").delay(2000).fadeOut(800);
</script>