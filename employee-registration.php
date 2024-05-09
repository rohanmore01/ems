<?php
include "header.php";
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Employee Registration</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="store-registration-send-email.php" name="registrationForm" method="post" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="first_name" name="first_name" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="gender" id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="dob" name="dob" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone No.</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="phone" name="phone" required="">
                            </div>            
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Qualification</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="qualification" name="qualification">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Experience</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="experience" name="experience">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Designation</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="designation" name="designation" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Blood Group</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="blood_group" name="blood_group">
                                <option value="">select blood group</option>
                                <option value="O+ve">O+ve</option>
                                <option value="O+ve">O-ve</option>
                                <option value="A+ve">A+ve</option>
                                <option value="A-ve">A-ve</option>
                                <option value="B+ve">B+ve</option>
                                <option value="B-ve">B-ve</option>
                                <option value="B-ve">AB+ve</option>
                                <option value="B-ve">AB-ve</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="user_type" name="user_type" <?php echo (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 'admin') ?  "" : "disabled" ;?> required>
                                <option value="Normal User" selected>Normal User</option>
                                <option value="admin">Admin</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">User Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="emp_category" name="emp_category" required>
                                <option value="FMS" selected>FMS</option>
                                <option value="Officer">Officer</option>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" required="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Emergency Contact No.</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="emergency_contact_no" name="emergency_contact_no" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                            <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Skills</label>
                            <div class="col-sm-9">
                            <textarea class="form-control" id="skills" name="skills"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Work Assign</label>
                            <div class="col-sm-9">
                            <textarea class="form-control" id="work_assign" name="work_assign"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">            
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Photo</label>
                            <div class="col-sm-9">
                            <input type="file" name="photo" class="form-control d-none" id="photo">
                            <button type="button" class="btn btn-outline-secondary btnFileUpload"><i class="fa fa-upload photo-upload" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Upload Resume</label>
                              <div class="col-sm-9">
                              <input type="file" name="resume" class="form-control d-none" id="resume">
                              <button type="button" class="btn btn-outline-secondary btnResumeUpload"><i class="fa fa-upload resume-upload" aria-hidden="true" title=""></i></button>
                              </div>
                          </div>
                      </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Joining</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit-registration-form">Submit</button>
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

  $('#photo').trigger('click');

  $('#photo').change(function(e) {

    var file = e.target.files[0].name;
    $('.photo-upload').html(" " + file.substr(0,25)).attr('title',file);
  });
});

$(".btnResumeUpload").click(function(){

$('#resume').trigger('click');

$('#resume').change(function(e) {

  var file = e.target.files[0].name;
  $('.resume-upload').html(" " + file.substr(0,25)).attr('title',file);
});
});
</script>