<?php
include('config/dbconnection.php');
$qid = $_POST['qid'];
$enroll = trim($_POST['enroll']);

$result = $db->prepare("SELECT respone, markreview FROM `response` where enrollment_no = '$enroll' and qid = '$qid'");
	      $result->execute();	      
 		 $row = $result->fetch();
?>
<label id="resp"><?php echo $row['respone'];?></label>
<label id="mkreview"><?php echo $row['markreview'];?></label>