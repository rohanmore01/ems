<?php
include "header.php";

$getHardwareList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '5b9ac0ed-75fe-11ed-87f1-186024eca36c'");
$getVendorList = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '85fd7658-75f0-11ed-87f1-186024eca36c'");
$locationOfHardwareReceived = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '6d187165-7630-11ed-87f1-186024eca36c'");
$currentLocationOfHardware = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '6d187165-7630-11ed-87f1-186024eca36c'");
$hardwareTransferFrom = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '6d187165-7630-11ed-87f1-186024eca36c'");
$hardwareTransferTo = mysqli_query($conn, "SELECT name, value FROM `dropdown_list` WHERE `dropdown_id` = '6d187165-7630-11ed-87f1-186024eca36c'");

$selectNonConsumableStockItem = mysqli_query($conn, "SELECT * FROM `non_consumable_stock_items` WHERE `id` = '" . $_GET['id'] . "';");
$nonConsumableStockItem = mysqli_fetch_assoc($selectNonConsumableStockItem);

$selectNonConsumableStockItemUploads = mysqli_query($conn, "SELECT entry_in_stock_register_upload_name, installation_report_name, amc_doc_name, hardware_received_receipt_name, hardware_invoice_upload_name, gem_document_name FROM `non_consumable_stock_items_uploads` WHERE `item_id` = '" . $_GET['id'] . "';");
$nonConsumableStockItemUploads = mysqli_fetch_assoc($selectNonConsumableStockItemUploads);
?>
<div class="main-panel">
  <div class="content-wrapper">

  <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body">
        <h4 class="text-center">Non Consumable Stock Item</h4>
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
                                <option value="<?php echo $row['value']; ?>" <?php echo ($row['value'] == $nonConsumableStockItem['hardware_name']) ?  "selected" : "" ;  ?>><?php echo $row['value']; ?></option>
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
                                <option value="<?php echo $row['value']; ?>" <?php echo ($row['value'] == $nonConsumableStockItem['vendor_name']) ?  "selected" : "" ;  ?>><?php echo $row['value']; ?></option>
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
                            <input type="text" class="form-control" id="model_number" name="model_number" required="" value="<?php echo $nonConsumableStockItem['model_number']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Serial Number</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required="" value="<?php echo $nonConsumableStockItem['serial_number']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" name="quantity" required="" value="<?php echo $nonConsumableStockItem['quantity']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Purchase Order No</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="purchase_order_no" name="purchase_order_no" value="<?php echo $nonConsumableStockItem['purchase_order_no']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Purchase Order Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="purchase_order_date" name="purchase_order_date" required="" value="<?php echo $nonConsumableStockItem['purchase_order_date']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit Price</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit_price" name="unit_price" value="<?php echo $nonConsumableStockItem['unit_price']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Entry In Stock Register</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="entry_in_stock_register" name="entry_in_stock_register" value="<?php echo $nonConsumableStockItem['entry_in_stock_register']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Stock Register Entry upload</label>
                            <div class="col-sm-9">
                            <input type="file" name="entry_in_stock_register_upload" class="form-control d-none" id="entry_in_stock_register_upload">
                            <button type="button" class="btn btn-outline-secondary btnStockRegisterEntryUpload"><i class="fa fa-upload stock-register-entry-upload" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['entry_in_stock_register_upload_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Project Name Under Hardware Received</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="project_name_under_hardware_received" name="project_name_under_hardware_received" value="<?php echo $nonConsumableStockItem['project_name_under_hardware_received']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date Of Installation</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="date_of_installation" name="date_of_installation" value="<?php echo $nonConsumableStockItem['date_of_installation']; ?>">
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
                            <button type="button" class="btn btn-outline-secondary btnInstallationReportUpload"><i class="fa fa-upload installation-report-upload" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['installation_report_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warranty Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="warranty_status" name="warranty_status" required>
                                <option value=""></option>
                                <option value="yes" <?php echo ($nonConsumableStockItem['warranty_status'] == "yes") ?  "selected" : "" ;  ?>>yes</option>
                                <option value="no" <?php echo ($nonConsumableStockItem['warranty_status'] == "no") ?  "selected" : "" ;  ?>>no</option>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Warranty Last Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="warranty_last_date" name="warranty_last_date" readonly="readonly" value="<?php echo $nonConsumableStockItem['warranty_last_date']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="amc_status" name="amc_status" required>
                                <option value=""></option>
                                <option value="yes" <?php echo ($nonConsumableStockItem['amc_status'] == "yes") ?  "selected" : "" ;  ?>>yes</option>
                                <option value="no" <?php echo ($nonConsumableStockItem['amc_status'] == "no") ?  "selected" : "" ;  ?>>no</option>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Period From</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="amc_period_from" name="amc_period_from" readonly="readonly" value="<?php echo $nonConsumableStockItem['amc_period_from']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Period To</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="amc_period_to" name="amc_period_to" readonly="readonly" value="<?php echo $nonConsumableStockItem['amc_period_to']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Vendor Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="amc_vendor_name" name="amc_vendor_name" readonly="readonly" value="<?php echo $nonConsumableStockItem['amc_vendor_name']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Unit Price</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="amc_unit_price" name="amc_unit_price" readonly="readonly" value="<?php echo $nonConsumableStockItem['amc_unit_price']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">AMC Document</label>
                            <div class="col-sm-9">
                            <input type="file" name="amc_document" class="form-control d-none" id="amc_document">
                            <button type="button" class="btn btn-outline-secondary btnAmcDocUpload" readonly="readonly"><i class="fa fa-upload amc-document" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['amc_doc_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Received By</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="hardware_received_by" name="hardware_received_by" value="<?php echo $nonConsumableStockItem['hardware_received_by']; ?>">
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
                            <button type="button" class="btn btn-outline-secondary hardwareReceivedReceipt"><i class="fa fa-upload hardware-received-receipt" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['hardware_received_receipt_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location of Hardware Received</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="location_of_hardware_received" name="location_of_hardware_received" required>
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($locationOfHardwareReceived)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($nonConsumableStockItem['location_of_hardware_received'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                            <label class="col-sm-3 col-form-label">Current Location of Hardware</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="current_location_of_hardware" name="current_location_of_hardware" required>
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($currentLocationOfHardware)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($nonConsumableStockItem['current_location_of_hardware'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Transfer From</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="hardware_transfer_from" name="hardware_transfer_from">
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($hardwareTransferFrom)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($nonConsumableStockItem['hardware_transfer_from'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
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
                            <label class="col-sm-3 col-form-label">Hardware Transfer To</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="hardware_transfer_to" name="hardware_transfer_to">
                                <option value=""></option>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($hardwareTransferTo)) 
                                    {
                                  ?>
                                    <option value="<?php echo $row['value']; ?>" <?php echo ($nonConsumableStockItem['hardware_transfer_to'] == $row['value']) ?  "selected" : "" ;  ?>><?php echo $row['name']; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Transfer On Date</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="hardware_transfer_on_date" name="hardware_transfer_on_date" value="<?php echo $nonConsumableStockItem['hardware_transfer_on_date']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hardware Invoice Upload</label>
                            <div class="col-sm-9">
                            <input type="file" name="hardware_invoice_upload" class="form-control d-none" id="hardware_invoice_upload">
                            <button type="button" class="btn btn-outline-secondary hardwareInvoiceUpload"><i class="fa fa-upload hardware-invoice-upload" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['hardware_invoice_upload_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gem Document</label>
                            <div class="col-sm-9">
                            <input type="file" name="gem_document" class="form-control d-none" id="gem_document">
                            <button type="button" class="btn btn-outline-secondary genDocUpload"><i class="fa fa-upload gem-document" aria-hidden="true" > <?php echo  substr($nonConsumableStockItemUploads['gem_document_name'], 0, 25); ?></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ODF Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="odf_status" name="odf_status" required>
                                <option value=""></option>
                                <option value="yes" <?php echo ($nonConsumableStockItem['odf_status'] == "yes") ?  "selected" : "" ;  ?>>yes</option>
                                <option value="no" <?php echo ($nonConsumableStockItem['odf_status'] == "no") ?  "selected" : "" ;  ?>>no</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ODF Number</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="odf_number" name="odf_number" readonly="readonly" value="<?php echo $nonConsumableStockItem['odf_number']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remark</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $nonConsumableStockItem['remark']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <a href="non-consumable-stock-items.php" class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5">Cancel</a>
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
    if(!empty($_FILES['entry_in_stock_register_upload']['name']))
    {
        $entryInStockRegisterName = $_FILES['entry_in_stock_register_upload']['name'];
        $entryInStockRegisterUpload = chunk_split(base64_encode(file_get_contents($_FILES['entry_in_stock_register_upload']['tmp_name'])));
        
        $entryInStockRegisterQuery = ",`entry_in_stock_register_upload_name`='".$entryInStockRegisterName."', `entry_in_stock_register_upload`='".$entryInStockRegisterUpload."'";
    }
    else
    {
        $entryInStockRegisterQuery = "";
    }

    if(!empty($_FILES['installation_report']['name']))
    {
        $installationReportName = $_FILES['installation_report']['name'];
        $installationReportUpload = chunk_split(base64_encode(file_get_contents($_FILES['installation_report']['tmp_name'])));
        
        $installationReportQuery = ",`installation_report_name`='".$installationReportName."', `installation_report`='".$installationReportUpload."'";
    }
    else
    {
        $installationReportQuery = "";
    }

    if(!empty($_FILES['amc_document']['name']))
    {
        $amcDocumentName = $_FILES['amc_document']['name'];
        $amcDocumentUpload = chunk_split(base64_encode(file_get_contents($_FILES['amc_document']['tmp_name'])));
        
        $amcDocumentQuery = ",`amc_doc_name`='".$amcDocumentName."', `amc_doc`='".$amcDocumentUpload."'";
    }
    else
    {
        $amcDocumentQuery = "";
    }

    if(!empty($_FILES['hardware_received_receipt']['name']))
    {
        $hardwareReceivedReceiptName = $_FILES['hardware_received_receipt']['name'];
        $hardwareReceivedReceiptUpload = chunk_split(base64_encode(file_get_contents($_FILES['hardware_received_receipt']['tmp_name'])));
        
        $hardwareReceivedReceiptQuery = ",`hardware_received_receipt_name`='".$hardwareReceivedReceiptName."', `hardware_received_receipt`='".$hardwareReceivedReceiptUpload."'";
    }
    else
    {
        $hardwareReceivedReceiptQuery = "";
    }

    if(!empty($_FILES['hardware_invoice_upload']['name']))
    {
        $hardwareInvoiceName = $_FILES['hardware_invoice_upload']['name'];
        $hardwareInvoiceUpload = chunk_split(base64_encode(file_get_contents($_FILES['hardware_invoice_upload']['tmp_name'])));
        
        $hardwareInvoiceQuery = ",`hardware_invoice_upload_name`='".$hardwareInvoiceName."', `hardware_invoice_upload`='".$hardwareInvoiceUpload."'";
    }
    else
    {
        $hardwareInvoiceQuery = "";
    }

    if(!empty($_FILES['gem_document']['name']))
    {
        $gemDocumentName = $_FILES['gem_document']['name'];
        $gemDocumentUpload = chunk_split(base64_encode(file_get_contents($_FILES['gem_document']['tmp_name'])));
        
        $gemDocumentQuery = ",`gem_document_name`='".$gemDocumentName."', `gem_document`='".$gemDocumentUpload."'";
    }
    else
    {
        $gemDocumentQuery = "";
    }

    $updateQuery = "UPDATE `non_consumable_stock_items` SET `hardware_name`='".$_POST['hardware_name']."',`vendor_name`='".$_POST['vendor_name']."',`model_number`='".$_POST['model_number']."',`serial_number`='".$_POST['serial_number']."',`quantity`='".$_POST['quantity']."',`purchase_order_no`='".$_POST['purchase_order_no']."',`purchase_order_date`='".$_POST['purchase_order_date']."',`unit_price`='".$_POST['unit_price']."',`entry_in_stock_register`='".$_POST['entry_in_stock_register']."',`project_name_under_hardware_received`='".$_POST['project_name_under_hardware_received']."' ,`date_of_installation`='".$_POST['date_of_installation']."',`warranty_status`='".$_POST['warranty_status']."' ,`warranty_last_date`='".$_POST['warranty_last_date']."' ,`amc_status`='".$_POST['amc_status']."',`amc_period_from`='".$_POST['amc_period_from']."',`amc_period_to`='".$_POST['amc_period_to']."',`amc_vendor_name`='".$_POST['amc_vendor_name']."',`amc_unit_price`='".$_POST['amc_unit_price']."',`hardware_received_by`='".$_POST['hardware_received_by']."',`location_of_hardware_received`='".$_POST['location_of_hardware_received']."',`current_location_of_hardware`='".$_POST['current_location_of_hardware']."',`hardware_transfer_from`='".$_POST['hardware_transfer_from']."',`hardware_transfer_to`='".$_POST['hardware_transfer_to']."',`hardware_transfer_on_date`='".$_POST['hardware_transfer_on_date']."',`odf_status`='".$_POST['odf_status']."',`odf_number`='".$_POST['odf_number']."',`remark`='".$_POST['remark']."' ,`updated_by`='".$_SESSION['id']."' WHERE id='".$_GET['id']."'";

    $updateDocumentUploadQuery = "UPDATE `non_consumable_stock_items_uploads` SET `item_id`='".$_GET['id']."' $entryInStockRegisterQuery  $installationReportQuery $amcDocumentQuery $hardwareReceivedReceiptQuery $hardwareInvoiceQuery $gemDocumentQuery WHERE item_id='".$_GET['id']."'";
    
    $updateNonConsumableStockItem = mysqli_query($conn,$updateQuery);

    $updateNonConsumableStockItemUpload = mysqli_query($conn,$updateDocumentUploadQuery);

    if($updateNonConsumableStockItem == 1 && $updateNonConsumableStockItemUpload == 1)
    {
        $_SESSION["message"] = "Stock Item Updated Successfully";
        header('Location: '.'non-consumable-stock-items.php');
    }
    else
    {
        $_SESSION["message"] = "Unable to Update Data";
        header('Location: '.'non-consumable-stock-items.php');
    }
}
?>

<script>

  $("#warranty_status").on("change", function(){  

          if ($(this).val()== "yes")
          {
              $("#warranty_last_date").removeAttr("readonly");
          }
          else
          {
              $("#warranty_last_date").prop("readonly", true);
              $("#warranty_last_date").val("");
          }
  });

  $("#odf_status").on("change", function(){  

    if ($(this).val()== "yes")
    {
        $("#odf_number").removeAttr("readonly");
    }
    else
    {
        $("#odf_number").prop("readonly", true);
        $("#odf_number").val("");
    }
  });

  $("#amc_status").on("change", function(){  

    if ($(this).val()== "yes")
    {
      $("#amc_period_from").removeAttr("readonly");
      $("#amc_period_to").removeAttr("readonly");
      $("#amc_vendor_name").removeAttr("readonly");
      $("#amc_unit_price").removeAttr("readonly");
      $(".btnAmcDocUpload").removeAttr("readonly");
    }
    else
    {
      $("#amc_period_from").prop("readonly", true);
      $("#amc_period_from").val("");
      $("#amc_period_to").prop("readonly", true);
      $("#amc_period_to").val("");
      $("#amc_vendor_name").prop("readonly", true);
      $("#amc_vendor_name").val("");
      $("#amc_unit_price").prop("readonly", true);
      $("#amc_unit_price").val("");
      $(".btnAmcDocUpload").prop("readonly", true);
      $("#amc_document").val("");
      $(".amc-document").html("");
    }
  });

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

  $(".btnAmcDocUpload").click(function(){

    $('#amc_document').trigger('click');

    $('#amc_document').change(function(e) {

      var file = e.target.files[0].name;
      $('.amc-document').html(" " + file.substr(0,25)).attr('title',file);
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

</script>