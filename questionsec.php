<?php
include('config/dbconnection.php');

$qid = $_POST['qid'];
$sec = $_POST['sec'];
$setname = trim($_POST['setname']);
$pprid = trim($_POST['pprid']);

$result = $db->prepare("SELECT *, (SELECT COUNT(set_name) FROM new_qpack WHERE set_name = '$setname' ) as cnt FROM new_qpack nq WHERE q_no = '$qid' AND set_name = '$setname' AND section_id = '$sec' AND paper_id = '$pprid'");
	      $result->execute();	      
 		 $row = $result->fetch();
 		 $q_type = $row['ques_type'];
?>	
	<label id="qnos" style="display: none;"><?php echo $row['q_no']; ?></label>
	<label id="ttlquestion" style="display: none;"><?php echo $row['cnt']; ?></label>
	<label id="sname" style="display: none;"><?php echo "&nbsp;".$row['secname']; ?></label>
	<label id="secids" style="display: none;"><?php echo $row['section_id']; ?></label>
	<label id="qid" style="display: none;"><?php echo $row['q_no']; ?></label>
	<label id="mark" style="display: none;"><?php echo $row['mark']; ?></label>
	<label id="negativemark" style="display: none;"><?php echo $row['negativemrk']; ?></label>
	<label id="qtype" style="display: none;"><?php echo $q_type; ?></label>
<?php 
if($q_type == "image"){
?>

<div id="quesid">
	<div style="width: 100%">
		<img src="<?php echo "question/".$row['question'];?>" alt="img" style="width: 100%"/>
	</div>
	<div><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op1" value="<?php echo $row['op_A'] ?>" onclick="checkrda($('#op1').val())"><img style="width: 10%;" src="<?php echo "op1/".$row['op_A'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
	<div><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op2" value="<?php echo $row['op_B'] ?>" onclick="checkrdb($('#op2').val())"><img style="width: 10%;" src="<?php echo "op2/".$row['op_B'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
	<div><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op3" value="<?php echo $row['op_C'] ?>" onclick="checkrdc($('#op3').val())"><img style="width: 10%;" src="<?php echo "op3/".$row['op_C'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
	<div><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op4" value="<?php echo $row['op_D'] ?>" onclick="checkrdd($('#op4').val())"><img style="width: 10%;" src="<?php echo "op4/".$row['op_D'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>

</div>
<?php } else{ ?>
<div  class="fntweght" style="width: 1100px;" id="zoomques">
	<div style="width: 100%">
		<label style="width: 100%;"><?php echo $row['question'];?></label>
	</div>
	<div style="width: 100%;"><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op1" value="<?php echo $row['op_A'] ?>" onclick="checkrda($('#op1').val())">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_A'] ?></label></div>
	<div style="width: 100%;"><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op2" value="<?php echo $row['op_B'] ?>" onclick="checkrdb($('#op2').val())">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_B'] ?></label></div>
	<div style="width: 100%;"><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op3" value="<?php echo $row['op_C'] ?>" onclick="checkrdc($('#op3').val())">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_C'] ?></label></div>
	<div style="width: 100%;"><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo" id="op4" value="<?php echo $row['Op_D'] ?>" onclick="checkrdd($('#op4').val())">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['Op_D'] ?></label></div>

</div>
<?php } ?>