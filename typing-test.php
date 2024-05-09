<?php
ini_set('display_errors', '1');
include "header.php";
 
if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectTypingTestDetails = mysqli_query($conn,"SELECT * FROM typing_test WHERE `department_id` = '" . $_GET['id'] . "';");

    $row = mysqli_num_rows($selectTypingTestDetails);
    
    if($row > 0)
    {
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
            <h4 class="card-title text-center">Typing Test Details
            <a type="button" href="import-typing-test-data.php?id=<?php echo $_GET['id'] ?>" class="btn btn-outline-danger float-right btn-sm mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"></path>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"></path>
              </svg> Re-Import</a>
            <button type="button" class="btn btn-outline-secondary float-right btn-sm mr-2" data-toggle="modal" data-target="#typingTestModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                  </svg>
                  <span class="visually-hidden">Report</span>
            </button>
            </h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Address</th>
                    <th>Gross Speed</th>
                    <th>Net Speed</th>
                    <th>Accuracy</th>
                    <?php
                    if($_SESSION["user_type"] == "admin")
                    { 
                    ?>
                    <th>Action</th>
                    <?php 
                    } ?>
                </tr>
              </thead>
              <tbody>
              <?php 
          while($row = mysqli_fetch_assoc($selectTypingTestDetails)) 
          { 
          ?>
            <tr>
              <td><?php echo $row['roll_no'] ?></td>
              <td><?php echo $row['name'] ?></td>
              <td><?php echo $row['mobile_no'] ?></td>
              <td><?php echo $row['address'] ?></td>
              <td><?php echo $row['gross_speed'] ?></td>
              <td><?php echo $row['net_speed'] ?></td>
              <td><?php echo $row['accuracy'] ?></td>
             <?php
              if($_SESSION["user_type"] == "admin")
              { 
              ?>
              <td>
                   <a type="submit" class="badge badge-success" title="Edit" href="edit-typing-test.php?id=<?php echo $row['id'] ?>&department_id=<?php echo $row['department_id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>

                  <a type="submit" class="badge badge-danger" title="Delete" onclick="return confirm(' Are You Sure Want To Delete ?');" href="delete-typing-test.php?id=<?php echo $row['id'] ?>&department_id=<?php echo $row['department_id'] ?>" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                  </a>
            </td>
              <?php
              }
              ?>
            </tr>
          <?php
          }
              } 
              else 
              {
                header('Location: '. 'import-typing-test-data.php?id='.$_GET['id']);
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

<!-- Modal -->
<div class="modal fade" id="typingTestModal" tabindex="-1" role="dialog" aria-labelledby="typingTestReportLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <input type="hidden" class="form-control" id="department_id" name="department_id" required="" value="<?php echo $_GET['id']; ?>">
            
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Gross Speed</label>
              <div class="col-sm-3">
                <select class="form-control" id="gross_speed_condition" name="gross_speed_condition">
                                  <option value="=">=</option>
                                  <option value=">">></option>
                                  <option value="<"><</option>
                                  <option value=">=">>=</option>
                                  <option value="<="><=</option>
                </select>
              </div>
              <div class="col-sm-6">
              <input type="number" class="form-control" id="gross_speed" name="gross_speed" required="">
              </div>
           </div>
           <div class="form-group row">
              <label class="col-sm-3 col-form-label">Net Speed</label>
              <div class="col-sm-3">
                <select class="form-control" id="net_speed_condition" name="net_speed_condition">
                                  <option value="=">=</option>
                                  <option value=">">></option>
                                  <option value="<"><</option>
                                  <option value=">=">>=</option>
                                  <option value="<="><=</option>
                </select>
              </div>
              <div class="col-sm-6">
              <input type="number" class="form-control" id="net_speed" name="net_speed" required="">
              </div>
           </div>
           <div class="form-group row">
              <label class="col-sm-3 col-form-label">Accuracy</label>
              <div class="col-sm-3">
                <select class="form-control" id="accuracy_condition" name="accuracy_condition">
                                  <option value="=">=</option>
                                  <option value=">">></option>
                                  <option value="<"><</option>
                                  <option value=">=">>=</option>
                                  <option value="<="><=</option>
                </select>
              </div>
              <div class="col-sm-6">
              <input type="number" class="form-control" id="accuracy" name="accuracy" required="">
              </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="typingTestReportSearch">Search</button>
      </div>
    </div>
  </div>
</div>