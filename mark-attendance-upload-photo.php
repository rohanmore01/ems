<?php
ini_set('display_errors', '1');
include "db.php";

if (isset($_POST['photo'])) {
    $todayDate = date("Y-m-d");
    $todayTime = date("h:i:s A");

    $checkEmpExists = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id='" . $_POST['eno'] . "'");

    $row = mysqli_num_rows($checkEmpExists);

    if ($row > 0) {
        $row = mysqli_fetch_array($checkEmpExists);


        if ($row['status'] == 1 && $row['email_verified_at'] != NULL) {
            $checkAttenaceRecordExists = mysqli_query($conn, "SELECT * FROM attendance WHERE emp_id='" . $_POST['eno'] . "' AND date='" . $todayDate . "'");
            $getAttendaceRecord = mysqli_fetch_array($checkAttenaceRecordExists);

            $getAttendaceRecordRows = mysqli_num_rows($checkAttenaceRecordExists);

            if ($getAttendaceRecordRows == 0) {
                $data['status'] = 2;
                $data['msg'] = '<h6 style="color:red">Attendance Mark Option Not Available Today</h6>';
                echo json_encode($data);
                die();
            }

            if ($getAttendaceRecord['in_time'] == '') {
                //for photo upload
                $encoded_data = $_POST['photo'];
                $binary_data = base64_decode($encoded_data);
                $photoname = 'temp.jpeg';

                //timestamp on photo code
                header("Content-type: image/jpeg");
                $string = "Check In : " . date("d-m-Y", strtotime($todayDate)) . " " . $todayTime;
                $image = imagecreatefromstring($binary_data);
                $stringColour = imagecolorallocate($image, 255, 0, 0);
                $px = round((imagesx($image) - 5 * strlen($string)) / 2);
                imagestring($image, 3, $px, 220, $string, $stringColour);
                imagejpeg($image, "uploads/$photoname");
                $encodedImgData = chunk_split(base64_encode(file_get_contents("uploads/$photoname")));

                //end

                //$result = file_put_contents('uploads/'.$photoname, $binary_data);
                //end

                $updateQuery = "UPDATE `attendance` SET `in_time`='" . $todayTime . "',`status`='P', `in_photo`='" . $encodedImgData . "' WHERE emp_id='" . $_POST['eno'] . "' AND date='" . $todayDate . "'";

                mysqli_query($conn, $updateQuery);
                $data['status'] = 1;
                $data['msg'] = '<h6 style="color:green">Attendance Mark In</h6>';
                $data['name'] = "Name: " . $row["first_name"] . " " . $row["last_name"];
                $data['emp_id'] =  "Emp Id: " . $_POST['eno'];
                $data['photo'] =  $photoname;
                $data['in_time'] =  "In Time: " . date("d-m-Y", strtotime($todayDate)) . " " . $todayTime;
                echo json_encode($data);
            } else {
                //for photo upload
                $encoded_data = $_POST['photo'];
                $binary_data = base64_decode($encoded_data);
                $photoname = 'temp.jpeg';

                //timestamp on photo code
                header("Content-type: image/jpeg");
                $string = "Check Out : " . date("d-m-Y", strtotime($todayDate)) . " " . $todayTime;
                $image = imagecreatefromstring($binary_data);
                $stringColour = imagecolorallocate($image, 255, 0, 0);
                $px = (imagesx($image) - 5 * strlen($string)) / 2;
                imagestring($image, 3, $px, 220, $string, $stringColour);
                imagejpeg($image, "uploads/$photoname");
                $encodedImgData = chunk_split(base64_encode(file_get_contents("uploads/$photoname")));
                //end

                //$result = file_put_contents('uploads/'.$photoname, $binary_data);
                //end

                $updateQuery = "UPDATE `attendance` SET `out_time`= '" . $todayTime . "',`out_photo`= '" . $encodedImgData . "'  WHERE emp_id='" . $_POST['eno'] . "' AND date='" . $todayDate . "'";
                $updatedData = mysqli_query($conn, $updateQuery);
                $data['status'] = 1;
                $data['msg'] = '<h6 style="color:red">Attendance Mark Out</h6>';
                $data['name'] = "Name : " . $row["first_name"] . " " . $row["last_name"];
                $data['emp_id'] =  "Employee ID : " . $row['emp_id'];
                $data['photo'] = $photoname;
                $data['in_time'] =  "In Time : " . date("d-m-Y", strtotime($getAttendaceRecord['date'])) . " " . $getAttendaceRecord['in_time'];
                $data['out_time'] =  "Out Time : " . date("d-m-Y", strtotime($todayDate)) . " " . $todayTime;

                //for Total Duration
                $inDateTime = new DateTime($getAttendaceRecord['date'] . "" . $getAttendaceRecord['in_time']);
                $outDateTime = new DateTime($todayDate . "" . $todayTime);
                $dateTimeDiff  = $inDateTime->diff($outDateTime);
                $totalDuration = $dateTimeDiff->format("%H hrs %I min %S sec");
                $data['total_duration'] = "<b>Total Duration : " . $totalDuration . "</b>";

                echo json_encode($data);
            }
        } else {
            $data['status'] = 0;
            $data['msg'] = '<h6 style="color:red">Not Varified Employee</h6>';
            echo json_encode($data);
        }
    } else {
        $data['status'] = 0;
        $data['msg'] = '<h6 style="color:red">Invalid Employee ID</h6>';
        echo json_encode($data);
    }
}
