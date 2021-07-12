   
 <?php
include('config/dbconnection.php');
$i = $_POST['id'];
$enroll = $_POST['enroll'];


    $result2 = $db->prepare("select count(*) mrkans ,(select count(*) from response where command = 'answered' and enrollment_no = 'ubro123451' and section_id ='$i') as ans,(select count(*) from response where command = 'notanswered' and enrollment_no = 'ubro123451' and section_id =' $i') as notans, (select count(*) from response where command = 'markforreview' and enrollment_no = 'ubro123451' and section_id ='$i') as mrk from response where command = 'markRorRev_ANS' and enrollment_no = 'ubro123451' and section_id = '$i'");

                           $result2->execute();
                           $row2 = $result2->fetch();
                           $notvisited = 20-($row2['ans']+$row2['notans']+$row2['mrk']+$row2['mrkans']);    
                           echo ($row2["ans"].','.$row2["notans"].','.$row2["mrk"].','.$row2["mrkans"].',' .$notvisited);
                           ?>