<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>



<?php 



$msg = "";
    
    if(isset($_POST['btnsave']) && isset($_POST['contractorId'])){

        $contractorId  = $_POST['contractorId']; 
        $name = $_POST['name'];
        $contactnumber = $_POST['contactnumber'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $ifscCode = $_POST['ifscCode'];
        $bankname = $_POST['bankname'];
        $branch = $_POST['branch']; 
        $accountno = $_POST['accountno'];
      $contractrenewaldate= $_POST['contractrenewaldate'];
    
      $newDate = date("d-m-Y", strtotime($contractrenewaldate));  
      $cemail= $_POST['cemail'];
      $aadhar=$_POST['aadhar'];
    $pan=$_POST['pan'];
    $aadharname=$_POST['aadharname'];
    $panname=$_POST['panname'];

        

        /// update password code here 
       // $password = $_POST['password'];

        $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId    = ?');
        $stmt->bind_param('i',$contractorId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
        
            $param_password = $row['sPassword'];

        }

        // if($password != ""){
        //     $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        // }



        $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId   = ?');
        $stmt->bind_param('i',$contractorId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $esiregistrationcertification = $row['sEsiregistrationcetifiaction'];
            $epfregistrationcertifiaction= $row['sEpfregistrationcertifcation'];
            $contractlabouractregistrationcertification  = $row['sContractlabouractregistrationcertification'];
            
            
      
    
        }
    

        if(isset($_FILES['esiregistrationcertification']) && $_FILES['esiregistrationcertification']['size'] > 0){
        
            $target_dir = "uploaded_images/";
            
            $ext = substr(strrchr($_FILES["esiregistrationcertification"]["name"],'.'),1);
            $target_file = $target_dir ."esiregistrationcertification_". time().".".$ext;
         
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES["esiregistrationcertification"]["tmp_name"]);
            if($check == true) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            
            if (move_uploaded_file($_FILES["esiregistrationcertification"]["tmp_name"], $target_file)) {
                $esiregistrationcertification = "uploaded_images/esiregistrationcertification_". time().".".$ext;
                
              }
            }
            
    
    
            ///below epf
    
         
    
            if(isset($_FILES['epfregistrationcertifiaction']) && $_FILES['epfregistrationcertifiaction']['size'] > 0){
            
                $target_dir = "uploaded_images/";
                
                $ext = substr(strrchr($_FILES["epfregistrationcertifiaction"]["name"],'.'),1);
                $target_file = $target_dir ."epfregistrationcertifiaction_". time().".".$ext;
             
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $check = getimagesize($_FILES["epfregistrationcertifiaction"]["tmp_name"]);
                if($check == true) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
                
                if (move_uploaded_file($_FILES["epfregistrationcertifiaction"]["tmp_name"], $target_file)) {
                    $epfregistrationcertifiaction = "uploaded_images/epfregistrationcertifiaction_". time().".".$ext;
                    
                  }
                }
               
    
              // below contrct labour act  
            
    
              if(isset($_FILES['contractlabouractregistrationcertification']) && $_FILES['contractlabouractregistrationcertification']['size'] > 0){
              
                  $target_dir = "uploaded_images/";
                  
                  $ext = substr(strrchr($_FILES["contractlabouractregistrationcertification"]["name"],'.'),1);
                  $target_file = $target_dir ."contractlabouractregistrationcertification_". time().".".$ext;
               
                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                  $check = getimagesize($_FILES["contractlabouractregistrationcertification"]["tmp_name"]);
                  if($check == true) {
                      $uploadOk = 1;
                  } else {
                      $uploadOk = 0;
                  }
                  
                  if (move_uploaded_file($_FILES["contractlabouractregistrationcertification"]["tmp_name"], $target_file)) {
                      $contractlabouractregistrationcertification = "uploaded_images/contractlabouractregistrationcertification_". time().".".$ext;
                      
                    }
                  }
                 
      
                  $cancelledchequecopy = '';

                  if(isset($_FILES['cancelledchequecopy']) && $_FILES['cancelledchequecopy']['size'] > 0){
                  
                      $target_dir = "uploaded_images/";
                      
                      $ext = substr(strrchr($_FILES["cancelledchequecopy"]["name"],'.'),1);
                      $target_file = $target_dir . time().".".$ext;
                   
                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                      $check = getimagesize($_FILES["cancelledchequecopy"]["tmp_name"]);
                      if($check == true) {
                          $uploadOk = 1;
                      } else {
                          $uploadOk = 0;
                      }
                      
                      if (move_uploaded_file($_FILES["cancelledchequecopy"]["tmp_name"], $target_file)) {
                          $cancelledchequecopy = "uploaded_images/". time().".".$ext;
                          
                        }
                      }
                      if($cancelledchequecopy == null){
                          $cancelledchequecopy = "";
                      }


                      $aadharcard = '';



                      if(isset($_FILES['aadharcard']) && $_FILES['aadharcard']['size'] > 0){

                      

                          $target_dir = "uploaded_images/";

                          

                          $ext = substr(strrchr($_FILES["aadharcard"]["name"],'.'),1);

                          $target_file = $target_dir ."aadharcard". time().".".$ext;

                       

                          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                          $check = getimagesize($_FILES["aadharcard"]["tmp_name"]);

                          if($check == true) {

                              $uploadOk = 1;

                          } else {

                              $uploadOk = 0;

                          }

                          

                          if (move_uploaded_file($_FILES["aadharcard"]["tmp_name"], $target_file)) {

                              $aadharcard = "uploaded_images/aadharcard". time().".".$ext;

                              

                            }

                          }

                          if($aadharcard == null){

                              $aadharcard = "";

                          }
                 
                 
                 
                                               $pancard = '';
                 
                 
                 
                                               if(isset($_FILES['pancard']) && $_FILES['pancard']['size'] > 0){
                         
                                               
                         
                                                   $target_dir = "uploaded_images/";
                         
                                                   
                         
                                                   $ext = substr(strrchr($_FILES["pancard"]["name"],'.'),1);
                         
                                                   $target_file = $target_dir ."pancard". time().".".$ext;
                         
                                                
                         
                                                   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                         
                                                   $check = getimagesize($_FILES["pancard"]["tmp_name"]);
                         
                                                   if($check == true) {
                         
                                                       $uploadOk = 1;
                         
                                                   } else {
                         
                                                       $uploadOk = 0;
                         
                                                   }
                         
                                                   
                         
                                                   if (move_uploaded_file($_FILES["pancard"]["tmp_name"], $target_file)) {
                         
                                                       $pancard = "uploaded_images/pancard". time().".".$ext;
                         
                                                       
                         
                                                     }
                         
                                                   }
                         
                                                   if($pancard == null){
                         
                                                       $pancard = "";
                         
                                                   }
                 



     
        $query = "update tblcontractorregform set sName=?,sContactnumber=?,sAddress=?,sEmail=?,sIFSCCode=?,sBankName=?,sBranch=?,sAccountNo=?,sContractrenewaldate=? ,Company_Email=?,sAadharNo=?,sNameonAadhar=?,sPanNo=?,sNameonPan=? where iContractorRegFormId=?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ssssssssssissss", $name,$contactnumber,$address,$email,$ifscCode,$bankname,$branch,$accountno, $newDate,$cemail,$aadhar,$aadharname,$pan,$panname,$contractorId);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // exit();

        if(!$ret){
            $msg= "Data Not Updated";
        }else{
            $msg= "Data Updated";

            echo "<script>window.location.href = 'list-contractor-registration-form.php';</script>";
        } 
    }


   else if(isset($_POST['btnsave']))
   {
 
    $name = $_POST['name'];
    
    $contactnumber = $_POST['contactnumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $ifscCode = $_POST['ifscCode'];
    $bankname = $_POST['bankname'];
    $branch = $_POST['branch']; 
    $accountno = $_POST['accountno'];
  //  $contractrenewaldate= $_POST['contractrenewaldate'];
    $password = $_POST['password'];
    $aadhar=$_POST['aadhar'];
    $pan=$_POST['pan'];
    $aadharname=$_POST['aadharname'];
    $panname=$_POST['panname'];
    $contractrenewaldate= $_POST['contractrenewaldate'];
    $cemail= $_POST['cemail'];


    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


   
              
    $cancelledchequecopy = '';

    if(isset($_FILES['cancelledchequecopy']) && $_FILES['cancelledchequecopy']['size'] > 0){
    
        $target_dir = "uploaded_images/";
        
        $ext = substr(strrchr($_FILES["cancelledchequecopy"]["name"],'.'),1);
        $target_file = $target_dir . time().".".$ext;
     
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["cancelledchequecopy"]["tmp_name"]);
        if($check == true) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        
        if (move_uploaded_file($_FILES["cancelledchequecopy"]["tmp_name"], $target_file)) {
            $cancelledchequecopy = "uploaded_images/". time().".".$ext;
            
          }
        }
        if($cancelledchequecopy == null){
            $cancelledchequecopy = "";
        }


        $aadharcard = '';



                          if(isset($_FILES['aadharcard']) && $_FILES['aadharcard']['size'] > 0){

                          

                              $target_dir = "uploaded_images/";

                              

                              $ext = substr(strrchr($_FILES["aadharcard"]["name"],'.'),1);

                              $target_file = $target_dir ."aadharcard". time().".".$ext;

                           

                              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                              $check = getimagesize($_FILES["aadharcard"]["tmp_name"]);

                              if($check == true) {

                                  $uploadOk = 1;

                              } else {

                                  $uploadOk = 0;

                              }

                              

                              if (move_uploaded_file($_FILES["aadharcard"]["tmp_name"], $target_file)) {

                                  $aadharcard = "uploaded_images/aadharcard". time().".".$ext;

                                  

                                }

                              }

                              if($aadharcard == null){

                                  $aadharcard = "";

                              }



                              $pancard = '';



                              if(isset($_FILES['pancard']) && $_FILES['pancard']['size'] > 0){
        
                              
        
                                  $target_dir = "uploaded_images/";
        
                                  
        
                                  $ext = substr(strrchr($_FILES["pancard"]["name"],'.'),1);
        
                                  $target_file = $target_dir ."pancard". time().".".$ext;
        
                               
        
                                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
                                  $check = getimagesize($_FILES["pancard"]["tmp_name"]);
        
                                  if($check == true) {
        
                                      $uploadOk = 1;
        
                                  } else {
        
                                      $uploadOk = 0;
        
                                  }
        
                                  
        
                                  if (move_uploaded_file($_FILES["pancard"]["tmp_name"], $target_file)) {
        
                                      $pancard = "uploaded_images/pancard". time().".".$ext;
        
                                      
        
                                    }
        
                                  }
        
                                  if($pancard == null){
        
                                      $pancard = "";
        
                                  }


  /*  $query = "INSERT INTO tblcontractorregform (sName,sContactnumber,sAddress,sEmail,sEsiregistrationcetifiaction,sEpfregistrationcertifcation,sContractlabouractregistrationcertification,sIFSCCode,sBankName,sBranch,sAccountNo,sPassword,iCreatedBy,sCancelledChequeCopy) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "ssssssssssssis",$name,$contactnumber,$address,$email,$esiregistrationcertification,$epfregistrationcertifiaction,$contractlabouractregistrationcertification,$ifscCode,$bankname,$branch,$accountno, $param_password,$_SESSION['id'],$cancelledchequecopy);*/
    
    // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";
//echo "INSERT INTO tblcontractorregform (sName,sContactnumber,sAddress,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sPassword,iCreatedBy,sCancelledChequeCopy) VALUES ('".$name."','".$contactnumber."','".$address."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','". $param_password."','".$_SESSION['id']."','".$cancelledchequecopy."')";

  $query = "INSERT INTO tblcontractorregform (sName,sContactnumber,sAddress,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sPassword,iCreatedBy,sCancelledChequeCopy,sAadharNo,sNameonAadhar,sPanNo,sNameonPan,sAadharImage,sPanImage,sContractrenewaldate,Company_Email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "sssssssssisssssssss",$name,$contactnumber,$address,$email,$ifscCode,$bankname,$branch,$accountno, $param_password,$_SESSION['id'],$cancelledchequecopy,$aadhar,$aadharname,$pan,$panname,$aadharcard,$pancard,$contractrenewaldate,$cemail);

    $ret = mysqli_stmt_execute($stmt);
    // $error=mysqli_error($link);
    // print("error occured:".$error);
    mysqli_stmt_close($stmt);
    // exit();

    if(!$ret){

        $msg= "Data Not Saved";
    }else{
        $msg= "Data Saved";

        //echo "<script>window.location.href = 'list-process.php';</script>";
    }    

}

else if(isset($_POST['contractorId'])){
    $contractorId  = $_POST['contractorId']; 
        
    $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId    = ?');
    $stmt->bind_param('i',$contractorId);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
    
        $output = $row;

    }
} 
?>

<head>
    <title>Agent Registration Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php 

    include 'layouts/body.php'; 

?>


<style>
    
        .div p{
            font-size:28px;
            background-color:#D3D3D3;
            margin-left:260px;
            padding-left:200px;
            padding-bottom:15px;     
        }
       
       .div{
        background-color:#D3D3D3;      
       } 
       .div img{
           width: 150px;
           padding-top:10px;
           margin-left:570px;
           padding-bottom:10px;
       }

  .form-label:after {
    content:" *";
    color: red;
  }

       
</style> 
<!-- header-->
    
 <!-- end header-->


<!-- Begin page -->
<div id="layout-wrapper">

<?php include 'layouts/menu.php'; ?>

    

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
    <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"> ADD Agent </h4>
                            

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                                    <li class="breadcrumb-item active">Add Agent</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
    <div class="">
   
                <div class="row" >
                <div class="col-xl-12" ></div>
                    <!-- <div class="col-xl-5"> -->
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                                <h4>Agent Information:</h4><br>
                                
                                <form action="contractor-registration-form.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();"; >
                                    <div class="row">
                                        <div class="col-md-6">
                                           
                                        <div>                 
                                    </div>

                                </div>

                                    
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name"  name="name" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sName']; ?>" required>
                                            </div>
                                        </div>
                                    

                                    <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Contact Number</label>
                                              <input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNumber']; ?>" required>
                                          </div>
                                      </div>
                                       
                                    <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Address</label>  
                                                <textarea type="text" class="form-control" name = "address" id="address" placeholder=" Address" required ><?php if(isset($output)) echo $output['sAddress']; ?></textarea>                   
                                            </div>
                                        </div>
                                       
                                  
                                        <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Email ID</label>
                                              <input type="text" class="form-control" id="email"  name="email" value="<?php if(isset($output)) echo $output['sEmail']; ?>" required ><br>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label-notr">Aadhar Card No.</label>
                                              <input type="text" class="form-control" id="aadhar"  name="aadhar" value="<?php if(isset($output)) echo $output['sAadharNo']; ?>" ><br>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label-notr">Name As on Aadhar</label>
                                              <input type="text" class="form-control" id="aadharname"  name="aadharname" value="<?php if(isset($output)) echo $output['sNameonAadhar']; ?>"  ><br>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label-notr">Pan Card No.</label>
                                              <input type="text" class="form-control" id="pan"  name="pan" value="<?php if(isset($output)) echo $output['sPanNo']; ?>"  ><br>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label-notr">Name As on Pan</label>
                                              <input type="text" class="form-control" id="panname"  name="panname" value="<?php if(isset($output)) echo $output['sNameonPan']; ?>" ><br>
                                          </div>
                                      </div>
                                      <?php if (!isset($_POST['contractorId'])) {
    
    ?>
                                      <div class="col-md-12">
                                            <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label-notr">Aadhar Card Image</label>
                                                <input type="file" class="form-control" id="aadharcard"  name="aadharcard" ><br>
                                            </div>
                                            </div>

                                            <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label-notr">Pan Card Image </label>


                                                <input type="file" class="form-control" id="pancard"  name="pancard" ><br>
                                            </div>
                                            </div>
                                            <?php }?>

                                           
                                           <?php if (isset($_POST['contractorId'])) {
    
    ?>


   <div class="col-md-12">
      <div class="mb-3">
          <label for="formrow-firstname-input" class="form-label-notr">Aadhar Card Image</label>
          <br/>
   <a href="<?php if(isset($output['sAadharImage']) && $output['sAadharImage'] != "") echo $output['sAadharImage']; ?>" target="_blank">
            <img src="<?php echo $output['sAadharImage']; ?>" style="height: 200px; width: 300px" alt="Not Available">
        </a>
   <br/><br/>
</div>
</div>
<div class="col-md-12">
      <div class="mb-3">
          <label for="formrow-firstname-input" class="form-label-notr">Pan Card Image</label>
          <br/>
  <a href="<?php if(isset($output['sPanImage']) && $output['sPanImage'] != "") echo $output['sPanImage']; ?>" target="_blank">
            <img src="<?php echo $output['sPanImage']; ?>" style="height: 200px; width: 300px" alt="Not Available">
        </a> 
   <br/><br/>
</div>
</div>
<?php }?>


                                     
                                     
                                      <div class="title-details mb">
						 	              <h4>Bank Details:</h4>
						             </div>
 
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">IFSC Code</label>
                                                <input type="text" class="form-control" id="ifscCode"  name="ifscCode" value="<?php if(isset($output)) echo $output['sIFSCCode']; ?>" onblur="getBankData(this.value)" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control" id="bankname"  name="bankname" value="<?php if(isset($output)) echo $output['sBankName']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Branch</label>
                                                <input type="text" class="form-control" id="branch"  name="branch" value="<?php if(isset($output)) echo $output['sBranch']; ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Account No</label>
                                                <input type="text" class="form-control" id="accountno"  name="accountno" value="<?php if(isset($output)) echo $output['sAccountNo']; ?>" required>
                                            </div>
                                        </div>

                                       
                                         </div>
                                        

                               
                                <?php if (!isset($_POST['contractorId'])) {
    
                                ?>

                                 <div class="col-md-12">
                                            <div class="mb-3">
                                          <label for="formrow-firstname-input" class="form-label">Cancelled Cheque Copy </label>
                                                <input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" required><br>
                                            </div>
                                 </div>
                                 <?php } 

                                ?>

<?php if (isset($_POST['contractorId'])) {
    
    ?>


<div class="col-md-12">
    <div class="mb-3">
        <label for="formrow-firstname-input" class="form-label">Cheque Image</label>
        <br/>
        <a href="<?php if(isset($output['sCancelledChequeCopy']) && $output['sCancelledChequeCopy'] != "") echo $output['sCancelledChequeCopy']; ?>" target="_blank">
            <img src="<?php echo $output['sCancelledChequeCopy']; ?>" style="height: 200px; width: 300px">
        </a>
        <br/><br/>
    </div>
</div>


           <?php
          }
        ?>



                                            <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Company Email ID</label>
                                              <input type="text" class="form-control" id="email"  name="cemail" value="<?php if(isset($output)) echo $output['Company_Email']; ?>" required><br>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
    <div class="mb-3">
        <label for="formrow-password-input" class="form-label">Contract Renewal Date</label>
        <input type="date" class="form-control" id="contractrenewaldate" name="contractrenewaldate" 
               value="<?php if(isset($output['sContractrenewaldate'])) echo date('Y-m-d', strtotime($output['sContractrenewaldate'])); ?>" 
               required>
    </div>

    </div>


                                 <?php if (!isset($_POST['contractorId'])) {
    
    ?>
                                <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Password</label>
                                                <input type="password"  class="form-control" id="password"  name="password" <?php if(!isset($contractorId)) echo  "required"; ?>>
                                            </div>
                                </div> 

                                <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Confirm Password</label>
                                                <input type="password"  class="form-control" id="conpassword"  name="conpassword"  <?php if(!isset($contractorId)) echo  "required"; ?>>
                                            </div>
                                </div>

                                
                                <?php } 
                                ?>
                                <?php
                                        if (isset($contractorId)) {
                                    ?>
                                        <input type="hidden" name="contractorId" value="<?php echo $contractorId; ?>">
                                    <?php        
                                        }
                                    ?>


                                    <div>
                                        <center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>
                                    </div>
                                  
                                    
                                </div>     
                                      
                                </div>  
                             </div>

                                 
                                     
                                
                                     
                                        
                                        <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Percent Payable</label>
                                                <input type="number" class="form-control" id="formrow-password-input" name="percentpayment" value="<?php //if(isset($output)) echo $output['iPercentPayment']; else $globalsettings['iPercentPayable']; ?>">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="formrow-password-input" name="password" <?php //if(!isset($output)) echo 'required'; ?>>
                                            </div>
                                        </div> -->
                                      
                                    </div>
                                



                                 
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    
                </div>
                <!-- end row -->
                <div class="col-xl-3"></div>
               

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php //include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>
<script>

    function validateForm(){
        if(document.getElementById("password").value !== document.getElementById("conpassword").value){
            alert("Passwords do not Match");
            return false;
        }
        return true;
    }
    
//     function showMSME(value){
//         if(value< 500000000){
           
//             document.getElementById("msme").required = true;
            
//         }else {
            
//             document.getElementById("msme").required = false;
//         }
//     }

//     function check(){
        

        
//     if(document.getElementById("checkbox").checked)
//         {
//         document.getElementById("gstno").readOnly = true;
//         document.getElementById("gstno").required = false;
//         document.getElementById('panno').readOnly = false;
//         document.getElementById("panno").required = true;
        
//         }
//     else
//         {
//         document.getElementById("gstno").readOnly = false;
//         document.getElementById("gstno").required = true;
//         document.getElementById('panno').readOnly = true;
//         document.getElementById("panno").required = false;
        
//         }
//     }



//     function showPAN(gstno){
//     if(gstno.length == 15){
//         document.getElementById("panno").value = gstno.substr(2,10);
//         }
//     }

//     function showAdd(){
//     if(document.getElementById("ckeck").checked){
//         document.getElementById("communicationaddress").value = document.getElementById("registrationaddress").value;
//         }
//     }

function getBankData(IFSCCODE)
  {
    $.get( "https://ifsc.razorpay.com/"+IFSCCODE)
        .done(function(data) {
            
            var obj = (data);
            console.log(obj);
            if(obj.hasOwnProperty("BANK")){
                document.getElementById("bankname").value = obj.BANK;
                document.getElementById("branch").value = obj.BRANCH;
            }   
    });
  }

// function getGST(GST)
//   {
//     // var gstinformat = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/; 

//     // if (gstinformat.test(GST)) {    
        
//     //                 return true;    
//     //             } else {    
//     //                 alert('Please Enter Valid GSTIN Number');    
                     
//     //             } 
//         $.post( "api.php", {action:'verifyGST',gstno:GST})
//         .done(function(data) {
            
//             var obj  = jQuery.parseJSON(data);
//             console.log(obj);
//             if(obj.hasOwnProperty("tradename")){
//                 document.getElementById("companyname").value = obj.tradename;
//                 document.getElementById("registrationaddress").value = obj.address;
//                 document.getElementById("promotersname").value = obj.tradetype;
                
//             }   
//     });
    
//     }


</script>

</html>