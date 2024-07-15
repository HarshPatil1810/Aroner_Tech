<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>



<head>
    <title>view Contractor Registration Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

?>

<?php
$msg ="";
if(isset($_POST['inwardId']))
{
	$contractorId  = $_POST['inwardId']; 
            
        $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId =?');
        $stmt->bind_param('i',$contractorId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){        
            $output = $row;
        }
     
}

?>


<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/vertical-menu - 3.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <!--<div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Vender Registration Form</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vender Registration Form</a></li>
                                    <li class="breadcrumb-item active">View Vender Registration Form</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
               

                <div class="">
   
                <div class="row" >
                <!--<div class="col-xl-3" ></div>-->
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                                <h4>Contractor Information:</h4><br>
                                
                                <form action="contractor-registration-form.php" method="post" enctype="multipart/form-data" >

                               
                                       
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        <div>                 
                                    </div>

                                </div>
                                <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name"  name="name" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sName']; ?>" readonly>
                                            </div>
                                        </div>
                                       
                                       
                                    <div class="row">
                                        
                                   

                                        <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Contact Number</label>
                                              <input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNumber']; ?>" required>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Address</label>  
                                                <textarea type="text" class="form-control" name = "address" id="address" placeholder=" Address" ><?php if(isset($output)) echo $output['sAddress']; ?></textarea>                   
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
                                    <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">ESI Registration Certification </label><br>
                                                <img src="<?php if(isset($output)) echo $output['sEsiregistrationcetifiaction']; ?>" width="200px" height="200px"><br>
                                                           
                                                <!--<input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" value="<?php if(isset($output)) echo $output['sCancelledChequeCopy']; ?>" readonly><br>-->

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">EPF Registration Certification </label><br>
                                                <img src="<?php if(isset($output)) echo $output['sEpfregistrationcertifcation']; ?>" width="200px" height="200px"><br>
                                                           
                                                <!--<input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" value="<?php if(isset($output)) echo $output['sCancelledChequeCopy']; ?>" readonly><br>-->

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> </label><br>
                                                <img src="<?php if(isset($output)) echo $output['sContractlabouractregistrationcertification']; ?>" width="200px" height="200px"><br>
                                                           
                                                <!--<input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" value="<?php if(isset($output)) echo $output['sCancelledChequeCopy']; ?>" readonly><br>-->

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
                                                <input type="text" class="form-control" id="ifscCode"  name="ifscCode" value="<?php if(isset($output)) echo $output['sIFSCCode']; ?>" onblur="getBankData(this.value)" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control" id="bankname"  name="bankname" value="<?php if(isset($output)) echo $output['sBankName']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Branch</label>
                                                <input type="text" class="form-control" id="branch"  name="branch" value="<?php if(isset($output)) echo $output['sBranch']; ?>" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Account No</label>
                                                <input type="text" class="form-control" id="accountno"  name="accountno" value="<?php if(isset($output)) echo $output['sAccountNo']; ?>" readonly>
                                            </div>
                                        </div>

                                       
                                        </div>
                        
                                </div>

                               

                                <div class="row">
                                    
                                    
                                <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Contract Renewal Date</label>
                                                <input type="text" step="0.001" class="form-control" id="contractrenewaldate"  name="contractrenewaldate" value="<?php if(isset($output)) echo $output['sContractrenewaldate']; ?>" readonly>
                                            </div>
                                </div> 
                                      
                                </div>  
                             </div>

                             

                                  <!--<?php
                                        if (isset($venderId)) {
                                    ?>
                                        <input type="hidden" name="venderId" value="<?php echo $venderId; ?>">
                                    <?php        
                                        }
                                    ?>-->
                                    <div>
                                       <!--  <center><button type="submit" class="btn btn-primary w-md" name="btnsave" onclick="getCompanyCode()" >Save</button></center>-->
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

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- <script src="assets/js/pages/dashboard.init.js"></script> -->

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>