<?php
ini_set('display_errors', '1');
include "header.php";

if (isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
?>
<div class="main-panel">
	<div class="content-wrapper">

	<div class="col-md-7 grid-margin stretch-card m-auto">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
				  <div class="text-center">
								<h4><?php echo date('F d,Y') ?> <span id="now"></span></h4>
							</div>
							<div class="col-md-12">
								<div class="text-center mb-4" id="log_display"></div>
								<form action="" id="att-log-frm">
									<div class="form-group">
										<label for="eno" class="control-label">Enter Employee ID</label>
										<input type="number" id="eno" name="eno" class="form-control col-sm-12" value="<?php echo $_SESSION['emp_id']; ?>" readonly>
									</div>
									<center>
										<button type="button" class="btn btn-gradient-primary mx-auto btn-rounded btn-fw mb-2 log_now" data-toggle="modal" data-target="#photoModal">Mark Attendance</button>
									</center>
									<div class="loading" style="display: none">
										<center>Please wait...</center>
									</div>

								</form>
							</div>
                  </div>
                </div>

	<!--Modal-->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Capture Photo</h5>
                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
                    </div>
                    <div id="results" class="d-none"></div>
                    <form method="post" id="photoForm">
                        <input type="hidden" id="photoStore" name="photoStore" value="">
                    </form>

							<div class="row attendanceDetailshow d-none">

								<div class="col-sm-5">
										<div id="photo">
										<img src="uploads/" id="photo_insert" alt="" height="180" width="190">
										</div>
								</div>
								<div class="col-sm-7">
									
									<div id="name">				
									</div>
									<hr>
									<div id="emp_id">										
									</div>
									<hr>
									<div id="in_time">										
									</div>
									<hr>
									<div id="out_time">										
									</div>
								</div>
							</div>
					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture Photo</button>
                    <button type="button" class="btn btn-warning mx-auto text-white d-none" id="retakephoto">Retake</button>
                    <button type="submit" class="btn btn-warning mx-auto text-white d-none" id="uploadphoto" form="photoForm">Upload</button>
					<div class="modal-title w-100 text-center" id="total_duration">
					</div>
                </div>
            </div>
        </div>
    </div>
	<!-- model end -->
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