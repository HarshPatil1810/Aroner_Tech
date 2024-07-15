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
            
        $stmt = $link->prepare('select * from tblfactory where sFactoryName=?');
        $stmt->bind_param('s',$FactoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){        
            $output = $row;
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
                        <?php         
                            $count = 0;

                            $stmt1 = $link->prepare('select DISTINCT sFactoryName from tblfactory  where sFactoryName=?');
                            $stmt1->bind_param('s',$FactoryId);
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>
                            <h4 class="mb-sm-0 font-size-18"><?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?></h4>
                        <?php
                            }
                            ?>
                           

                        </div>
                    </div>
                    <hr>
                </div>
        
                
                <!-- end page title -->

            
                                <?php
                                            $count = 0;

                                            $stmt1 = $link->prepare('SELECT * FROM tblfactory WHERE sFactoryName=?');
                                            $stmt1->bind_param('s', $FactoryId);
                                            $stmt1->execute();
                                            $result1 = $stmt1->get_result();

                                            while ($row1 = $result1->fetch_assoc()){
                                                $count++;

                                                
                                                $complianceName = '';
                                                $stmtCompliance = $link->prepare('SELECT sName FROM tblcompliance WHERE iComplianceId=?');
                                                $stmtCompliance->bind_param('i', $row1['iComplianceID']);
                                                $stmtCompliance->execute();
                                                $resultCompliance = $stmtCompliance->get_result();
                                                if ($rowCompliance = $resultCompliance->fetch_assoc()) {
                                                    $complianceName = htmlentities($rowCompliance['sName'], ENT_QUOTES);
                                                }
                                            ?>

                                           <br>
                                             <h6><b><?php echo " ".$complianceName;?></b></h6> 
                                        
                                           

                                        
                                            <table id="datatable_<?php echo $count; ?>" class="table table-bordered table-striped" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Act Name</th>   
                                                        <th>Compliance</th>
                                                        <th>Date</th>
                                                        <th>DueDate</th>
                                                        <th>Cost</th>    
                                                        <th>Remark</th>  
                                                    </tr>  
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php 
                                                            $stmt = $link->prepare("SELECT * FROM tblact WHERE iActId IN (SELECT sActName FROM tblcompliance WHERE iComplianceId = ?)");
                                                            $stmt->bind_param('i', $row1['iComplianceID']);
                                                            $stmt->execute();
                                                            $result = $stmt->get_result();
                                                            while ($row = $result->fetch_assoc()){        
                                                                echo htmlentities($row['sActName'], ENT_QUOTES);
                                                            }   
                                                        ?></td>
                                                        <td><?php echo $complianceName; ?></td>
                                                        <td><?php echo htmlentities($row1['sDate'], ENT_QUOTES);?></td>
                                                        <td><?php echo htmlentities($row1['sDueDate'], ENT_QUOTES);?></td>
                                                        <td><?php echo htmlentities($row1['sCost'], ENT_QUOTES);?></td>
                                                        <td><?php echo htmlentities($row1['sRemark'], ENT_QUOTES);?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                           

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