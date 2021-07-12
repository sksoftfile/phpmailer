<?php
include('config/dbconnection.php');
$setname = trim($_POST['setname']);
$pprid = trim($_POST['pprid']);
	     $result = $db->prepare("SELECT * FROM q_pack where set_name = '$setname' and paper_id = '$pprid'");
	      $result->execute();
	      for($i=1; $row = $result->fetch(); $i++){
	      	$q_type = $row['ques_type']; 
	      	?>
	    <div class="" style="border-style: double;width: 100%">
				<label style="margin-left: 5px" class="">Question No:</label>
				<label id="qno"><?php echo $i; ?></label>
		</div>
<?php 
if($q_type == "image"){
?>
		<div  class="" style="width: 100%">
				<img src="<?php echo $row['q_img'];?>" alt="img" style="width:100%"/>
				<div>A.&nbsp;&nbsp;<img src="<?php echo $row['op_a'] ?>" alt="op_A" /></div>
				<div>B.&nbsp;&nbsp;<img src="<?php echo $row['op_b'] ?>" alt="op_B" /></div>
				<div>C.&nbsp;&nbsp;<img src="<?php echo $row['op_c'] ?>" alt="op_C" /></div>
				<div>D.&nbsp;&nbsp;<img src="<?php echo $row['op_d'] ?>" alt="op_D" /></div>
		</div>
<?php } else{ ?>	
	<div  class="" style="width: 100%">
				<label style=""><?php echo $row['q_img'];?></label>
				<div><label>A.&nbsp;&nbsp;<?php echo $row['op_a'] ?></label></div>
				<div><label>B.&nbsp;&nbsp;<?php echo $row['op_b'] ?></label></div>
				<div><label>C.&nbsp;&nbsp;<?php echo $row['op_c'] ?></label></div>
				<div><label>D.&nbsp;&nbsp;<?php echo $row['op_d'] ?></label></div>
		</div>
		<?php }

	}
		?>

