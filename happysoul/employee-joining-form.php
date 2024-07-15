<?php include 'layouts/session.php'; ?>

<?php include 'layouts/head-main.php'; ?>

<?php include 'layouts/config.php'; ?>

<?php 
$subcategories = [];
$active = 0;
$msg = "";

    if(isset($_POST['btnsave']) && isset($_POST['employeeId'])){



        $employeeId  = $_POST['employeeId']; 

        if(isset($_POST['name'])){

       

        // $employeecode=$_POST['employeecode'];

        $dateofjoining = $_POST['dateofjoining'];

        $name = $_POST['name'];

        $presentaddress = $_POST['presentaddress'];

        $permanentaddress = $_POST['permanentaddress'];

        $mobilenumber = $_POST['mobilenumber'];

        $emailid = $_POST['emailid'];

        $dateofbirth = $_POST['dateofbirth']; 

        $mode = $_POST['mode'];

        $pancardno= $_POST['pancardno'];

        $adharcardno= $_POST['adharcardno'];

        $nameasonpan= $_POST['nameasonpan'];

        $nameasonadhar= $_POST['nameasonadhar'];

        $namee= $_POST['namee']; 

        $relation= $_POST['relation']; 

        $contactnumber= $_POST['contactnumber'];

        $esino= $_POST['esino'];

        $uanno= $_POST['uanno'];

        $remarks= $_POST['remarks'];



        $pverification= $_POST['pverification'];

        $city= $_POST['city'];
        $brandcompanyname=$_POST['brandcompanyname'];
    $gstno=$_POST['gstno'];

    //   $contractor="";

    // if(isset( $_POST['contractor'])){

    //     $contractor= $_POST['contractor'];

    // }

     





    $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId=?');

    $stmt->bind_param('i',$employeeId);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

        $personalphotocopy = $row['sPersonalphotocopy'];

        $updatedresume = $row['sUpdatedprofile'];

        $educationalcertificates = $row['sEducationalcertificates'];

        $pancard = $row['sPancard'];

        $aadharcard = $row['sAadharcard'];

        $relievingletters = $row['sImages'];

        $bankzerox = $row['sBankcheque'];

    }

            ///below epf

              // below contrct labour act  

 
              if(isset($_FILES['personalphotocopy']) && $_FILES['personalphotocopy']['size'] > 0){

              

                  $target_dir = "uploaded_images/";

                  

                  $ext = substr(strrchr($_FILES["personalphotocopy"]["name"],'.'),1);

                  $target_file = $target_dir ."personalphotocopy". time().".".$ext;

               

                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                  $check = getimagesize($_FILES["personalphotocopy"]["tmp_name"]);

                  if($check == true) {

                      $uploadOk = 1;

                  } else {

                      $uploadOk = 0;

                  }

                  

                  if (move_uploaded_file($_FILES["personalphotocopy"]["tmp_name"], $target_file)) {

                      $personalphotocopy = "uploaded_images/personalphotocopy". time().".".$ext;

                      

                    }

                  }


    

                  if(isset($_FILES['updatedresume']) && $_FILES['updatedresume']['size'] > 0){

                  

                      $target_dir = "uploaded_images/";

                      

                      $ext = substr(strrchr($_FILES["updatedresume"]["name"],'.'),1);

                      $target_file = $target_dir ."updatedresume". time().".".$ext;

                   

                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                      $check = getimagesize($_FILES["updatedresume"]["tmp_name"]);

                      if($check == true) {

                          $uploadOk = 1;

                      } else {

                          $uploadOk = 0;

                      }

                      

                      if (move_uploaded_file($_FILES["updatedresume"]["tmp_name"], $target_file)) {

                          $updatedresume = "uploaded_images/updatedresume". time().".".$ext;

                          

                        }

                      }

                     


                      if(isset($_FILES['educationalcertificates']) && $_FILES['educationalcertificates']['size'] > 0){

                          $target_dir = "uploaded_images/";

                          $ext = substr(strrchr($_FILES["educationalcertificates"]["name"],'.'),1);

                          $target_file = $target_dir ."educationalcertificates". time().".".$ext;

                       

                          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                          $check = getimagesize($_FILES["educationalcertificates"]["tmp_name"]);

                          if($check == true) {

                              $uploadOk = 1;

                          } else {

                              $uploadOk = 0;

                          }

                          

                          if (move_uploaded_file($_FILES["educationalcertificates"]["tmp_name"], $target_file)) {

                              $educationalcertificates = "uploaded_images/educationalcertificates". time().".".$ext;

                              

                            }

                          }

                        







                         

    

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

                                







                            

    

                                  if(isset($_FILES['relievingletters']) && $_FILES['relievingletters']['size'] > 0){

                                  

                                      $target_dir = "uploaded_images/";

                                      

                                      $ext = substr(strrchr($_FILES["relievingletters"]["name"],'.'),1);

                                      $target_file = $target_dir ."relievingletters". time().".".$ext;

                                   

                                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                      $check = getimagesize($_FILES["relievingletters"]["tmp_name"]);

                                      if($check == true) {

                                          $uploadOk = 1;

                                      } else {

                                          $uploadOk = 0;

                                      }

                                      

                                      if (move_uploaded_file($_FILES["relievingletters"]["tmp_name"], $target_file)) {

                                          $relievingletters = "uploaded_images/relievingletters". time().".".$ext;

                                          

                                        }

                                      }

                                    





                                  

    

                                      if(isset($_FILES['bankzerox']) && $_FILES['bankzerox']['size'] > 0){

                                      

                                          $target_dir = "uploaded_images/";

                                          

                                          $ext = substr(strrchr($_FILES["bankzerox"]["name"],'.'),1);

                                          $target_file = $target_dir ."bankzerox". time().".".$ext;

                                       

                                          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                          $check = getimagesize($_FILES["bankzerox"]["tmp_name"]);

                                          if($check == true) {

                                              $uploadOk = 1;

                                          } else {

                                              $uploadOk = 0;

                                          }

                                          

                                          if (move_uploaded_file($_FILES["bankzerox"]["tmp_name"], $target_file)) {

                                              $bankzerox = "uploaded_images/bankzerox". time().".".$ext;

                                              

                                            }

                                          }

                                         




    $query = "update tblemployeejoiningform set sEmployeeCode=?, sDateofjoining=?,sName=?,sPersonalphotocopy=?,sPresentaddress=?,sPermanentaddress=?,sMobilenumber=?,sEmailid=?,sDateofbirth=?,sMode=?,sPancardno=?,sAdharcardno=?,sNameasonpan=?,sNameasonadhar=?,sNamee=?,sRelation=?,sContactNumber=?,sEsino=?,sUanno=?,sUpdatedprofile=?,sPancard=?,sAadharcard=?, sImages=?,sBankcheque=?,sRemarks=?,sPaymentVerification = ?,sCity = ?,sBrandCompanyName=?,sGST=? where iEmployeeFormId=?";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssi",$employeeId,$dateofjoining,$name,$personalphotocopy,$presentaddress,$permanentaddress,$mobilenumber,$emailid,$dateofbirth,$mode,$pancardno,$adharcardno,$nameasonpan, $nameasonadhar,$namee,$relation,$contactnumber,$esino,$uanno,$updatedresume, $pancard, $aadharcard, $relievingletters,$bankzerox,$remarks,$pverification,$city,$brandcompanyname,$gstno,$employeeId);



        $ret = mysqli_stmt_execute($stmt);
        $error=mysqli_error($link);

        // $error=mysqli_error($link);

        //         print("error occured:".$error);

        mysqli_stmt_close($stmt);

    }

        // exit();



        // if(!$ret){
        //     $msg="Not Updated";
        //     echo '<script>alert("Not Updated")</script>'; 
  
        //     echo $error;
        //     echo $msg;

        // }else{

        //     $msg= "Data Updated";
        //     echo '<script>alert("Updated")</script>'; 



           



          





          




            if(isset($_POST['categoryy'])){

            
            $categoryy = $_POST['categoryy'];
            $subcategoryy = $_POST['subcategoryy'];
           
            $query = "DELETE from tblcategoryandsubcategory where iEmployeeFormId  = ?";

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "i", $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

            // Insert category details for each record
            for ($i = 0; $i < count($categoryy); $i++) {
                
                if ($categoryy[$i] == "") {
                    continue;
                }
    
                $query = "INSERT INTO tblcategoryandsubcategory (sCategory, sSubcategory,iEmployeeFormId) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($link, $query);
                
                mysqli_stmt_bind_param($stmt, "ssi", $categoryy[$i], $subcategoryy[$i], $employeeId);
                $ret = mysqli_stmt_execute($stmt);
    
                if (!$ret) {
                    $error = mysqli_error($link);
                    print("Error occurred: " . $error);
                }
            
                mysqli_stmt_close($stmt);
            }

        }

        if(isset($_POST['degree'])){
            $degree = $_POST['degree'];
            $universityinstitute = $_POST['universityinstitute'];
            $year = $_POST['year'];
            $level = $_POST['level'];
            $accreditationbody = $_POST['accreditationbody'];
            $query = "DELETE from tbleducationaldetails where iEmployeeFormId  = ?";

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "i", $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

            // Insert educational details for each record
            for ($i = 0; $i < count($degree); $i++) {
                if ($degree[$i] == "") {
                    continue;
                }
    
                $query = "INSERT INTO tbleducationaldetails (sDegree, sUniversityinstitute, sYear, sLevel, sAccreditationBody, iEmployeeFormId) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $query);
                
                mysqli_stmt_bind_param($stmt, "sssssi", $degree[$i], $universityinstitute[$i], $year[$i], $level[$i], $accreditationbody[$i], $employeeId);
                $ret = mysqli_stmt_execute($stmt);
    
                if (!$ret) {
                    $error = mysqli_error($link);
                  //  print("Error occurred: " . $error);
                }
            
                mysqli_stmt_close($stmt);
            }
        
            
    
           
        }


            
    
    
    
    if(isset($_POST['scheme'])){
        $scheme=$_POST['scheme'];
            
        // $newDate = date("d-m-Y", strtotime($paymentmode));  
        $paymentmode=$_POST['paymentmode'];

        $paymentdate=$_POST['paymentdate'];
   

        $validity=$_POST['validity'];

        
        $query = "DELETE from tbllistingplan where iEmployeeFormId  = ?";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "i", $employeeId);

        $ret = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);


        for($i=0;$i<count($scheme);$i++)

        {

            if($scheme[$i]==""){

                continue;

            }

            $query = "INSERT INTO tbllistingplan (sSchemeName,sPaymentMode,sPaymentDate,sValidity,iEmployeeFormId) VALUES (?,?,?,?,?)";

           

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "ssssi",$scheme[$i],$paymentmode[$i],$paymentdate[$i], $validity[$i], $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            if (!$ret) {
                $error = mysqli_error($link);
               print("Error occurred: " . $error);
            }

            mysqli_stmt_close($stmt);

        }

    }
            
    
    
    
    
    if(isset($_POST['orginiztionname'])){
        $orginiztionname=$_POST['orginiztionname'];
    
        $licensename=$_POST['licensename'];

        $from=$_POST['from'];

        $to=$_POST['to'];

        $licenseno=$_POST['licenseno'];
        $query = "DELETE from tbllicensedetails where iEmployeeFormId  = ?";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "i",  $employeeId);

        $ret = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
     





        for($i=0;$i<count($orginiztionname);$i++)

        {

            if($orginiztionname[$i]==""){

                continue;

            }

            $query = "INSERT INTO tbllicensedetails (sOrginiztionname,sLicenseName,sFrom,sTo,sLicenseNo,iEmployeeFormId) VALUES (?,?,?,?,?,?)";



            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "sssssi",$orginiztionname[$i],$licensename[$i],$from[$i], $to[$i], $licenseno[$i], $employeeId);

            

            // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,ssubcategory,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

        

        

        

            $ret = mysqli_stmt_execute($stmt);

            // $error=mysqli_error($link);

            // print("error occured:".$error);

            mysqli_stmt_close($stmt);

        }
    }
    
            
        







            // $subcategory= $_POST['subcategory'];

            // $query = "update tblsubcategory set sSubcategory = ? where iEmployeeFormId = ?";

            // $stmt = mysqli_prepare($link,$query);

            // mysqli_stmt_bind_param($stmt, "si",$subcategory,$employeeId);

            // $ret = mysqli_stmt_execute($stmt);

            // mysqli_stmt_close($stmt);





    if(isset($_POST['pverification'])){
        $pverification= $_POST['pverification'];

        $query = "Update tblpverification set sVerificationStatus = ? where iEmployeeFormId = ?";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "si",$pverification,$employeeId);

        $ret = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

            



if(isset($_POST['city'])){
    $city= $_POST['city'];

    $pin = $_POST['pin'];

   // $query = "INSERT INTO tblcity (sCity,iEmployeeFormId,sPincode) VALUES (?,?,?)";
    $query = "Update tblcity set sCity=?,sPincode=? Where iEmployeeFormId=?";

    $stmt = mysqli_prepare($link,$query);

    mysqli_stmt_bind_param($stmt, "ssi",$city,$pin,$employeeId);

    $ret = mysqli_stmt_execute($stmt);
    
    if (!$ret) {
        $error = mysqli_error($link);
       print("Error occurred: " . $error);
    }

    mysqli_stmt_close($stmt);
}
            
           

            

            // if(!$unitpresent){

            //     $query = "INSERT INTO tblunit (sUnit,iEmployeeFormId,sDate) VALUES (?,?,?)";

            //     $stmt = mysqli_prepare($link,$query);

            //     mysqli_stmt_bind_param($stmt, "sis",$unit,$employeeId,$unitdate);

            //     $ret = mysqli_stmt_execute($stmt);

            //     mysqli_stmt_close($stmt);    

            // }

            




        //    echo "<script>window.location.href = 'list-employee-joining-form.php';</script>";

        } 
        else if(isset($_POST['btnsave']))

   {

 
    $brandcompanyname=$_POST['brandcompanyname'];
    $gstno=$_POST['gstno'];
  //  $employeecode = $_POST['employeecode'];

    $dateofjoining = $_POST['dateofjoining'];



    $name = $_POST['name'];

    $presentaddress = $_POST['presentaddress'];

    $permanentaddress = $_POST['permanentaddress'];

    $mobilenumber = $_POST['mobilenumber'];

    $emailid = $_POST['emailid'];

    $dateofbirth = $_POST['dateofbirth']; 

    $mode = $_POST['mode'];

    $pancardno= $_POST['pancardno'];

    $adharcardno= $_POST['adharcardno'];

    $nameasonpan= $_POST['nameasonpan'];

    $nameasonadhar= $_POST['nameasonadhar'];

    $namee= $_POST['namee']; 

    $relation= $_POST['relation']; 

    $contactnumber= $_POST['contactnumber'];





    $esino= $_POST['esino'];

    $uanno= $_POST['uanno'];

    $remarks= $_POST['remarks'];

    

        $pverification= $_POST['pverification'];

        $city= $_POST['city'];

        $numbernotpresent = true;

        $stmt = $link->prepare('select * from tblemployeejoiningform where sMobilenumber = ?');

    $stmt->bind_param('s',$mobilenumber);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

    

        $output = $row;
        $numbernotpresent = false;

        $_POST['employeeId']  = $row['iEmployeeFormId']; 
        // $employeeId  = $row['iEmployeeFormId']; 
    }

    if($numbernotpresent){

    // $contractor="";

    // if(isset( $_POST['contractor'])){

    //     $contractor= $_POST['contractor'];

    // }

   


    //below esi




        ///below epf




          // below contrct labour act  

          $personalphotocopy = '';



          if(isset($_FILES['personalphotocopy']) && $_FILES['personalphotocopy']['size'] > 0){

          

              $target_dir = "uploaded_images/";

              

              $ext = substr(strrchr($_FILES["personalphotocopy"]["name"],'.'),1);

              $target_file = $target_dir ."personalphotocopy". time().".".$ext;

           

              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

              $check = getimagesize($_FILES["personalphotocopy"]["tmp_name"]);

              if($check == true) {

                  $uploadOk = 1;

              } else {

                  $uploadOk = 0;

              }

              

              if (move_uploaded_file($_FILES["personalphotocopy"]["tmp_name"], $target_file)) {

                  $personalphotocopy = "uploaded_images/personalphotocopy". time().".".$ext;

                  

                }

              }

              if($personalphotocopy == null){

                  $personalphotocopy = "";

              }







              $updatedresume = '';



              if(isset($_FILES['updatedresume']) && $_FILES['updatedresume']['size'] > 0){

              

                  $target_dir = "uploaded_images/";

                  

                  $ext = substr(strrchr($_FILES["updatedresume"]["name"],'.'),1);

                  $target_file = $target_dir ."updatedresume". time().".".$ext;

               

                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                  $check = getimagesize($_FILES["updatedresume"]["tmp_name"]);

                  if($check == true) {

                      $uploadOk = 1;

                  } else {

                      $uploadOk = 0;

                  }

                  

                  if (move_uploaded_file($_FILES["updatedresume"]["tmp_name"], $target_file)) {

                      $updatedresume = "uploaded_images/updatedresume". time().".".$ext;

                      

                    }

                  }

                  if($updatedresume == null){

                      $updatedresume = "";

                  }

                 

            



                  $educationalcertificates = '';



                  if(isset($_FILES['educationalcertificates']) && $_FILES['educationalcertificates']['size'] > 0){

                  

                      $target_dir = "uploaded_images/";

                      

                      $ext = substr(strrchr($_FILES["educationalcertificates"]["name"],'.'),1);

                      $target_file = $target_dir ."educationalcertificates". time().".".$ext;

                   

                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                      $check = getimagesize($_FILES["educationalcertificates"]["tmp_name"]);

                      if($check == true) {

                          $uploadOk = 1;

                      } else {

                          $uploadOk = 0;

                      }

                      

                      if (move_uploaded_file($_FILES["educationalcertificates"]["tmp_name"], $target_file)) {

                          $educationalcertificates = "uploaded_images/educationalcertificates". time().".".$ext;

                          

                        }

                      }

                      if($educationalcertificates == null){

                          $educationalcertificates = "";

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

                









                              $relievingletters = '';



                              if(isset($_FILES['relievingletters']) && $_FILES['relievingletters']['size'] > 0){

                              

                                  $target_dir = "uploaded_images/";

                                  

                                  $ext = substr(strrchr($_FILES["relievingletters"]["name"],'.'),1);

                                  $target_file = $target_dir ."relievingletters". time().".".$ext;

                               

                                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                  $check = getimagesize($_FILES["relievingletters"]["tmp_name"]);

                                  if($check == true) {

                                      $uploadOk = 1;

                                  } else {

                                      $uploadOk = 0;

                                  }

                                  

                                  if (move_uploaded_file($_FILES["relievingletters"]["tmp_name"], $target_file)) {

                                      $relievingletters = "uploaded_images/relievingletters". time().".".$ext;

                                      

                                    }

                                  }

                                  if($relievingletters == null){

                                      $relievingletters = "";

                                  }







                                  $bankzerox = '';



                                  if(isset($_FILES['bankzerox']) && $_FILES['bankzerox']['size'] > 0){

                                  

                                      $target_dir = "uploaded_images/";

                                      

                                      $ext = substr(strrchr($_FILES["bankzerox"]["name"],'.'),1);

                                      $target_file = $target_dir ."bankzerox". time().".".$ext;

                                   

                                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                      $check = getimagesize($_FILES["bankzerox"]["tmp_name"]);

                                      if($check == true) {

                                          $uploadOk = 1;

                                      } else {

                                          $uploadOk = 0;

                                      }

                                      

                                      if (move_uploaded_file($_FILES["bankzerox"]["tmp_name"], $target_file)) {

                                          $bankzerox = "uploaded_images/bankzerox". time().".".$ext;

                                          

                                        }

                                      }

                                      if($bankzerox == null){

                                          $bankzerox = "";

                                      }



   $query = "INSERT INTO tblemployeejoiningform (sDateofjoining, sName, sPersonalphotocopy,sPresentaddress, sPermanentaddress, sMobilenumber, sEmailid, sDateofbirth, sMode, sPancardno, sAdharcardno, sNameasonpan, sNameasonadhar, sNamee, sRelation, sContactNumber,sEsino, sUanno, sUpdatedprofile,  sPancard, sAadharcard, sImages, sBankcheque,sRemarks, iCreatedBy, sPaymentVerification, sCity,sBrandCompanyName, sGST) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
   $stmt = mysqli_prepare($link,$query);

mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssssissss",$dateofjoining,$name,$personalphotocopy,$presentaddress,$permanentaddress, $mobilenumber, $emailid ,$dateofbirth,$mode,$pancardno,$adharcardno,$nameasonpan, $nameasonadhar,$namee,$relation,$contactnumber,$esino,$uanno,$updatedresume,$pancard, $aadharcard, $relievingletters,$bankzerox,$remarks,$_SESSION['id'],$pverification,$city,$brandcompanyname,$gstno);

     $error=mysqli_error($link);

    $ret = mysqli_stmt_execute($stmt);

    $error=mysqli_error($link);
 //   $error=mysqli_error($stmt);

  //   print("error occured:".$error);

    mysqli_stmt_close($stmt);

    // exit();



    if(!$ret){



        $msg= "Data Not Saved";
        echo '<script>alert("Not Saved")</script>';
        echo $error; 
    } 

    else{

        // $msg= "Data Saved";
        echo '<script>alert(" Saved")</script>'; 

        $maxId=0;

        $stmt = $link->prepare('select max(iEmployeeFormId) as num from tblemployeejoiningform ');

        // $stmt->bind_param('i',$employeeId);

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){

        

            // $output = $row;

            $maxId=$row['num'];

    

        }




        if(isset($_POST['categoryy'])){
            $categoryy = $_POST['categoryy'];
            $subcategoryy = $_POST['subcategoryy'];
           
    
            // Insert educational details for each record
            for ($i = 0; $i < count($categoryy); $i++) {
                if ($categoryy[$i] == "") {
                    continue;
                }
    
                $query = "INSERT INTO tblcategoryandsubcategory (sCategory, sSubcategory,iEmployeeFormId) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($link, $query);
                
                mysqli_stmt_bind_param($stmt, "ssi", $categoryy[$i], $subcategoryy[$i], $maxId);
                $ret = mysqli_stmt_execute($stmt);
    
                if (!$ret) {
                    $error = mysqli_error($link);
                  //  print("Error occurred: " . $error);
                }
            
                mysqli_stmt_close($stmt);
            }
    
        }
        




        if(isset($_POST['degree'])){
            $degree = $_POST['degree'];
            $universityinstitute = $_POST['universityinstitute'];
            $year = $_POST['year'];
            $level = $_POST['level'];
            $accreditationbody = $_POST['accreditationbody'];
    
            // Insert educational details for each record
            for ($i = 0; $i < count($degree); $i++) {
                if ($degree[$i] == "") {
                    continue;
                }
    
                $query = "INSERT INTO tbleducationaldetails (sDegree, sUniversityinstitute, sYear, sLevel, sAccreditationBody, iEmployeeFormId) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $query);
                
                mysqli_stmt_bind_param($stmt, "sssssi", $degree[$i], $universityinstitute[$i], $year[$i], $level[$i], $accreditationbody[$i], $maxId);
                $ret = mysqli_stmt_execute($stmt);
    
                if (!$ret) {
                    $error = mysqli_error($link);
                  //  print("Error occurred: " . $error);
                }
            
                mysqli_stmt_close($stmt);
            }
        }
        
    
        

       

        if(isset($_POST['scheme'])){
            $scheme=$_POST['scheme'];

            $paymentmode=$_POST['paymentmode'];
    
            $paymentdate=$_POST['paymentdate'];
          
    
            $validity=$_POST['validity'];
    
    
            for($i=0;$i<count($scheme);$i++)
    
            {
    
                if($scheme[$i]==""){
    
                    continue;
    
                }
    
                $query = "INSERT INTO tbllistingplan (sSchemeName,sPaymentMode,sPaymentDate,sValidity,iEmployeeFormId) VALUES (?,?,?,?,?)";
    
               
    
                $stmt = mysqli_prepare($link,$query);
    
                mysqli_stmt_bind_param($stmt, "ssssi",$scheme[$i],$paymentmode[$i],$paymentdate[$i], $validity[$i], $maxId);
    
                $ret = mysqli_stmt_execute($stmt);
    
                if (!$ret) {
                    $error = mysqli_error($link);
                   print("Error occurred: " . $error);
                }
    
                mysqli_stmt_close($stmt);
    
            }
    
    
    
        }


       


        if(isset($_POST['orginiztionname'])){
            $orginiztionname=$_POST['orginiztionname'];

            $licensename=$_POST['licensename'];
    
            $from=$_POST['from'];
    
            $to=$_POST['to'];
    
            $licenseno=$_POST['licenseno'];
    
         
    
    
    
    
    
            for($i=0;$i<count($orginiztionname);$i++)
    
            {
    
                if($orginiztionname[$i]==""){
    
                    continue;
    
                }
    
                $query = "INSERT INTO tbllicensedetails (sOrginiztionname,sLicenseName,sFrom,sTo,sLicenseNo,iEmployeeFormId) VALUES (?,?,?,?,?,?)";
    
    
    
                $stmt = mysqli_prepare($link,$query);
    
                mysqli_stmt_bind_param($stmt, "sssssi",$orginiztionname[$i],$licensename[$i],$from[$i], $to[$i], $licenseno[$i], $maxId);
    
                
    
                // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,ssubcategory,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";
    
            
    
            
    
            
    
                $ret = mysqli_stmt_execute($stmt);
    
                // $error=mysqli_error($link);
    
                // print("error occured:".$error);
    
                mysqli_stmt_close($stmt);
    
            }
    
        }

        
  

        // $subcategory= $_POST['subcategory'];

        // $query = "INSERT INTO tblsubcategory (sSubcategory,iEmployeeFormId) VALUES (?,?)";

        // $stmt = mysqli_prepare($link,$query);

        // mysqli_stmt_bind_param($stmt, "si",$subcategory,$maxId);

        // $ret = mysqli_stmt_execute($stmt);

        // mysqli_stmt_close($stmt);





       if(isset($_POST['pverification'])){
        $pverification= $_POST['pverification'];

        $query = "INSERT INTO tblpverification (sVerificationStatus,iEmployeeFormId) VALUES (?,?)";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "si",$pverification,$maxId);

        $ret = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
       }

       
       if(isset($_POST['city'])){
        $city= $_POST['city'];

        $pin = $_POST['pin'];

        $query = "INSERT INTO tblcity (sCity,iEmployeeFormId,sPincode) VALUES (?,?,?)";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "sis",$city,$maxId,$pin);

        $ret = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
       }

             

            

                                                                                          

       


        $_POST['employeeId'] = $maxId;




        //  echo "<script>window.location.href = 'employee-joining-form.php';</script>";

        //echo "<script>window.location.href = 'list-process.php';</script>";

    }  

}







}

else if(isset($_POST['btnNumberSearch'])){
    $numbernotpresent = true;
    $searchnumber = $_POST['searchnumber'];

    $stmt = $link->prepare('select * from tblemployeejoiningform where sMobilenumber = ?');

    $stmt->bind_param('s',$searchnumber);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

    

        $output = $row;
        $numbernotpresent = false;

        $_POST['employeeId']  = $row['iEmployeeFormId']; 

        $msg = "OOPS! This service provider is already registered in our database.Let\'s onboard others!";

        // $employeeId  = $row['iEmployeeFormId']; 
    }
}

$aadharuploaded = 0;
$pancarduploaded = 0;
$bankuploaded = 0;

if(isset($_POST['employeeId'])){

    $employeeId  = $_POST['employeeId']; 

    $pesronalcompleted = false;
    $categorycompleted = false;
    $qualificationcompleted = false;
    $lisitngcompleted = false;
    $liensecompleted = false;
    $hrcompleted = false;
    $active = 0;

    $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId   = ?');

    $stmt->bind_param('i',$employeeId);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

    

        $output = $row;

        if($output['sPancard'] != ""){
            $pancarduploaded = 1;
        }

        if($output['sAadharcard'] != ""){
            $aadharuploaded = 1;
        }

        if($output['sBankcheque'] != ""){
            $bankuploaded = 1;
        }

        if($output['sBrandCompanyName'] != "" && $output['sName'] != "" && $output['sPersonalphotocopy'] != "" && $output['sDateofjoining'] != "" && $output['sPresentaddress'] != "" && $output['sPermanentaddress'] != "" && $output['sMobilenumber'] != "" && $output['sEmailid'] != "" && $output['sDateofbirth'] != "" && $output['sMode'] != "" && $output['sAdharcardno'] != "" && $output['sNameasonadhar'] != "" && $output['sNamee'] != "" && $output['sRelation'] != "" && $output['sContactNumber'] != ""){
            $pesronalcompleted = true;
            $active=1;
        }

        if($output['sPancard'] != "" && $output['sAadharcard'] != "" && $output['sBankcheque'] != ""){
            // Update tblcity set sCity=?,sPincode=? Where iEmployeeFormId=?
            $stmt = $link->prepare('select * from tblcity where iEmployeeFormId=?');
            $stmt->bind_param('i',$employeeId);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $hrcompleted = true;
                $active=6;
            }
        }

        
        $stmt = $link->prepare('select * from tblcategoryandsubcategory where iEmployeeFormId=?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $categorycompleted = true;
            $active=2;
        }

        $stmt = $link->prepare('select * from tbleducationaldetails where iEmployeeFormId=?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $qualificationcompleted = true;
            $active=3;
        }

        
        $stmt = $link->prepare('select * from tbllistingplan where iEmployeeFormId   = ?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $lisitngcompleted = true;
            $active=4;
        }


        $stmt = $link->prepare('select * from tbllicensedetails where iEmployeeFormId   = ?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $liensecompleted[]=$row;
            $active=5;
        }




    }

} 

?>



<head>

    <title>Add Service Provider Form</title>

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
       .reqiured-mark:after {
    content:" *";
    color: red;
  }

  
        .tab {
            display: none;
        }
        .tab-header {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
        }
        .tab-header div {
            padding: 10px;
            cursor: pointer;
        }
        .tab-header .active {
            background-color: #ccc;
        }
        /* .tab-content {
            display: none;
        } */
        .tab.active {
            display: block;
        }

        .completed{
            border: 2px solid green !important;
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

                            <h4 class="mb-sm-0 font-size-18"> ADD Service Provider </h4>

                            



                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Service Provider</a></li>

                                    <li class="breadcrumb-item active">Add Service Provider</li>

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
                                <?php if($_SESSION["usertype"] == "Contractor" || $_SESSION["usertype"] == "Admin"){ ?>
                                <?php if((!isset($numbernotpresent) || !$numbernotpresent) || !isset($output)){ ?>                 
<div class="col-md-12">

<div class="mb-3">

<h4>SEARCH NUMBER</h4><br>

</div>

<form action="employee-joining-form.php" method="post" id="myForm" onsubmit="return validateForm();">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Mobile Number :</label>

<input type="text" class="form-control" id="searchnumber"  name="searchnumber" value="<?php if(isset($_POST['searchnumber'])) echo $_POST['searchnumber']; ?>" required >
<center><button type="submit" class="btn btn-success mt-3" name="btnNumberSearch" value="search">Search</button></center>
</form>

</div>
<?php } ?>
<?php } ?>

<?php 
if($msg != ""){
    echo "<script>alert('".$msg."')</script>";
}
?>
<?php if((isset($numbernotpresent) && $numbernotpresent && $msg == "") || (isset($output) && $msg == "")){ ?>


                                

                                

                                <div class="tab-header mt-3" style="border-bottom: 1px solid black;">
        <div class="tab-header-item <?php if($active == 0 || $active == 6) echo "active"; ?> <?php if($pesronalcompleted) echo "completed"; ?>" onclick="showTab(0)">PERSONAL DETAILS</div>
        <div class="tab-header-item <?php if($active == 1) echo "active" ?> <?php if($categorycompleted) echo "completed"; ?>" onclick="showTab(1)">CATEGORY AND SUBCATEGORY</div>
        <div class="tab-header-item <?php if($active == 2) echo "active" ?> <?php if($qualificationcompleted) echo "completed"; ?>" onclick="showTab(2)">QUALIFICATION AND CERTIFICATION</div>
        <div class="tab-header-item <?php if($active == 3) echo "active" ?> <?php if($lisitngcompleted) echo "completed"; ?>" onclick="showTab(3)">LISTING PLAN</div>
        <div class="tab-header-item <?php if($active == 4) echo "active" ?> <?php if($liensecompleted) echo "completed"; ?>" onclick="showTab(4)">LICENSE DETAILS</div>
        <div class="tab-header-item <?php if($active == 5) echo "active" ?> <?php if($hrcompleted) echo "completed"; ?>" onclick="showTab(5)">FOR HR PURPOSE ONLY</div>
    </div>


    <form action="employee-joining-form.php" method="post" enctype="multipart/form-data" >
        <div class="tab active" id="tab1">
            <!-- <h2>PERSONAL DETAILS</h2> -->
            <!-- Add your form fields for personal details here -->

            

            <div class="col-md-12">

<div class="mb-3">

<!-- <h4>PERSONAL DETAILS</h4><br> -->

</div>

</div>




<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label  reqiured-mark">Brand / Company Name :</label>

<input type="text" class="form-control" id="brandcompanyname"  name="brandcompanyname" value="<?php if(isset($output)) echo $output['sBrandCompanyName']; ?>" >

</div>

</div>

<?php  if (isset($employeeId)) {

?>
<div class="col-md-6" style="display: none;">

<div class="mb-3">
<label for="formrow-firstname-input" class="form-label">Service Provider Code:</label>
<input type="text"  class="form-control" name="employeeId" value="<?php echo $employeeId; ?>">
</div>
</div>
<?php        

}

?>

<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Name (In Capital Letters):</label>

<input type="text" class="form-control" id="name"  name="name" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sName']; ?>">

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Personal Photo  <?php if(isset($output) && $output['sPersonalphotocopy'] != "") echo "<a href='".$output['sPersonalphotocopy']."' target='_blank'>View</a>" ?> </label>

<input type="file" class="form-control" id="personalphotocopy "  name="personalphotocopy" >

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label for="formrow-password-input" class="form-label reqiured-mark">Date of Joining:</label>

<input type="Date" class="form-control" id="dateofjoining"  name="dateofjoining" value="<?php if(isset($output)) echo $output['sDateofjoining']; ?>" max="<?php echo date("Y-m-d"); ?>" >

</div>

</div>







<!--    <input type="hidden" class="form-control" id="employeecode"  name="employeecode" value="<?php if(isset($output)) echo $output['sEmployeeCode']; ?>"required >-->





  





<?php

 if(isset($employeeId)){

        $employeeId=$_POST['employeeId'];

        $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');

        $stmt->bind_param('i',$employeeId);

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){

            $output = $row;

          }

      }

     

  ?> 







<div class="col-md-12">

  <div class="mb-3">

      <label for="formrow-firstname-input" class="form-label reqiured-mark">Present  Address:</label>  

      <textarea type="text" class="form-control" name = "presentaddress" id="presentaddress" placeholder="Present address"  ><?php if(isset($output)) echo $output['sPresentaddress']; ?></textarea>                   

  </div>

</div>



<div class="col-md-12">

  <div class="mb-3">

      <label for="formrow-firstname-input" class="form-label reqiured-mark">Permanent Address:</label> 

          <label for="formrow-model-input" class="form-label-not"></label>

      <input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="ckecksameaddress" onclick="showAdd()" >

          <label class="form-check-label" for="ckecksameaddress">Same As Above</label>

      <textarea type="text" class="form-control" name = "permanentaddress" id="permanentaddress" placeholder="Permanent address" ><?php if(isset($output)) echo $output['sPermanentaddress']; ?></textarea>                                        

  </div>

</div>



<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label">Mobile Number:</label>

<input type="text" class="form-control" id="mobilenumber"  name="mobilenumber" value="<?php if(isset($output)) echo $output['sMobilenumber']; else if (isset($_POST['searchnumber'])) echo $_POST['searchnumber']; ?>"  readonly>

</div>

</div>



<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Email ID:</label>

    <input type="text" class="form-control" id="emailid"  name="emailid" value="<?php if(isset($output)) echo $output['sEmailid']; ?>" ><br>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label for="formrow-password-input" class="form-label reqiured-mark">Date Of Birth:</label>

<input type="Date" class="form-control" id="dateofbirth"  name="dateofbirth" value="<?php if(isset($output)) echo $output['sDateofbirth']; ?>" max="<?php echo date("Y-m-d"); ?>"  ><br>

</div>

</div>



<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Mode</label>

<select id="formrow-inputState" class="form-select" id="mode" name="mode" >

          <option <?php if(isset($output) && $output['sMode'] == 'Online') echo 'selected'; ?>>Online</option> 

          <option <?php if(isset($output) && $output['sMode'] == 'Offline') echo 'selected'; ?>>Offline</option> 

           

          <option <?php if(isset($output) && $output['sMode'] == 'Both') echo 'selected'; ?>>Both</option> 

                                                                                                              

      </select>

</div>

</div>


<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label">GST No</label>

<input type="text" class="form-control" id="gstno"  name="gstno" value="<?php if(isset ($output)) echo $output['sGST']; ?>" onblur="showPAN(this.value)"  ><br>

</div>

</div>
<div class="col-md-6">
  </div>

<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label">Pan Card No:</label>

<input type="text" class="form-control" id="pancardno"  name="pancardno" value="<?php if(isset($output)) echo $output['sPancardno']; ?>" readonly>

</div>

</div>


<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label">Name As on Pan:</label>

<input type="text" class="form-control" id="nameasonpan"  name="nameasonpan" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNameasonpan']; ?>" >

</div>

</div>




<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Aadhar Card No:</label>

<input type="text" class="form-control" id="adharcardno"  name="adharcardno" value="<?php if(isset($output)) echo $output['sAdharcardno']; ?>" >

</div>

</div>








<div class="col-md-6">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Name As on Aadhar:</label>

      <input type="text" class="form-control" id="nameasonadhar"  name="nameasonadhar" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNameasonadhar']; ?>" >

</div>

</div>







<!-- start emerggency contact details -->

<h4>Emergency Contact Details</h4><br><br>



<div class="col-md-4">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Name:</label>

      <input type="text" class="form-control" id="namee"  name="namee" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNamee']; ?>" >

</div>

</div>



<div class="col-md-4">

  <div class="mb-3">

      <label for="formrow-firstname-input" class="form-label reqiured-mark">Relation:</label>  

      <input type="text" class="form-control" id="relation"  name="relation" value="<?php if(isset($output)) echo $output['sRelation']; ?>" ><br>      

  </div>

</div>





<div class="col-md-4">

<div class="mb-3">

<label for="formrow-firstname-input" class="form-label reqiured-mark">Contact Number:</label>

<input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNumber']; ?>" ><br><br>

</div>

</div>


<center><input type="submit" class="btn btn-primary w-md" name="btnsave" value="Save" ></center>    
<hr><br><br>









        </div>
        <div class="tab" id="tab2">
            <!-- <h2>CATEGORY AND SUBCATEGORY</h2> -->
            <!-- Add your form fields for category and subcategory here -->
             

<!-- <h3 style="text-align:center;"> CATEGORY AND SUBCATEGORY</h3><br><br><BR></BR> -->

                        

<div class="col-md-12">

      <div class="mb-3" >

      <table class="table table-bordered table-striped">

<thead>

<tr>



<th scope="col" class="form-label reqiured-mark">Category</th>

<th scope="col"  class="form-label reqiured-mark">Subcategory</th>
<th scope="col"  class="form-label reqiured-mark">Add</th>





</tr>

</thead>

<tbody id="div_category_body">









<?php

$atLeastOneEntry = false;
$categorydetails=[];
if(isset($employeeId))

{





$stmt = $link->prepare('select * from tblcategoryandsubcategory where iEmployeeFormId=?');

$stmt->bind_param('i',$employeeId);

$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

$categorydetails[]=$row;

// $output = $row;



}

}

?>

<tr>


<th id="th_category">
<select id="categoryy" class="form-control" onchange="dynamicSubcategories()" >

                <option value="">Select Category</option>

                   

             



                       <option value="MIND">MIND</option>

                       <option value="BODY & FITNESS" >BODY & FITNESS</option>

                       <option value="ALTERNATIVE MEDICINE">ALTERNATIVE MEDICINE</option>

                       <option value="SOUL & ENERGY WORK">SOUL & ENERGY WORK</option>

                       <option value="ENVIRONMENT">ENVIRONMENT</option>

                       <option value="GYM & STUDIO">GYM & STUDIO</option>

                       <option value="SPA ">SPA </option>

                       <option value="WELLNESS CENTRE">WELLNESS CENTRE </option>

                       <option value="PILATES STUDIO" >PILATES STUDIO </option>

                       <option value="YOGA STUDIO" >YOGA STUDIO </option>


           

                

            </select></th>

               

<th id="th_subcategory">  <select id="subcategoryy" class="form-control">
                      <option value="">Select Subcategeory</option>
                      <!-- <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option> -->

                         <!-- subcategory options will be loaded dynamically here -->
                      </select></th>

                      <th><button type="button" class="btn btn-primary w-md" name="btnadd" onclick="saveCategory();" >Add</button></th>
                      

<script>


</script>
<?php
// Define subcategories array
$subcategories = array(
"MIND" => array(
"AGE REGRESSION THERAPY",
"PAST LIFE REGRESSION THERAPY ",
"PSYCHOLOGY",
"PHYSIOTHERAPY",
"HYPNOTHERAPY",
"NEURO LINGUISTIC PROGRAMMING",
"AROMATHERAPY ",
"ART THERAPY",
"YOGA ",
"TAI CHI ",
"MEDITATION ",
"BIOFEEDBACK",
"career & business coach",
"Money & Finance coach",
"Leadership Coach",
"Stress Management Coach",
"Marketing Coach",
"Mindset coach",
"Empowerment coach",
"Mindfulness Coach",
"Spiritual Coach",
"Confidence Coach",
"Relationship Coach",
"Intimacy Coach",
"Parenting Coach",
"Life Coach"
),
"BODY & FITNESS" => array( "ALLERGY REMOVAL",
"FITNESS TRAINERS",
"PILATES",
"HOMEOPATHY ",
"AYURVEDA ",
"MARTIAL ARTS",
"NUTRITIONAL CONSULTANTS",
"classical Dance",
"Modern Dance",
"Ballet Dance",
"Sufi Whirling",
"belly dance",
"Bollywood Dance",

"REFLEXOLOGY ",
"ACUPRESSURE ",
"TAI CHI ",
"WATER THERAPY",
"QIGONG",
"ZUMBA",
"Yoga"),
"ALTERNATIVE MEDICINE" => array(
"HOMEOPATHY ",
"AYURVEDA ",
"REFLEXOLOGY ",
"ACUPRESSURE ",
"NATUROPATHY ",
"CHINESE/ ORIENTAL MEDICINE "
),
"SOUL & ENERGY WORK" => array(
"AROMATHERAPY ",
"MEDITATION ",
"COMPREHENSIVE HEALING",
"ENERGY HEALING",
"HEAL YOUR LIFE",
"PRANIC HEALING",
"REIKI",
"SHAMANISM",
"MAGNIFIED HEALING",
"SOUND BOWL HEALING",
"TAROT & ANGEL CARDS",
"PAST LIFE REGRESSION THERAPY ",
"ELECTROMAGNETIC THERAPY"
),
"ENVIRONMENT" => array(
"FENG SHUI",
"VASTU",
"AQUAPONICS",
"HYDROPONICS",
"ECO SOLUTIONS"
),
"SPA" => array("None"),
"GYM & STUDIO" => array("None"),
"WELLNESS CENTRE" => array("None"),
"PILATES STUDIO" => array("None"),
"YOGA STUDIO" => array("None")
);


?>






</tr>

<?php 
for($i = 0;$i <  count($categorydetails); $i++){



?>


<tr name='savedcategory'>


<th>
<input type='text' name='categoryy[]' readonly class='form-control' value='<?php echo $categorydetails[$i]['sCategory']; ?>'>
</th>

               

<th> 
<input type='text' name='subcategoryy[]' readonly class='form-control' value='<?php echo $categorydetails[$i]['sSubcategory']; ?>'>   
</th>

                      <th><button type='button' class='btn btn-danger w-md' name='btndeletecatgory' onclick='deleteCategory(this);' >Delete</button></th>
                      









</tr>
<?php } ?>
</tbody>

</table> <br>                                  

</div>

</div>

<center><input type="submit" class="btn btn-primary w-md" name="btnsave" value="Save" ></center>    


                <hr><br><br>
        </div>
        <div class="tab" id="tab3">
            <!-- <h2>QUALIFICATION AND CERTIFICATION</h2> -->
            <!-- Add your form fields for qualification and certification here -->

            <!-- <h3 style="text-align:center;"> QUALIFICATION AND CERTIFICATION</h3><br><br><BR></BR> -->

                                      

                                      <div class="col-md-12">

                                            <div class="mb-3">

                                            <table class="table table-bordered table-striped">

            <thead>

         <tr>

    

      <th scope="col" class="form-label reqiured-mark">Course</th>

       <th scope="col"  class="form-label reqiured-mark">University / Institute</th>

      <th scope="col"  class="form-label reqiured-mark">Year</th>

      <th scope="col"  class="form-label reqiured-mark">Level</th>

      <th scope="col"  class="form-label reqiured-mark">Accreditation Body</th>

      

    </tr>

  </thead>

  <tbody>



    <?php

$atLeastOneEntry = false;

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

    

     for($i=0;$i<5;$i++)

     {

     ?>

         <tr>

  

    <th>  <input type="text" class="form-control" id="degree"  name="degree[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sDegree']; ?>"></th>    

    <th>  <input type="text" class="form-control" id="universityinstitute"  name="universityinstitute[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sUniversityinstitute']; ?>"></th>  

    <th>  <input type="text" class="form-control" id="year"  name="year[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sYear']; ?>"></th>  

   <th>  <input type="text" class="form-control" id="level"  name="level[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sLevel']; ?>"></th>  

    <th>  <input type="text" class="form-control" id="accreditationbody"  name="accreditationbody[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sAccreditationBody']; ?>"></th>       



</tr>

  <?php

 }

 

?>
</tbody>

</table> <br>                                  

 </div>

</div>




<center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>
<hr><br><br>
        </div>
        <div class="tab" id="tab4">
            <!-- <h2>Listing Plan</h2> -->
            <!-- Add your form fields for listing plan here -->
            <!-- <h3 style="text-align:center;"> Listing Plan</h3><br><br><BR></BR> -->

                                   

<div class="col-md-12">

      <div class="mb-3">

      <table class="table table-bordered table-striped">

<thead>

<tr>



<th scope="col"  class="form-label reqiured-mark">Scheme</th>

<th scope="col"  class="form-label reqiured-mark">Mode of Payment</th>

<th scope="col"  class="form-label reqiured-mark">Date of Payment</th>

<th scope="col"  class="form-label reqiured-mark">Validity</th>





</tr>

<tr>



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
// print_r($familydeatils);


for($i=0;$i<4;$i++)

{



?>

<tr>


<th>
<select id="scheme" class="form-control" name="scheme[]"  >

<option value="">Select</option>
<option value="Prelaunch" <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sSchemeName'] == "Prelaunch") echo "Selected"; ?> >Prelaunch</option>
<option value="1 Year" <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sSchemeName'] == "1 Year") echo "Selected"; ?>>1 Year</option>
<option value="Renewal" <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sSchemeName'] == "Renewal") echo "Selected"; ?>>Renewal</option>
<option value="Dual Listing"<?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sSchemeName'] == "Dual Listing") echo "Selected"; ?>>Dual Listing</option>
<option value="Multiple Listing" <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sSchemeName'] == "Multiple Listing") echo "Selected"; ?>>Multiple Listing</option>
</select>
</th>
<th>
<select id="paymentmode" class="form-control" name="paymentmode[]" >

<option value="">Select</option>
<option value="Free Listing"  <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sPaymentMode'] == "Free Listing") echo "Selected"; ?>>Free Listing</option>
<option value="Bank Transfer"  <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sPaymentMode'] == "Bank Transfer") echo "Selected"; ?>>Bank Transfer</option>
<option value="UPI"  <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sPaymentMode'] == "UPI") echo "Selected"; ?>>UPI</option>
<option value="Through Website"  <?php if (isset($familydeatils[$i]) && $familydeatils[$i]['sPaymentMode'] == "Through Website") echo "Selected"; ?> >Through Website</option>
</select>
</th>

<th>

<input type="Date"  class="form-control" id="paymentdate"  name="paymentdate[]" value="<?php if(isset($familydeatils[$i])) echo $familydeatils[$i]['sPaymentDate']; ?>">
</th>

<th>

<input type="text"  class="form-control" id="validity"  name="validity[]" value="<?php if(isset($familydeatils[$i])) echo $familydeatils[$i]['sValidity']; ?>">
</th>
</tr>

<?php





}



?>











</tbody>

</table>                                   

      </div>

  </div>



<!-- employee details organization start here -->
<center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>
  <hr><br><br>


        </div>
        <div class="tab" id="tab5">
            <!-- <h2>LICENSE DETAILS</h2> -->
            <!-- Add your form fields for license details here -->
             
            <!-- <h3 style="text-align:center;"> LICENSE DETAILS</h3><br><br><BR></BR> -->

                                   

<div class="col-md-12">

      <div class="mb-3">

      <table class="table table-bordered table-striped">

<thead>

<tr>



<th  rowspan="2"  style="text-align:center;" >Organisation / Company Name</th>

<th   rowspan="2" style="text-align:center;">License Name</th>

<!-- <th  colspan="2" style="text-align:center;">Period of Service    </th>-->







</tr>



<tr>



<th style="text-align:center;" >Date of Issue</th>

<th  style="text-align:center;" >Expiry Date </th>
<th  rowspan="2" >License No.</th>



</tr>





</thead>

<tbody>

<?php





if(isset($employeeId))

{

$employmentdetails=[];



$stmt = $link->prepare('select * from tbllicensedetails where iEmployeeFormId   = ?');

$stmt->bind_param('i',$employeeId);

$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

$employmentdetails[]=$row;

// $output = $row;



}

}





for($i=0;$i<5;$i++)

{



?>

<tr>

<th>  <input type="text" class="form-control" id="orginiztionname"  name="orginiztionname[]" value="<?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i]['sOrginiztionname']; ?>" ></th>    

<th>  <input type="text" class="form-control" id="licensename"  name="licensename[]" value="<?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i]['sLicenseName']; ?>" ></th>  

<th>  <input type="date" class="form-control" id="from"  name="from[]" value="<?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i]['sFrom']; ?>" max="<?php echo date("Y-m-d"); ?>" ></th>  

<th>  <input type="date" class="form-control" id="to"  name="to[]" value="<?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i]['sTo']; ?>" min="<?php echo date("Y-m-d"); ?>" ></th>  

<th>  <input type="text" class="form-control" id="licenseno"  name="licenseno[]" value="<?php if(isset($employmentdetails[$i])) echo $employmentdetails[$i]['sLicenseNo']; ?>" ></th>  





</tr>

<?php





}



?>











</tbody>

</table>                                   

      </div>

  </div>









  <div class="col-md-12" style="display: none;">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label">ESI No: (if applicable)</label>

       <div class="col-sm-5">

       <input type="text" class="form-control" id="esino"  name="esino" value="<?php if(isset($output)) echo $output['sEsino']; ?>" >



    </div>

       </div>

   </div>

 





   <div class="col-md-12" style="display: none;">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label">UAN No: (if applicable)</label>

       <div class="col-sm-5">

       <input type="text" class="form-control" id="uanno"  name="uanno" value="<?php if(isset($output)) echo $output['sUanno']; ?>">

       </div>

       </div>

   </div>

   <center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>

<hr style="border: 1px dashed black;" /><BR></BR>



        </div>
        <div class="tab" id="tab6">
            <!-- <h2>FOR HR PURPOSE ONLY</h2> -->
            <!-- Add your form fields for HR purpose here -->
             



                                         

            <!-- <h3 style="text-align:center;">FOR HR PURPOSE ONLY</h3><br><br> -->



<h5 style="text-align:left;">List of Documents Submitted By Service Provider</h5><br><br>





<div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label">1. Service Provider Profile/Biodata  <?php if(isset($output) && $output['sUpdatedprofile'] != "") echo "<a href='".$output['sUpdatedprofile']."' target='_blank'>View</a>" ?> </label>

     

             <input type="file" class="form-control" id="updatedresume"  name="updatedresume"?><br>

             

       </div>

   </div>






   <div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label reqiured-mark">2. Pan Card  <?php if(isset($output) && $output['sPancard'] != "") echo "<a href='".$output['sPancard']."' target='_blank'>View</a>" ?></label>

             <input type="file" class="form-control" id="pancard"  name="pancard" ><br>

       </div>

   </div>





   <div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label reqiured-mark">3. Aadhar Card <?php if(isset($output) && $output['sAadharcard'] != "") echo "<a href='".$output['sAadharcard']."' target='_blank'>View</a>" ?></label>

             <input type="file" class="form-control" id="aadharcard"  name="aadharcard"><br>

       </div>

   </div>



   <div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label">4. Images <?php if(isset($output) && $output['sImages'] != "") echo "<a href='".$output['sImages']."' target='_blank'>View</a>" ?> </label>

             <input type="file" class="form-control" id="relievingletters"  name="relievingletters"><br>

       </div>

   </div>



   <div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label reqiured-mark">5. Bank Cheque  <?php if(isset($output) && $output['sBankcheque'] != "") echo "<a href='".$output['sBankcheque']."' target='_blank'>View</a>" ?></label>

             <input type="file" class="form-control" id="bankzerox"  name="bankzerox" ><br>

       </div>

   </div>









   <hr style="border: 1px dashed black;" /><BR></BR>





   <div class="col-md-12">

       <div class="mb-3">

       <label for="formrow-firstname-input" class="form-label">Remarks:</label>

       <div class="col-sm-5">

       <input type="text" class="form-control" id="remarks"  name="remarks" value="<?php if(isset($output)) echo $output['sRemarks']; ?>" >

       </div>

       </div>

   </div>

       <?php

        if(isset($employeeId)){

               $employeeId=$_POST['employeeId'];

               $stmt = $link->prepare('select * from tblpverification where iEmployeeFormId=?');

               $stmt->bind_param('i',$employeeId);

               $stmt->execute();

               $result = $stmt->get_result();

               while($row = $result->fetch_assoc()){

                   $output = $row;

                 }

             }

         ?>

         

           <div class="col-md-12">

           <div class="mb-3">

           <label for="formrow-firstname-input" class="form-label">Payment Verified:</label>

           <div class="col-sm-5">

        

           <select id="pverification" name="pverification"  class="form-control" >
             <option value="">Select</option>  
         
              <option value="Yes" <?php  if((isset($output) && $output['sVerificationStatus'] == 'Yes')  ){ echo "selected"; }  ?> >Yes</option>

              <option value="No" <?php  if((isset($output) && $output['sVerificationStatus'] == 'No')  ){ echo "selected"; }  ?> >No</option>


                
             </select>

           </div>

           </div>

       </div>




       <?php

if(isset($employeeId)){

$employeeId=$_POST['employeeId'];

$stmt = $link->prepare('select * from tblcity where iEmployeeFormId=?');

$stmt->bind_param('i',$employeeId);

$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

$output = $row;

}

}

?>

        <div class="col-md-12">

            <div class="mb-3">

               <label for="formrow-firstname-input" class="form-label reqiured-mark">City:</label>

                <div class="col-sm-5">

               <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php if(isset($output) && $output['sCity'] != '') echo $output['sCity']; ?>">

             </div>

         </div>

     </div>

     

     <div class="col-md-12">

            <div class="mb-3">

               <label for="formrow-firstname-input" class="form-label reqiured-mark">Pin Code : </label>

                <div class="col-sm-5">

                 <input type="text" id="pincode" class="form-control" name="pin" placeholder="Enter Pin" value="<?php if(isset($output) && $output['sPincode'] != '') echo $output['sPincode']; ?>" >

                 

             </div>

         </div>

     </div>

<div class="row">

 

<?php

     if (isset($employeeId)) {

 ?>

     <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">

 <?php        

     }

 ?>
 <?php if($_SESSION["usertype"] == "Admin" || $_SESSION["usertype"] == "Contractor"){ ?>

 <div>

<center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>

 </div>
 <?php } ?>

</div>    
        </div>

        <!-- <input type="submit" value="Submit"> -->
    </form>

                                    

                            </div>






                                <?php } ?>

   

                       












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

    

    // function showMSME(value){

    //     if(value< 500000000){

           

    //         document.getElementById("msme"). = true;

            

    //     }else {

            

    //         document.getElementById("msme"). = false;

    //     }

    // }



//     function check(){

        



        

//     if(document.getElementById("checkbox").checked)

//         {

//         document.getElementById("gstno").readOnly = true;

//         document.getElementById("gstno"). = false;

//         document.getElementById('panno').readOnly = false;

//         document.getElementById("panno"). = true;

        

//         }

//     else

//         {

//         document.getElementById("gstno").readOnly = false;

//         document.getElementById("gstno"). = true;

//         document.getElementById('panno').readOnly = true;

//         document.getElementById("panno"). = false;

        

//         }

//     }











//     function showPAN(gstno){

//     if(gstno.length == 15){

//         document.getElementById("panno").value = gstno.substr(2,10);

//         }

//     }





    function showAdd(){

    if(document.getElementById("ckecksameaddress").checked){

        document.getElementById("permanentaddress").value = document.getElementById("presentaddress").value;

        }

    }

    function showPAN(gstno){
    if(gstno.length == 15){
        document.getElementById("pancardno").value = gstno.substr(2,10);
        }
    }
    <?php

// if(isset($employeeId)){

//        $employeeId=$_POST['employeeId'];

//        $stmt = $link->prepare('select * from tblsubcategory where iEmployeeFormId = ?');

//        $stmt->bind_param('i',$employeeId);

//        $stmt->execute();

//        $result = $stmt->get_result();

//        while($row = $result->fetch_assoc()){

//            $output = $row;

//          }

//      }

    

 ?> 
//    function updateSubcategories() {
//     var category = document.getElementById("category").value;
//     var subcategoryDropdown = document.getElementById("subcategory");
//     subcategoryDropdown.innerHTML = ""; // Clear existing options

//     var subcategories = <?php //echo json_encode($subcategories); ?>;
//  var selectedsubcategory = "<?php //if (isset($output)) echo $output['sSubcategory']; ?>";
   
// alert(selectedsubcategory);
//     if (subcategories.hasOwnProperty(category)) {
//         subcategories[category].forEach(function(subcategory) {
//             var option = document.createElement("option");
//             option.text = subcategory;
//             option.value = subcategory;
//             if (subcategory === selectedsubcategory) {
//                 option.selected = true; // Select the matching subcategory
//             }
//             subcategoryDropdown.add(option);
//         });
        
//         // Check if subSubcategories exist for the selected subcategory
       
//     }
// } 

<?php // if(isset($output)){
    ?>//updateSubcategories();<?php
//} ?>







function dynamicSubcategories() {
    if(document.getElementById("categoryy") == undefined){
        return;
    }
        var category = document.getElementById("categoryy").value;
        var subcategoryDropdown = document.getElementById("subcategoryy");
        subcategoryDropdown.innerHTML = ""; // Clear existing options

        // Get subcategories array from PHP
        var subcategories = <?php echo json_encode($subcategories); ?>;
        var selectedSubcategory = "<?php if (!empty($categorydetails) && isset($categorydetails[0]['sSubcategory'])) echo $categorydetails[0]['sSubcategory']; ?>";

        if (subcategories.hasOwnProperty(category)) {
            subcategories[category].forEach(function(subcategory) {
                var option = document.createElement("option");
                option.text = subcategory;
                option.value = subcategory;
                if (subcategory === selectedSubcategory) {
                    option.selected = true; // Select the matching subcategory
                }
                subcategoryDropdown.add(option);
            });
        }
    }

    // Call the function once to populate subcategories based on default selection
    dynamicSubcategories();





// function getBankData(IFSCCODE)

//   {

//     $.get( "https://ifsc.razorpay.com/"+IFSCCODE)

//         .done(function(data) {

            

//             var obj = (data);

//             console.log(obj);

//             if(obj.hasOwnProperty("BANK")){

//                 document.getElementById("bankname").value = obj.BANK;

//                 document.getElementById("branch").value = obj.BRANCH;

//             }   

//     });

//   }



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



function saveCategory() {
    
    var categoryValue = document.getElementById("categoryy").value;
    var subcategoryValue = document.getElementById("subcategoryy").value;

  
    if (categoryValue && subcategoryValue) {
       
        var html = "<tr name='savedcategory'><th>";
        html += "<input type='text' name='categoryy[]' readonly class='form-control' value='" + categoryValue + "'>";
        html += "</th><th>";
        html += "<input type='text' name='subcategoryy[]' readonly class='form-control' value='" + subcategoryValue + "'>";
        html += "</th><th><button type='button' class='btn btn-danger w-md' name='btndeletecatgory' onclick='deleteCategory(this);'>Delete</button></th></tr>";

        
        document.getElementById("div_category_body").insertAdjacentHTML("beforeend", html);

        
        document.getElementById("categoryy").selectedIndex = 0; 
        document.getElementById("subcategoryy").innerHTML = '<option value="">Select Subcategory</option>'; 
    } else {
        alert("Please select both category and subcategory.");
    }
}

/*function saveCategory(){

 


var html = "<tr name='savedcategory'><th>";
var categoryhtml = "<input type='text' name='categoryy[]' readonly class='form-control' value='"+document.getElementById("categoryy").value+"'>";
html = html + categoryhtml;
html = html + "</th><th>";

categoryhtml = "<input type='text' name='subcategoryy[]' readonly class='form-control' value='"+document.getElementById("subcategoryy").value+"'>";
html = html + categoryhtml;

html = html + "</th><th><button type='button' class='btn btn-danger w-md' name='btndeletecatgory' onclick='deleteCategory(this);' >Delete</button></th></tr>";

document.getElementById("div_category_body").insertAdjacentHTML("afterend",html);



}*/


function deleteCategory(deletebtn){
    var deletes = document.getElementsByName("btndeletecatgory");
    var deletesrow = document.getElementsByName("savedcategory");

    for(var i =0; i < deletes.length; i++){
        if(deletes[i] == deletebtn){
            console.log(deletesrow[i]);
            deletesrow[i].remove();
        }
    }
}
var shownTab = 0;
function showTab(n) {
            var tabs = document.getElementsByClassName('tab');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }
            tabs[n].classList.add('active');
            shownTab = n;
            var headers = document.getElementsByClassName('tab-header-item');
            for (var i = 0; i < headers.length; i++) {
                headers[i].classList.remove('active');
            }
            headers[n].classList.add('active');

            if(<?php echo $active; ?> == 5 || shownTab == 5){
                if(<?php echo $pancarduploaded ?> == 0){
                    document.getElementById("pancard").required = true;
                }

                if(<?php echo $aadharuploaded ?> == 0){
                    document.getElementById("aadharcard").required = true;
                }
                
                if(<?php echo $bankuploaded ?> == 0){
                    document.getElementById("bankzerox").required = true;
                }
                
                
                document.getElementById("city").required = true;
                document.getElementById("pincode").required = true;
            }else if(shownTab != 5){
                
                document.getElementById("pancard").required = false;
                document.getElementById("aadharcard").required = false;
                document.getElementById("bankzerox").required = false;
                document.getElementById("city").required = false;
                document.getElementById("pincode").required = false;
            }
        }

        function validateForm(){
            debugger;
            if(<?php echo $active; ?> == 1){
            var categories = document.getElementsByName("categoryy[]");
            var subcategories = document.getElementsByName("categoryy[]");
            if(categories[0] == undefined){
                alert("Select Atleast 1 category");
                return false;
            }else{
                return true;
            }
        }
            
        }


        

        if(<?php if((isset($numbernotpresent) && $numbernotpresent && $msg == "") || (isset($output) && $msg == "")) echo "1"; ?> && <?php echo $active; ?> !== 6){
            showTab(<?php echo $active; ?>);
        }

        dynamicSubcategories();

        
        if(<?php echo $active; ?> == 0){
            document.getElementById("brandcompanyname").required = true;
            document.getElementById("name").required = true;
            document.getElementById("dateofjoining").required = true;
            document.getElementById("presentaddress").required = true;
            document.getElementById("mobilenumber").required = true;
            document.getElementById("emailid").required = true;
            document.getElementById("dateofbirth").required = true;
            document.getElementById("mode").required = true;
            document.getElementById("adharcardno").required = true;
            document.getElementById("nameasonadhar").required = true;
            document.getElementById("namee").required = true;
            document.getElementById("relation").required = true;
            document.getElementById("contactnumber").required = true;
        }else if(<?php echo $active; ?> == 1){
// categoryy[]
// subcategoryy[]
            var categories = document.getElementsByName("categoryy[]");
            var subcategories = document.getElementsByName("categoryy[]");
            if(categories[0] != undefined){
                categories[0].required = true;
                subcategories[0].required = true;
            }
           

        }else if(<?php echo $active; ?> == 2){

            var degree = document.getElementsByName("degree[]");
            var universityinstitute = document.getElementsByName("universityinstitute[]");
            var year = document.getElementsByName("year[]");
            var level = document.getElementsByName("level[]");
            var accreditationbody = document.getElementsByName("accreditationbody[]");

            degree[0].required = true;
            universityinstitute[0].required = true;
            year[0].required = true;
            level[0].required = true;
            accreditationbody[0].required = true;

        }else if(<?php echo $active; ?> == 3){

            var scheme = document.getElementsByName("scheme[]");
            var paymentmode = document.getElementsByName("paymentmode[]");
            var paymentdate = document.getElementsByName("paymentdate[]");
            var validity = document.getElementsByName("validity[]");

            scheme[0].required = true;
            paymentmode[0].required = true;
            paymentdate[0].required = true;
            validity[0].required = true;
            

        }else if(<?php echo $active; ?> == 5 || shownTab == 5){
            if(<?php echo $pancarduploaded ?> == 0){
                document.getElementById("pancard").required = true;
            }

            if(<?php echo $aadharuploaded ?> == 0){
                document.getElementById("aadharcard").required = true;
            }
            
            if(<?php echo $bankuploaded ?> == 0){
                document.getElementById("bankzerox").required = true;
            }
            
            
            document.getElementById("city").required = true;
            document.getElementById("pincode").required = true;
        }
//         brandcompanyname
// name
// dateofjoining
// presentaddress
// mobilenumber
// emailid
// dateofbirth
// mode
// adharcardno
// nameasonadhar
// namee	
// relation
// contactnumber            

// categoryy[]
// subcategoryy[]

// degree[]
// universityinstitute[]
// year[]
// level[]
// accreditationbody[]

// scheme[]
// paymentmode[]
// paymentdate[]
// validity[]

// pancard
// aadharcard
// bankzerox
// city
// pincode

</script>



</html>


