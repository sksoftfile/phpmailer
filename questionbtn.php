<?php
include('config/dbconnection.php');
$sec = $_POST['sec'];
$setname = trim($_POST['setname']);
$pprid = trim($_POST['pprid']);
?>
<div class="row">
	<?php
	$result = $db->prepare("SELECT q_no,(SELECT command FROM `response` where qid = np.q_no) cmd FROM `q_pack` np WHERE section_id = '$sec' AND set_name = '$setname' AND paper_id = '$pprid'");
	      $result->execute();	      
 		?>
 		  	<div id="sec_a" class="">
 		<?php
 		 	for($j=1;$row = $result->fetch();$j++){
 		$qd = $row['q_no'];
 		$cmd = $row['cmd'];
	    if($cmd != ""){
		switch ($cmd) {
		case "notanswered":
		?>
		<button type="button" class="btnstyle active" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>			    
		<?php
		  break;
		  case "answered":
		?>
		<button type="button" class="btnstyle activebbb" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>			    
		  <?php
		  break;
		  case "markforreviewandanswered":
		  ?>
		<button type="button" class="btnstyle fachek" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>			    
		  <?php
		  break;
		  case "markforreview":
		  ?>
		<button type="button" class="btnstyle mrkrev" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>			    
		  <?php
		  break;  
		  default:
		  ?>
		<button type="button" class="btnstyle" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>			    
		  <?php
			}
	} else {
			?>
		<button type="button" class="btnstyle" id="<?php echo "btn".$row['q_no']; ?>" style="" onclick="getq_packbtn('<?php echo $row['q_no'] ?>')" value="<?php echo $row['q_no']; ?>"><?php echo $row['q_no']; ?></button>		
		<?php
		}	
 	} 
 	?>
 			</div>
 		</div>
