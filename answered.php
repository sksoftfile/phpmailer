<?php
include('config/dbconnection.php');
$str = $_POST['str'];
$result = $db->prepare("SELECT COUNT(respone) as answer FROM `response` WHERE $str");
	      $result->execute();
	      $row = $result->fetch();
	      echo $row['answer'];
?>
