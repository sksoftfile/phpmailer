<?php
include('config/dbconnection.php');
$duration = $_POST['time'];
$enroll = $_POST['enroll'];
$sts = 1;
$sqlup = "UPDATE `main_regcd` SET `exam_duration` = :duration, `con_status_val` = :sts WHERE enrollment_no = '$enroll' ";
           $q = $db->prepare($sqlup);
           $exe = $q->execute(array(':duration'=>$duration, ':sts'=>$sts));
           if($exe){
            echo "Update Successfully";
           }
           else{
            echo "Not Update Successfully";
           }
?>
