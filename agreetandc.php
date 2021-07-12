<?php
// error_reporting(0);
// ini_set('display_errors', 0);
session_start();


 require_once('includexa/function/autoload.php');
      $fetch = new fetchRecord;
      $candetail = $fetch->candidatedetail();
     // $canimg = $fetch->candidateimg();
?>
<html>
<head>
	<title>Exam</title>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="css/bootstrap_4.5.2.css">
  <script src="js/ajax_jquery_3.5.1.js"></script>
  <script src="js/cdnjs_popper_1.16.0.js"></script>
  <script src="js/bootstrap_4.5.2.js"></script>

</head>
<body class="bg-light">
		<div class="row " style="margin:5px">
              <div class="col-sm-9" style="border:1px solid">
                <center><h5><u>मॉक टेस्ट के लिए प्रश्न</u></h5></center>
                <label>इस प्रश्नपत्र में वस्तुनिष्ठ प्रश्न हैं जो चार खण्डों (I, II, III और IV) में विभाजित है</label>
                <label>(अ) खण्ड - I, II और III में सामान्य जागरुकता, मानसिक योग्यता और अंकगणितीय योग्यता से संबंधित 30-30 प्रश्न हैं। ये खण्ड प्रत्येक अभ्यर्थी के लिए अनिवार्य हैं।</label>
                <label>(ब) खण्ड - IV में (क) अंग्रेजी भाषा और (ख) हिन्दी भाषा के 30-30 वस्तुनिष्ठ प्रश्न हैं। अभ्यर्थी को इनमें से किसी एक भाषा का चयन करना है और खण्ड में दिए गए सभी 30 प्रश्नों का उतर देना है।</label>
                <label><strong>नोट :</strong> प्रत्येक प्रश्न 3 (तीन अंक) का है। प्रत्येक गलत उत्तर के लिए <strong>एक</strong> अंक काटा जाएगा। प्रत्येक अनुत्तरित प्रश्न के लिए <strong>शून्य</strong> अंक प्रदान किया जाएगा।</label>
                

                <center><h5><u>Questions for Mock Test</u></h5></center>
                <label>This paper consists of Objective Type Questions and is divided into <strong>four</strong> Sections <strong>(I, II, III & IV)</strong></label>
                <label><strong>(a) Section-I, II & III</strong> consist of 30 questions each relating to General Awaress, Mental Ability and Numerical Ability. These Sections are compulsory to everybody.</label>
                <label><strong>(b) Section-IV</strong> consists of 30 Objective Type Questions on (a) English Language and (b) Hindi Language. A candidate is required to choose any <strong><i>one</i></strong> of these and attempt all <strong>30</strong> questions in the Section.</label>
                <label><strong>Note :</strong> Each question carries 3 (Three Marks). <strong>One</strong> mark will be deducted for each incorrect answer. <strong>Zero</strong> mark will be awarded for each unattempted question.</label>
                <hr>
                <div>
                <input type="checkbox" name="termandcondition" id="check" onclick="check()"/>
                <center><h5>Mock Test (CBT)</h5></center>
                <div class="row">
                <button class="btn btn-default bg-success text-white col-md-2" id="" onclick="termncndition()" style="">Previous</button>
                <div class="col-md-3"></div>
                  <button class="btn btn-default bg-success text-white col-sm-2" id="aggree" onclick="exampanel()" style="display: none">I Agree</button>
                </div>
                </div>
              </div>
              <div class="col-sm-3" style="border:1px solid">
                <div class="" style="width:150px;height: 150px">
                <img src="<?php //echo $canimg['img']; ?>" alt="img" style="width: 150px;height: 150px" />
              </div>
                <h3><?php echo $candetail['candidate_name']; ?></h3>
                <h5>Roll No. <?php echo $candetail['enrollment_no']; ?></h5>
              </div>  
            </div>
</body>

<script src="js/custom.js"></script>

</html>