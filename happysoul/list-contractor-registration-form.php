<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>List Agent Registration Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

    
    $msg = "";

    if (isset($_POST['btndelelte'])){
        
        $query = "DELETE from tblcontractorregform where iContractorRegFormId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['contractorId']);
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
                            <h4 class="mb-sm-0 font-size-18">LIST AGENTS</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Agent Registration Form</a></li>
                                    <li class="breadcrumb-item active">List Agents</li>
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
                         <th>Name </th> 
                         <th>Contact Number</th>
                         <th>Address</th>
                         <!--<th>Agent Renewal Date</th>-->
                         <th>Email ID</th>
                         <th>Contract Renewal Date</th>
                            <th>Edit</th>
                          <th>Delete</th>
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;
                            $stmt1 = $link->prepare("Select * from tblcontractorregform");
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            <td><?php echo htmlentities($count) ?></td>
                          
                          
                            <td><?php echo htmlentities($row1['sName'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sContactNumber'], ENT_QUOTES);?></td>
                            
                            <td><?php echo htmlentities($row1['sAddress'], ENT_QUOTES);?></td>

                            <td><?php echo htmlentities($row1['sEmail'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities( date('d-m-Y', strtotime($row1['sContractrenewaldate'])));?></td>

                            

                            <!-- <td>
                              <form action="view-contractor-registration-form.php" method="post" target="_blank">
                                <input type="hidden" name="inwardId" value="<?php echo htmlentities($row1['iContractorRegFormId'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnView" value="View" class="btn btn-success">View</button>
                                </form>
                            </td> -->

                            <td>
                 
                 <form action="contractor-registration-form.php" method="post">
                 <input type="hidden" name="contractorId" value="<?php echo htmlentities($row1['iContractorRegFormId'], ENT_QUOTES);?>">

                     <button type="submit" name="btnedit" value="Edit" onclick="return confirm('Are you sure you want to edit this Data?');" class="btn btn-warning" >Edit</button>
                 </form>
             </td>
                                 

                            <td>

                              <form action="list-contractor-registration-form.php" method="post">
                                <input type="hidden" name="contractorId" value="<?php echo htmlentities($row1['iContractorRegFormId'], ENT_QUOTES);?>">
                                 
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