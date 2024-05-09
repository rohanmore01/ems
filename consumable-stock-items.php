<?php
include "header.php";

if(isset($_SESSION["id"]) && isset($_SESSION["user_type"])) 
{
    $selectConsumableItems = mysqli_query($conn, "SELECT * FROM `consumable_stock_items`");
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
            <h4 class="card-title text-center">Consumable Stock Items
            <a type="button" href='add-consumable-stock-item.php' title="Add Consumable Stock Item" class="btn btn-outline-success float-right btn-sm mr-2">Add</a>
            <button type="button" class="btn btn-outline-secondary float-right btn-sm mr-2" data-toggle="modal" data-target="#ConsumableStockItemModel">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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
                    <th>#</th>
                    <th>Hardware Name</th>
                    <th>Vendor Name</th>
                    <th>Model Number</th>
                    <th>Serial Number</th>
                    <th>Quantity</th>
                    <th>Purchase Order No.</th>
                    <th>Purchase Order Date</th>
                    <th>Unit Price</th>
                    <th>Entry In Stock Register</th>
                    <th>Project Name Under Hardware Received</th>
                    <th>Date Of Installation</th>
                    <th>Hardware Received By</th>
                    <th>Location of Hardware Received</th>
                    <th>Current Location of Hardware</th>
                    <th>Remark</th>
                    <th>Documents</th>
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
          $i=1;
          while($stockItem = mysqli_fetch_array($selectConsumableItems)) 
          { 
          ?>
            <tr>
                <td><?php echo $i; ?></td>
              <td><?php echo $stockItem['hardware_name'] ?></td>
              <td><?php echo $stockItem['vendor_name'] ?></td>
              <td><?php echo $stockItem['model_number'] ?></td>
              <td><?php echo $stockItem['serial_number'] ?></td>
              <td><?php echo $stockItem['quantity'] ?></td>
              <td><?php echo $stockItem['purchase_order_no'] ?></td>
              <td><?php echo date("d-m-Y", strtotime($stockItem['purchase_order_date'])); ?></td>
              <td><?php echo $stockItem['unit_price'] ?></td>
              <td><?php echo $stockItem['entry_in_stock_register'] ?></td>
              <td><?php echo $stockItem['project_name_under_hardware_received'] ?></td>
              <td><?php if($stockItem['date_of_installation']) { echo date("d-m-Y", strtotime($stockItem['date_of_installation'])); } else { echo ''; } ?></td>
              <td><?php echo $stockItem['hardware_received_by'] ?></td>
              <td><?php echo $stockItem['location_of_hardware_received'] ?></td>
              <td><?php echo $stockItem['current_location_of_hardware'] ?></td>
              <td><?php echo $stockItem['remark'] ?></td>
              <td>
                <a href="view-consumable-document.php?id=<?php echo $stockItem['id'] ?>&document=entry_in_stock_register" title="View Stock Register Entry Upload" class="btn btn-outline-dark btn-sm mr-1" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg>
                </a>
                <a href="view-consumable-document.php?id=<?php echo $stockItem['id'] ?>&document=installation_report" title="View Installation Report" class="btn btn-outline-dark btn-sm mr-1" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg>
                </a>
                <a href="view-consumable-document.php?id=<?php echo $stockItem['id'] ?>&document=hardware_received_receipt" title="View Hardware Received Receipt" class="btn btn-outline-dark btn-sm mr-1" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg>
                </a>
                <a href="view-consumable-document.php?id=<?php echo $stockItem['id'] ?>&document=hardware_invoice" title="View Hardware Invoice" class="btn btn-outline-dark btn-sm mr-1" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg>
                </a>
                <a href="view-consumable-document.php?id=<?php echo $stockItem['id'] ?>&document=gem_document" title="View Gem Document" class="btn btn-outline-dark btn-sm mr-1" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path></svg>
                </a>
                </td>
              <?php
              if($_SESSION["user_type"] == "admin")
              { 
              ?>
              <td>
                  <a type="submit" class="badge badge-success" title="Edit" href="edit-consumable-stock-item.php?id=<?php echo $stockItem['id'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                  </a>

                  <a type="submit" class="badge badge-danger" title="Delete" onclick="return confirm(' Are You Sure Want To Delete ?');" href="delete-consumable-stock-item.php?id=<?php echo $stockItem['id'] ?>" >
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
            $i++;
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
<div class="modal fade" id="ConsumableStockItemModel" tabindex="-1" role="dialog" aria-labelledby="ConsumableStockItemModelReportLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
                  <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-8">
                              <select class="form-control" id="select_field" name="select_field">
                                      <option value="=">Select Field</option>
                                      <?php
                                        $sql = "SHOW FULL COLUMNS FROM consumable_stock_items";
                                        $result = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<option value=".$row['Field']." data-id=".$row['Comment'].">".ucwords(str_replace('_', ' ', $row['Field']))."</option>";
                                        }
                                      ?>
                            </select>
                            </div>
                            <div class="col-sm-4">
                              <select class="form-control" id="condition" name="condition">
                                      <option value="=">is</option>
                                      <option value="!=">is Not</option>
                                      <option value="=''">is Empty</option>
                                      <option value="!=''">is Not Empty</option>
                                      <option value="BETWEEN">Between</option>
                              </select>
                            </div>
                          </div>
                        </div>
                  </div>  
                  <div class="row">  
                      <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="input_value" name="input_value" required="">
                              <select class="form-control d-none" id="select_value" name="select_value">
                              </select>
                              <div class="row d-none" id="betweenDate">
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="from_date" name="from_date" required="">
                                </div>
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="to_date" name="to_date" required="">
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="table_name" name="table_name" value="consumable_stock_items">
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="andOrConditon" name="andOrConditon">
                                        <option value=""></option>
                                        <option value="AND">AND</option>
                                        <option value="OR">OR</option>
                                </select>
                            </div>
                          </div>
                        </div>
                  </div> 

                  <div class="row andOrField d-none">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-8">
                              <select class="form-control" id="select_field_second" name="select_field_second">
                                      <option value="=">Select Field</option>
                                      <?php
                                        $sql = "SHOW FULL COLUMNS FROM consumable_stock_items";
                                        $result = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<option value=".$row['Field']." data-id=".$row['Comment'].">".ucwords(str_replace('_', ' ', $row['Field']))."</option>";
                                        }
                                      ?>
                            </select>
                            </div>
                            <div class="col-sm-4">
                              <select class="form-control" id="condition_second" name="condition_second">
                                      <option value="=">is</option>
                                      <option value="!=">is Not</option>
                                      <option value="=''">is Empty</option>
                                      <option value="!=''">is Not Empty</option>
                                      <option value="BETWEEN">Between</option>
                              </select>
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="row andOrField d-none">  
                      <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="input_value_second" name="input_value_second" required="">
                              <select class="form-control d-none" id="select_value_second" name="select_value_second">
                              </select>
                              <div class="row d-none" id="betweenDateSecond">
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="from_date_second" name="from_date_second" required="">
                                </div>
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="to_date_second" name="to_date_second" required="">
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="table_name" name="table_name" value="consumable_stock_items">
                            </div>
                          </div>
                        </div>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw mb-2 float-right mr-5" id="stockItemReportSearch">Search</button>
        <a class="btn btn-gradient-info btn-rounded btn-fw mb-2 float-right mr-5" data-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>