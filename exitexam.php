<?php
session_start();
 require_once('includexa/function/autoload.php');
      $fetch = new fetchRecord;
      $candetail = $fetch->candidatedetail();
      $canimg = $fetch->candidateimg();
?>
<html>
<head>
	<title>Exam</title>
	 <link rel="stylesheet" href="css/bootstrap_4.5.2.css">
  <script src="js/ajax_jquery_3.5.1.js"></script>
  <script src="js/cdnjs_popper_1.16.0.js"></script>
  <script src="js/bootstrap_4.5.2.js"></script>

</head>
<body class="">
    <div class="col-sm-12" style="margin-top: 15%">
      <center>
        <div style="border:groove;width: 40%" class="bg-light">
        <p style="font-size: 1.3em;">Dear Candidate, You have now successfully completed the Exam.</p>
        <p style="font-size: 1.3em">Please click on the below button to exit.</p><br/>
        <button type="button" class="btn  btn-primary col-md-3" id="" onclick="closewindow()" style="">Exit Exam</button><br/><br/>
      </div>
      </center>
    </div>
</body>

<script src="js/custom.js"></script>

</html>