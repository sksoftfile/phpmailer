<?php
include('config/dbconnection.php');
$str = $_POST['str'];
$result = $db->prepare("SELECT COUNT(set_name) as notanswer FROM `q_pack` WHERE set_name = '$str' ");
	      $result->execute();
	      $row = $result->fetch();
	      echo $row['notanswer'];
?>
