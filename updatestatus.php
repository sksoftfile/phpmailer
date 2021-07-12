<?php
include('config/dbconnection.php');
$enroll = trim($_POST['enroll']);
   $sqlup = "UPDATE `main_regcd` SET `submit_stat` = :status where enrollment_no = '$enroll'";
           $q = $db->prepare($sqlup);
           $exe = $q->execute(array(':status'=>1));
           if($exe){
            echo "Update Successfully";
           }
           else{
            echo "Not Update Successfully";
           }     
?>
