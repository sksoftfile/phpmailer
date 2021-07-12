<?php
include('config/dbconnection.php');
$qid = $_POST['qid'];
$enroll = $_POST['enroll'];
$res = $_POST['res'];
$cmd = $_POST['com'];
$mark = "";

        try {         
          $sqlup = "UPDATE `response` SET `respone` = :res, `markreview` = :mrk , `command` = :cmdup where enrollment_no = '$enroll' and qid = $qid";
           $q = $db->prepare($sqlup);
           $exe = $q->execute(array(':res'=>$res,':mrk'=>$mark, ':cmdup'=>$cmd));
           if($exe){
            echo "Update Successfully";
           }
           else{
            echo "Not Update Successfully";
           }
           $db = null;
          }        
        catch(PDOException $e)
        {
          echo $e->getMessage();
        }
?>
