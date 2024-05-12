<?php
ini_set('display_errors', '1');
include "header.php";

if(isset($_SESSION["id"]) && isset($_SESSION["user_type"]))
{
    $getLeaveApplicationDetails = mysqli_query($conn,"SELECT * FROM `leave_application` WHERE id='" . $_GET['id'] . "'");

    $leaveApplicationDetails = mysqli_fetch_array($getLeaveApplicationDetails);
?>

<div class="main-panel">
	<div class="content-wrapper">
    <div class=" grid-margin stretch-card m-auto">

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-12 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <h4 class="text-center">Update Leave Application</h4>
                </div>
                <br>
                <form action="" class="leave-application" method="post" autocomplete="off" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id'] ?>">
                            <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $leaveApplicationDetails['subject'] ?>" required="">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Leave Type</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="leave_type" name="leave_type" required="">
                                <option value=""></option>
                                <option value="Sick Leave" <?php echo ($leaveApplicationDetails['leave_type'] == 'Sick Leave') ?  "selected" : "" ;  ?>>Sick Leave</option>
                                <option value="Other Leave" <?php echo ($leaveApplicationDetails['leave_type'] == 'Other Leave') ?  "selected" : "" ;  ?>>Other Leave</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6 d-none">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="status" name="status" required="">
                                <option value="Requested" <?php echo ($leaveApplicationDetails['status'] == 'Requested') ?  "selected" : "" ;  ?>>Request</option>
                                <option value="Approved" <?php echo ($leaveApplicationDetails['status'] == 'Approved') ?  "selected" : "" ;  ?> disabled>Approved</option>
                                <option value="Rejected" <?php echo ($leaveApplicationDetails['status'] == 'Rejected') ?  "selected" : "" ;  ?> disabled>Reject</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">From Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $leaveApplicationDetails['from_date'] ?>" required="" min="<?php echo date("Y-m-d") ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">To Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo $leaveApplicationDetails['to_date'] ?>" required="" min="<?php echo date("Y-m-d") ?>">
                        </div>            
                          </div>
                        </div>
                      </div>
                      <div class="row">                      
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Leave Duration</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="leave_duration" name="leave_duration" required="">
                                <option value=""></option>
                                <option value="Full Day" <?php echo ($leaveApplicationDetails['leave_duration'] == 'Full Day') ?  "selected" : "" ;  ?>>Full Day</option>
                                <option value="Half Day" <?php echo ($leaveApplicationDetails['leave_duration'] == 'Half Day') ?  "selected" : "" ;  ?>>Half Day</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Of Days</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="no_of_days" name="no_of_days" value="<?php echo $leaveApplicationDetails['no_of_days'] ?>" required="">
                            </div>
                          </div>
                        </div> 
                      </div>              
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload File</label>
                            <div class="col-sm-9">
                              <input type="file" class="form-control d-none" id="doc_upload" name="doc_upload" accept="application/pdf">                              
                              <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload" aria-hidden="true" encoded-file="<?php echo $leaveApplicationDetails['doc_upload'] ?>" title="<?php echo $leaveApplicationDetails['doc_name'] ?>">  <?php echo  substr($leaveApplicationDetails['doc_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                            <a href="leave-application.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                          <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="update-leave-application-form" data-toggle="modal" data-target="#pdfVerifyModal">Submit</button>
                        </div>                  
                      </div>
                    </form>

                    <!--Modal-->
                    <div class="modal fade" id="pdfVerifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:660px;">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalLabel">Verify Your Application</h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="padding:0px 30px;">     
                                      <div class="form-group">
                                      <embed id="pdfView"  src="" width="600" height="400">
                                      </div>
                                      <div class="form-group" style="text-align:center;">
                                      <label><h5>Verify Your Application </h5></label>
                                      <input type="checkbox" style="width:25px;height:25px;" id="verify_pdf" name="verify_pdf" required="" autocomplete="off">
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-gradient-success mx-auto btn-rounded btn-fw mb-2 float-right mr-5" id="submit_verify_pdf">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
              <!-- modal end -->

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
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
  header('Location: '.'login.php');
}
?>
<script src="js/edit-leave-application-js.js"></script>