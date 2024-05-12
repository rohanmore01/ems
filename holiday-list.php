<?php
ini_set('display_errors', '1');
include "header.php";
 
if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectHolidayList = mysqli_query($conn,"SELECT * FROM holiday_list WHERE `holiday_master` = '" . $_GET['id'] . "';");

    $row = mysqli_num_rows($selectHolidayList);
    
    if($row > 0)
    {
?>
    <div class="main-panel">
      <div class="content-wrapper">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

        <?php
        if(isset($_SESSION["message"]))
        {
          echo '<span id="success" class="alert-section">
                <h1 class="text-center">Success</h1>
                <p class="text-center">'.$_SESSION["message"].'</p>
                <i class="fa fa-times succ" aria-hidden="true"></i>
                </span>';
          unset($_SESSION["message"]);
        }
        ?>
        
          <div class="card-body">    
            <h4 class="card-title text-center"><?php echo $_GET['name'] ?>
            <?php if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin') 
            { ?>
            <a type="button" href="import-holiday-list.php?id=<?php echo $_GET['id'] ?>&name=<?php echo $_GET['name'] ?>" class="btn btn-outline-danger float-right btn-sm mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"></path>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"></path>
              </svg> Re-Import</a>
              <?php } ?>
            </h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Date</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $i=1;
          while($row = mysqli_fetch_assoc($selectHolidayList)) 
          { 
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td data-sort="<?php echo $row['date'] ?>"><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
              </tr>
            <?php
            $i++;
          }
          } 
              else 
              {
                header('Location: '. 'import-holiday-list.php?id='.$_GET['id'].'&name='.$_GET['name']);
              }
              ?>
              </tbody>
            </table>
            </div>
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
  $(".alert-section").delay(2000).fadeOut(800);
</script>