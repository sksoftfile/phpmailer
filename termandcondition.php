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

		<div class="row" style="margin: 5px;height: 200px;">
              <div class="col-sm-9" style="border:1px solid">
                <div style="width: 100%; height: 710px; overflow-y: scroll;">
                <h5><u>General Instruction</u></h5>                 
                <label>1. The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</label>
                <label>2. The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols:</label>

                <img src="img/instruction.PNG" alt="img" height="200px";/>

                <label>The Marked for Review status for a question simply indicates that you would like to look at that question again.</label>
                <label>3. You can click on the ">" arrow which appears to the left of question palette to collapse the question palette thereby maximizing the question window. To view the question palette again, you can click on "< " which appears on the right side of question window.</label>
                <label>4. You can click on your "Profile" image on top right corner of your screen to change the language during the exam for entire question paper.</label>
                <label>5. You can click on down arrow to  navigate to the bottom and up arrow to navigate to the top of the question area, without scrolling.</label>

                <h5><u>Navigating to a Question</u></h5>
                <label>6. To answer a question, do the following:</label>
                <label>a. Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</label>
                <label>b. Click on <strong>Save & Next</strong> to save your answer for the current question and then go to the next question.</label>
                <label>c. Click on <strong>Mark for Review & Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</label>

                <h5><u>Answering a Question:</u></h5>
                <label>7. Procedure for answering a multiple choice type question:</label>
                <label>a. To select your answer, click on the button of one of the options</label>
                <label>b. To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</label>
                <label>c. To change your chosen answer, click on the button of another option</label>
                <label>d. To save your answer, you MUST click on the <strong>Save & Next</strong> button</label>
                <label>e. To mark the question for review, click on the <strong>Mark for Review & Next</strong> button.</label>
                <label>f. To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</label>

                <h5><u>Navigating through sections:</u></h5>
                <label>8. Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by clicking on the section name. The section you are currently viewing is highlighted.</label>
                <label>9. After clicking the <strong>Save & Next</strong> button on the last question for a section, you will automatically be taken to the first question of the next section.</label>
                <label>10. You can shuffle between sections and questions anytime during the examination as per your convenience only during the time stipulated.</label>
                <label>11. Candidate can view the corresponding section summary as part of the legend that appears in every section above the question palette.</label>

                <h5><u>Instruction for images:</u></h5>
                <label>12. To zoom the image provided in the question roll over it.</label>
                <hr>
              </div>
              <div style="text-align-last: right;">
                <button style="text-align-last: center;margin-bottom: 5px;" class="btn btn-default bg-success text-white col-sm-2" onclick="openotherinstruction()">Next</button>
              </div>
              
            </div>
              <div class="col-sm-3" style="border:1px solid">
              <div class="" style="width:150px;height: 150px;">
                <img src="<?php //echo $canimg['img']; ?>" alt="img" style="width: 150px;height: 150px;" />
              </div>
                <h3><?php echo $candetail['candidate_name']; ?></h3>
                <h5>Roll No. <?php echo $candetail['enrollment_no']; ?></h5>
              </div>  
            </div>
</body>

<script src="js/custom.js"></script>

</html>