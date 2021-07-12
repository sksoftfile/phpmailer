<?php
//error_reporting(0);
  //ini_set('display_errors', 0);
include('config/dbconnection.php');
$qidss = $_POST['qid'];
$setname = trim($_POST['setname']);
$pprid = trim($_POST['pprid']);

$result = $db->prepare("SELECT *, (SELECT COUNT(set_name) FROM q_pack WHERE set_name = '$setname' ) as cnt FROM q_pack nq WHERE q_no = '$qidss' AND set_name = '$setname' AND paper_id = '$pprid' ");
	      $result->execute();
	      $row = $result->fetch();
 		 $q_type = $row['ques_type'];
 		  ?>
	<label id="qnos" style="display: none;"><?php echo $row['q_no']; ?></label>
	<label id="ttlquestion" style="display: none;"><?php echo $row['cnt']; ?></label>
	<!-- <label id="secids" style="display: none;"><?php //echo $row['section_id']; ?></label> -->
	<label id="qid" style="display: none;"><?php echo $row['q_no']; ?></label>
	<label id="qtype" style="display: none;"><?php echo $q_type; ?></label>
<?php 
if($q_type == "image"){
?>
<div  class="" id="quesid" style="">
	<div style="width: 100%" >
		<img src="<?php echo $row['q_img'];?>" alt="img" style="width:100%;"/>
	</div>
	<div><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op1" value="<?php echo $row['op_a'] ?>" onclick="checkrda($('#op1').val())"><img style="width:10%;" src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
	<div><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op2" value="<?php echo $row['op_b'] ?>" onclick="checkrdb($('#op2').val())"><img style="width: 10%;" src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
	<div><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op3" value="<?php echo $row['op_c'] ?>" onclick="checkrdc($('#op3').val())"><img style="width: 10%;" src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
	<div><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op4" value="<?php echo $row['op_d'] ?>" onclick="checkrdd($('#op4').val())"><img style="width: 10%;" src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>

</div>
<?php } else { ?>
<div  class="fntweght" style="width: 1100px;" id="zoomques">
	<div style="width: 100%">
		<label style="width: 100%;"><?php echo $row['q_img'];?></label>
	</div>
	<div style="width: 100%;"><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op1" value="<?php echo $row['op_a'] ?>" onclick="checkrda($('#op1').val())">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
	<div style="width: 100%;"><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op2" value="<?php echo $row['op_b'] ?>" onclick="checkrdb($('#op2').val())">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
	<div style="width: 100%;"><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op3" value="<?php echo $row['op_c'] ?>" onclick="checkrdc($('#op3').val())">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
	<div style="width: 100%;"><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op4" value="<?php echo $row['op_d'] ?>" onclick="checkrdd($('#op4').val())">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>

</div>
<?php } ?>