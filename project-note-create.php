<?php
include "header.php";
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Add Project Note</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" method="post" enctype="multipart/form-data" autocomplete="off">
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
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date" name="date" required="">
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Your Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Doc.</label>
                                <div class="col-sm-9">
                                <input type="file" name="document" class="form-control d-none" id="document">
                                <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" ></i></button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class=" col-form-label col-md-3">Remark</label>
                            <div class="col-md-9">
                            <textarea class="form-control" id="remark" name="remark"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                            <a href="project-details.php?id=<?php echo $_GET['id'] ?>" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-note-create-form">Submit</button>
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

if(isset($_POST['submit-note-create-form']))
{
    if($_FILES['document']['name'] != '')
    {
        $fileName = $_FILES['document']['name'];
        $docName = chunk_split(base64_encode(file_get_contents($_FILES['document']['tmp_name'])));
    }
    else
    {
      $fileName = '';
      $docName = '';
    }

    $insertQuery = "INSERT INTO project_notes(id, subject, date, name, document_name, encoded_document, remark, project_id, created_by) VALUES(UUID(),'" . $_POST['subject'] . "','" . $_POST['date'] . "','" . $_POST['name'] . "', '" . $fileName . "','" . $docName . "','" . $_POST['remark'] . "', '" . $_GET['id'] . "', '" . $_SESSION['id'] . "')";
    $insertProjectNote = mysqli_query($conn, $insertQuery);

    if($insertProjectNote == 1)
    {
        $_SESSION["message"] = "Project Note Created Successfully";
        header('Location: '.'project-details.php?id='.$_GET["id"]);
    }
    else
    {
        $_SESSION["message"] = "Unable to Insert Data";
    }
}
?>