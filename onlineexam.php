<?php
 //error_reporting(0);
  //ini_set('display_errors', 0);
session_start();

 require_once('includexa/function/autoload.php');
 
      $fetch = new fetchRecord;
      $examdetail = $fetch->examdetail();
     // $canimg = $fetch->candidateimg();
      $candetail = $fetch->candidatedetail();
      $secdrop = new dropdown;
      $button = new button;
      $count = new Questioncount;
?>

<html>
<head>
  <title>Exam</title>
    <meta charset="utf-8">
    <script src="js/ajax_jquery_3.5.1.js"></script>
    <link rel="stylesheet" href="css/custom.css">  
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.15.3-web/css/all.css"> 
    <link rel="stylesheet" href="css/model.css">
   </head>
<style>
 






 
.hides {
  display: none;
}
.holequestion{
  display: none;
}
    
.myDIV:hover + .hides {
  display: block;
  color: red;
}
#btndiv1,#btndiv2,#btndiv3{
  display: none;
}


.loader{
   /*left: 50%;
  position: fixed;
  top: 50%;
  transform: translate3d(-50%, -50%, 0);
  z-index: 999;*/
   position: fixed;
   z-index: 999;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   display: flex;
   justify-content: center;
   align-items: center;
}

</style>

<body style="color:black;">
<main>
<input type="hidden" name="" id='SectionNo'>
<!-- Modal For Question-->
<!--  <div class="modal fade" id="questionmodal" role="dialog " >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-primary">          
          <label class="modal-title text-white" >Question Pack</label>
          <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
        </div>

        <div class="modal-body">
            <div id="quespaper"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >OK</button>
        </div>
      </div>
    </div>
  </div> -->

<!-- Modal For Instruction
  <div class="modal fade " id="instructionmodal" role="dialog ">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-primary">          
          <label class="modal-title" >Instruction</label>
          <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
        </div>

        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >OK</button>
        </div>
      </div>
    </div>
  </div>


 -->

 <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <p>Some text. Some text. Some text.</p>
        <p>Some text. Some text. Some text.</p>
      </div>
    </div>
  </div>



  <div class="div1">
      <div class="loader" id='loader' ><img src="assets/exam-loading.gif" > </div>
    
      <!-- <img src="<?php // echo 'data: image/jpeg;base64,'.base64_encode( $examdetail['exam_logo'] ).' '?>" alt="logo" style="width: 100px;height: 100px;"/> -->
    <img src="assets/logo/download.jpg" alt="logo" style="width: 90px;height: 90px;padding-top: 15px;"/>
    

     <div class="studenDeatil" >
    <h4><?php echo $examdetail['exam_name'];?></h4> 
    <label>Candidate Name : </label><label id="can_name"><?php echo $candetail['candidate_name']; ?></label><br/>
    <label>Roll No: </label><label id="enroll"><?php echo $candetail['enrollment_no']; ?></label><br/>
    <label>Paper Name: </label><label><?php echo $candetail['paper_name']; ?></label>
           <label style="display: none;" id="setname"><?php echo $candetail['setname'];?></label>
           <label style="display: none;" id="paper_id"><?php echo $candetail['paper_id'];?></label>
           <label style="display: none;" id="totalques"></label>
       </div>
       <img src="<?php //echo $canimg['img']; ?>" alt="img" style="width: 125px;height: 90px;margin-left: auto;" />
 
    
    
   </div>  


<div class="div2 brd  section"> <!-- row two -->
    <div class="" >

      <?php echo $secdrop->sectionDropdown(); ?>
      <?php echo $count->allcount(); ?>
     
    </div>
    <div class="marginauto" >
      <h5 class="fntweght" id="quiz-time-left"></h5> 
      <h5 class="fntweght" id="disconnect" style="display: none;">Disconnected</h5> 
    </div>
    <div class="marginauto" >
      <label  class="qpaperAndI" data-toggle="modal" data-target="#questionmodal" onclick="quespaper()" >Question Paper&nbsp;</label>
    <i class="fas fa-file-alt"></i>
    </div>
    <div class="marginauto">
      <label  class="qpaperAndI" data-toggle="modal" data-target="#instructionmodal">Instruction&nbsp;</label><i class="fa fa-info-circle" style="color: blue" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black"></i>
    </div>
  </div>  

  <div class="div3"> <!-- row three -->

    <div class="nopad fntsize">
      <label class="" id="minute" style="display: none;"></label> 
    <label id ="countdown" style="display: none;"><?php echo $candetail['exam_duration']; ?></label>  
    <input type="hidden" id="sectionvalue" />
    
        
   <?php 
   $enro = $candetail['enrollment_no'];
   include('config/dbconnection.php');
      $result = $db->prepare("SELECT * FROM q_pack_two nq WHERE  set_name = 'A' AND paper_id = '1' ");
        $result->execute();
      for($i=1;$row=$result->fetch();$i++)
      {

  $qids = $row['q_no'];
  $results = $db->prepare("SELECT * FROM `response` where enrollment_no = '$enro' and qid = '$qids'");
        $results->execute();       
     $rows = $results->fetch();
     $ress = $rows['respone'];
     $mrkr = $rows['command'];
        
      $q_type = $row['ques_type'];
      ?>
<div class="holequestion" id='qdiv<?php echo $i; ?>'> <!-- // full hide and show div -->

    <div class="qnoandzoom" > <!-- //question no and zoom div -->
    
      <label class="">Question No: <?php echo $i; ?></label>
      <label style='margin-left: 106px;' class="">Text Size :</label>
      <button style="width: 50px" type="button" onclick="zoomout(<?php echo $i; ?>)">A-</button>
      <button style="width: 50px" type="button" onclick="zoomin(<?php echo $i; ?>)">A+</button>  
 
   </div>     

  <div id="showquestion" style="width:100%;height:400px;padding: 10px;overflow-y:scroll; "> 
  <label id="qnos" style="display: none;"><?php echo $row['q_no']; ?></label>
  <label id="ttlquestion" style="display: none;"><?php echo $row['cnt']; ?></label>
  <!-- <label id="secids" style="display: none;"><?php //echo $row['section_id']; ?></label> -->
  <label id="qid" style="display: none;"><?php echo $row['q_no']; ?></label>
  <label id="qtype<?php echo $i; ?>" style="display: none;"><?php echo $q_type; ?></label>
<?php 
if($q_type == "image"){
?>


<div   id="quesid<?php echo $i; ?>" style="">
  <div  >
    <img id='map<?php echo $i; ?>' src="<?php echo $row['q_img'];?>" alt="img" />
  </div>
  <?php
switch ($ress){
case "A":
?>
  <div  class="questions"><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i; ?>)" checked> <img id = 'map1<?php echo $i; ?>' src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
  <div class="questions"><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)" > <img id = 'map2<?php echo $i; ?>' src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
  <div class="questions"><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)"> <img id = 'map3<?php echo $i; ?>'  src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
  <div class="questions"><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)"> <img id = 'map4<?php echo $i; ?>'  src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>

<?php break;
case "B": ?>
  
<div class="questions"><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i; ?>)"> <img id = 'map1<?php echo $i; ?>'  src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
  <div class="questions"><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)" checked> <img id = 'map2<?php echo $i; ?>'  src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
  <div class="questions"><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)"> <img  id = 'map3<?php echo $i; ?>' src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
  <div class="questions"><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)"> <img id = 'map4<?php echo $i; ?>'  src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>


  <?php break;
case "C": ?>
<div class="questions"><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i; ?>)"> <img id = 'map1<?php echo $i; ?>'  src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
  <div class="questions"><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)"> <img id = 'map2<?php echo $i; ?>'  src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
  <div class="questions"><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)" checked> <img id = 'map3<?php echo $i; ?>'  src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
  <div class="questions"><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)"> <img id = 'map4<?php echo $i; ?>'  src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>
  <?php break;
case "D": ?>
<div class="questions"><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i; ?>)"> <img id = 'map1<?php echo $i; ?>'  src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
  <div class="questions"><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)"> <img id = 'map2<?php echo $i; ?>'  src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
  <div class="questions"><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)"> <img  id = 'map3<?php echo $i; ?>' src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
  <div class="questions"><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)" checked> <img  id = 'map4<?php echo $i; ?>'  src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>
<?php break;
default: ?>

<div class="questions"><label class="fntsize">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i; ?>)"> <img id = 'map1<?php echo $i; ?>'  src="<?php echo $row['op_a'] ?>" alt="op_A" onclick="checkrda($('#op1').val())"/></div>
  <div class="questions"><label class="fntsize">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)"> <img id = 'map2<?php echo $i; ?>'  src="<?php echo $row['op_b'] ?>" alt="op_B" onclick="checkrdb($('#op2').val())" /></div>
  <div class="questions"><label class="fntsize">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)"> <img  id = 'map3<?php echo $i; ?>' src="<?php echo $row['op_c'] ?>" alt="op_C" onclick="checkrdc($('#op3').val())" /></div>
  <div class="questions"><label class="fntsize">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)"> <img id = 'map4<?php echo $i; ?>'   src="<?php echo $row['op_d'] ?>" alt="op_D" onclick="checkrdd($('#op4').val())"/></div>
  <?php } ?>
</div>

<?php } else { ?>

<div  class="fntweght" style="width:100%px;" id="zoomques<?php echo $i; ?>">
  <div style="width: 100%">
    <label style=""><?php echo $row['q_img'];?></label>
  </div>
  <?php
switch ($ress){
case "A":
?>
  <div class="questions" ><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i;?>)" checked>&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
  <div class="questions" ><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
  <div class="questions" ><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
  <div class="questions" ><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>
<?php break;
case "B": ?>
<div class="questions" ><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i;?>)">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
  <div class="questions" ><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)" checked>&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
  <div class="questions" ><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
  <div class="questions" ><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>
<?php break;
case "C": ?>
<div class="questions" ><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i;?>)">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
  <div class="questions" ><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
  <div class="questions" ><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)" checked>&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
  <div class="questions" ><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>
  <?php break;
case "D"; ?>
<div class="questions" ><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i;?>)">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
  <div class="questions" ><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
  <div class="questions" ><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
  <div class="questions" ><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)"
    checked>&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>
  <?php break;
default: ?>
<div class="questions" ><label class="">(A)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op1<?php echo $i; ?>" value= 'A' onclick="checkrda(<?php echo $i;?>)">&nbsp;<label onclick="checkrda($('#op1').val())"><?php echo $row['op_a'] ?></label></div>
  <div class="questions" ><label class="">(B)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op2<?php echo $i; ?>" value= 'B' onclick="checkrdb(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdb($('#op2').val())"><?php echo $row['op_b'] ?></label></div>
  <div class="questions" ><label class="">(C)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op3<?php echo $i; ?>" value= 'C' onclick="checkrdc(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdc($('#op3').val())"><?php echo $row['op_c'] ?></label></div>
  <div class="questions" ><label class="">(D)&nbsp;&nbsp;</label><input type="radio" name="rdo<?php echo $i; ?>" id="op4<?php echo $i; ?>" value= 'D' onclick="checkrdd(<?php echo $i; ?>)">&nbsp;<label onclick="checkrdd($('#opd').val())"><?php echo $row['op_d'] ?></label></div>
  <?php } ?>
</div>
<?php } ?>
</div>

<!-- <div class="row nopad" >
    

  <div class="col-sm-3">
    <button class="form-control btnclr"  id="prev" onclick="previous(<?php echo $i; ?>)"><< Previous</button>
  </div>
  
  <div class="col-sm-3">
  <button style="" class="form-control cltbtn"  onclick="markforreview(<?php echo $i; ?>)">Marked for Review & Next</button>
  </div>
  <div class="col-sm-3">
  <button  class="form-control cltbtn"  onclick="clearresponse(<?php echo $i; ?>)">Clear Response</button>
  </div>
  
  <div class="col-sm-3">
    <button class="form-control btnclr"   onclick="savenext(<?php echo $i; ?>)">Save & Next >></button>
  </div>
  
</div> -->
</div>  <!-- close loop main div -->
<?php 
if($mrkr == "answered"){?>

<input type="hidden" id="bubbledtrue<?php echo $i;?>" value="1">  
<input type="hidden" id="log<?php echo $i; ?>" value="<?php echo $ress ;?>">
<input type="hidden" id="Ans<?php echo $i; ?>" value="1">
<input type="hidden" id="visited<?php echo $i; ?>" value = "">
<input type="hidden" id="markForAns<?php echo $i; ?>"value = "">
<input type="hidden" id="markForRev<?php echo $i; ?>"value = "">
<?php }
 else if($mrkr == "markRorRev_ANS"){?>
<input type="hidden" id="bubbledtrue<?php echo $i;?>" value="1">  
<input type="hidden" id="log<?php echo $i; ?>" value="<?php echo $ress ;?>">
<input type="hidden" id="Ans<?php echo $i; ?>" value="">
<input type="hidden" id="visited<?php echo $i; ?>" value = "">
<input type="hidden" id="markForAns<?php echo $i; ?>" value = "1">
<input type="hidden" id="markForRev<?php echo $i; ?>"value = "" >
<?php }
 else if($mrkr == "markforreview"){ ?>
<input type="hidden" id="bubbledtrue<?php echo $i;?>" value="">  
<input type="hidden" id="log<?php echo $i; ?>" value="">
<input type="hidden" id="Ans<?php echo $i; ?>" value="">
<input type="hidden" id="visited<?php echo $i; ?>" value = "">
<input type="hidden" id="markForAns<?php echo $i; ?>"value = "" >
<input type="hidden" id="markForRev<?php echo $i; ?>"value = "1" >
<?php }
else if($mrkr == "notanswered"){ ?>

<input type="hidden" id="bubbledtrue<?php echo $i;?>" value="">  
<input type="hidden" id="log<?php echo $i; ?>" value="">
<input type="hidden" id="Ans<?php echo $i; ?>" value="">
<input type="hidden" id="visited<?php echo $i;?>" value = "1">
<input type="hidden" id="markForAns<?php echo $i; ?>" value = "">
<input type="hidden" id="markForRev<?php echo $i; ?>" value = "">
<?php } else { ?>
<input type="hidden" id="bubbledtrue<?php echo $i;?>" value="">  
<input type="hidden" id="log<?php echo $i; ?>" value="">
<input type="hidden" id="Ans<?php echo $i; ?>" value="">
<input type="hidden" id="visited<?php echo $i; ?>" value = "">
<input type="hidden" id="markForAns<?php echo $i; ?>" value = "">
<input type="hidden" id="markForRev<?php echo $i; ?>" value = "">
<?php } ?>

<?php
} ?> 
      
      <label id="setresponse" style="display: none;"></label>
      <label id="responsecnt" style="display: none;"></label>
      <!-- <label id="log" style="display: none"></label> -->
      <label id="revalue" style="display: none;"></label>
      <label id="svalue" style="display: none;"></label>
      <label id="demo" style="display: none;"></label>
      <label id="sectionid" style="display: none;"><?php $secdrop->sectionid(); ?></label>
</div> <!-- col-sm-9
 -->    
 </div> <!-- row2 closed -->


<div class="div4 brd" >

<div class="div4sty mrgn-tp">
    
      <button class="activebbb text-white cbtn " id="answerid">0</button>
  
      <label>Answered Questions</label>
    
</div>
<div class="div4sty mrgn-tp">
   
      <button class="text-white cbtn red" id="notanswerid">1</button>
   
      <label>&nbsp;Not Answered Questions</label>
    
</div>  
<div class="div4sty mrgn-tp">
   
      <button class="mrkrev cbtn" id="markreview">0</button>
    
      <label>Marked For Review</label>
    
</div>  
<div class="div4sty mrgn-tp">
    
      <button class="fachek cbtn" id="reviewandanswer">0</button>
      
      <label>Marked For Review</label>
   
</div>
<div class="div4sty mrgn-tp">
   
      <button class="tblack cbtn" id="notvisited"></button>
    
      <label>Not Visited</label>
    
</div>  

  <div class="mrgn-tp brd" style="text-align: center;">
    <label id="setsection" >Section Wise Button</label>
  </div>
  <div class="btndiv " id="showbtn"  >
    <?php echo $button->showbtn(); ?>

  </div> 

   

       
</div> <!-- col-3 -->
    




  <div class="div5 brd" id='bottom' >

    <?php for($j=1 ;$j<=60;$j++)
    {?>
    <div  class="holequestion" id='qqdiv<?php echo $j; ?>'>

  
    <button class="button btnclr"  id="prev" onclick="previous(<?php echo $j; ?>)"><< Previous</button>
 
  
  <button style="" class="button cltbtn"  onclick="markforreview(<?php echo $j; ?>)">Marked for Review & Next</button>

 
  <button  class="button cltbtn"  onclick="clearresponse(<?php echo $j; ?>)">Clear Response</button>
 
 
    <button class="button btnclr"   onclick="savenext(<?php echo $j; ?>)">Save & Next >></button>
 
</div>
   <?php 
    }?>

  
  <button  class="button button6"  data-toggle="modal" data-target="#summarymodal" onclick="summary()" id="sumdiv">Submit</button>
 

</div>

</main>

</body>

<script src="js/custom.js"></script>
<script>

$(function () {
  $('[data-toggle="popover"]').popover()
})

$(function(){
$(".framemodel_box").css('display','none');
$(".framemodel_box").css('height','0px');
var fid;
        $('.chover').hover(function(){      
     fid=$(this).attr('framenum');
        $(".frame"+fid).css('display','block');
    }, function(){
       $(".frame"+fid).css('display','none');
    });    
});


function zoomin(id){
        var myImg = document.getElementById("map"+id);
        var currWidth = myImg.clientWidth;
        if(currWidth == 2500) return false;
         else{
            myImg.style.width = (currWidth + 100) + "px";
        } 
        var myImg1 = document.getElementById("map1"+id);
        var currWidth1 = myImg1.clientWidth;
        if(currWidth1 == 2500) return false;
         else{
            myImg1.style.width = (currWidth1 + 100) + "px";
        } 
        var myImg2 = document.getElementById("map2"+id);
        var currWidth2 = myImg2.clientWidth;
        if(currWidth2 == 2500) return false;
         else{
            myImg2.style.width = (currWidth2 + 100) + "px";
        } 
        var myImg3 = document.getElementById("map3"+id);
        var currWidth3 = myImg3.clientWidth;
        if(currWidth3 == 2500) return false;
         else{
            myImg3.style.width = (currWidth3 + 100) + "px";
        } 
        var myImg4 = document.getElementById("map4"+id);
        var currWidth4 = myImg4.clientWidth;
        if(currWidth4 == 2500) return false;
         else{
            myImg4.style.width = (currWidth4 + 100) + "px";
        } 
    }

    function zoomout(id){
        var myImg = document.getElementById("map"+id);
        var currWidth = myImg.clientWidth;
        if(currWidth == 100) return false;
     else{
            myImg.style.width = (currWidth - 100) + "px";
        }

        var myImg1 = document.getElementById("map1"+id);
        var currWidth1 = myImg1.clientWidth;
        if(currWidth1 == 2500) return false;
         else{
            myImg1.style.width = (currWidth1 - 100) + "px";
        } 
        
        var myImg2 = document.getElementById("map2"+id);
        var currWidth2 = myImg2.clientWidth;
        if(currWidth2 == 2500) return false;
         else{
            myImg2.style.width = (currWidth2 - 100) + "px";
        } 
        var myImg3 = document.getElementById("map3"+id);
        var currWidth3 = myImg3.clientWidth;
        if(currWidth3 == 2500) return false;
         else{
            myImg3.style.width = (currWidth3 - 100) + "px";
        } 
        var myImg4 = document.getElementById("map4"+id);
        var currWidth4 = myImg4.clientWidth;
        if(currWidth4 == 2500) return false;
         else{
            myImg4.style.width = (currWidth4 - 100) + "px";
        } 
    }

    // function zoomin(id){
    //   var qtype = document.getElementById("qtype"+id).textContent;      
    //   if(qtype == "text"){      
    //   var el = document.getElementById("zoomques"+id);
    //   var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
    //   var fontSize = parseFloat(style); 
    //   el.style.fontSize = (fontSize + 2) + 'px';
    //   }else{
    //     var myImg = document.getElementById("quesid"+id);
    //     var currWidth = myImg.clientWidth;
    //     var currHeight = myImg.clientHeight;
    //     if(currWidth == 500 && currHeight == 500){
    //         alert("Maximum zoom-in level reached.");
    //     } else{
    //         myImg.style.width = (currWidth + 50) + "px";
    //         myImg.style.height = (currHeight + 50) + "px";
    //     }
    //   } 
    // }
    // function zoomout(id){
    //   var qtype = document.getElementById("qtype"+id).textContent;      
    //   if(qtype == "text"){      
    //   var el = document.getElementById("zoomques"+id);
    //   var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
    //   var fontSize = parseFloat(style); 
    //   el.style.fontSize = (fontSize - 2) + 'px';
    //   }else{
    //     var myImg = document.getElementById("quesid"+id);
    //     var currWidth = myImg.clientWidth;
    //     var currHeight = myImg.clientHeight;
    //     if(currWidth == 500 && currHeight == 500){
    //         alert("Maximum zoom-out level reached.");
    //     } else{
    //         myImg.style.width = (currWidth - 50) + "px";
    //         myImg.style.height = (currHeight - 50) + "px";
    //     }
    //   }
    // }
 
   

function checkrda(id){  // method for for check bubbled or not
  
var valu = $("#op1"+id).val();
  $("#log"+id).val(valu);
  bubbled(id);
  
}
function checkrdb(id){
 var valu = $("#op2"+id).val();
  $("#log"+id).val(valu);
  bubbled(id);
}
function checkrdc(id){
 var valu = $("#op3"+id).val();
  $("#log"+id).val(valu);
  bubbled(id);
}
function checkrdd(id){
var  valu = $("#op4"+id).val();
  $("#log"+id).val(valu);
  bubbled(id);
}

function bubbled(id)
{
document.getElementById('bubbledtrue'+id).value = '1';
}

const sec1 = document.querySelector("#secarr1");
const sec2 = document.querySelector("#secarr2");
const sec3 = document.querySelector("#secarr3");
 sec1.addEventListener('click' , show1);
 sec2.addEventListener('click' , show2);
 sec3.addEventListener('click' , show3);

 

var notAns = [];
var answered = [];
var markFOrreview = [];
var markFOrreviewAndans = []; 

function setonload()
{

  notAns.length = 0;
 
  var ans= document.getElementById('ansW').value;
  var not_ans=document.getElementById('not_ansW').value;
  var mrkANs = document.getElementById('mrk_ansW').value;
  var mrk =document.getElementById('mrkW').value;
   
   for(let i=0;i<ans;i++){

    answered.push('1');
     
   }

   
    for(let i=0;i<not_ans;i++){
    notAns.push('1');
   }
    for(let i=0;i<mrk;i++){
    markFOrreview.push('1');
   }
    for(let i=0;i<mrkANs;i++){
    markFOrreviewAndans.push('1');
   }
  
        setItems();
          $('#btn1').removeClass("fachek");//blue
          $("#btn1").removeClass("activebbb");//green
          $('#btn1').removeClass("mrkrev");//yellow
          $('#btn1').addClass("red");
}



function show1(){
   document.getElementById('SectionNo').value = '';
  $('#secarr1').addClass("seccolor");
  $('#secarr2').removeClass("seccolor");
  $('#secarr3').removeClass("seccolor");
      document.getElementById('btndiv1').style.display = "block";
      document.getElementById('btndiv2').style.display = "none";
      document.getElementById('btndiv3').style.display = "none";
     var visited =  document.getElementById('visited'+1).value;
     var bub =  document.getElementById('bubbledtrue'+1).value;
     var mrk =  document.getElementById('markForRev'+1).value;
      //alert(visited);
      if(visited =='' && bub== '' && mrk ==''){
      document.getElementById('visited'+1).value = '1';
      notAns.push('1');
       }
      $('.holequestion').css("display", "none");
      document.getElementById('qdiv'+1).style.display = "block";
      document.getElementById('qqdiv'+1).style.display = "block";
      document.getElementById('SectionNo').value = '1';
      setItems();
      color(1);
 }
 function show2(){
   document.getElementById('SectionNo').value = '';
        $('#secarr2').addClass("seccolor");
        $('#secarr3').removeClass("seccolor");
        $('#secarr1').removeClass("seccolor");
      document.getElementById('btndiv2').style.display = "block";
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv3').style.display = "none";
     var visited =  document.getElementById('visited'+21).value;
     var bub =  document.getElementById('bubbledtrue'+21).value;
     var mrk =  document.getElementById('markForRev'+21).value;
      //alert(visited);
      if(visited =='' && bub== '' && mrk ==''){
      document.getElementById('visited'+21).value = '1';
      notAns.push('1');
       }
      $('.holequestion').css("display", "none");
      document.getElementById('qdiv'+21).style.display = "block";
      document.getElementById('qqdiv'+21).style.display = "block";
      document.getElementById('SectionNo').value = '2';
      setItems();
       color(21);
 }
 
 function show3(){
   document.getElementById('SectionNo').value = '';
    $('#secarr3').addClass("seccolor");
    $('#secarr1').removeClass("seccolor");
    $('#secarr2').removeClass("seccolor");
      document.getElementById('btndiv3').style.display = "block";
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv2').style.display = "none";

     var visited =  document.getElementById('visited'+41).value;
     var bub =  document.getElementById('bubbledtrue'+41).value;
     var mrk =  document.getElementById('markForRev'+41).value;
      //alert(visited);
      if(visited =='' && bub== '' && mrk ==''){
      document.getElementById('visited'+41).value = '1';
      notAns.push('1');
       }
      $('.holequestion').css("display", "none");
      document.getElementById('qdiv'+41).style.display = "block";
      document.getElementById('qqdiv'+41).style.display = "block";
       document.getElementById('SectionNo').value = '3';
      setItems();
         color(41);

 }
 
 document.getElementById("loader").style.display="none";

function loadFirstQ()
{ 
  
  document.getElementById('SectionNo').value = '1';
  $('#secarr1').addClass("seccolor");
  document.getElementById('btndiv1').style.display = "block";
  document.getElementById('visited1').value = '1';
  $('.holequestion').css("display", "none"); 
  document.getElementById('qdiv1').style.display = "block";
  document.getElementById('qqdiv1').style.display = "block";
   $('#btn'+1).addClass("red");
 
 
  notAns.push('1');
  setItems();
  setonload();

}

function previous(id)
{
  if(id>1){
  $('.holequestion').css("display", "none"); 
  document.getElementById('qdiv'+(id-1)).style.display = "block";
  document.getElementById('qqdiv'+(id-1)).style.display = "block";
  }
// for show next section
    if(id==21){
    $('#secarr1').addClass("seccolor");
    $('#secarr2').removeClass("seccolor");
    $('#secarr3').removeClass("seccolor");
       document.getElementById('btndiv1').style.display = "block";
       document.getElementById('btndiv2').style.display = "none";
       document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '1';
    }
     if(id==41){
    $('#secarr1').removeClass("seccolor");
    $('#secarr2').addClass("seccolor");
    $('#secarr3').removeClass("seccolor");
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv2').style.display = "block";
      document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '2';
    }

}


 function getq_packbtn(id)
    {
      var bub =  document.getElementById('bubbledtrue'+id).value;
      var markkRev = document.getElementById('markForRev'+id).value;
      var visited =  document.getElementById('visited'+id).value;
     // alert(bub);
      if(visited =='' && bub=='' && markkRev==''){
      document.getElementById('visited'+id).value = '1';
      notAns.push('1');
       }
      $('.holequestion').css("display", "none");
      document.getElementById('qdiv'+id).style.display = "block";document.getElementById('qqdiv'+id).style.display = "block";
       color(id);
    setItems();

    }

    function clearresponse(id)
    {
   var visited = document.getElementById('visited'+id).value;
   var markforRevAns = document.getElementById('markForAns'+id).value;
   var asnw = document.getElementById('Ans'+id).value;
   var ele = document.getElementsByName('rdo'+id);
     //alert(ele.length);
     for(var i=0;i<ele.length;i++)
     {
     ele[i].checked = false;
     }
       
    if(markforRevAns!='' || asnw!='')
     {
      //document.getElementById('visited'+id).value = '';
     if(visited==''){
      notAns.push('1');}
      document.getElementById('visited'+id).value = '1';
          
     
if(markforRevAns!='')
{
  markFOrreviewAndans.pop('1');
  document.getElementById('markForAns'+id).value = '';
}
if(asnw!='')
{
  answered.pop('1');
  document.getElementById('Ans'+id).value = '';
}
document.getElementById('markForAns'+id).value ='';
document.getElementById('Ans'+id).value ='';

}
document.getElementById('bubbledtrue'+id).value = '';

 setItems();
 response(id);
    }

function savenext(id)
{
// alert(id);
        var qno = 0;
        if(id<60){  qno = parseInt(id)+1;}  else { qno = 1;}
var visited = document.getElementById('visited'+qno).value;
var visitedThis = document.getElementById('visited'+id).value;

//var markforRev = document.getElementById('markForreview'+id).value;
var markforRevAns = document.getElementById('markForAns'+id).value;
//alert(markforRevAns);
var bub =  document.getElementById('bubbledtrue'+id).value;
//alert(bub);
var asnw = document.getElementById('Ans'+id).value;
//alert('asd'+asnw);
var markkRev = document.getElementById('markForRev'+id).value;
var marfornext = document.getElementById('markForRev'+qno).value;
var bubnext = document.getElementById('bubbledtrue'+qno).value;
// its check one question ahead

if(visited ==''&& bubnext == '' && marfornext==''){ 

  notAns.push('1');
  document.getElementById('visited'+qno).value = '1';
  document.getElementById('visited'+id).value = '1';
   // $('#btn'+id).removeClass("fachek");
   // $('#btn'+id).removeClass("active");
   // $("#btn"+id).addClass("activebbb");
}

if(asnw =='' && bub!=''){ 
// alert(asnw);
  answered.push('1');
  document.getElementById('Ans'+id).value = '1';
    if(visitedThis!='')
     {
    notAns.pop('1');
    document.getElementById('visited'+id).value='';
    }
     
}else{
   if(visitedThis=='' && bub==''){
   
      notAns.push('1');
      document.getElementById('visited'+id).value = '1';
      if(asnw !='' && bub!='')
      {
      answered.pop('1');
     document.getElementById('Ans'+id).value='';
       }
      }


}

if(markforRevAns!='')
{
  markFOrreviewAndans.pop('1');
  document.getElementById('markForAns'+id).value = '';
}
if(markkRev!='')
{
  markFOrreview.pop('1');
  document.getElementById('markForRev'+id).value = '';
}


 

    var tQus = 60;
    var a = markFOrreview.length;
    var b = markFOrreviewAndans.length;
    var c = notAns.length;
    var d = answered.length;
 var total = (parseInt(tQus)-(parseInt(b)+parseInt(d)+parseInt(a)+parseInt(c)));
 
  document.getElementById("answerid").innerHTML = d;
  document.getElementById("notanswerid").innerHTML = c;
  document.getElementById("markreview").innerHTML = a;
  document.getElementById("reviewandanswer").innerHTML = b;
  document.getElementById("notvisited").innerHTML = total;
      
        
        
        $('.holequestion').css("display", "none");
        document.getElementById('qdiv'+qno).style.display = "block"; document.getElementById('qqdiv'+qno).style.display = "block";
    // for show next section
    if(id==20){

    $('#secarr1').removeClass("seccolor");
    $('#secarr2').addClass("seccolor");
    $('#secarr3').removeClass("seccolor");
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv2').style.display = "block";
      document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '2';

    }
     if(id==40){
    $('#secarr1').removeClass("seccolor");
    $('#secarr2').removeClass("seccolor");
    $('#secarr3').addClass("seccolor");
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv2').style.display = "none";
      document.getElementById('btndiv3').style.display = "block";
      document.getElementById('SectionNo').value = '';
      document.getElementById('SectionNo').value = '3';
    }
    if(id==60){
    $('#secarr1').addClass("seccolor");
    $('#secarr2').removeClass("seccolor");
    $('#secarr3').removeClass("seccolor");
      document.getElementById('btndiv1').style.display = "block";
      document.getElementById('btndiv2').style.display = "none";
      document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '1';
    }

    color(qno);
    response(id);
}


 function markforreview(id)
{
        var qno = 0;
        if(id<60){  qno = parseInt(id)+1;}  else { qno = 1;}

var visited = document.getElementById('visited'+qno).value;
var visitedThis = document.getElementById('visited'+id).value;

//var markforRev = document.getElementById('markForreview'+id).value;
var markforRevAns = document.getElementById('markForAns'+id).value;
//alert(markforRevAns);
var bub =  document.getElementById('bubbledtrue'+id).value;
//alert(bub);
var asnw = document.getElementById('Ans'+id).value;
//alert('asd'+asnw);
var markkRev = document.getElementById('markForRev'+id).value;
 var marfornext = document.getElementById('markForRev'+qno).value;
var bubnext = document.getElementById('bubbledtrue'+qno).value;
if(visited =='' && marfornext=='' && bubnext==''){ 
// alert(asnw);
  notAns.push('1');
  document.getElementById('visited'+qno).value = '1';
  document.getElementById('visited'+id).value = '1';
   
}

if(bub!='' && markforRevAns==''){ 
// alert(asnw);
  markFOrreviewAndans.push('1');
  document.getElementById('markForAns'+id).value = '1';
   
   if(markforRevAns!='')
{
  markFOrreviewAndans.pop('1');
  document.getElementById('markForAns'+id).value = '';
}
if(markkRev!='' )
{
  markFOrreview.pop('1');
  document.getElementById('markForRev'+id).value = '';
}
} else{
  if(markkRev=='')
  {
    //alert('gjvhmc'+markkRev);
  markFOrreview.push(1);
  document.getElementById('markForRev'+id).value = '1';
    if(markforRevAns!='')
{
  markFOrreviewAndans.pop('1');
  document.getElementById('markForAns'+id).value = '';
}
if(markkRev!='' )
{
  markFOrreview.pop('1');
  document.getElementById('markForRev'+id).value = '';
}
}
}

if(visitedThis!='')
{
   notAns.pop('1');
   document.getElementById('visited'+id).value='';
}


if(asnw!='')
  {
  answered.pop('1');
  document.getElementById('Ans'+id).value = '';
  }


    var tQus = 60;
    var a = markFOrreview.length;
    var b = markFOrreviewAndans.length;
    var c = notAns.length;
    var d = answered.length;
 var total = (parseInt(tQus)-(parseInt(b)+parseInt(d)+parseInt(a)+parseInt(c)));
 //alert('22'+total);
  document.getElementById("answerid").innerHTML = d;
  document.getElementById("notanswerid").innerHTML = c;
  document.getElementById("markreview").innerHTML = a;
  document.getElementById("reviewandanswer").innerHTML = b;
  document.getElementById("notvisited").innerHTML = total;
     
        
        $('.holequestion').css("display", "none");
        document.getElementById('qdiv'+qno).style.display = "block"; document.getElementById('qqdiv'+qno).style.display = "block";

        // for show next section
    if(id==20){
    $('#secarr1').removeClass("seccolor");
    $('#secarr2').addClass("seccolor");
    $('#secarr3').removeClass("seccolor");
       document.getElementById('btndiv1').style.display = "none";
       document.getElementById('btndiv2').style.display = "block";
       document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '2';
    }
     if(id==40){
    $('#secarr1').removeClass("seccolor");
    $('#secarr2').removeClass("seccolor");
    $('#secarr3').addClass("seccolor");
      document.getElementById('btndiv1').style.display = "none";
      document.getElementById('btndiv2').style.display = "none";
      document.getElementById('btndiv3').style.display = "block";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '3';
    }
     if(id==60){
     $('#secarr1').addClass("seccolor");
     $('#secarr2').removeClass("seccolor");
     $('#secarr3').removeClass("seccolor");
      document.getElementById('btndiv1').style.display = "block";
      document.getElementById('btndiv2').style.display = "none";
      document.getElementById('btndiv3').style.display = "none";
       document.getElementById('SectionNo').value = '';
       document.getElementById('SectionNo').value = '1';
    }
    color(qno);
    response(id);
}

const colorid = [1];
function color(id)
 {
  
    newid =  colorid[0];
       //alert('newid1'+newid);
    //$('#btn'+id).removeClass("active");
   // $("#btn"+id).addClass("activebbb");
   var visited = document.getElementById('visited'+newid).value;
   //var visitedThis = document.getElementById('visited'+id).value;
  //var markforRev = document.getElementById('markForreview'+id).value;
   var markforRevAns = document.getElementById('markForAns'+newid).value;
  //alert(markforRevAns);
  var bub =  document.getElementById('bubbledtrue'+newid).value;
  //alert(bub);
  var asnw = document.getElementById('Ans'+newid).value;
  //alert('asd'+asnw);
  var markkRev = document.getElementById('markForRev'+newid).value;
     if(visited!='')
     {
   $('#btn'+newid).removeClass("fachek");//blue
   $("#btn"+newid).removeClass("activebbb");//green
   $('#btn'+newid).removeClass("mrkrev");//yellow
   $("#btn"+newid).addClass("active");//active red
     }
  if(asnw!='')
     {
      //alert('green'+newid);
      $("#btn"+newid).removeClass("active");//active
    $('#btn'+newid).removeClass("fachek");//blue
    $('#btn'+newid).removeClass("mrkrev");//yellow
    $("#btn"+newid).removeClass("red");//active
     

    $("#btn"+newid).addClass("activebbb");//green
     }

     if(markforRevAns!='')
     {
   $("#btn"+newid).removeClass("active");//active
    $('#btn'+newid).removeClass("mrkrev");//yellow
    $("#btn"+newid).removeClass("red");//active
    $("#btn"+newid).removeClass("activebbb");//green
    $('#btn'+newid).addClass("fachek");//blue
     }

     if(markkRev!='')
     {

       $("#btn"+newid).removeClass("active");//active
    $('#btn'+newid).removeClass("fachek");//blue
    $("#btn"+newid).removeClass("red");//active
    $("#btn"+newid).removeClass("activebbb");//green
     $('#btn'+newid).addClass("mrkrev");//yellow
     }

       colorid[0] = id;
       var newid2 = colorid[0];
       //alert('newid2'+newid2);
          $('#btn'+newid2).removeClass("fachek");//blue
          $("#btn"+newid2).removeClass("activebbb");//green
          $('#btn'+newid2).removeClass("mrkrev");//yellow
          $('#btn'+newid2).addClass("red");


 }

window.onload=loadFirstQ();

function setItems()
{
    var tQus = 60;
    var a = markFOrreview.length;
    var b = markFOrreviewAndans.length;
    var c = notAns.length;
    var d = answered.length;
// alert(c);
 var total = (parseInt(tQus)-(parseInt(b)+parseInt(d)+parseInt(a)+parseInt(c)));
 //alert('22'+total);
  document.getElementById("answerid").innerHTML = d;
  document.getElementById("notanswerid").innerHTML = c;
  document.getElementById("markreview").innerHTML = a;
  document.getElementById("reviewandanswer").innerHTML = b;
  document.getElementById("notvisited").innerHTML = total;
}

function response(id){

  var command = ""; 
  var enroll = document.getElementById("enroll").textContent;
  var res = document.getElementById("log"+id).value;
  var secid = document.getElementById('SectionNo').value;
  // alert(secid);
  var ans = document.getElementById("Ans"+id).value;
  var mrkrev = document.getElementById("markForRev"+id).value;
  var mrkrevans = document.getElementById("markForAns"+id).value;
  
  var cmdanswer = "answered";
  var cmdmrk = "markforreview";
  var cmdmrknans = "markRorRev_ANS";
  var cmdnotans = "notanswered";
  if(res !="" && ans != ""){
    command = "";
    command += cmdanswer;
  
  }
  else if(mrkrev != ""){
    command = "";
    command += cmdmrk;
    
  }
  else if(mrkrevans!="" && res!= ""){
    command = "";
    command += cmdmrknans;
  }
  else{
     command = "";
     command += cmdnotans;
     res = 'null';
  }
  
  $.ajax({
    type: "POST",
    url: "response.php",
    data:{enroll:enroll,id:id,res:res,command:command,secid:secid},
    success: function(msges){  
      
           
    } 
  });   
  
  // command = "";
  // document.getElementById("log").textContent = "";
}

function setSection(id){
  
  var enroll = document.getElementById("enroll").textContent;
  $.ajax({
   type: "POST",
    url: "setSection.php",
    data:{enroll:enroll,id:id},
    success: function(data){  
     
       var abcd=data.split(','); 
       $('.s1').text(abcd[0]);
        $('.s2').text(abcd[1]);
         $('.s3').text(abcd[2]);
          $('.s4').text(abcd[3]);
           $('.s5').text(abcd[4]);
        

    } 
  }); 
}

 document.documentElement.requestFullscreen();

</script>
</html>
