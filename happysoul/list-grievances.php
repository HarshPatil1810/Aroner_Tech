<?php include 'layouts/session.php';
include 'layouts/config.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
    <title>List Grievances</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 


if(isset($_POST['btnResolved'])){
    $id = $_POST['id'];
    
     $query = "update tblcomplaint set sStatus = 'Resolved',sStatusChangeBy = ?,sStatusChangeTime = NOW() where iComplaintId  = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ii",$_SESSION['id'],$id);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

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
                 <!-- start page title -->
                 <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">List Grievances</h4>
                        </div>
                    </div>
                </div>
                        
             
              

                      <!-- end page title -->
             <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Name</th>
                           <th>Description</th>
                           <th>Photo</th>
                           <th>Status</th>
                           <th>Mark</th>
                           <!--<th>Unit</th>-->
                           <!--<th>Date Of Birth</th>-->
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php
                        $count = 0;      
                        
                            $stmt1 = $link->prepare("SELECT * FROM tblcomplaint order by sStatus,sCreatedTimestamp");
                        
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();
                        while ($row1 = $result1->fetch_assoc()){
                        $count++;


                                   // $count = 0;
                                    // $stmt1 = $link->prepare("Select * from tblemployeejoiningform where MONTH(sDateofbirth) = MONTH(CURDATE()) and DAY(sDateofbirth) = DAY(CURDATE());");
                                    // $stmt1->execute();
                                    // $result1 = $stmt1->get_result();
                                    // while ($row1 = $result1->fetch_assoc()){
                                    //  $count++;
                        ?>

                        <tr>
                            <td><?php echo htmlentities($count) ?></td>
                            <td><?php echo htmlentities($row1['sName'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sDescription'], ENT_QUOTES);?></td>
                           <td><?php 
                            if($row1['sImage'] != ""){
                                ?>
                                    <a href="<?php echo $row1['sImage']; ?>" target="_blank">View</a>
                                <?php
                            }
                           ?></td>
                          
                     <td><?php echo htmlentities($row1['sStatus'], ENT_QUOTES);?></td>
                    <td>
                        <?php if($row1['sStatus'] == "Pending"){ ?>
                        <form action="list-grievances.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row1['iComplaintId'] ?>"/>
                            <input type="submit" name="btnResolved" value="Resolved" class="btn btn-success"/>
                            
                        </form>
                        <?php } ?>
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