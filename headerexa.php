<?php
//session_start();
 require_once('includexa/function/autoload.php');
      $fetch = new fetchRecord;
      $examdetail = $fetch->examdetail();
?>

	<div class="row justify-content-center" style="margin-right: 0px;">
		<div class="col-md-6" style="padding-left: 22px;padding-right: 22px;">
			<div class="card">
				<div class="card-header">
			<div class="text-center text-uppercase">
				<h4>Welcome To</h4>
				<h4><?php echo $examdetail['exam_name'];?></h4>
			</div>
			    </div>	
			</div>
		</div>
		
	</div>	



