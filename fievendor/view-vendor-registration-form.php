<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>



<head>
    <title>View Vender Registration Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

?>

<?php
$msg ="";
if(isset($_POST['inwardId']))
{
	$venderId  = $_POST['inwardId']; 
            
        $stmt = $link->prepare('select * from tblvendorregform where iVendorRegFormId =?');
        $stmt->bind_param('i',$venderId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){        
            $output = $row;
        }
     
}

?>


<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/vertical-menu - 4.php'; ?>

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
                                <h4>Company Information:</h4><br>
                                
                                <form action="vendor-registration-form.php" method="post" enctype="multipart/form-data" >

                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Company Code</label>
                                                <input type="text" class="form-control" id="panno"  name="panno" style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sCompanyCode']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                       
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-model-input" class="form-label">GST No</label>                                   
                                                <!--<input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="checkbox" onclick="check()">
                                                <label class="form-check-label" for="flexCheckDefault">GST is not applicable</label>-->                         
                                                <input type="text" class="form-control" id="gstno" name="gstno"  style="text-transform:uppercase" value="<?php if(isset($output)) echo $output['sGSTNo']; ?>" onblur="showPAN(this.value)" readonly > 
                                                
                                                <!--<button type="button" class="fa fa-search btn btn-info" style="margin-top:-32px; margin-left:280px;" name="search" onclick="getGST(document.getElementById('gstno').value)">Search</button>-->
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
                                                <input type="text" class="form-control" id="companyname"  name="companyname" value="<?php if(isset($output)) echo $output['sCompanyName']; ?>" readonly>
                                            </div>
                                        </div>

                                          
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Year of Establishment</label>
                                                <input type="text" class="form-control" id="establishment"  name="establishment" value="<?php if(isset($output)) echo $output['sEstablishment'];?>" readonly>
                                            </div>
                                        </div>

                                          <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label" >Nature of Company Ownership </label>
                                                <label for="formrow-password-input" class="form-label" style="line-height: 0.5;"> (whether Proprietorship, Partnership, Private Ltd.. Etc) </label>
                                                <input type="text" class="form-control" id="companyownership"  name="companyownership" value="<?php if(isset($output)) echo $output['sCompanyOwnership']; ?>" readonly>
                                            </div>
                                        </div>               
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name of Promoters/Directors/Proprietor</label>
                                                <input type="text" class="form-control" id="promotersname"  name="promotersname" value="<?php if(isset($output)) echo $output['sPromotersDirectorsProprietor']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Registration Address</label>  
                                                <textarea type="text" class="form-control" name = "registrationaddress" id="registrationaddress" placeholder="Registration Address" readonly><?php if(isset($output)) echo $output['sRegistrationAddress']; ?></textarea >                   
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Registration Address Line 2</label>  
                                                <input type="text" class="form-control" name = "registrationaddressline2" id="registrationaddressline2" placeholder="Address Line 2 " value="<?php if(isset($output)) echo $output['sAddressLine2']; ?>" readonly>                   
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Registration Address Line 3</label>  
                                                <input type="text" class="form-control" name = "registrationaddressline3" id="registrationaddressline3" placeholder="Address Line 3 " value="<?php if(isset($output)) echo $output['sAddressLine3']; ?>" readonly>                   
                                            </div>
                                        </div>


                                       

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">City</label>  
                                                <input type="text" class="form-control" name = "city" id="city" placeholder="City " value="<?php if(isset($output)) echo $output['sCity']; ?>" readonly>                   
                                            </div>
                                        </div>  

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">State</label>  
                                                <input type="text" class="form-control" name = "state" id="state" placeholder="state " value="<?php if(isset($output)) echo $output['sState']; ?>" readonly>                   
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Pin Code</label>  
                                                <input type="text" class="form-control" name = "pin" id="pin" placeholder="Pin Code " value="<?php if(isset($output)) echo $output['sPinCode']; ?>" readonly>                   
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Communication Address</label> 
                                                    <label for="formrow-model-input" class="form-label"></label>
                                                <!-- <input class="form-check-input"  style="margin-left:20px;" type="checkbox" value="" id="ckeck" onclick="showAdd()">
                                                   <!-- <label class="form-check-label" for="flexCheckDefault">Same As Registration Address</label>-->
                                                <textarea type="text" class="form-control" name = "communicationaddress" id="communicationaddress" placeholder="Communication Address" readonly><?php if(isset($output)) echo $output['sCommunicationAddress']; ?></textarea>                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Annual Turnover</label>
                                                <input type="number" class="form-control" id="annualturnover"  name="annualturnover" value="<?php if(isset($output)) echo $output['sAnnualTurnover']; ?>" onblur="showMSME(this.value)" readonly>
                                            </div>
                                        </div>
                                    </div> 
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Number of Offices / Manufacturing Units</label>
                                                <input type="text" class="form-control" id="officeno"  name="officeno" value="<?php if(isset($output)) echo $output['sNoOfOffices']; ?>" readonly><br>
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
                                              <input type="text" class="form-control" id="contactpersonname"  name="contactpersonname" value="<?php if(isset($output)) echo $output['sContactPersonName']; ?>" readonly>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Contact Number</label>
                                              <input type="text" class="form-control" id="contactnumber"  name="contactnumber" value="<?php if(isset($output)) echo $output['sContactNo']; ?>" readonly>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Designation</label>
                                              <input type="text" class="form-control" id="designation"  name="designation" value="<?php if(isset($output)) echo $output['sDesignation']; ?>" readonly>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Email ID</label>
                                              <input type="text" class="form-control" id="email"  name="email" value="<?php if(isset($output)) echo $output['sEmail']; ?>" readonly><br>
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

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Cancelled Cheque Copy </label><br>
                                                <img src="<?php if(isset($output)) echo $output['sCancelledChequeCopy']; ?>" width="100%" height=" " readonly><br>
                                                           
                                                <!--<input type="file" class="form-control" id="cancelledchequecopy"  name="cancelledchequecopy" value="<?php if(isset($output)) echo $output['sCancelledChequeCopy']; ?>" readonly><br>-->

                                            </div>
                                        </div>
                        
                                </div>

                                <h4>Other Information:</h4>

                                <div class="row">
                                    
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Monthly Volumes Handled (Teus)</label>
                                              <input type="text" class="form-control" id="monthlyvolumeshandled"  name="monthlyvolumeshandled" value="<?php if(isset($output)) echo $output['sMonthlyVolumesHandled'];?>" readonly>
                                          </div>
                                      </div>

                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">MSME Registration No</label>
                                              <input type="text" class="form-control" id="msme" style="text-transform:uppercase"  name="msme" value="<?php if(isset($output)) echo $output['sMSMERegNo']; ?>" readonly>
                                          </div>
                                      </div> 
                                      
                                      
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Unit</label>
                                              <input type="text" class="form-control" id="msme" style="text-transform:uppercase"  name="msme" value="<?php if(isset($output)) echo $output['sUnit']; ?>" readonly>
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