<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>List Vendors</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>


<?php include 'layouts/body.php'; 

    
    $msg = "";

    if (isset($_POST['employeeId'])) {
        
        $query = "DELETE from tblvendors where iVendorId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['employeeId']);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $query = "DELETE from tbleducationaldetails where iVendorId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['employeeId']);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $query = "DELETE from tbllistingplans where iVendorId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['employeeId']);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $query = "DELETE from tbllicense where iVendorId = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "i", $_POST['employeeId']);
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
                            <h4 class="mb-sm-0 font-size-18">List Vendor</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor</a></li>
                                    <li class="breadcrumb-item active">List Vendor</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Sr No.</th>
                          <th>Vendor Code</th>
                          <th>Category</th>
                          <th>Date of Joining</th>
                          <th>Name</th>
                          <th>Mobile Number</th>
                          <th>Email ID</th>
                          <!-- <th>Percent Payable</th> -->
                          <!-- <th>Type</th> -->
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php 
                            $count = 0;


                           if($_SESSION["usertype"] == 'Admin'){
                            $stmt1 = $link->prepare("Select * from tblvendors");
                             
                           }

                          else if($_SESSION['usertype'] == 'Contractor'){
                            $stmt1 = $link->prepare("Select * from tblvendors where iCreatedBy=?");
                            $stmt1->bind_param('i',$_SESSION['id']);
                           }

                        
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            
                            <td><?php echo htmlentities($count, ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sVendorCode'], ENT_QUOTES);?></td>
                            <td>
                                <?php echo htmlentities($row1['sCategory'], ENT_QUOTES); ?>
                                
                              <!-- <a href="<?php  //echo $row1['sPDFUrl']; ?>" class="btn btn-warning" target="_blank" >View</a> -->
                            </td>
                            <td><?php echo htmlentities($row1['sDateofjoining'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlentities($row1['sName'], ENT_QUOTES); ?></td>
                             <td><?php echo htmlentities($row1['sMobilenumber'], ENT_QUOTES); ?></td>
                             <td><?php echo htmlentities($row1['sEmailid'], ENT_QUOTES); ?></td>

                                <td>
                              <form action="add-Vendors.php" method="post">
                                <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iVendorId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btnedit" value="Edit" class="btn btn-success">Edit</button>
                                </form>
                            </td>

                             <td>  <form action="list-Vendors.php" method="post">
                                <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iVendorId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btndelelte" value="edit" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                                </form></td>
                            
                            

                         

                           
                              <!-- <form action="list-notification.php" method="post">
                                <input type="hidden" name="notificationid" value="<?php //echo htmlentities($row1['iNotificationId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btndelelte" value="Edit" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                                </form> -->
                           
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