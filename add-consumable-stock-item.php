<?php
include "header.php";

$getHardwareList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '99b5bb06-75ef-11ed-87f1-186024eca36c'");
$getVendorList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '85fd7658-75f0-11ed-87f1-186024eca36c'");
$getHardwareLocationList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '6d187165-7630-11ed-87f1-186024eca36c'");

  $hardwareLocationDropdown = "";

  while ($row = mysqli_fetch_assoc($getHardwareLocationList)) 
  {
    $hardwareLocationDropdown .= "<option value='".$row['value']."'>".$row['name']."</option>";
  }

?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Consumable Stock Item</h4>
        <hr style="border-top: 1px solid rgb(229 16 16);">
        <form class="form-sample" action="" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Name</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="hardware_name" name="hardware_name" required>
                                <option value=""></option>
                              <?php
                                while ($row = mysqli_fetch_assoc($getHardwareList)) 
                                {
                              ?>
                                <option value="<?php echo $row['value']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                }
                            ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vendor Name</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="vendor_name" name="vendor_name" required>
                                <option value=""></option>
                              <?php
                                while ($row = mysqli_fetch_assoc($getVendorList)) 
                                {
                              ?>
                                <option value="<?php echo $row['value']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                }
                            ?>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Model Number</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="model_number" name="model_number" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Serial Number</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required="">
                            <small id="serialNoHelp" class="form-text text-danger"></small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="quantity" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Purchase Order No</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="purchase_order_no" name="purchase_order_no">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Purchase Order Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="purchase_order_date" name="purchase_order_date" required="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit Price</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit_price" name="unit_price">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Entry In Stock Register</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="entry_in_stock_register" name="entry_in_stock_register">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Stock Register Entry upload</label>
                            <div class="col-sm-9">
                            <input type="file" name="entry_in_stock_register_upload" class="form-control d-none" id="entry_in_stock_register_upload">
                            <button type="button" class="btn btn-outline-secondary btnStockRegisterEntryUpload"><i class="fa fa-upload stock-register-entry-upload" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Project Name Under Hardware Received</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="project_name_under_hardware_received" name="project_name_under_hardware_received">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Installation</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date_of_installation" name="date_of_installation">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload Installation Report</label>
                            <div class="col-sm-9">
                            <input type="file" name="installation_report" class="form-control d-none" id="installation_report">
                            <button type="button" class="btn btn-outline-secondary btnInstallationReportUpload"><i class="fa fa-upload installation-report-upload" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Received By</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="hardware_received_by" name="hardware_received_by">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Received Receipt</label>
                            <div class="col-sm-9">
                            <input type="file" name="hardware_received_receipt" class="form-control d-none" id="hardware_received_receipt">
                            <button type="button" class="btn btn-outline-secondary hardwareReceivedReceipt"><i class="fa fa-upload hardware-received-receipt" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location of Hardware Received</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="location_of_hardware_received" name="location_of_hardware_received" required>
                                <option value=""></option>
                                <?php echo $hardwareLocationDropdown; ?>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Current Location of Hardware</label>
                            <div class="col-sm-9">      
                            <select class="form-control" id="current_location_of_hardware" name="current_location_of_hardware" required>
                                <option value=""></option>
                                <?php echo $hardwareLocationDropdown; ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Invoice Upload</label>
                            <div class="col-sm-9">
                            <input type="file" name="hardware_invoice_upload" class="form-control d-none" id="hardware_invoice_upload">
                            <button type="button" class="btn btn-outline-secondary hardwareInvoiceUpload"><i class="fa fa-upload hardware-invoice-upload" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      

                      <div class="row">                      
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gem Document</label>
                            <div class="col-sm-9">
                            <input type="file" name="gem_document" class="form-control d-none" id="gem_document">
                            <button type="button" class="btn btn-outline-secondary genDocUpload"><i class="fa fa-upload gem-document" aria-hidden="true" ></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remark</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="remark" name="remark">
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <a href="consumable-stock-items.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
                            <button type="submit" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" name="submit">Submit</button>
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
if(isset($_POST['submit']))
{
  $getUuid = mysqli_query($conn, "SELECT UUID()");
  $getUuid = mysqli_fetch_assoc($getUuid);

  $insertQuery = "INSERT INTO `consumable_stock_items`(`id`, `hardware_name`, `vendor_name`, `model_number`, `serial_number`, `quantity`, `purchase_order_no`, `purchase_order_date`, `unit_price`, `entry_in_stock_register`, `project_name_under_hardware_received`, `date_of_installation`, `hardware_received_by`, `location_of_hardware_received`, `current_location_of_hardware`, `remark`, `created_by`) VALUES('" . $getUuid['UUID()'] . "','" . $_POST['hardware_name'] . "','" . $_POST['vendor_name'] . "','" . $_POST['model_number'] . "', '" . $_POST['serial_number'] . "','" . $_POST['quantity'] . "','" . $_POST['purchase_order_no'] . "','" . $_POST['purchase_order_date'] . "','" . $_POST['unit_price'] . "','" . $_POST['entry_in_stock_register'] . "','" . $_POST['project_name_under_hardware_received'] . "','" . $_POST['date_of_installation'] . "','" . $_POST['hardware_received_by'] . "','" . $_POST['location_of_hardware_received'] . "','" . $_POST['current_location_of_hardware'] . "','" . $_POST['remark'] . "','" . $_SESSION['id'] . "')";

  $insertConsumableItem = mysqli_query($conn, $insertQuery);


  //for document insertion
  if($_FILES['entry_in_stock_register_upload']['name'] != '')
  {
    $entryInStockRegisterName = $_FILES['entry_in_stock_register_upload']['name'];
    $entryInStockRegisterBase64 = chunk_split(base64_encode(file_get_contents($_FILES['entry_in_stock_register_upload']['tmp_name'])));
  }
  else
  {
    $entryInStockRegisterName = "";
    $entryInStockRegisterBase64 = "";
  }

  if($_FILES['installation_report']['name'] != '')
  {
    $installationReportName = $_FILES['installation_report']['name'];
    $installationReportBase64 = chunk_split(base64_encode(file_get_contents($_FILES['installation_report']['tmp_name'])));
  }
  else
  {
    $installationReportName = "";
    $installationReportBase64 = "";
  }

  if($_FILES['hardware_received_receipt']['name'] != '')
  {
    $hardwareReceivedReceiptName = $_FILES['hardware_received_receipt']['name'];
    $hardwareReceivedReceiptBase64 = chunk_split(base64_encode(file_get_contents($_FILES['hardware_received_receipt']['tmp_name'])));
  }
  else
  {
    $hardwareReceivedReceiptName = "";
    $hardwareReceivedReceiptBase64 = "";
  }

  if($_FILES['hardware_invoice_upload']['name'] != '')
  {
    $hardwareInvoiceUpload = $_FILES['hardware_invoice_upload']['name'];
    $hardwareInvoiceUploadBase64 = chunk_split(base64_encode(file_get_contents($_FILES['hardware_invoice_upload']['tmp_name'])));
  }
  else
  {
    $hardwareInvoiceUpload = "";
    $hardwareInvoiceUploadBase64 = "";
  }

  if($_FILES['gem_document']['name'] != '')
  {
    $gemDocName = $_FILES['gem_document']['name'];
    $gemDocBase64 = chunk_split(base64_encode(file_get_contents($_FILES['gem_document']['tmp_name'])));
  }
  else
  {
    $gemDocName = "";
    $gemDocBase64 = "";
  }

  $insertDocument = mysqli_query($conn, "INSERT INTO `consumable_stock_items_uploads`(`id`, `item_id`, `entry_in_stock_register_upload_name`, `entry_in_stock_register_upload`, `installation_report_name`, `installation_report`, `hardware_received_receipt_name`, `hardware_received_receipt`, `hardware_invoice_upload_name`, `hardware_invoice_upload`, `gem_document_name`, `gem_document`) VALUES(UUID(),'" . $getUuid['UUID()'] . "','" . $entryInStockRegisterName . "','" . $entryInStockRegisterBase64 . "','" . $installationReportName . "','" . $installationReportBase64 . "','" . $hardwareReceivedReceiptName . "','" . $hardwareReceivedReceiptBase64 . "','" . $hardwareInvoiceUpload . "','" . $hardwareInvoiceUploadBase64 . "','" . $gemDocName . "','" . $gemDocBase64 . "')");


  if($insertConsumableItem == 1 && $insertDocument == 1)
  {
      $_SESSION["message"] = "Stock Item Added Successfully";
      header('Location: '.'consumable-stock-items.php');
  }
  else
  {
     $_SESSION["message"] = "Unable to Insert Data";
     header('Location: '.'consumable-stock-items.php');
  }
}
?>

<script>
  $(".btnStockRegisterEntryUpload").click(function(){

    $('#entry_in_stock_register_upload').trigger('click');

    $('#entry_in_stock_register_upload').change(function(e) {

      var file = e.target.files[0].name;
      $('.stock-register-entry-upload').html(" " + file.substr(0,25)).attr('title',file);
    });
  });

  $(".btnInstallationReportUpload").click(function(){

    $('#installation_report').trigger('click');

    $('#installation_report').change(function(e) {

      var file = e.target.files[0].name;
      $('.installation-report-upload').html(" " + file.substr(0,25)).attr('title',file);
    });
  });

  $(".hardwareReceivedReceipt").click(function(){

    $('#hardware_received_receipt').trigger('click');

    $('#hardware_received_receipt').change(function(e) {

      var file = e.target.files[0].name;
      $('.hardware-received-receipt').html(" " + file.substr(0,25)).attr('title',file);
    });
  });

  $(".hardwareInvoiceUpload").click(function(){

    $('#hardware_invoice_upload').trigger('click');

    $('#hardware_invoice_upload').change(function(e) {

      var file = e.target.files[0].name;
      $('.hardware-invoice-upload').html(" " + file.substr(0,25)).attr('title',file);
    });
  });

  $(".genDocUpload").click(function(){

    $('#gem_document').trigger('click');

    $('#gem_document').change(function(e) {

      var file = e.target.files[0].name;
      $('.gem-document').html(" " + file.substr(0,25)).attr('title',file);
    });
  });


  $("#serial_number").blur(function(){
  
    var serialNo = $(this).val();
    var table = "consumable_stock_items";
    $.ajax({
              url: 'check-serial-no-exists.php',
              method: 'POST',
              data: {
                  serialNo : serialNo,
                  table : table
              },
              error: err => console.log(err),
              success: function(resp) {

                  resp = JSON.parse(resp);
                  if(resp.status == 1)
                  {
                    $('#serialNoHelp').html(resp.msg);
                  }
                  else
                  {
                    $('#serialNoHelp').html("");
                  }
              }
          });
  });

</script>