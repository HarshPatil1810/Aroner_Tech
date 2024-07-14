<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>


<?php //include 'layouts/head-main.php'; ?>



<?php
if(isset($_POST['btnsave']))
{
    $gstno = $_POST['gstno'];
    $gst_value_uppercase = strtoupper($gstno);
    $panno = $_POST['panno'];
    $pan_value_uppercase = strtoupper($panno);
    $companyname = $_POST['companyname'];
    $establishment = $_POST['establishment'];
    $companyownership = $_POST['companyownership'];
    $promotersname = $_POST['promotersname'];
    $registrationaddress = $_POST['registrationaddress'];
    $registrationaddress2 = $_POST['registrationaddressline2'];
    $registrationaddress3 = $_POST['registrationaddressline3'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin = $_POST['pin'];
    $communicationaddress = $_POST['communicationaddress'];
    $annualturnover = $_POST['annualturnover'];
    $officeno = $_POST['officeno'];
    $contactpersonname = $_POST['contactpersonname'];
    $contactnumber = $_POST['contactnumber'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $ifscCode = $_POST['ifscCode'];
    $ifscCode_value_uppercase = strtoupper($ifscCode);
    $bankname = $_POST['bankname'];
    $branch = $_POST['branch']; 
    $accountno = $_POST['accountno'];
    $monthlyvolumeshandled = $_POST['monthlyvolumeshandled'];
    $msme = $_POST['msme'];
    $unit = $_POST['unit'];
    


    $arrayString= explode(" ", $companyname );
    
    $companycode="";
    
    for($i=0;$i<sizeof($arrayString);$i++)
    {
        $companycode = $companycode.substr($arrayString[$i],0,1);
    }
    
    if(sizeof($arrayString)==2)
    {
        $companycode = $companycode."Z";
    }
    
    $companycode = $companycode.rand(100,999);
    
    //echo $companycode;



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
    
  

    $query = "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sAddressLine2,sAddressLine3,sCity,sState,sPinCode,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode,sUnit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssss", $gst_value_uppercase,$pan_value_uppercase,$companyname,$establishment,$companyownership,$promotersname,$registrationaddress,$registrationaddress2,$registrationaddress3,$city,$state,$pin,$communicationaddress,$annualturnover,$officeno,$contactpersonname,$contactnumber,$designation,$email,$ifscCode_value_uppercase,$bankname,$branch,$accountno,$cancelledchequecopy,$monthlyvolumeshandled,$msme,$companycode,$unit);
    
    // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";



    $ret = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $messagestring = "<html>
    <body>
       
            <table cellspacing=0>
                <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <img src=\"https://vendor.fietest.in/assets/images/new-logo.jpg\" style=\"width:50%;margin:auto;display:block\" >
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:28px;margin:auto;display:block;text-align:center\">Vendor Registration Details</p>  
                    </td>
                </tr>";

                    //$companyname = "SHRI RADHAMADHAV ENTERPRISES";
                    $stmt = $link->prepare("Select * from tblvendorregform WHERE sPANNo= ?");
                    $stmt->bind_param('s',$panno);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                
        $messagestring = $messagestring."<tr>
                        <td style=\"width:30%;padding:20px;\">
                       
                        </td>
                        <td>
                        <p style=\"font-size:20px;font-weight:bold;text-align:center\">  Company Details</p>
                        </td>
                    </tr>
                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Company Name</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sCompanyName']." </p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  GST No</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ". $row['sGSTNo']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  PAN No</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sPANNo']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Registration Address</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sRegistrationAddress']."</p>
                        </td>
                    </tr>

                    <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Registration Address Line 2</p>
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sAddressLine2']."</p>
                    </td>
                </tr>

                <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> Registration Address Line 3</p>
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sAddressLine3']."</p>
                    </td>
                </tr>

                <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">City</p>
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sCity']."</p>
                    </td>
                </tr>

                <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> State</p>
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sState']."</p>
                    </td>
                </tr>

                <tr>
                    <td style=\"width:30%;border:1px solid black;padding:10px;\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> Pin Code</p>
                    </td>
                    <td style=\"border:1px solid black\">
                    <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sPinCode']."</p>
                    </td>
                </tr>


                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Communication Address</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sCommunicationAddress']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Year of Establishment</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sEstablishment']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Nature of Company Ownership</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sCompanyOwnership']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Name of Promoters/Directors/Proprietor</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ". $row['sPromotersDirectorsProprietor']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Annual Turnover</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ". $row['sAnnualTurnover']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Number of Offices / Manufacturing Units</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sNoOfOffices']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;padding:20px;\">
                       
                        </td>
                        <td style=\"\">
                        <p style=\"font-size:20px;font-weight:bold;text-align:center\">  Contact Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Contact Person Name</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sContactPersonName']." </p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Designation</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">". $row['sDesignation']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Contact Number</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ".$row['sContactNo']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Email Id</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sEmail']."</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style=\"width:30%;padding:20px;\">
                       
                        </td>
                        <td style=\"\">
                        <p style=\"font-size:20px;font-weight:bold;text-align:center\">  Bank Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Bank Name</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">". $row['sBankName']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Account No</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> ". $row['sAccountNo']." </p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Branch</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sBranch']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  IFSC Code</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sIFSCCode']." </p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Cheque Photo</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <img src=\"https://vendor.fietest.in/".$row['sCancelledChequeCopy']."\" style=\"height:200px\">
                        </td>
                    </tr>


                    <tr>
                        <td style=\"width:30%;padding:20px;\">
                       
                        </td>
                        <td>
                        <p style=\"font-size:20px;font-weight:bold;text-align:center\">  Other Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  Monthly Volumes Handled</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">".$row['sMonthlyVolumesHandled']."</p>
                        </td>
                    </tr>

                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">  MSME Registration No</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">". $row['sMSMERegNo']." </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style=\"width:30%;border:1px solid black;padding:10px;\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\"> Unit</p>
                        </td>
                        <td style=\"border:1px solid black\">
                        <p style=\"font-size:18px;margin:auto;display:block;text-align:center\">". $row['sUnit']." </p>
                        </td>
                    </tr>
                    
                    
                    
                    ";
    }   
                
           $messagestring = $messagestring." </table>
      
    </body>
</html>";


 include "sendemail.php";

$status = sendEmail($email,$companyname,$messagestring,0,0,"");



$unitemail = "";

if($unit == "Testing")
{
    $unitemail = "purchase@fietest.com";
}
else if($unit == "HMD")
{
    $unitemail = "purchasehmd@fiegroup.in";
}
else if($unit == "PCD")
{
    $unitemail = "storepcd@fiethv.in";
}
else if($unit == "THV")
{
    $unitemail = "wathare@fiethv.in";
}
else if($unit == "Corporate Unit")
{
    $unitemail = "aap@fietest.com";
}

$status = sendEmail($unitemail,$companyname,$messagestring,0,0,"");


if (!isset($_POST['emailcheckbox']) ) {
    $accemail = "account@fietest.com";
    $status = sendEmail($accemail, $companyname, $messagestring, 0, 0, "");
}


header('Location: success.php');
    if(!$ret){

        $msg= "Data Not Saved";
    }else{
        $msg= "Data Saved";

        //echo "<script>window.location.href = 'list-process.php';</script>";
    }    

}
?>

<head>
    <title>Vendor Registration Form</title>
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
            padding-bottom:15px;     
        }
       
       .div{
        background-color:#D3D3D3;      
       } 
       .div img{
           padding-top:10px;
           padding-bottom:10px;
           margin:auto;
       }
       
</style> 
<!-- header-->
<div class="div">    
        <img src="assets/images/new-logo.jpg" alt=""  width="" style="width:15%;margin:auto;display:block" ></div>
        <div class="div">    
        <p style="margin:auto;display:block;text-align:center">Vendor Registration Form</p>  
     </div>
 <!-- end header-->
<div>

<!-- Begin page -->
<div id="layout-wrapper">


    <?php// include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="">
   
                <div class="row" >
                <div class="col-xl-3" ></div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                                <h4>Company Information:</h4><br>
                                
                                <form action="vendor-registration-form.php" method="post" enctype="multipart/form-data" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-model-input" class="form-label">GST No</label>                                   
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="checkbox" onclick="check()">
                                                <label class="form-check-label" for="flexCheckDefault">GST is not applicable</label>                         
                                                <input type="text" class="form-control" id="gstno" name="gstno"  style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sGSTNo']; ?>" onblur="showPAN(this.value)" required > 
                                                
                                                <button type="button" class="fa fa-search btn btn-info" style="margin-top:-32px; margin-left:340px;" name="search" onclick="getGST(document.getElementById('gstno').value)">Search</button>
                                            </div>
                                        <div>                 
                                    </div>

                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">PAN Card No</label>
                                                <input type="text" class="form-control" id="panno"  name="panno" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sPANNo']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                       
                                       
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Name of Company</label>
                                                <input type="text" class="form-control" id="companyname"  name="companyname" value="<?php if(isset($output)) echo $output['sCompanyName']; ?>" required>
                                            </div>
                                        </div>

                                          
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Year of Establishment</label>
                                                <input type="text" class="form-control" id="establishment"  name="establishment" value="<?php if(isset($output)) echo $output['sEstablishment'];?>" required>
                                            </div>
                                        </div>

                                          <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label" >Nature of Company Ownership </label>
                                                <label for="formrow-password-input" class="form-label" style="line-height: 0.5;"> (whether Proprietorship, Partnership, Private Ltd.. Etc) </label>
                                                <input type="text" class="form-control" id="companyownership"  name="companyownership" value="<?php if(isset($output)) echo $output['sCompanyOwnership']; ?>" required>
                                            </div>
                                        </div>               
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name of Promoters/Directors/Proprietor</label>
                                                <input type="text" class="form-control" id="promotersname"  name="promotersname" value="<?php if(isset($output)) echo $output['sPromotersDirectorsProprietor']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Registration Address</label>  
                                                <textarea type="text" class="form-control" name = "registrationaddress" id="registrationaddress" placeholder="Registration Address" ><?php if(isset($output)) echo $output['sRegistrationAddress']; ?></textarea>                   
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> Address Line 2</label>  
                                                <input type="text" class="form-control" name = "registrationaddressline2" id="registrationaddressline2" placeholder="Registration Address" value="<?php if(isset($output)) echo $output['sAddressLine2']; ?>">                   
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> Address Line 3</label>  
                                                <input type="text" class="form-control" name = "registrationaddressline3" id="registrationaddressline3" placeholder="Registration Address" value="<?php if(isset($output)) echo $output['sAddressLine3']; ?>">                   
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($output)) echo $output['sCity']; ?>" placeholder="City" required>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Select State</label>
                                            <div class="col-sm-5">
                                            <select name="state" class="form-select" id="state">
                                            <?php
    
                                        $indian_states = array(
                                     "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur","Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan","Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
                                      );?>
                             <!--<option value="" >Select State</option>-->

   <?php
    foreach ($indian_states as $state) {
     ?>        
     <option <?php if(isset($output) && $output['sState'] == '$state') echo 'selected'; ?>> <?php echo $state;?> </option> 
   <?php 
   }
    ?>
</select>

                                            </div>
                                             </div>
                                            </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Pin Code</label>
                                                <input type="text" class="form-control" id="pin"  name="pin" value="<?php if(isset($output)) echo $output['sPinCode']; ?>" placeholder="Pin Code" required>
                                            </div>
                                        </div>
                                     

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Communication Address</label> 
                                                    <label for="formrow-model-input" class="form-label"></label>
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="ckeck" onclick="showAdd()">
                                                    <label class="form-check-label" for="flexCheckDefault">Same As Registration Address</label>
                                                <textarea type="text" class="form-control" name = "communicationaddress" id="communicationaddress" placeholder="Communication Address" ><?php if(isset($output)) echo $output['sCommunicationAddress']; ?></textarea>                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Annual Turnover</label>
                                                <input type="number" class="form-control" id="annualturnover"  name="annualturnover" value="<?php if(isset($output)) echo $output['sAnnualTurnover']; ?>" onblur="showMSME(this.value)" required>
                                            </div>
                                        </div>
                                    </div> 
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Number of Offices / Manufacturing Units</label>
                                                <input type="text" class="form-control" id="officeno"  name="officeno" value="<?php if(isset($output)) echo $output['sNoOfOffices']; ?>" required><br>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                            
                                <div class="row">
                                    <div class="row">
                                        <div class="title-details mb">
						 	              <h4>Contact:</h4>
						                </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Contact Person Name</label>
                                              <input type="text" class="form-control" id="contactpersonname"  name="contactpersonname" value="<?php if(isset($output)) echo $output['sContactPersonName']; ?>" required>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Contact Number</label>
                                              <input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNo']; ?>" required>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Designation</label>
                                              <input type="text" class="form-control" id="designation"  name="designation" value="<?php if(isset($output)) echo $output['sDesignation']; ?>" required>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Email ID</label>
                                              <input type="text" class="form-control" id="email"  name="email" value="<?php if(isset($output)) echo $output['sEmail']; ?>" ><br>
                                          </div>
                                      </div>
                                    </div>

                                <div class="row">
                                      <div class="title-details mb">
						 	              <h4>Bank Details:</h4>
						             </div>
 
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">IFSC Code</label>
                                                <input type="text"  style="text-transform:uppercase" class="form-control" id="ifscCode"  name="ifscCode" value="<?php if(isset($output)) echo $output['sIFSCCode']; ?>" onblur="getBankData(this.value)" required>
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

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Cancelled Cheque Copy </label>
                                                <input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" required><br>
                                            </div>
                                        </div>
                        
                                </div>

                                <h4>Other Information:</h4>

                                <div class="row">
                                    
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Monthly Volumes Handled (Teus)</label>
                                              <input type="text" class="form-control" id="monthlyvolumeshandled"  name="monthlyvolumeshandled" value="<?php if(isset($output)) echo $output['sMonthlyVolumesHandled'];?>">
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">MSME Registration No</label>
                                              <input type="text" class="form-control" id="msme" style="text-transform:uppercase"  name="msme" value="<?php if(isset($output)) echo $output['sMSMERegNo']; ?>" >
                                          </div>
                                      </div>    
                                </div>  
                             </div>


                             <div class="col-md-12">
                                               <div class="mb-3">
                                                  <label for="formrow-firstname-input" class="form-label">Unit</label>
                                                   <div class="col-sm-5">
                                                    <select id="formrow-inputState" class="form-select" name="unit" required>
                                                    <option <?php if(isset($output) && $output['sUnit'] == 'Testing') echo 'selected'; ?>>Testing </option> 
                                                    <option <?php if(isset($output) && $output['sUnit'] == 'HMD') echo 'selected'; ?>>HMD </option> 
                                                    <option <?php if(isset($output) && $output['sUnit'] == 'PCD') echo 'selected'; ?>>PCD</option> 
                                                
                                                    <option <?php if(isset($output) && $output['sUnit'] == 'THV') echo 'selected'; ?>>THV </option>
                                                    <option <?php if(isset($output) && $output['sUnit'] == 'Corporate Unit') echo 'selected'; ?>>Corporate Unit </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                               <div class="mb-3">
                                            <input class="form-check-input"  style="margin-left:4px;" type="checkbox" value="" id="emailcheckbox" name="emailcheckbox" onclick="">
                                                <label class="form-check-label" for="flexCheckDefault">Do not Send Email</label> 
                                            </div>
                                            </div>
                                        </div>
                                  <?php
                                        if (isset($venderId)) {
                                    ?>
                                        <input type="hidden" name="venderId" value="<?php echo $venderId; ?>">
                                    <?php        
                                        }
                                    ?>
                                    <div>
                                        <center><button type="submit" class="btn btn-primary w-md" name="btnsave" onclick="getCompanyCode()" id="btnSave" >Save</button></center>
                                    </div>
                                  
                                    
                                </div>
                                     
                                
                                     
                                        
                                        <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Percent Payable</label>
                                                <input type="number" class="form-control" id="formrow-password-input" name="percentpayment" value="<?php if(isset($output)) echo $output['iPercentPayment']; else $globalsettings['iPercentPayable']; ?>">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="formrow-password-input" name="password" <?php if(!isset($output)) echo 'required'; ?>>
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
    
    function showMSME(value){
        if(value< 500000000){
           
            document.getElementById("msme").required = true;
            
        }else {
            
            document.getElementById("msme").required = false;
        }
    }

    function check(){
        

        
    if(document.getElementById("checkbox").checked)
        {
        document.getElementById("gstno").readOnly = true;
        document.getElementById("gstno").required = false;
        document.getElementById('panno').readOnly = false;
        document.getElementById("panno").required = true;
        
        }
    else
        {
        document.getElementById("gstno").readOnly = false;
        document.getElementById("gstno").required = true;
        document.getElementById('panno').readOnly = true;
        document.getElementById("panno").required = false;
        
        }
    }



    function showPAN(gstno){
    if(gstno.length == 15){
        document.getElementById("panno").value = gstno.substr(2,10);
        }
    }

    function showAdd(){
    if(document.getElementById("ckeck").checked){
        var combinedValue = document.getElementById("registrationaddress").value +" " +
         document.getElementById("registrationaddressline2").value +" "+ 
         document.getElementById("registrationaddressline3").value +" "+ 
         document.getElementById("city").value +","+
         document.getElementById("state").value + ","+ 
         document.getElementById("pin").value;


        document.getElementById("communicationaddress").value = combinedValue;
        
        }
    }

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

function getGST(GST)
  {
    // var gstinformat = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/; 

    // if (gstinformat.test(GST)) {    
        
    //                 return true;    
    //             } else {    
    //                 alert('Please Enter Valid GSTIN Number');    
                     
    //             } 
        $.post( "api.php", {action:'verifyGST',gstno:GST})
        .done(function(data) {
            
            var obj  = jQuery.parseJSON(data);
            if(obj.hasOwnProperty("tradename")){
                
                
                if(obj.status !== "Active"){
                    alert("GST Number is "+obj.status);
                    // document.getElementById("btnSave").style.display = "none";
                    document.getElementById("gstno").value = "";
                    document.getElementById("panno").value = "";
                    document.getElementById("companyname").value = "";
                    document.getElementById("registrationaddress").value = "";
                    document.getElementById("companyownership").value = "";
                    
                }else{
                    // document.getElementById("btnSave").style.display = "block";
                    document.getElementById("companyname").value = obj.tradename;
                    document.getElementById("registrationaddress").value = obj.address;
                    document.getElementById("companyownership").value = obj.tradetype;
                    document.getElementById("city").value = obj.city;
                    document.getElementById("pin").value = obj.pin;
                   document.getElementById("state").value=obj.state;
                  
                
               
                }
                
            }   
    });
    
    }


</script>

</html>