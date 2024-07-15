<?php include 'layouts/session.php'; ?>

<?php include 'layouts/head-main.php'; ?>

<?php include 'layouts/config.php'; ?>


<?php 


$msg = "";


 if(isset($_POST['btnsubmit'])){
           $mobile  = $_POST['mobilenumber']; 
            
        $stmt = $link->prepare('select * from tblvendors where sMobilenumber= ?');
        $stmt->bind_param('s',$mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){

            $output = $row;
            $vendorId = $row['iVendorId'];

            $employeeId = $row['iVendorId'];


        }

       
        $stmt1 = $link->prepare('select * from tbleducationaldetails where iVendorId= ?');
        $stmt1->bind_param('s',$vendorId);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while($row1 = $result1->fetch_assoc()){

          $educationaldeails[] = $row1;

     }

      $stmt1 = $link->prepare('select * from tbllistingplans where iVendorId= ?');
        $stmt1->bind_param('s',$vendorId);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while($row1 = $result1->fetch_assoc()){

          $familydeatils = $row1;

     }


     $stmt1 = $link->prepare('select * from tbllicense where iVendorId= ?');
        $stmt1->bind_param('s',$vendorId);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while($row1 = $result1->fetch_assoc()){

          $licensedetails = $row1;

     }

     

   }

    

   else if(isset($_POST['btnsave']) && isset($_POST['employeeId'])){



        $employeeId  = $_POST['employeeId']; 

        $employeecode=$_POST['employeecode'];

        $dateofjoining = $_POST['dateofjoining'];

        $name = $_POST['name'];

        $presentaddress = $_POST['presentaddress'];

        $permanentaddress = $_POST['permanentaddress'];

        $mobilenumber = $_POST['mobilenumber'];

        $emailid = $_POST['emailid'];

        $dateofbirth = $_POST['dateofbirth']; 

        $maritialstatus = $_POST['maritialstatus'];

        $pancardno= $_POST['pancardno'];

        $adharcardno= $_POST['adharcardno'];

        $nameasonpan= $_POST['nameasonpan'];

        $nameasonadhar= $_POST['nameasonadhar'];

        $gstnumber = $_POST['gstnumber'];

        $namee= $_POST['namee']; 

        $relation= $_POST['relation']; 

        $contactnumber= $_POST['contactnumber'];

        $esino= $_POST['esino'];

        $uanno= $_POST['uanno'];

        $remarks= $_POST['remarks'];

        $category= $_POST['category'];

        $employeedesignation= $_POST['employeedesignation'];

      //  $department= $_POST['department'];

        $paymentverified = $_POST['paymentverified'];

       // $unit= $_POST['unit'];

        $city = $_POST['city'];

        $pincode = $_POST['pincode'];

        $subcategories = $_POST['subcategories'];

        $companyname = $_POST['companyname'];



    //   $contractor="";

    // if(isset( $_POST['contractor'])){

    //     $contractor= $_POST['contractor'];

    // }

     





    $stmt = $link->prepare('select * from tblvendors where iVendorId=?');

    $stmt->bind_param('i',$employeeId);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

        $personalphotocopy = $row['sPersonalphotocopy'];

        $updatedresume = $row['sUpdatedresume'];

       // $educationalcertificates = $row['sEducationalcertificates'];

        $pancard = $row['sPancard'];

        $aadharcard = $row['sAadharcard'];

       // $relievingletters = $row['sRelievingletters'];

        $images = $row['sImages'];

       // $bankzerox = $row['sBankzerox'];

        $bankcheque = $row['sBankCheque'];

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

                     







                     

    

                     // if(isset($_FILES['educationalcertificates']) && $_FILES['educationalcertificates']['size'] > 0){

                      

                         // $target_dir = "uploaded_images/";

                          

                         // $ext = substr(strrchr($_FILES["educationalcertificates"]["name"],'.'),1);

                         // $target_file = $target_dir ."educationalcertificates". time().".".$ext;

                       

                         // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                         // $check = getimagesize($_FILES["educationalcertificates"]["tmp_name"]);

                          //if($check == true) {

                          //    $uploadOk = 1;

                         // } else {

                          //    $uploadOk = 0;

                          //}

                          

                        //  if (move_uploaded_file($_FILES["educationalcertificates"]["tmp_name"], $target_file)) {

                          //    $educationalcertificates = "uploaded_images/educationalcertificates". time().".".$ext;

                              

                           // }

                        //  }

                        







                         

    

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

                                







                            

    

                                  if(isset($_FILES['images']) && $_FILES['images']['size'] > 0){

                                  

                                      $target_dir = "uploaded_images/";

                                      

                                      $ext = substr(strrchr($_FILES["images"]["name"],'.'),1);

                                      $target_file = $target_dir ."images". time().".".$ext;

                                   

                                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                      $check = getimagesize($_FILES["images"]["tmp_name"]);

                                      if($check == true) {

                                          $uploadOk = 1;

                                      } else {

                                          $uploadOk = 0;

                                      }

                                      

                                      if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {

                                          $images = "uploaded_images/images". time().".".$ext;

                                          

                                        }

                                      }

                                    





                                  

    

                                      if(isset($_FILES['bankcheque']) && $_FILES['bankcheque']['size'] > 0){

                                      

                                          $target_dir = "uploaded_images/";

                                          

                                          $ext = substr(strrchr($_FILES["bankcheque"]["name"],'.'),1);

                                          $target_file = $target_dir ."bankcheque". time().".".$ext;

                                       

                                          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                          $check = getimagesize($_FILES["bankcheque"]["tmp_name"]);

                                          if($check == true) {

                                              $uploadOk = 1;

                                          } else {

                                              $uploadOk = 0;

                                          }

                                          

                                          if (move_uploaded_file($_FILES["bankcheque"]["tmp_name"], $target_file)) {

                                              $bankcheque = "uploaded_images/bankcheque". time().".".$ext;

                                              

                                            }

                                          }

                           

          
        $query = "update tblvendors set sVendorCode=?, sDateofjoining=?,sName=?,sPersonalphotocopy=?,sPresentaddress=?,sPermanentaddress=?,sMobilenumber=?,sEmailid=?,sDateofbirth=?,sMaritialstatus=?,sPancardno=?,sAdharcardno=?,sNameasonpan=?,sNameasonadhar=?,sNamee=?,sRelation=?,sContactNumber=?,sEsino=?,sUanno=?,sUpdatedresume=?,sPancard=?,sAadharcard=?, sImages=?,sBankCheque=?,sRemarks=?,sCategory = ?,sPaymentVerified = ?,sCity = ?,sPincode =?, sGSTNumber = ?,sSubCategories=?,sCompanyName=? where iVendorId=?";

        $stmt = mysqli_prepare($link,$query);

        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssi",$employeecode,$dateofjoining,$name,$personalphotocopy,$presentaddress,$permanentaddress,$mobilenumber,$emailid,$dateofbirth,$maritialstatus,$pancardno,$adharcardno,$nameasonpan, $nameasonadhar,$namee,$relation,$contactnumber,$esino,$uanno,$updatedresume,$pancard, $aadharcard, $images,$bankcheque,$remarks,$category,$paymentverified,$city,$pincode,$gstnumber,$subcategories,$companyname,$employeeId);

        $ret = mysqli_stmt_execute($stmt);

        // $error=mysqli_error($link);

        //         print("error occured:".$error);

        mysqli_stmt_close($stmt);



        // exit();



        if(!$ret){

            $msg= "Data Not Updated";

        }else{

            $msg= "Data Updated";



            $query = "DELETE from tbleducationaldetails where iVendorId = ?";

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "i", $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            $query = "DELETE from tbllistingplans where iVendorId = ?";

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "i", $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            $query = "DELETE from tbllicense where iVendorId = ?";

            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "i",  $employeeId);

            $ret = mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);



            $course=$_POST['course'];

            $universityinstitute=$_POST['universityinstitute'];

           

            $year=$_POST['year'];

    

            $level=$_POST['level'];

            $accreditationBody=$_POST['accreditationBody'];

    


            for($i=0;$i<count($course);$i++)

            {

                if($course[$i]==""){

                    continue;

                }

                $query = "INSERT INTO tbleducationaldetails (sDegree,sUniversityinstitute,sYear,sLevel,sAccreditationBody,iVendorId) VALUES (?,?,?,?,?,?)";

    

                $stmt = mysqli_prepare($link,$query);

                mysqli_stmt_bind_param($stmt, "sssssi",$course[$i],$universityinstitute[$i],$year[$i], $level[$i], $accreditationBody[$i], $employeeId);

                

                // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

            

            

            

                $ret = mysqli_stmt_execute($stmt);

                // $error=mysqli_error($link);

                // print("error occured:".$error);

                mysqli_stmt_close($stmt);

            }

    

    


            $scheme=$_POST['scheme'];

            $ModeofPayment=$_POST['ModeofPayment'];

            $dateofPayment=$_POST['dateofPayment'];

            $validity=$_POST['validity'];

 
          //  for($i=0;$i<count($familyname);$i++)

            //{

             //   if($familyname[$i]==""){

               //     continue;

              //  }

                $query = "INSERT INTO tbllistingplans (sScheme,sModeofPayment,sDateofPayment,sValidity,iVendorId) VALUES (?,?,?,?,?)";

    

                $stmt = mysqli_prepare($link,$query);

                mysqli_stmt_bind_param($stmt, "ssssi",$scheme,$ModeofPayment,$dateofPayment, $validity,$employeeId);

                

                // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

          

                $ret = mysqli_stmt_execute($stmt);

                // $error=mysqli_error($link);

                // print("error occured:".$error);

                mysqli_stmt_close($stmt);

           // }

    

    

    

            $orginiztionname=$_POST['orginiztionname'];

            $licensename=$_POST['licensename'];

            $dateofissue=$_POST['dateofissue'];

            $expirydate=$_POST['expirydate'];

            $licensenumber=$_POST['licensenumber'];

         

    

    

           // for($i=0;$i<count($orginiztionname);$i++)

           // {

             //   if($orginiztionname==""){

                //    continue;

               // }

                $query = "INSERT INTO tbllicense (sOrginiztionname,sLicenseName,sDateofIssue,sExpiryDate,sLicenseNumber,iVendorId) VALUES (?,?,?,?,?,?)";

    

                $stmt = mysqli_prepare($link,$query);

                mysqli_stmt_bind_param($stmt, "sssssi",$orginiztionname,$licensename,$dateofissue, $expirydate, $licensenumber, $employeeId);

                

                // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

            

            

            

                $ret = mysqli_stmt_execute($stmt);

                // $error=mysqli_error($link);

                // print("error occured:".$error);

                mysqli_stmt_close($stmt);

            //}







          //  $employeedesignation= $_POST['employeedesignation'];

         //   $query = "INSERT INTO tbldesignation (sDesignation,iEmployeeFormId) VALUES (?,?)";

          //  $stmt = mysqli_prepare($link,$query);

           // mysqli_stmt_bind_param($stmt, "si",$employeedesignation,$employeeId);

           // $ret = mysqli_stmt_execute($stmt);

           // mysqli_stmt_close($stmt);





    

           // $department= $_POST['department'];

          //  $query = "INSERT INTO tbldepartment (sDepartment,iEmployeeFormId) VALUES (?,?)";

           // $stmt = mysqli_prepare($link,$query);

           // mysqli_stmt_bind_param($stmt, "si",$department,$employeeId);

           // $ret = mysqli_stmt_execute($stmt);

           // mysqli_stmt_close($stmt);





            

         //   $unit= $_POST['unit'];

          //  $unitdate = $_POST['unitdate'];

          //  $unitpresent = false;

            

          //  $stmt = $link->prepare('select * from tblunit where iEmployeeFormId=? and sUnit = ? and sDate = ?');

          //  $stmt->bind_param('iss',$employeeId,$unit,$unitdate);

          //  $stmt->execute();

           // $result = $stmt->get_result();

           // while($row = $result->fetch_assoc()){

           //     $unitpresent = true;

           // }

            

           // if(!$unitpresent){

             //   $query = "INSERT INTO tblunit (sUnit,iEmployeeFormId,sDate) VALUES (?,?,?)";

              //  $stmt = mysqli_prepare($link,$query);

              //  mysqli_stmt_bind_param($stmt, "sis",$unit,$employeeId,$unitdate);

              //  $ret = mysqli_stmt_execute($stmt);

              //  mysqli_stmt_close($stmt);    

           // }

  

           echo "<script>window.location.href = 'list-Vendors.php';</script>";

        } 

    }





   else if(isset($_POST['btnsave']))

   {

 

   // $employeeId  = $_POST['employeeId']; 

        $employeecode=$_POST['employeecode'];

        $dateofjoining = $_POST['dateofjoining'];

        $name = $_POST['name'];

        $presentaddress = $_POST['presentaddress'];

        $permanentaddress = $_POST['permanentaddress'];

        $mobilenumber = $_POST['mobilenumber'];

        $emailid = $_POST['emailid'];

        $dateofbirth = $_POST['dateofbirth']; 

        $maritialstatus = $_POST['maritialstatus'];

        $pancardno= $_POST['pancardno'];

        $adharcardno= $_POST['adharcardno'];

        $nameasonpan= $_POST['nameasonpan'];

        $nameasonadhar= $_POST['nameasonadhar'];

        $gstnumber = $_POST['gstnumber'];

        $namee= $_POST['namee']; 

        $relation= $_POST['relation']; 

        $contactnumber= $_POST['contactnumber'];

        $esino= $_POST['esino'];

        $uanno= $_POST['uanno'];

        $remarks= $_POST['remarks'];

        $category= $_POST['category'];

     //   $employeedesignation= $_POST['employeedesignation'];

      //  $department= $_POST['department'];

        $paymentverified = $_POST['paymentverified'];

       // $unit= $_POST['unit'];

        $city = $_POST['city'];

        $pincode = $_POST['pincode'];

        $subcategories = $_POST['subcategories'];

        $companyname = $_POST['companyname'];


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

                 

            



                //  $educationalcertificates = '';



                //  if(isset($_FILES['educationalcertificates']) && $_FILES['educationalcertificates']['size'] > 0){

                  

                  //    $target_dir = "uploaded_images/";

                      

                  //    $ext = substr(strrchr($_FILES["educationalcertificates"]["name"],'.'),1);

                  //    $target_file = $target_dir ."educationalcertificates". time().".".$ext;

                   

                   //   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                   //   $check = getimagesize($_FILES["educationalcertificates"]["tmp_name"]);

                   //   if($check == true) {

                     //     $uploadOk = 1;

                     // } else {

                       //   $uploadOk = 0;

                     // }

                      

                    //  if (move_uploaded_file($_FILES["educationalcertificates"]["tmp_name"], $target_file)) {

                     //     $educationalcertificates = "uploaded_images/educationalcertificates". time().".".$ext;

                          

                     //   }

                     // }

                     // if($educationalcertificates == null){

                     //     $educationalcertificates = "";

                    //  }

    







    

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

                









                              $images = '';



                              if(isset($_FILES['images']) && $_FILES['images']['size'] > 0){

                              

                                  $target_dir = "uploaded_images/";

                                  

                                  $ext = substr(strrchr($_FILES["images"]["name"],'.'),1);

                                  $target_file = $target_dir ."images". time().".".$ext;

                               

                                  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                  $check = getimagesize($_FILES["images"]["tmp_name"]);

                                  if($check == true) {

                                      $uploadOk = 1;

                                  } else {

                                      $uploadOk = 0;

                                  }

                                  

                                  if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {

                                      $images = "uploaded_images/images". time().".".$ext;

                                      

                                    }

                                  }

                                  if($images == null){

                                      $images = "";

                                  }







                                  $bankcheque = '';



                                  if(isset($_FILES['bankcheque']) && $_FILES['bankcheque']['size'] > 0){

                                  

                                      $target_dir = "uploaded_images/";

                                      

                                      $ext = substr(strrchr($_FILES["bankcheque"]["name"],'.'),1);

                                      $target_file = $target_dir ."bankcheque". time().".".$ext;

                                   

                                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                      $check = getimagesize($_FILES["bankcheque"]["tmp_name"]);

                                      if($check == true) {

                                          $uploadOk = 1;

                                      } else {

                                          $uploadOk = 0;

                                      }

                                      

                                      if (move_uploaded_file($_FILES["bankcheque"]["tmp_name"], $target_file)) {

                                          $bankcheque = "uploaded_images/bankcheque". time().".".$ext;

                                          

                                        }

                                      }

                                      if($bankcheque == null){

                                          $bankcheque = "";

                                      }





  



    $query = "INSERT INTO tblvendors (sVendorCode,sDateofjoining,sName,sPersonalphotocopy,sPresentaddress,sPermanentaddress,sMobilenumber,sEmailid,sDateofbirth,sMaritialstatus,sPancardno,sAdharcardno,sNameasonpan,sNameasonadhar,sNamee,sRelation,sContactNumber,sEsino,sUanno,sUpdatedresume,sPancard,sAadharcard, sImages,sBankCheque,sRemarks,sCategory,iCreatedBy,sPaymentVerified,sCity,sPincode,sGSTNumber,sSubCategories,sCompanyName) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    

    $stmt = mysqli_prepare($link,$query);

                         

    mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssssssissssss",$employeecode,$dateofjoining,$name,$personalphotocopy,$presentaddress,$permanentaddress,$mobilenumber,$emailid,$dateofbirth,$maritialstatus,$pancardno,$adharcardno,$nameasonpan, $nameasonadhar,$namee,$relation,$contactnumber,$esino,$uanno,$updatedresume,$pancard, $aadharcard, $images,$bankcheque,$remarks,$category,$_SESSION['id'],$paymentverified,$city,$pincode,$gstnumber,$subcategories,$companyname);

    // $error=mysqli_error($link);

    //  print("error occured:".$error);





    // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";







    $ret = mysqli_stmt_execute($stmt);

    // $error=mysqli_error($link);

    // print("error occured:".$error);

    mysqli_stmt_close($stmt);

    // exit();



    if(!$ret){



        $msg= "Data Not Saved";

    } 

    else{

        $msg= "Data Saved";

        $maxId=0;

        //$stmt = $link->prepare('select max(iEmployeeFormId) as num from tblemployeejoiningform ');

        $stmt = $link ->prepare('select max(iVendorId) as num from tblvendors');

        // $stmt->bind_param('i',$employeeId);

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){

        

            // $output = $row;

            $maxId=$row['num'];

    

        }







            $course=$_POST['course'];

            $universityinstitute=$_POST['universityinstitute'];

            $year=$_POST['year'];

            $level=$_POST['level'];

            $accreditationBody=$_POST['accreditationBody'];




        for($i=0;$i<count($course);$i++)

        {

            if($course[$i]==""){

                continue;

            }

            $query = "INSERT INTO tbleducationaldetails (sDegree,sUniversityinstitute,sYear,sLevel,sAccreditationBody,iVendorId) VALUES (?,?,?,?,?,?)";



            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "sssssi",$course[$i],$universityinstitute[$i],$year[$i], $level[$i], $accreditationBody[$i], $maxId);

            

            // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

        

        

        

            $ret = mysqli_stmt_execute($stmt);

            // $error=mysqli_error($link);

            // print("error occured:".$error);

            mysqli_stmt_close($stmt);

        }





    



        $scheme=$_POST['scheme'];

        $ModeofPayment=$_POST['ModeofPayment'];

        $dateofPayment=$_POST['dateofPayment'];

        $validity=$_POST['validity'];

     





       // for($i=0;$i<count($familyname);$i++)

       // {

           // if($familyname[$i]==""){

             //   continue;

           // }

            $query = "INSERT INTO tbllistingplans (sScheme,sModeofPayment,sDateofPayment,sValidity,iVendorId) VALUES (?,?,?,?,?)";



            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "ssssi",$scheme,$ModeofPayment,$dateofPayment, $validity, $maxId);

            

            // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

        

        

        

            $ret = mysqli_stmt_execute($stmt);

            // $error=mysqli_error($link);

            // print("error occured:".$error);

            mysqli_stmt_close($stmt);

       // }







        $orginiztionname=$_POST['orginiztionname'];

        $licensename=$_POST['licensename'];

        $dateofissue=$_POST['dateofissue'];

        $expirydate=$_POST['expirydate'];

        $licensenumber=$_POST['licensenumber'];

     





       // for($i=0;$i<count($orginiztionname);$i++)

       // {

            //if($orginiztionname[$i]==""){

             //   continue;

          //  }

            $query = "INSERT INTO tbllicense (sOrginiztionname,sLicenseName,sDateofIssue,sExpiryDate,sLicenseNumber,iVendorId) VALUES (?,?,?,?,?,?)";



            $stmt = mysqli_prepare($link,$query);

            mysqli_stmt_bind_param($stmt, "sssssi",$orginiztionname,$licensename,$dateofissue, $expirydate, $licensenumber, $maxId);

            

            // echo  "INSERT INTO tblvendorregform (sGSTNo,sPANNo,sCompanyName,sEstablishment,sCompanyOwnership,sPromotersDirectorsProprietor,sRegistrationAddress,sCommunicationAddress,sAnnualTurnover,sNoOfOffices,sContactPersonName,sContactNo,sDesignation,sEmail,sIFSCCode,sBankName,sBranch,sAccountNo,sCancelledChequeCopy,sMonthlyVolumesHandled,sMSMERegNo,sCompanyCode) VALUES ('".$gstno."','".$panno."','".$companyname."','".$establishment."','".$companyownership."','".$promotersname."','".$registrationaddress."','".$communicationaddress."','".$annualturnover."','".$officeno."','".$contactpersonname."','".$contactnumber."','".$designation."','".$email."','".$ifscCode."','".$bankname."','".$branch."','".$accountno."','".$cancelledchequecopy."','".$monthlyvolumeshandled."','".$msme."','".$companycode."')";

        

        

        

            $ret = mysqli_stmt_execute($stmt);

            // $error=mysqli_error($link);

            // print("error occured:".$error);

            mysqli_stmt_close($stmt);

       // }

  

      //  $employeedesignation= $_POST['employeedesignation'];

     //   $query = "INSERT INTO tbldesignation (sDesignation,iEmployeeFormId) VALUES (?,?)";

      //  $stmt = mysqli_prepare($link,$query);

      //  mysqli_stmt_bind_param($stmt, "si",$employeedesignation,$maxId);

      //  $ret = mysqli_stmt_execute($stmt);

      //  mysqli_stmt_close($stmt);





       

      //  $department= $_POST['department'];

       // $query = "INSERT INTO tbldepartment (sDepartment,iEmployeeFormId) VALUES (?,?)";

       // $stmt = mysqli_prepare($link,$query);

       // mysqli_stmt_bind_param($stmt, "si",$department,$maxId);

       // $ret = mysqli_stmt_execute($stmt);

      //  mysqli_stmt_close($stmt);

             

            

                                                                                          

      //  $unit= $_POST['unit'];

       // $unitdate = $_POST['unitdate'];

       // $query = "INSERT INTO tblunit (sUnit,iEmployeeFormId,sDate) VALUES (?,?,?)";

      //  $stmt = mysqli_prepare($link,$query);

      //  mysqli_stmt_bind_param($stmt, "sis",$unit,$maxId,$unitdate);

      //  $ret = mysqli_stmt_execute($stmt);

      //  mysqli_stmt_close($stmt);







         echo "<script>window.location.href = 'add-Vendors.php';</script>";

        //echo "<script>window.location.href = 'list-process.php';</script>";

    }  

   







}



else if(isset($_POST['employeeId'])){

    $employeeId  = $_POST['employeeId']; 

        

    $stmt = $link->prepare('select * from tblvendors where iVendorId = ?');

    $stmt->bind_param('i',$employeeId);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

    

        $output = $row;



    }

} 

?>



<head>

    <title>Vendors</title>

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

                            <h4 class="mb-sm-0 font-size-18"> ADD Vendors </h4>

                            



                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">VENDORS</a></li>

                                    <li class="breadcrumb-item active">Add Vendor</li>

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

                              

                                

                                <form action="add-Vendors.php" method="post" enctype="multipart/form-data" >

                                    <div class="row">

                                        <div class="col-md-6">

                                           

                                        <div>   

                                                          

                                    </div>



                                </div>



                                <div class="row">

                                       <div class="col-md-12">

                                          <div class="mb-3">

                                          <h4>PERSONAL DETAILS</h4><br>

                                          </div>

                                       </div>


                                         <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Mobile Number:</label>

                                          <input type="text" class="form-control" id="mobilenumber"  name="mobilenumber" onkeypress="if(this.value.length == 10) return false;" onblur="if(this.value.length < 10) this.focus();" value="<?php if(isset($output)) echo $output['sMobilenumber']; else if(isset($_POST['mobilenumber'])) echo $_POST['mobilenumber'];?>"required >

                                          </div>

                                      </div>

                                          <?php if(!isset($_POST['mobilenumber']) && !isset($output)){

                                        ?>

                                         <div>
                                        <center><button type="submit" class="btn btn-primary w-md" name="btnsubmit" value="btnsubmit">Submit</button></center>
                                    </div>
                                    <?php
                                }
                                ?>


                                  <?php if(isset($_POST['mobilenumber']) || isset($output)){
                                       ?>

                                         <div class="col-md-6">

                                              <div class="mb-3">

                                              <label for="formrow-firstname-input" class="form-label">Company Name:</label>

                                          

                                              <input type="text" class="form-control" id="companyname"  name="companyname" value="<?php if(isset($output)) echo $output['sCompanyName']; ?>" >

                                     

                                              </div>

                                          </div>

                                <div class="col-md-6">

                                        <div class="mb-3">

                                            <label for="formrow-firstname-input" class="form-label" required>Category</label>

                                            

                                            <select id="formrow-inputState" class="form-control" name="category"  >

                                        <option value="">Select</option>

                                           

                                                



                                               <option value="Staff" <?php if (isset($output) && $output['sCategory'] == "Staff") echo "Selected"; ?>>Staff</option>

                                               <option value="Worker" <?php if (isset($output) && $output['sCategory'] == "Worker") echo "Selected"; ?>>Worker</option>



                                   

                                        

                                    </select>

                                        </div>

                                    </div>


                                       <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Vendor Code:</label>

                                          <input type="text" class="form-control" id="employeecode"  name="employeecode" value="<?php if(isset($output)) echo $output['sVendorCode']; ?>"required >

                                          </div>

                                      </div>

                                          <div class="col-md-6">

                                            <div class="mb-3">

                                                <label for="formrow-firstname-input" class="form-label">Name (In Capital Letters):</label>

                                                <input type="text" class="form-control" id="name"  name="name" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sName']; ?>" required>

                                            </div>

                                        </div>



                                      <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-password-input" class="form-label">Date of joining:</label>

                                          <input type="Date" step="0.001" class="form-control" id="dateofjoining"  name="dateofjoining" value="<?php if(isset($output)) echo $output['sDateofjoining']; ?>"required >

                                          </div>

                                      </div>



        

         

     

                              





                            





                                      

                                    

                                    



                                        <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Personal Photo Copy  &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sPersonalphotocopy'] != "") echo "<a href='".$output['sPersonalphotocopy']."' target='_blank'>View</a>" ?> </label>

                                                <input type="file" class="form-control" id="personalphotocopy "  name="personalphotocopy" >

                                          </div>

                                      </div>

                                      

                                  





                                      <?php

                                           // if(isset($employeeId)){

                                           //        $employeeId=$_POST['employeeId'];

                                           //        $stmt = $link->prepare('select * from tbldesignation where iEmployeeFormId = ?');

                                           //        $stmt->bind_param('i',$employeeId);

                                           //        $stmt->execute();

                                           //        $result = $stmt->get_result();

                                           //        while($row = $result->fetch_assoc()){

                                           //            $output = $row;

                                           //          }

                                           //      }

                                               

                                            ?> 

                                  

                                            

                                              <div class="col-md-6">

                                              <div class="mb-3">

                                              <label for="formrow-firstname-input" class="form-label">Subcategories:</label>

                                          

                                              <input type="text" class="form-control" id="subcategories"  name="subcategories" value="<?php if(isset($output)) echo $output['sSubCategories']; ?>" >

                                     

                                              </div>

                                          </div>

                                         



                                       <?php

                                           // if(isset($employeeId)){

                                           //        $employeeId=$_POST['employeeId'];

                                           //        $stmt = $link->prepare('select * from tblvendors where iVendorId = ?');

                                           //        $stmt->bind_param('i',$employeeId);

                                           //        $stmt->execute();

                                           //        $result = $stmt->get_result();

                                           //        while($row = $result->fetch_assoc()){

                                           //            $output = $row;

                                           //          }

                                           //      }

                                               

                                            ?> 



                                  



                                         <div class="col-md-12">

                                            <div class="mb-3">

                                                <label for="formrow-firstname-input" class="form-label">Present  Address:</label>  

                                                <textarea type="text" class="form-control" name = "presentaddress" id="presentaddress" placeholder="Present address" ><?php if(isset($output)) echo $output['sPresentaddress']; ?></textarea>                   

                                            </div>

                                        </div>



                                        <div class="col-md-12">

                                            <div class="mb-3">

                                                <label for="formrow-firstname-input" class="form-label">Permanent Address:</label> 

                                                    <label for="formrow-model-input" class="form-label"></label>

                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="ckecksameaddress" onclick="showAdd()">

                                                    <label class="form-check-label" for="ckecksameaddress">Same As Above</label>

                                                <textarea type="text" class="form-control" name = "permanentaddress" id="permanentaddress" placeholder="Permanent address" ><?php if(isset($output)) echo $output['sPermanentaddress']; ?></textarea>                                        

                                            </div>

                                        </div>



                                      



                                      <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Email ID:</label>

                                              <input type="text" class="form-control" id="emailid"  name="emailid" value="<?php if(isset($output)) echo $output['sEmailid']; ?>"required ><br>

                                          </div>

                                      </div>

       







                               <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-password-input" class="form-label">Date Of Birth:</label>

                     <input type="Date" step="0.001" class="form-control" id="dateofbirth"  name="dateofbirth" value="<?php if(isset($output)) echo $output['sDateofbirth']; ?>"required ><br>

                                          </div>

                                      </div>



                                      <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Marital Status:</label>

                                          <select id="formrow-inputState" class="form-select" name="maritialstatus" required>

                                                    <option <?php if(isset($output) && $output['sMaritialstatus'] == 'Unmarried') echo 'selected'; ?>>Unmarried</option> 

                                                    <option <?php if(isset($output) && $output['sMaritialstatus'] == 'Married') echo 'selected'; ?>>Married</option> 

                                                  

                                                                                                                                                        

                                                </select>

                                          </div>

                                      </div>

       



                                      <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Pan Card No:</label>

                                        <input type="text" class="form-control" id="pancardno"  name="pancardno" value="<?php if(isset($output)) echo $output['sPancardno']; ?>" required>

                                          </div>

                                      </div>







                         <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Adhar Card No:</label>

                                       <input type="text" class="form-control" id="adharcardno"  name="adharcardno" value="<?php if(isset($output)) echo $output['sAdharcardno']; ?>"required >

                                          </div>

                                      </div>





       

                     





                                <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Name As on Pan:</label>

                                                <input type="text" class="form-control" id="nameasonpan"  name="nameasonpan" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNameasonpan']; ?>" required>

                                          </div>

                                      </div>





                                      <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Name As on Adhar:</label>

                                                <input type="text" class="form-control" id="nameasonadhar"  name="nameasonadhar" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNameasonadhar']; ?>" required>

                                          </div>

                                      </div>

                                       <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">GST Number:</label>

                                                <input type="text" class="form-control" id="gstnumber"  name="gstnumber" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sGSTNumber']; ?>" required>

                                          </div>

                                      </div>







             <!-- start emerggency contact details -->

             <h4>Emergancy Contact Details</h4><br><br>



                                        <div class="col-md-4">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Name:</label>

                                                <input type="text" class="form-control" id="namee"  name="namee" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sNamee']; ?>" required>

                                          </div>

                                      </div>

                                       

                                      <div class="col-md-4">

                                            <div class="mb-3">

                                                <label for="formrow-firstname-input" class="form-label">Relation:</label>  

                                                <input type="text" class="form-control" id="relation"  name="relation" value="<?php if(isset($output)) echo $output['sRelation']; ?>"required ><br>      

                                            </div>

                                        </div>

                                       

                                  

                                        <div class="col-md-4">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">Contact Number:</label>

                       <input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNumber']; ?>" required><br><br>

                                          </div>

                                      </div>

                                        <hr><br><br>

                                   







              <!-- end emergency details -->







              <!-- start education details -->


                                      <h3 style="text-align:center;"> QUALIFICATION AND CERTIFICATION </h3><br><br><BR></BR>
                                    <!--  <h3 style="text-align:center;"> EDUCATIONAL DETAILS</h3><br><br><BR></BR> -->

                                      

                                      <div class="col-md-12">

                                            <div class="mb-3">

                                            <table class="table table-bordered table-striped">

            <thead>

         <tr>

    

    <!--  <th scope="col">Degree</th> -->

      <th scope="col">Course</th>

       <th scope="col">University Institute</th>

      <th scope="col">Year</th>

     <!-- <th scope="col">Percentage</th> -->
     <th scope="col">Level</th>

      <th scope="col">Accreditation Body</th>

      

    </tr>

  </thead>

  <tbody>





                                

  

    <?php

     

    if(isset($employeeId))

    {

      $educationaldeails=[];

        

        $stmt = $link->prepare('select * from tbleducationaldetails where iVendorId=?');

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

            <th>  <input type="text" class="form-control" id="course"  name="course[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i] ['sDegree']; ?>" ></th>    

            <th>  <input type="text" class="form-control" id="universityinstitute"  name="universityinstitute[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sUniversityinstitute']; ?>" ></th>  

            <th>  <input type="text" class="form-control" id="year"  name="year[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sYear']; ?>" ></th>  

            <th>  <input type="text" class="form-control" id="level"  name="level[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sLevel']; ?>" ></th>  

            <th>  <input type="text" class="form-control" id="accreditationBody"  name="accreditationBody[]" value="<?php if(isset($educationaldeails[$i])) echo $educationaldeails[$i]['sAccreditationBody']; ?>" ></th>       

    

    </tr>

      <?php





    }

    

    ?>

  



   

  



        </tbody>

</table> <br>                                  

 </div>

</div>





<hr><br><br>

                              <!-- end education details -->        

                                <!--   <h3 style="text-align:center;"> FAMILY DETAILS</h3><br><br><BR></BR> -->

                           <h3 style="text-align:center;"> LISTING PLAN</h3><br><br><BR></BR>

                                   <div class="col-md-12">

                                         <div class="mb-3">

                                         <table class="table table-bordered table-striped">

      <thead>

<tr>

 <th scope="col">Scheme</th>
 <th scope="col">Mode of Payment</th>
 <th scope="col">Date of Payment</th>
<th scope="col">Validity</th>

  <!-- <th scope="col">Name</th>

   <th scope="col">Relation</th>

   <th scope="col">Date of Birth</th>

   <th scope="col">Adhar No</th> -->

  

   

 </tr>

 <tr>



 </tr>

</thead>

<tbody>

 <?php



if(isset($employeeId))

{

 // $familydeatils=[];

    

   // $stmt = $link->prepare('select * from tblfamilydetails where iEmployeeFormId   = ?');

  

  $stmt = $link->prepare('select * from tbllistingplans where iVendorId= ?');

    $stmt->bind_param('i',$employeeId);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){

        $familydeatils=$row;
    }

}

 

 //for($i=0;$i<4;$i++)

 //{



   ?>

       <tr>
        <td> <select id="scheme" class="form-select" name="scheme">
                                                    <option value="">Select</option>

                                                     <option <?php if(isset($familydeatils) && $familydeatils['sScheme'] == 'Pre-Launch') echo 'selected'; ?>>Pre-Launch</option>
                                                     <option <?php if(isset($familydeatils) && $familydeatils['sScheme'] == '1 Year') echo 'selected'; ?>>1 Year</option>
                                                       <option <?php if(isset($familydeatils) && $familydeatils['sScheme'] == 'Dual Listing') echo 'selected'; ?>>Dual Listing</option>
                                                      <option <?php if(isset($familydeatils) && $familydeatils['sScheme'] == 'Multiple Listing') echo 'selected'; ?>>Multiple Listing</option>
                                                    <option <?php if(isset($familydeatils) && $familydeatils['sScheme'] == 'Complimentary') echo 'selected'; ?>>Complimentary</option></select></td>
        <td> <select id="ModeofPayment" class="form-select" name="ModeofPayment">
                                                    <option value="">Select</option>

                                                     <option <?php if(isset($familydeatils) && $familydeatils['sModeofPayment'] == 'Bank Transfer') echo 'selected'; ?>>Bank Transfer</option>
                                                     <option <?php if(isset($familydeatils) && $familydeatils['sModeofPayment'] == 'UPI') echo 'selected'; ?>>UPI</option>
                                                       <option <?php if(isset($familydeatils) && $familydeatils['sModeofPayment'] == 'Through Website') echo 'selected'; ?>>Through Website</option></select></td>
       <!--  <th>  <input type="text" class="form-control" id="familyname"  name="familyname[]" value="<?php //if(isset($familydeatils[$i])) echo $familydeatils[$i]['sFamilyName']; ?>" ></th>    

         <th>  <input type="text" class="form-control" id="familyrelation"  name="familyrelation[]" value="<?php //if(isset($familydeatils[$i])) echo $familydeatils[$i]['sFamilyRelation']; ?>" ></th> --> 

         <th>  <input type="date" class="form-control" id="dateofPayment"  name="dateofPayment" value="<?php if(isset($familydeatils)) echo $familydeatils['sDateofPayment']; ?>" ></th>  

         <th>  <input type="text" class="form-control" id="validity"  name="validity" value="<?php if(isset($familydeatils)) echo $familydeatils['sValidity']; ?>" ></th>  

          

 

 </tr>

   <?php





 //}

 

 ?>











</tbody>

</table>                                   

                                         </div>

                                     </div>



<!-- employee details organization start here -->

                                     <hr><br><br>

                                   

                                 <!--  <h3 style="text-align:center;"> EMPLOYMENT DETAILS (starting from previous organization)</h3><br><br><BR></BR> -->

                                 <h3 style="text-align:center;"> LICENSE DETAILS </h3><br><br><BR></BR>

                                   

                                   <div class="col-md-12">

                                         <div class="mb-3">

                                         <table class="table table-bordered table-striped">

      <thead>

<!-- <tr>

   

   <th  rowspan="2"  style="text-align:center;" >Organization / Company Name</th>

   <th   rowspan="2" style="text-align:center;">Designation</th>

   <th  colspan="2" style="text-align:center;">Period of Service    </th>

   <th  rowspan="2" >Salary</th>

   </tr>



   <tr>

   

   <th style="text-align:center;" >From</th>

   <th  style="text-align:center;" >To </th>

   

   </tr> -->

<tr>

   

   <th  rowspan="2"  style="text-align:center;" >Organization / Company Name</th>

   <th   rowspan="2" style="text-align:center;">License Name</th>

   <th style="text-align:center;" >Date Of Issue</th>

   <th  style="text-align:center;" >Expiry Date </th>

   <th  rowspan="2" >License Number</th>

   </tr>


 

</thead>

<tbody>

 <?php

 



 if(isset($employeeId))

 {

   //$licensedetails=[];

     

   //  $stmt = $link->prepare('select * from tblemploymentdetails where iEmployeeFormId   = ?');

     $stmt = $link->prepare('select * from tbllicense where iVendorId= ?');

     $stmt->bind_param('i',$employeeId);

     $stmt->execute();

     $result = $stmt->get_result();

     while($row = $result->fetch_assoc()){

       //  $employmentdetails[]=$row;

         $licensedetails=$row;

 

     }


     // print_r($licensedetails);
     // exit();

 }





 //for($i=0;$i<5;$i++)

 //{



   ?>

       <tr>

         <th>  <input type="text" class="form-control" id="orginiztionname"  name="orginiztionname" value="<?php if(isset($licensedetails)) echo $licensedetails['sOrginiztionname']; ?>" ></th>    

         <th>  <input type="text" class="form-control" id="licensename"  name="licensename" value="<?php if(isset($licensedetails)) echo $licensedetails['sLicenseName']; ?>" ></th>  

         <th>  <input type="date" class="form-control" id="dateofissue"  name="dateofissue" value="<?php if(isset($licensedetails)) echo $licensedetails['sDateofIssue']; ?>" ></th>  

         <th>  <input type="date" class="form-control" id="expirydate"  name="expirydate" value="<?php if(isset($licensedetails)) echo $licensedetails['sExpiryDate']; ?>" ></th>  

         <th>  <input type="text" class="form-control" id="licensenumber"  name="licensenumber" value="<?php if(isset($licensedetails)) echo $licensedetails['sLicenseNumber']; ?>" ></th>  

 
 </tr>

   <?php





 //}

 

 ?>











</tbody>

</table>                                   

                                         </div>

                                     </div>









                                     <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">ESI No: (if applicable)</label>

                                          <div class="col-sm-5">

                                          <input type="text" class="form-control" id="esino"  name="esino" value="<?php if(isset($output)) echo $output['sEsino']; ?>" >



                                       </div>

                                          </div>

                                      </div>

                                    





                                      <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">UAN No: (if applicable)</label>

                                          <div class="col-sm-5">

                                          <input type="text" class="form-control" id="uanno"  name="uanno" value="<?php if(isset($output)) echo $output['sUanno']; ?>">

                                          </div>

                                          </div>

                                      </div>



                                  <hr style="border: 1px dashed black;" /><BR></BR>







                                         

                                   <h3 style="text-align:center;">FOR HR PURPOSE ONLY</h3><br><br>



                                   <h5 style="text-align:left;">List of Documents Submitted By Vendor</h5><br><br>





                                   <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">1. Updated Profile / Biodata &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sUpdatedresume'] != "") echo "<a href='".$output['sUpdatedresume']."' target='_blank'>View</a>" ?> </label>

                                          <div class="col-sm-5">

                                                <input type="file" class="form-control" id="updatedresume"  name="updatedresume" ><br>

                                                </div>

                                          </div>

                                      </div>



                                    <!--  <div class="col-md-12">

                                          <div class="mb-3">

                                            

                                          <label for="formrow-firstname-input" class="form-label">2. Educational Certificates &nbsp;&nbsp;&nbsp;&nbsp; <?php //if(isset($output) && $output['sEducationalcertificates'] != "") echo "<a href='".$output['sEducationalcertificates']."' target='_blank'>View</a>" ?></label>

                                                <input type="file" class="form-control" id=" educationalcertificates"  name="educationalcertificates" ><br>

                                          </div>

                                      </div> -->





                                      <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">2. Pan Card  &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sPancard'] != "") echo "<a href='".$output['sPancard']."' target='_blank'>View</a>" ?></label>

                                                <input type="file" class="form-control" id="pancard"  name="pancard" ><br>

                                          </div>

                                      </div>





                                      <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">3. Aadhar Card &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sAadharcard'] != "") echo "<a href='".$output['sAadharcard']."' target='_blank'>View</a>" ?></label>

                                                <input type="file" class="form-control" id="aadharcard"  name="aadharcard" ><br>

                                          </div>

                                      </div>



                                      <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">4. Images &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sImages'] != "") echo "<a href='".$output['sImages']."' target='_blank'>View</a>" ?> </label>

                                                <input type="file" class="form-control" id="images"  name="images" ><br>

                                          </div>

                                      </div>



                                      <div class="col-md-12">

                                          <div class="mb-3">

                                          <label for="formrow-firstname-input" class="form-label">5. Bank Cheque  &nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($output) && $output['sBankCheque'] != "") echo "<a href='".$output['sBankCheque']."' target='_blank'>View</a>" ?></label>

                                                <input type="file" class="form-control" id="bankcheque"  name="bankcheque" ><br>

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

                                           // if(isset($employeeId)){

                                           //        $employeeId=$_POST['employeeId'];

                                           //        $stmt = $link->prepare('select * from tbldepartment where iEmployeeFormId=?');

                                           //        $stmt->bind_param('i',$employeeId);

                                           //        $stmt->execute();

                                           //        $result = $stmt->get_result();

                                           //        while($row = $result->fetch_assoc()){

                                           //            $output = $row;

                                           //          }

                                           //      }

                                            ?>

                                            

                                          <!--    <div class="col-md-12">

                                              <div class="mb-3">

                                              <label for="formrow-firstname-input" class="form-label">Department:</label>

                                              <div class="col-sm-5">

                                              <select id="department" name="department"  class="form-control"  >
                                                <option value="">Select</option>  
                                                <?php

                                             // $stmt = $link->prepare('select * from tbldepartment where iEmployeeFormId=0');
                                              //  $stmt->execute();
                                              //  $result = $stmt->get_result();
                                              //  while($row = $result->fetch_assoc()){
                                                    ?>
                                                    <option value="<?php  //echo $row['sDepartment']; ?>" <?php  //if((isset($output) && $output['sDepartment'] == $row['sDepartment'])  ){ echo "selected"; }  ?> ><?php //echo $row['sDepartment'];  ?></option>
                                                    <?php        
                                                        //}
                                                        ?>
                                                </select>

                                              </div>

                                              </div>

                                          </div> -->


                                           <div class="col-md-12">

                                              <div class="mb-3">

                                              <label for="formrow-firstname-input" class="form-label">Payment Verified:</label>

                                              <div class="col-sm-5">

                                              <select id="paymentverified" name="paymentverified"  class="form-control"  >
                                                <option value="">Select</option>

                                                   <option <?php if(isset($output) && $output['sPaymentVerified'] == 'Yes') echo 'selected'; ?>>Yes</option>


                                                   <option <?php if(isset($output) && $output['sPaymentVerified'] == 'No') echo 'selected'; ?>>No</option>

                                                  </select>

                                              </div>

                                              </div>

                                          </div>

                                  

                



                                     





                                  <?php

                                    //   if(isset($employeeId)){

                                    //        $employeeId=$_POST['employeeId'];

                                    //        $stmt = $link->prepare("Select * from tblunit where iEmployeeFormId=? and sUnit IN ('Intorq','ACD','PCD','HMD','Testing','Corporate Unit','NA') order by sCreatedTimestamp desc limit 1");

                                    //        $stmt->bind_param('i',$employeeId);

                                    //        $stmt->execute();

                                    //        $result = $stmt->get_result();

                                    //        while($row = $result->fetch_assoc()){

                                    //         $output = $row;

                                    //   }

                                      

                                    // }

                                     ?>

                                    <!--       <div class="col-md-12">

                                               <div class="mb-3">

                                                  <label for="formrow-firstname-input" class="form-label">Unit:</label>

                                                   <div class="col-sm-5">

                                                    <select id="formrow-inputState" class="form-select" name="unit" required>

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'Intorq') echo 'selected'; ?>>Intorq</option> 

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'ACD') echo 'selected'; ?>>ACD</option> 

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'PCD') echo 'selected'; ?>>PCD</option> 

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'HMD') echo 'selected'; ?>>HMD</option> 

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'Testing') echo 'selected'; ?>>Testing</option>

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'Corporate Unit') echo 'selected'; ?>>Corporate Unit</option>

                                                    <option <?php //if(isset($output) && $output['sUnit'] == 'NA') echo 'selected'; ?>>NA</option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div> -->


                                        <div class="col-md-12">

                                               <div class="mb-3">

                                                  <label for="formrow-firstname-input" class="form-label">City:</label>

                                                   <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="city"  name="city" value="<?php if(isset($output)) echo $output['sCity']; ?>" >



                                                  </div>

                                            </div>

                                        </div>


                                         <div class="col-md-12">

                                               <div class="mb-3">

                                                  <label for="formrow-firstname-input" class="form-label">Pin Code:</label>

                                                   <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="pincode"  name="pincode" value="<?php if(isset($output)) echo $output['sPincode']; ?>" >

                                                  </div>
                                            </div>

                                        </div>


                                        

                                      <!--  <div class="col-md-12">

                                               <div class="mb-3">

                                                  <label for="formrow-firstname-input" class="form-label">Unit Date : </label>

                                                   <div class="col-sm-5">

                                                    <input type="date" id="formrow-inputState" class="form-control" name="unitdate" value="<?php //if(isset($output) && $output['sDate'] != '') echo $output['sDate']; else echo date('Y-m-d'); ?>" required>

                                                    

                                                </div>

                                            </div>

                                        </div> -->

                                 







                              <div class="row">

                                    

                                <div class="col-md-4">

                                            <div class="mb-3">

                                                

                                            </div>

                                </div> 

                                <?php

                                        if (isset($employeeId)) {

                                    ?>

                                        <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">

                                    <?php        

                                        }

                                    ?>

                                    <div>

                                        <center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>

                                    </div>

                                    <?php 
                                  }
                                  ?>

                                  

                                    

                                </div>    

                                 

                                      

                                </div>  

                             </div>

                            </div>



                                 

                                </form>



                               

                            <?php

                    if(isset($output) && $output != "" ){

                        ?>

                        

                            <form action="AppAccess.php" method="post" target="_blank" >



                         

                            <?php if(isset($_POST['employeeId'])){ ?>

                            <input type="hidden" name="employeeId" value="<?php echo $_POST['employeeId']?>" >

                            <?php    } ?>

                            <div class="col-md-4">

                            <div class="mb-3">

                            

                    

                        <Center> <button type="submit" class="btn btn-primary w-md" name="btnPrint">App Acess</button></Center> 

                            <!-- <input type="hidden" name="btnsave" value="save" > -->

                            <br>

                        </div>

                        </div>

                        </form>

                        <?php



                    }                

                ?>

























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





</script>



</html>