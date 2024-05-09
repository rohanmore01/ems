<?php
include "header.php";
?>

<?php
    $selectProject = mysqli_query($conn, "SELECT * FROM `projects` WHERE `id` = '" . $_GET['id'] . "';");
    $Project = mysqli_fetch_assoc($selectProject);
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
        <h4 class="text-center">Project Details
        <a type="button" href='project-note-create.php?id=<?php echo $_GET['id']; ?>' title="Add Notes" class="btn btn-outline-success float-right btn-sm">Add</a>
        <a type="button" href='projects.php' title="Back" class="btn btn-outline-secondary float-right btn-sm mr-2">Back</a>
        </h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tbody>
                    <tr>
                        <td>Project Name</td>
                        <td><?php echo $Project['project_name'];  ?></td>
                        <td>Project URL</td>
                        <td><?php echo $Project['project_url'];  ?></td>
                    </tr>
                    <tr>
                        <td>Project Details</td>
                        <td colspan="3"><?php echo $Project['project_details'];  ?></td>
                    </tr>
                    <tr>        
                        <td>Project Status</td>
                        <td><?php echo $Project['status'];  ?></td>
                        <td>Project Head</td>
                        <td><?php echo $Project['project_head'];  ?></td>
                    </tr>
                    <tr>
                        <td>Officer 1</td>
                        <td><?php echo $Project['officer_1'];  ?></td>
                        <td>Officer 2</td>
                        <td><?php echo $Project['officer_2'];  ?></td>
                    </tr>
                    <tr>
                        <td>Communication</td>
                        <td><?php echo $Project['communication'];  ?></td>
                        <td>Coordinator Information</td>
                        <td><?php echo $Project['coordinator_information'];  ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <?php
            $getProjectNotes = mysqli_query($conn, "SELECT * FROM `project_notes` WHERE `project_id` = '".$_GET['id']."' ORDER BY `project_notes`.`date` DESC");
            $numRows = mysqli_num_rows($getProjectNotes);
            if($numRows > 0)
            { ?>
            <br>
        <h4 class="text-center">Project Notes</h4>
        <hr style="border-top: 1px solid black;">
        <div class="table-responsive">
        <table class="table table-bordered table-hover display nowrap data-table">
              <thead>
                <tr>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Remark</th>
                    <th>Document</th>
                    <th>Action</th>
                </tr>
              </thead>
              <?php
                    while ($getProjectNote = mysqli_fetch_assoc($getProjectNotes)) 
                    {
              ?>
                        <tr>
                            <td><?php echo $getProjectNote['subject'] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($getProjectNote['date'])); ?></td>
                            <td><?php echo $getProjectNote['name'] ?></td>
                            <td><?php echo $getProjectNote['remark'] ?></td>
                            <td><?php if($getProjectNote['document_name'] == '') echo "NA"; else {?><form method='POST' action='view-project-note-doc.php' target='_blank'> <input type="hidden" value="<?php echo $getProjectNote['encoded_document'] ?>" name="encoded_document"> <input type="hidden" value="<?php echo $getProjectNote['document_name'] ?>" name="document_name"><a href="" onclick='this.parentNode.submit();' title="Download"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
  <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
</svg></a></form> <?php } ?></td>
                            <td>
                            <a type="submit" class="badge badge-success" title="Edit" href="edit-project-note.php?id=<?php echo $getProjectNote['id'] ?>&project_id=<?php echo $_GET['id']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>

                            <a type="submit" class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" title="Delete" href="delete-project-note.php?id=<?php echo $getProjectNote['id'] ?>&project_id=<?php echo $_GET['id']; ?>" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                            </a>
                            </td>
                        </tr>
            <?php
                    }
              ?>
              <tbody>
              </tbody>
        </table>
        </div>
        <?php
            }
        ?>

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
  $(".alert-section").delay(2000).fadeOut(800);
</script>