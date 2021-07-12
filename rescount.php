<?php
include('config/dbconnection.php');
$qid = $_POST['qid'];
$enroll = trim($_POST['enroll']);

$result = $db->prepare("SELECT (SELECT COUNT(command) FROM response where command = 'notanswered') as notans, (SELECT COUNT(command) FROM response where command = 'answered') as ans, (SELECT COUNT(command) FROM response where command = 'markforreview') as mrkreview, (SELECT COUNT(command) FROM response where command = 'markforreviewandanswered') as reviewandans FROM `response` where enrollment_no = '$enroll' and qid = $qid");
	      $result->execute();	      
 		 $row = $result->fetch(); 		 
?>
<label id="ans"><?php echo $row['ans'];?></label>
<label id="notans"><?php echo $row['notans'];?></label>
<label id="mrkreview"><?php echo $row['mrkreview'];?></label>
<label id="reviewandans"><?php echo $row['reviewandans'];?></label>