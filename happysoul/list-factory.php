<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>List Factory</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 
$msg ="";
if(isset($_POST['FactoryId']))
{
	   $FactoryId  = $_POST['FactoryId']; 
            
        $stmt = $link->prepare('select * from tblfactory where iFactoryId=?');
        $stmt->bind_param('i',$FactoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){        
            $output = $row;
        }
     
}
    
    // $msg = "";

    // if (isset($_POST['WorkSheetId'])) {
        
    //     $query = "DELETE from tblworksheetforrockwell where iWorkSheetId = ?";
    //     $stmt = mysqli_prepare($link,$query);
    //     mysqli_stmt_bind_param($stmt, "i", $_POST['WorkSheetId']);
    //     $ret = mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);

    //     if (!$ret) {
    //         $msg  = "Data Not Deleted";
    //     }
    //     else{
    //         $msg  = "Data Deleted";
    //     }

    // }


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
                            <h4 class="mb-sm-0 font-size-18">List Factory</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">List Factory</a></li>
                                    <li class="breadcrumb-item active">List Factory</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <table id="datatable" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                          
                          <th>Sr No.</th>
                          
                         
                      
                          <th>Factory Name</th>         
                          <th>View Compliance</th>
                          <!-- <th>Copy Compliance</th> -->

                         
                         
                        
                    <!-- <th>Calibration By </th> -->
                     
                         
                       
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;

                            $stmt1 = $link->prepare("SELECT DISTINCT sFactoryName FROM tblfactory;");
                            // $stmt1->bind_param('s',$_SESSION['id'] );
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            <td><?php echo $count; ?></td>
                            
                            
                          
                           <td><?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?></td>
                           <td>
                              <form action="view-Compliances.php" method="post" target="_blank">
                                <input type="hidden" name="FactoryId" value="<?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnView" value="View" class="btn btn-success">View </button>
                                </form>
                            </td>
                            <!-- <td>
                              <form action="Copy-Compliances.php" method="post" target="_blank">
                                <input type="hidden" name="inwardId" value="<?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnView" value="View" class="btn btn-success">Copy</button>
                                </form>
                            </td>  -->

                        

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