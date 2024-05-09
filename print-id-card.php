<?php
ini_set('display_errors', '1');
include "db.php";
?>
<html>
    <head>
        <title>Employee ID Card</title>
        <script language="javascript">
        function printpage()
        {
                window.print();
        }
        </script>

        <style>
            #card{
                float:left;
                width:400px;
                height:240px;
                margin:5px;
                border:1px solid black;
                background-image: url("Master_Images/id_card.jpg");
                background-repeat: no-repeat;
                background-size: 400px 240px;
                -webkit-print-color-adjust: exact;
            }
            #c_left{
                margin-top:65px;
                margin-left:10px;
                float:left;
                width:80px;
                height:120px;

                
            }
            #c_box{
                width:80px; 
                height:20px;
                padding:5px;

            }
            #c_right{
                
                margin-left:120px;
                height:200px;

            }
            td{
                font-size:12px;
            }
        </style>
    </head>
   
   <?php
        
		$getEmployeeDetailsQuery = "select * from employees where id='$_GET[id]';";
		
		$getEmployeeDetails = mysqli_query($conn, $getEmployeeDetailsQuery);
		
		$row = mysqli_fetch_array($getEmployeeDetails);
    ?>
     <body>
	 <div id="card">
	  <div id="c_left">
	  <img src='data:image/gif;base64,<?php echo $row["encoded_photo"] ?>' width="80px"height="100px"style="border:1px solid black;"><br>
	  <!-- <div id="c_box" style="font-size:15px;">
	  Department:<?php echo $row['department']; ?>
	  </div> -->
	  </div>
	  <div id="c_right">
	  <div style="margin-top:2px;margin-left:150px;color:#fff;font-size:10px;font-weight:bold;">Company No. (0260)2642161 <br></div>
	   <!-- <div style="margin-left:168px;color:#fff;font-size:10px;"> 8460311007 <br></div> -->
	  <div style="margin-top:15px;margin-left:115px;color:#fff;">Employee Id: <?php echo $row['emp_id']; ?> <br></div>
	  <table style="margin-top:23px;">
	  <tr>
	  <td><b>Name</b></td><td><b>: <?php echo $row['first_name']." ".$row['last_name']; ?></b></td>
	  </tr>
	  <tr>
	  <td><b>Contact No.</b></td><td>: <?php echo $row['phone']; ?></td>
	  </tr>
      <tr>
	  <td><b>Designation</b></td><td>: <?php echo $row['designation']; ?></td>
	  </tr>
	  <tr>
	  <td><b>Date Of Birth</b></td><td>: <?php echo date("d/m/Y", strtotime($row['dob'])); ?></td>
	  </tr>
	  <tr>
	  <td><b>Blood Group</b></td><td>: <?php echo $row['blood_group']  ?></td>
	  </tr>
	  <tr>
	  <td><i>Issuing Authority</i></td>
      <!-- <td><img src=""width="100px"height="30px"></td> -->
	  </tr>
	  </table>
	  
	  </div>
	   <div style="margin-top:18px;margin-left:5px;color:#fff;font-size:14px;text-align:center;">National Informatics Centre, Silvassa</div>
	 </div>	 	
	 </body>
   </head>
</html>