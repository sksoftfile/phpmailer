<?php
include('config/dbconnection.php');
$qid = $_POST['id'];
$enroll = $_POST['enroll'];
$res = $_POST['res'];
$cmd = $_POST['command'];
$secid = $_POST['secid'];
        try {         
          //echo"Qid =".$qid;
           $result = $db->prepare("SELECT qid FROM `response` where qid = $qid ");
           $result->execute();       
           $row = $result->fetch();
           $resp = $row['qid'];
           echo"respone = ".$resp;
            if($qid == $resp){
              $sqlup = "UPDATE `response` SET `respone` = :res, `markreview` = '', `command` = :cmdup where enrollment_no = '$enroll' and qid = $qid";
           $q = $db->prepare($sqlup);
           $exe = $q->execute(array(':res'=>$res, ':cmdup'=>$cmd));
           if($exe){
            echo "Update Successfully";
           }
           else{
            echo "Not Update Successfully";
           }
            } else {
           $sql = "INSERT INTO `response`(`enrollment_no`, `qid`, `respone`, `command`, `markreview`, `section_id`) VALUES  (:a, :b, :c, :d, :e, :f)";
            $r = $db->prepare($sql);
            $insertques = $r->execute(array(':a'=>$enroll, ':b'=>$qid, ':c'=>$res, ':d'=>$cmd, ':e'=>'a',':f'=>$secid));
            if ($insertques) {
              echo "<div style='color:#990000' class='alert alert-success' role='alert'>Question Inserted Successfully.</div>";            
            } else {
              echo "<div style='color:green;'>Data not Inserted.</div>";
            }      
            }
            $db = null;
          }        
        catch(PDOException $e)
        {
          echo $e->getMessage();
        }
?>
