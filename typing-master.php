<?php
ini_set('display_errors', '1');
include "header.php";
 
if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectTypingMasterDetails = mysqli_query($conn,"SELECT * FROM typing_master WHERE 1");
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
            <h4 class="card-title text-center">Typing Master Details</h4>
            <hr style="border-top: 1px solid rgb(229 16 16);">
            <div class="table-responsive">
            <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Subject</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Conducted By</th>
                    <th>Document</th>
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
          while($row = mysqli_fetch_assoc($selectTypingMasterDetails)) 
          { 
          ?>
            <tr>
              <td><?php echo $row['subject'] ?></td>
              <td><?php echo $row['department'] ?></td>
              <td><?php echo date("d-m-Y", strtotime($row['date'])); ?></td>
              <td><?php echo $row['time'] ?></td>
              <td><?php echo $row['conducted_by'] ?></td>              
              <td><a href="view-typing-master-doc.php?id=<?php echo $row['id'] ?>" title="View Document" class="btn btn-outline-dark btn-sm mr-1" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg></a></td>
             <?php
              if($_SESSION["user_type"] == "admin")
              { 
              ?>
              <td>
                   <a type="submit" class="badge badge-success" title="Edit" href="edit-typing-master.php?id=<?php echo $row['id'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>

                  <a type="submit" class="badge badge-danger" title="Delete" onclick="return confirm(' Are You Sure Want To Delete ?');" href="delete-typing-master.php?id=<?php echo $row['id'] ?>" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                  </a>

                  <a type="submit" class="badge badge-info" title="View Typing Test List" href="typing-test.php?id=<?php echo $row['id'] ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                  </svg>
                    </a>
            </td>
              <?php
              }
              ?>
            </tr>
          <?php
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