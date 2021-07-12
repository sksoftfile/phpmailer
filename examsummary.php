<?php
session_start();
 require_once('includexa/function/autoload.php');
      $fetch = new fetchRecord;
      $candetail = $fetch->candidatedetail();
      //$canimg = $fetch->candidateimg();
?>
<html>
<head>
	<title>Exam</title>
	 <link rel="stylesheet" href="css/bootstrap_4.5.2.css">
  <script src="js/ajax_jquery_3.5.1.js"></script>
  <script src="js/cdnjs_popper_1.16.0.js"></script>
  <script src="js/bootstrap_4.5.2.js"></script>

</head>
<body class="bg-light">

		<div class="row" style="margin: 5px;height: 130px;border:groove;">
        <div class="col-sm-8" style="">              
        </div>
        <div class="col-sm-1" style="">
        <div class="" style="width:120px;height: 120px;">
          <img src="<?php //echo $canimg['img']; ?>" alt="img" style="width: 120px;height: 120px;" />
        </div>
        </div>
        <div class="col-sm-3">
          <h3><?php echo $candetail['candidate_name']; ?></h3>
          <h5>Roll No. 
          <?php 
            $enroll = $candetail['enrollment_no']; 
            echo $enroll;
            $set_name = $candetail['setname'];
          ?>            
          </h5>
        </div>  
    </div>

    <div class="col-sm-12 table-responsive" style="height: 510px;">
      <center><label style="font-size: 1.5em;">Exam Summary</label></center>
      <table class="" border=1 width=100% style="text-align: center;">
        <thead style="background-color: #59aac2;">
         <tr style="height: 80px;">
          <th>No. Of Questions</th>
          <th>Answered</th>
          <th>Not Answered</th>
          <th>Marked For Review</th>
          <th>Answered & Marked For Review(will be considered for evaluation)</th>
          <th>Not Visited</th>
         </tr>
        </thead>
        <tbody>
      <?php 
      include('config/dbconnection.php');
      // $result = $db->prepare("SELECT * FROM `section` ");
      //       $result->execute();
            //for($i=0; $row = $result->fetch(); $i++){ 
      //         $sid = $row['id'];
       $results = $db->prepare("SELECT (SELECT COUNT(set_name) FROM q_pack WHERE set_name = '$set_name' ) as ttq, (SELECT COUNT(command) FROM response where command = 'notanswered') as notans, 
(SELECT COUNT(command) FROM response where command = 'answered') as ans,
 (SELECT COUNT(command) FROM response where command = 'markforreview') as mrkreview,
 (SELECT COUNT(command) FROM response where command = 'markforreviewandanswered') as reviewandans 
 FROM `response` where enrollment_no = '$enroll' LIMIT 1");
        $results->execute(); ?>
         <tr style="height: 50px;">
        <?php 
        for($j=0; $rows = $results->fetch(); $j++){ 
        $notvisit = $rows['ttq']-($rows['ans']+$rows['notans']+$rows['mrkreview']+$rows['reviewandans']);
          ?>
          <td><?php echo $rows['ttq']; ?></td>
          <td><?php echo $rows['ans']; ?></td>
          <td><?php echo $rows['notans']; ?></td>
          <td><?php echo $rows['mrkreview']; ?></td>
          <td><?php echo $rows['reviewandans']; ?></td>
          <td><?php echo $notvisit; ?></td>
            <?php } ?>
         </tr>       
            <?php 
          //}
      ?>  
        </tbody>
      </table>
    </div>

    <div class="col-sm-12" style="border:groove;">
      <center>
        <p style="font-style: italic;">Are you sure to submit the Group? Click 'Yes' to proceed; Click 'No' to go back.<br/>
        Dear Candidate, Once the Group is submitted, you cannot edit your responses.</p>
        <button type="button" class="btn  btn-primary col-md-1" id="" onclick="yes()" style="">Yes</button>
        <button type="button" class="btn  btn-primary col-md-1" id="" onclick="exampanel()" style="">No</button>
      </center>
    </div>
</body>

<script src="js/custom.js"></script>

</html>