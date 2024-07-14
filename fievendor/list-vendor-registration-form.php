<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>List Vender Registration Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

    
    $msg = "";

    if (isset($_POST['btndelelte'])){
        
        $query = "DELETE from tblvendorregform where iVendorRegFormId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['venderId']);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$ret) {
            $msg  = "Data Not Deleted";
        }
        else{
            $msg  = "Data Deleted";
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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Vendors List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vendors List</a></li>
                                    <li class="breadcrumb-item active">Vendors List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
               

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Sr No</th>
                          <th>Company Code</th>
                          <th>Name of Company</th> 
                          <th>GST No</th>
                          <th>PAN Card No</th>
                          
                          <!--<th>Year of Establishment </th>
                          <th>Nature of Company Ownership</th>
                          <th>Name of Promoters/Directors/Proprietor</th>
                          <th>Registration Address</th>
                          <th>Communication Address</th>
                          <th>Annual Turnover</th>
                          <th>Number of Offices / Manufacturing Units</th>-->
                          <th>Contact Person Name</th>
                          <th>Contact Number</th>
                          <!--<th>Designation</th>
                          <th>Email ID</th>
                          <th>IFSC Code</th>
                          <th>Bank Name</th>
                          <th>Branch</th>
                          <th>Account No</th>
                          <th>Cancelled Cheque Copy</th>
                          <th>Monthly Volumes Handled (Teus)</th>
                          <th>MSME Registration No</th>-->
                          <th>View</th>
                          <th>Delete</th>
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;
                            $stmt1 = $link->prepare("Select * from tblvendorregform");
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            <td><?php echo htmlentities($count) ?></td>
                            <td><?php echo htmlentities($row1['sCompanyCode'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sCompanyName'], ENT_QUOTES);?></td>
                            <!--<td><?php// echo date('d/m/Y',strtotime($row1['sDate']));?></td>-->
                            <td><?php echo htmlentities($row1['sGSTNo'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sPANNo'], ENT_QUOTES);?></td>
                            
                           <!-- <td><?php //echo htmlentities($row1['sEstablishment'], ENT_QUOTES);?></td>
                            <td><?php// echo htmlentities($row1['sCompanyOwnership'], ENT_QUOTES);?></td>
                            <td><?php// echo htmlentities($row1['sPromotersDirectorsProprietor'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sRegistrationAddress'], ENT_QUOTES);?></td>
                            <td><?php// echo htmlentities($row1['sCommunicationAddress'], ENT_QUOTES);?></td>
                            <td><?php// echo htmlentities($row1['sAnnualTurnover'], ENT_QUOTES);?></td>
                            <td><?php// echo htmlentities($row1['sNoOfOffices'], ENT_QUOTES);?></td>-->
                            <td><?php echo htmlentities($row1['sContactPersonName'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sContactNo'], ENT_QUOTES);?></td>
                          <!--   <td>//<?php echo htmlentities($row1['sDesignation'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sEmail'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sIFSCCode'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sBankName'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sBranch'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sAccountNo'], ENT_QUOTES);?></td>
                            <td><a href="<?php if($row1['sCancelledChequeCopy'] == NULL || $row1['sCancelledChequeCopy'] == '') echo "javascript:void(0)";
                                else echo $row1['sCancelledChequeCopy']; ?>" <?php if($row1['sCancelledChequeCopy'] == NULL || $row1['sCancelledChequeCopy'] == '') ;
                                else echo 'target="_blank"'; ?>>View</a></td>
                            <!--<td><?php //echo htmlentities($row1['sCancelledChequeCopy'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sMonthlyVolumesHandled'], ENT_QUOTES);?></td>
                            <td><?php //echo htmlentities($row1['sMSMERegNo'], ENT_QUOTES);?></td>-->
                            


                            <td>
                              <form action="view-vendor-registration-form.php" method="post" target="_blank">
                                <input type="hidden" name="inwardId" value="<?php echo htmlentities($row1['iVendorRegFormId'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnView" value="View" class="btn btn-success">View</button>
                                </form>
                            </td>
                            <td>
                              <form action="list-vendor-registration-form.php" method="post">
                                <input type="hidden" name="venderId" value="<?php echo htmlentities($row1['iVendorRegFormId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            
                        </tr>

                        <?php 
                            }
                        ?> 
                       
                    </tbody>
                </table> 

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