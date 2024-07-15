<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>Factory Report</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

$msg = "";

// Rest of your PHP code...

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

            
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">List Current Year Compliance Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Current Year Compliance Report</a></li>
                                    <li class="breadcrumb-item active">List Current Year Compliance Report</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div> -->
              
               
                <!-- -->
                <?php
                $stmt1 = $link->prepare("SELECT distinct(sFactoryName)   FROM tblfactory ");
                $stmt1->execute();
                $result1 = $stmt1->get_result();

                while ($row1 = $result1->fetch_assoc()) {
                ?>
                    <div>
                        <h4><?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES); ?></h4>
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Act</th>
                                    <th>Compliance</th>
                                    <th>Date</th>
                                    <th>Due Date</th>
                                    <th>Cost</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                $stmt2 = $link->prepare("SELECT * FROM tblfactory WHERE sFactoryName = ?");
                                $stmt2->bind_param('s', $row1['sFactoryName']);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();

                                while ($row2 = $result2->fetch_assoc()) {
                                    $count++;
                                ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                    
                                        <td><?php 
                             
                             $stmt = $link->prepare("SELECT * from tblact where iActId in (select sActName from  tblcompliance where iComplianceId =?)");
                             $stmt->bind_param('i',$row2['iComplianceID']);
                             $stmt->execute();
                             $result = $stmt->get_result();
                             while ($row = $result->fetch_assoc()){        
                                 echo htmlentities($row['sActName'], ENT_QUOTES);
                             }   

                    ?></td>
                            
                                        <td><?php 

                            
                             $stmt3 = $link->prepare("Select * from tblcompliance  where iComplianceId =?");
                             $stmt3->bind_param('i',$row2['iComplianceID']);
                             $stmt3->execute();
                             $result3 = $stmt3->get_result();
                             while ($row3 = $result3->fetch_assoc()){
                               echo htmlentities($row3['sName'],ENT_QUOTES);
                             
                           }
                            // echo htmlentities($row1['sName'], ENT_QUOTES);
                            ?></td>
                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row2['sDate'])), ENT_QUOTES);?></td>
                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row2['sDueDate'])), ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row2['sCost'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row2['sRemark'], ENT_QUOTES);?></td>
                           
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>

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