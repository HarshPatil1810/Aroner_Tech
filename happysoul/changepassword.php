<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>




<?php
 
$msg = "";
$msgc = "";
$msgs = "";
$msgo = "";
$o = "";


if(isset($_POST['btnsave'])) {

    // if(isset($_GET['msgs']) && $_GET['msgs'] == 'password_updated') {
       
    // }
  
    $opass = $_POST['opassword'];
    $npass = $_POST['npassword'];
    $cpass = $_POST['cpassword'];

    // Validate input
    if(empty($opass) || empty($npass) || empty($cpass)) {
        $msg = "Please fill in all fields.";
    } elseif($npass !== $cpass) {
        $msgc = "New passwords do not match.";
    } else {
        

        
        $stmt = $link->prepare('SELECT sPassword, iContractorRegFormId FROM tblcontractorregform WHERE sName = ?');
        $stmt->bind_param('s', $_SESSION['username']);
        
        $stmt->execute();
        $result = $stmt->get_result();

        
        if($row = $result->fetch_assoc()) {
            $currentPasswordHash = $row['sPassword'];
            $contractorId = $row['iContractorRegFormId'];

            
            if(password_verify($opass, $currentPasswordHash)) {
                
                $hashedPassword = password_hash($npass, PASSWORD_DEFAULT);

               
                $updateStmt = $link->prepare('UPDATE tblcontractorregform SET sPassword = ? WHERE iContractorRegFormId = ?');
                $updateStmt->bind_param('si', $hashedPassword, $contractorId);
                if($updateStmt->execute()) {
                  $msgs="Password updated successfully.";
                //   echo '<script>alert("Password Updated");</script>';
                //   header("Location:index.php");
                 
                 // exit();
                } else {
                    $msg = "Error updating password: " . $updateStmt->error;
                }
            } else {
                $msgo = "Incorrect old password.";
            }
        } else {
            $msgo = "User not found.";
        }

       
        $stmt->close();
        if(isset($updateStmt)) {
            $updateStmt->close();
        }
       
    }
 
//    if(isset($msgs))
//    {
//     echo '<script>alert("Password Updated");</script>';
//     header("Location: index.php");
//    }
}
?>








<head>
    <title>Change Password Form</title>
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
                            <h4 class="mb-sm-0 font-size-18"> Change Password </h4>
                            

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Change Password</a></li>
                                    <li class="breadcrumb-item active">Change Password</li>
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
                                <h4>Change Password:</h4><br>
                                
                <form action="changepassword.php" method="post" enctype="multipart/form-data"  >
                                    <div class="row">
                                        <div class="col-md-6">
                                           
                                        <div>                 
                                    </div>

                                </div>

                                    

                                    <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Old Password</label>
                                            <input type="password" class="form-control" id="opassword"  name="opassword"  required>
                                            <span style="color:red;"><?php echo $msgo; ?></span>
                                          </div>
                                      </div>
                                       
                                    <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">New Password</label>  
                                                <input type="password" class="form-control" id="npassword"  name="npassword" required>    
                                                     
                                            </div>
                                        </div>
                                       
                                  
                                        <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Confirm Password</label>
                                              <input type="password" class="form-control" id="cpassword"  name="cpassword"  required >
                                              <span style="color:red;"><?php echo $msgc; ?></span>  <br>
                                          </div>
                                          <span style="color:green;"><?php echo $msgs; ?></span> 
                                     
                                      </div>

                                     
                                     
                                     

                                    <div>
                                 
                                <center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>
                                
                                    </div>
                                  
                                    
                                </div>     
                                      
                                </div>  
                             </div>

                                 
                                      
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
        if(document.getElementById("npassword").value !== document.getElementById("cpassword").value){
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