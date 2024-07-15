<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>


<?php
    $msg = "";
 if(isset($_POST['employeeId'])){
        $employeeId=$_POST['employeeId'];


        $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId   = ?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
           $output = $row;
        }
       
       
    
       
       

       

        // print_r($ICoutput);
        // exit();
    
        
      
        
      
     
    }


  


    // $expense=$_POST['expense'];
    // for ($i=0 ; $i<count($expense);$i++){
    //     echo $expense[$i];
    // }


?>

<head>
    <title>View PDF</title>

</head>


<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--  <title>Alpha Polymers</title>-->
  <!-- Tell the browser to be responsive to screen width -->
<!--  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
  <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
 <link href="https://fonts.googleapis.com/css?family=Tinos&display=swap" rel="stylesheet">
 <link href= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">  
 </head>
 <!--  -->
   <body   >
   <body onload="window.print();return false">
       <style>
           body{
               border: 2px solid black !important;
               /*height: 634px;width:449px ;border: 1px solid black*/
           }
           
           
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid black !important;
    background: transparent !important;
    
    font-size: 1.03rem;
    /* font-size: 1.1rem; */
    font-weight: 400;
    line-height: 1.5;
}

/* hr{
   background-color: black !important; 
   height: 0.8px  !important;
} */

th,td {
  padding:2px !important;
}
.padding-0 {
  padding:0px !important;
}
@media print {
    
   html, body {
    /* min-width: 0mm;
    min-height: 0mm; */
    -webkit-print-color-adjust: exact;
      background: transparent;
      margin-left: 25px !important;
      /* padding: 0 !important; */
  }
    /* .page {
            margin: 0 auto;
            min-width: 0mm;
            min-height: 0mm;
    } */
    #footer { 
    display: block;  
    position: fixed;  
    /* text-align: center; */
    bottom: 10px; 
    align-content: center;
  } 

}

.tdbg {
    background-color: red !important;   
    margin: 0;
    padding:  2px 0 0 0;
    
    min-height: 33px;
    /* background-image: "assets/images/bgred.PNG" !important;  */
    color: white !important;
    
}

.table-bordered {
    border: 1px solid #000 !important;
    border-color:black !important;
    padding: 0;

}

.watermark {
  width: auto;
  height: max-content;
  display: block;
  position: relative;
  max-width: 100%;
}

.watermark::after {
  content: "";
 background:url("assets/images/logohappysoul-removebg.png")  no-repeat;
  opacity: 0.1;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  background-size: contain;/*  Make background take entire page */
  background-position: center;/*  Center Background*/
background-repeat:  no-repeat;
  z-index: -1;   
}
.div-border {
 
  width: 5%;
  padding: 0px;
  border: 1px solid #ccc;
  
 
}

/* .bg {
 
 background-image: url("assets/images/logo.jpg");
 height: 100%; 
 background-position: center;
 align-self: center;
 background-repeat: no-repeat;
 background-size: cover;
 } */
 /*  */
 /* .page {
        width: 210mm;
        min-height: 297mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        
    }
@page {
  size: A4;
  margin: 0 !important;
} */

 .bottom-layout{
    /* position: absolute; */
    bottom: 0;
 }
        </style>
       
       <div class="watermark page" >
       <!-- <center><img src='assets/images/logo.jpg' style='float: center;width: 100px; margin-right:0;'></center> -->
       <!-- <div style="padding-top:0px;"> -->
      
       <!-- <table style="width:100%;" >
            <tbody >
                <tr>
                    <td style="width: 15%;">
                        <center>
                        <img src="assets/images/logo.jpg" alt="" height="65" >
                        </center>
                    </td>
                    <td style="width: 85%;">
                    <div style="padding-left:20px;margin-top: 0px; " align="center" ><h1 style="font-size:28px; color:#16b3fc">Fuel Instruments & Engineers Pvt. Ltd</h1>
                     <div style="padding-left:20px; color:#027ec4" align="center" ><h1 style="font-size:28px;">FUEL INSTRUMENTS AND ENGINEERS PVT. LTD.</h1> -->
                    <!-- <h5 style="font-size:12px;">Plot No. 68 to 89, Parvati Co-op. Industrial Estate Ltd., Yadrav (Ichalkaranji) </h5> -->
                    <!-- </div>
                    </td>
                </tr>
            </tbody>
       </table> -->
               
           <!-- <div style="padding-left:20px;" align="center"><h1 style="font-size:28px;">FUEL INSTRUMENTS AND ENGINEERS PVT. LTD.</h1></div> -->
           <!-- </div>  -->
           <div style="padding:10px;background-color: #FFFFFF;" align="center">
           <div style="float: left;">
                        <center>
                        <img src="assets/images/logohappysoul-removebg.png" alt=""  height="100" >
                        </center>
                    </div>
                <div style="padding-left:0px;margin-top: 0px; " align="center" ><h1 style="font-size:26px; color:#275b58">Happy Soul</h1>
                    <!-- <div style="padding-left:20px; color:#16b3fc" align="center" ><h1 style="font-size:28px;">FUEL INSTRUMENTS AND ENGINEERS PVT. LTD.</h1> -->
                <h5 style="font-size:12px;"> </h5>
                    </div>
        </div>
           <hr style="margin-top:45 ;margin-bottom: 10px;background-color: black ">
           <div class="clearfix"></div>
           <div class="col-md-12" style="margin: 0;padding: 20px;">
        <div style="padding-left:20px;" align="center">
           <!-- <h4 style="font-size:20px;">EMPLOYEE JOINING FORM </h4> -->
           <div style="padding-top: 8px;padding-left:20px;padding-right:20px;" align="center"><h1 style="font-size:15px;color:white;background: #275b58;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;"><b>SERVICE PROVIDER JOINING FORM</b></h1></div>
           <!-- <h4 style="font-size:15px;">CALIBRATION / VERIFICATION REPORT FOR ROCKWELL HARDNESS TESTER </h4> -->
           <!-- <h5 style="font-size:13px;">As per IS : 1568 : 2000 For Rockwell Test / IS : 2281, BS 100003 - 2 & ASTM E - 10 For Birnell Test </h5> -->
         
        </div>
       
       </div><hr style="height:2px;margin:0.25em 0; ">  


       <div class="clearfix"></div>
      
          <div class="clearfix"></div>
          <div class="col-12" style="padding-bottom: 0;">   
          <h3 style=" padding-left:20px ;font-size:15px;"><B>PERSONAL DETAILS </B> </h3>
          <hr style="height:2px;margin:0.25em 0; ">  

          <table style="width:100%; padding-left:20px; "  class="table table-bordered mb-0">
        
          <tr>
          <td align="left" style="width: 70%;">
            <div style="padding-left:20px;font-size:14px;" >
            <b> Employee Code :</b>  <?php echo htmlentities($output['iEmployeeFormId'], ENT_QUOTES);?>
            </div>
          </td>
          
          <td align="right" style="width: 50%;">
            <div style="padding-right:10px;font-size:14px;"  >
            <b>Date of Joining : </b>  <?php echo htmlentities(date('d/m/Y',strtotime($output['sDateofjoining'])), ENT_QUOTES);?>
            </div>
          </td>
          </tr> 
          
         
         <!-- <tr>

         <td align="left" style="width: 70%;">
  <div style="padding-left:20px;font-size:14px;">
   <b>Category :</b> <?php echo htmlentities($output['sCategory'], ENT_QUOTES);?>
  </div>
</td>


<td align="left" style="width: 70%;">
<div style="padding-left:20px;font-size:14px;"  >
   <b>Subcategory : </b><?php echo htmlentities($output['sSubcategory'], ENT_QUOTES);?>
  </div>
</td>
</tr>
<tr> -->

<td align="left" style="width: 70%;">
<div style="padding-left:20px;font-size:14px;">
<b>Brand Company Name :</b> <?php echo htmlentities($output['sBrandCompanyName'], ENT_QUOTES);?>
</div>
</td>

<td align="left" style="width: 70%;">
<div style="padding-left:20px;font-size:14px;">
<b>Mode :</b> <?php echo htmlentities($output['sMode'], ENT_QUOTES);?>
</div>
</td>
</tr>
          <tr>

          <td align="left" >
            <div style="padding-left:20px;font-size:14px;">
            <b> Name :</b> <?php echo htmlentities($output['sName'], ENT_QUOTES);?>
            </div>
          </td>
          

          <td align="right" style="width: 50%;" rowspan="4" >
            <div style="padding-right:10px;font-size:14px;"  > 
              <img src="<?php echo htmlentities($output['sPersonalphotocopy'], ENT_QUOTES);?>" width="200px" height="200px">
            </div></td>
          </tr> 
           
          <tr>

          <td align="left" style="width: 90%;">
          <div style="padding-left:20px;font-size:14px;" >
           <b> Present Address : </b> <?php echo htmlentities($output['sPresentaddress'], ENT_QUOTES);?>
            </div>
            </td>
          </tr>

          

          <tr>

          <td align="left" style="width: 80%;">
          <div style="padding-left:20px;font-size:14px;" >
          <b>Permanent Address :</b>  <?php echo htmlentities($output['sPermanentaddress'], ENT_QUOTES);?>
            </div>
            </td>
          </tr>
          
<!-- ------------------------------------------------------- -->
<table style="width:100%"  class="table table-bordered mb-0 "  style="padding-left:20px;"> 
<tr>

    <td align="left" style="width: 20%;">
      <div style="padding-left:20px;font-size:13px;">
        <b>Mobile Number : </b> <?php echo htmlentities($output['sMobilenumber'], ENT_QUOTES);?>
      </div>
    </td>
    <td>
      <div style="padding-right:20px;font-size:13px;">
      <b> Email ID :</b>   <?php echo htmlentities($output['sEmailid'], ENT_QUOTES);?>
      </div>
    </td>
    
  </tr>
          <tr>
          <td align="left" style="width: 50%;">
            <div style="padding-left:20px;font-size:13px;" >
           <b> Date Of Birth : </b>  <?php echo htmlentities(date('d/m/Y',strtotime($output['sDateofbirth'])), ENT_QUOTES);?>
            </div>
        
          </td>
          <td >
            <div style="padding-right:20px;font-size:13px;"  >
          <b>  GST No : </b> <?php echo htmlentities($output['sGST'], ENT_QUOTES);?>
            </div>
          </td>
          </tr>
          
          <tr>
          <td align="left" style="width: 50%;">
            <div style="padding-left:20px;font-size:13px;" >
           <b> Pan Card No :</b>  <?php echo htmlentities($output['sPancardno'], ENT_QUOTES);?>
            </div>
        
          </td>
          <td >
            <div style="padding-right:20px;font-size:13px;"  >
           <b> Adhar Card No : </b> <?php echo htmlentities($output['sAdharcardno'], ENT_QUOTES);?>
            </div>
          </td>
          </tr> 
       <tr>
          <td align="left" style="width: 50%;">
            <div style="padding-left:20px;font-size:13px;" >
             <b>Name As on Pan : </b> <?php echo htmlentities($output['sNameasonpan'], ENT_QUOTES);?>
            </div>
        
          </td>
          <td >
            <div style="padding-right:20px;font-size:13px;"  >
            <b> Name As on Adhar : </b> <?php echo htmlentities($output['sNameasonadhar'], ENT_QUOTES);?>
            </div>
          </td>
          </tr> 
          </table>  
          <tr> 
          <td align="left" style="width: 50%;">
            <div style="padding-left:22px;font-size:15px;" >
           <b>Emergancy Contact Details : </b> 
            </div>
        
          </td> 
          </tr>
          
         
          <table style="width:100%"  class="table table-bordered mb-0 "  style="padding-left:20px;"> 

         
          <tr>
          <td align="left" style="width: 40%;">
            <div style="padding-left:20px;font-size:13px;" >
            <b>Name :</b>  <?php echo htmlentities($output['sNamee'], ENT_QUOTES);?>
            </div>
        
          </td>
          <td >
            <div style="padding-right:20px;font-size:13px;"  >
           <b> Relation : </b> <?php echo htmlentities($output['sRelation'], ENT_QUOTES);?>
            </div>
          </td>
          </td>
          <td >

            <div style="padding-right:20px;font-size:13px;"  >
           <b> Contact Number : </b> <?php echo htmlentities($output['sContactNumber'], ENT_QUOTES);?>
            </div>
          </td>


          </tr> 
       
       </table>  
         
 </table>  
</div >      
<br>
<hr style="height:2px;margin:0.25em 0; ">

<div class="col-12" style="padding-bottom: 0;">
<div style="padding-top: 8px;padding-left:20px;padding-right:20px;" align="center"><h1 style="font-size:15px;color:white;background: #275b58;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;"><b>Category And Subcategory</b></h1></div>
    <table style="width:100%; padding-left:20px;">
        <tr>
            <td style="padding-left:0; width: 50%;" align="center">
                <table id="example1" class="table table-bordered mb-0">
                    <thead>
                        
                        <tr>
                          <th style="text-align:center;padding:5px;"><b>Category</b> </th>
                          <th style="text-align:center;padding:5px;"><b>Subcategory</b></th>
                            
                        </tr>
                    </thead>
                    <tbody>


                    <?php
     
     if(isset($employeeId))
     {
       $categorydetails=[];
         
         $stmt = $link->prepare('select * from tblcategoryandsubcategory where iEmployeeFormId=?');
         $stmt->bind_param('i',$employeeId);
         $stmt->execute();
         $result = $stmt->get_result();
         while($row = $result->fetch_assoc()){
             $categorydetails[]=$row;
             // $output = $row;
     
         }
     }
     
     for($i=0;$i<count($categorydetails);$i++)
     {
 
       ?>
                        <!-- Add your education details here -->
                        <tr style="text-align:center;">
                            <td ><?php if(isset($categorydetails[$i])) echo $categorydetails[$i]['sCategory'];?></td>
                            <td><?php if(isset($categorydetails[$i])) echo $categorydetails[$i]['sSubcategory'];?></td>
                           
                        </tr>


                        <?php


    }
    
    ?>
  
                        <!-- Add more rows if needed -->
                    </tbody>
                </table>
                </td>
                </tr>
                </table>




<br>
<hr style="height:2px;margin:0.25em 0; ">

<div class="col-12" style="padding-bottom: 0;">
<div style="padding-top: 8px;padding-left:20px;padding-right:20px;" align="center"><h1 style="font-size:15px;color:white;background: #275b58;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;"><b>Education Details</b></h1></div>
    <table style="width:100%; padding-left:20px;">
        <tr>
            <td style="padding-left:0; width: 50%;" align="center">
                <table id="example1" class="table table-bordered mb-0">
                    <thead>
                        
                        <tr>
                           <th style="text-align:center;padding:5px;"><b>Degree</b> </th>
                            <th style="text-align:center;padding:5px;"><b>University</b></th>
                            <th style="text-align:center;padding:5px;"><b>Year</b></th>
                            <th style="text-align:center;padding:5px;"><b>Level</b></th>
                            <th style="text-align:center;padding:5px;"><b>Accerediation Body</b></th>
                        </tr>
                    </thead>
                    <tbody>


                    <?php
     
     if(isset($employeeId))
     {
       $educationaldeails=[];
         
         $stmt = $link->prepare('select * from tbleducationaldetails where iEmployeeFormId=?');
         $stmt->bind_param('i',$employeeId);
         $stmt->execute();
         $result = $stmt->get_result();
         while($row = $result->fetch_assoc()){
             $educationaldeails[]=$row;
             // $output = $row;
     
         }
     }
     
     for($i=0;$i<count($educationaldeails);$i++)
     {
 
       ?>
                        <!-- Add your education details here -->
                        <tr style="text-align:center;">
                            <td ><?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sDegree'];?></td>
                            <td><?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sUniversityinstitute'];?></td>
                            <td><?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sYear'];?></td>
                            <td><?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sLevel'];?></td>
                            <td><?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sAccreditationBody'];?></td>
                        </tr>


                        <?php


    }
    ?>
  
                        <!-- Add more rows if needed -->
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

<!-- </div> -->
 
       

       
<br>
<hr style="height:2px;margin:0.25em 0; ">

<!-- <div class="col-12" style="padding-bottom: 0;"> -->
<div style="padding-top: 8px;padding-left:20px;padding-right:20px;" align="center"><h1 style="font-size:15px;color:white;background: #275b58;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;"><b>Listing Plan</b></h1></div>
    <table style="width:100%; padding-left:20px;">
        <tr>
            <td style="padding-left:0; width: 50%;" align="center">
                <table id="example1" class="table table-bordered mb-0">
                    <thead>
                      
                        <tr>
                           <th style="text-align:center;padding:5px;"><b>Scheme Name</b> </th>
                            <th style="text-align:center;padding:5px;"><b>Payment Mode</b></th>
                            <th style="text-align:center;padding:5px;"><b>Payment Date</b></th>
                            <th style="text-align:center;padding:5px;"><b>Validity</b></th>
                          
                        </tr>
                    </thead>
                    <tbody>


                    <?php
     
     if(isset($employeeId))
     {
        $familydeatils=[];
    
        $stmt = $link->prepare('select * from tbllistingplan where iEmployeeFormId   = ?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $familydeatils[]=$row;
            // $output = $row;
    
        }
     }
     
     for($i=0;$i<count($familydeatils);$i++)
     {
 
       ?>
                        <!-- Add your education details here -->
                        <tr style="text-align:center;">
                            <td ><?php if(isset($familydeatils[$i])) echo $familydeatils[$i] ['sSchemeName'];?></td>
                            <td><?php if(isset($familydeatils[$i])) echo $familydeatils[$i] ['sPaymentMode'];?></td>
                            <td><?php if(isset($familydeatils[$i])) echo date('d-m-Y', strtotime($familydeatils[$i] ['sPaymentDate']));?></td>
                            <td><?php if(isset($familydeatils[$i])) echo $familydeatils[$i] ['sValidity'];?></td>
                          
                        </tr>


                        <?php


    }
    
    ?>
  
                        <!-- Add more rows if needed -->
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</div>




<br>
<hr style="height:2px;margin:0.25em 0; ">

<div class="col-12" style="padding-bottom: 0;">
<div style="padding-top: 8px;padding-left:20px;padding-right:20px;" align="center"><h1 style="font-size:15px;color:white;background: #275b58;padding-top: 10px;padding-bottom: 10px;border-radius: 10px;"><b>LICENSE DETAILS</b></h1></div>
    <table style="width:100%; padding-left:20px;">
        <tr>
            <td style="padding-left:0; width: 50%;" align="center">
                <table id="example1" class="table table-bordered mb-0">
                    <thead>
                        
                        <tr>
                    
   
   <th  style="text-align:center;" ><b>Organisation / Company Name</b></th>
   <th   style="text-align:center;"><b>License Name</b></th>
   <th  style="text-align:center;"><b>Date of Issue</b> </th>
   <th  style="text-align:center;"><b>Expiry Date</b> </th>
   <th  style="text-align:center;"><b>License No</b> </th>
    
 
   
   </tr>

   

                          
                        
                    </thead>
                    <tbody>


                    <?php
     
     if(isset($employeeId))
     {
        $employmentdetails=[];
     
     $stmt = $link->prepare('select * from tbllicensedetails where iEmployeeFormId= ?');
     $stmt->bind_param('i',$employeeId);
     $stmt->execute();
     $result = $stmt->get_result();
     while($row = $result->fetch_assoc()){
         $employmentdetails[]=$row;
         // $output = $row;
 
     }
     }
     
     for($i=0;$i<count($employmentdetails);$i++)
     {
 
       ?>
                        <!-- Add your education details here -->
                        <tr style="text-align:center;">
                            <td ><?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i] ['sOrginiztionname'];?></td>
                            <td><?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i] ['sLicenseName'];?></td>
                            <td><?php if(isset($employmentdetails[$i])) echo date('d-m-Y', strtotime($employmentdetails[$i] ['sFrom']));?></td>
                            <td><?php if(isset($employmentdetails[$i])) echo date('d-m-Y', strtotime($employmentdetails[$i] ['sTo']));?></td>
                            <td><?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i] ['sLicenseNo'];?></td>
                          
                        </tr>


                        <?php


    }
    
    ?>
  
                        <!-- Add more rows if needed -->
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

<br>

    
  
    <table style="width:100%" >
         
    
          <tr>
          <td align="left" >
            <div style="padding-left:2px;font-size:14px;">
            <b>Remark:</b> <?php echo htmlentities($output['sRemarks'], ENT_QUOTES);?>
            </div>
          </td>

         

          </tr>

          <tr>

          <td align="left" >
            <div style="padding-left:2px;font-size:14px;">
            <b>Payment Verification:</b><?php echo htmlentities($output['sPaymentVerification'], ENT_QUOTES);?>
            </div>
          </td>
          </tr>
          <tr>

<td align="left" >
  <div style="padding-left:2px;font-size:14px;">
  <b>City:</b><?php echo htmlentities($output['sCity'], ENT_QUOTES);?>
  </div>
</td>
</tr>
<tr>

<?php
 if(isset($employeeId))
 {
  
 
 $stmt = $link->prepare('select * from tblcity where iEmployeeFormId   = ?');
 $stmt->bind_param('i',$employeeId);
 $stmt->execute();
 $result = $stmt->get_result();
 while($row = $result->fetch_assoc()){
    
  $ot = $row;

 }
 }?>

<td align="left" >
  <div style="padding-left:2px;font-size:14px;">
 <b>Pincode:</b> <?php echo htmlentities($ot['sPincode'], ENT_QUOTES);?>
  </div>
</td>
</tr>
          

          <!-- <tr>
            <td  style="width:50%;">
                <div style="padding-left:20px;">
                <div style="padding-left:20px;"><h1 style="font-size:16px;" ><b></b>
                </div>
                </div>
            </td>
            <td style="padding-left:20px;padding-top: 10px; width:50%;" align="center">
                <div style="padding-left:90px;padding-bottom:2px;"align="center"><h1 style="font-size:16px;" ><b>Signature of Employee</b></h1></div>
            
                <div style="padding-left:90px;padding-right:2px;"align="center"> <b> Name</b></h1></div>
                    
            </td>
          </tr>    -->
        </table>  

<br>
<hr style="height:2px;margin:0.25em 0; ">
        

</div>  

</div>




        <!-- <div class="col-md-6"  align="right"> -->
      <!-- <footer><footer class="footer"> -->
      <!-- <div class="col-md-12 bottom-layout  " id="footer" style="padding:30px; " align="bottom" > -->
      <div class="col-md-12 row bottom-layout" id="footer" style="padding:0px;" >
      
      <!-- <div class="col-md-6">
                <div style="padding-left:40px;">
                <h1 style="font-size:16px;padding-top: 25px;" ><b>Calibrated by :</b> 
                <?php   
                    // $stmt = $link->prepare('select * from tbluser where iUserId=?');
                    // $stmt->bind_param('i',$output['sCalibrationBy']);
                    // $stmt->execute();
                    // $result = $stmt->get_result();
                    // while($row = $result->fetch_assoc()){
                    //     echo $row['sName'];
                    // }
                    ?></h1>
                    </div>
               </div> 
      </div>
      <div class="col-md-6" >
      <div style="padding-left:20px;padding-top:0px; " align="center"><h1 style="font-size:16px;" ><b>Verification Authority</b></h1></div>
            
            <div style="padding-left:35px;padding-right:35px;padding-top:10px;" align="center"> <b> For Fuel Instruments And Engineers Pvt. Ltd</b></h1></div>
                
      </div> -->
<!-- <br> -->
       
        

                </div>  
       <!-- </footer>   -->
       
       
       <script>
        // window.print();
       </script>
      
