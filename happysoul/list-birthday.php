<?php include 'layouts/session.php';
include 'layouts/config.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
    <title>List of Today's Birthday</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

    
   


   

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
                            <h4 class="mb-sm-0 font-size-18">List of Today's Birthday</h4>
                        </div>
                    </div>
                </div>
                        
             
                        <form action="list-birthday.php" method="post" enctype="multipart/form-data"  >
                            <div class="col-md-12 row">
                                        
                                            <div class="col-md-3">
                                               <label for="from_date">From Date:</label>
                                                <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo isset($_POST['filter']) ? $_POST['from_date'] : date('Y-m-d'); ?>">
                                            </div>

                                            <div class="col-md-3">
                                            <label for="to_date">To Date:</label>
                                            <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo isset($_POST['filter']) ? $_POST['to_date'] : date('Y-m-d'); ?>">
                                            </div>
                                    
                                            <div class="col-md-4">
                                             <button type="submit" name="filter" class="btn btn-primary mt-4">Filter</button>
                                            </div>
                       </div>
                                </form>
              

                      <!-- end page title -->
             <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Name</th>
                           <th> Mobile Number</th>
                           <th>Email ID</th>
                           <th>Unit</th>
                           <th>Date Of Birth</th>
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php
                        $count = 0;      
                        if(isset($_POST['filter'])) {
                            $from_date = $_POST['from_date'];
                            $to_date = $_POST['to_date'];
                            $stmt1 = $link->prepare("SELECT *
                            FROM tblemployeejoiningform
                            WHERE DATE_FORMAT(sDateofbirth, '%m-%d') BETWEEN DATE_FORMAT(?, '%m-%d') AND DATE_FORMAT(?, '%m-%d')
                            ORDER BY MONTH(sDateofbirth), DAY(sDateofbirth); ");
                            $stmt1->bind_param("ss", $from_date, $to_date);
                        } else {
                            $stmt1 = $link->prepare("SELECT * FROM tblemployeejoiningform WHERE MONTH(sDateofbirth) = MONTH(CURDATE()) AND DAY(sDateofbirth) = DAY(CURDATE())");
                        }
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
                            <td><?php echo htmlentities($row1['sMobilenumber'], ENT_QUOTES);?></td>
                           <td><?php echo htmlentities($row1['sEmailid'], ENT_QUOTES);?></td>
                           <td><?php 
                             

                             $stmt2 = $link->prepare("Select * from tblunit  where iEmployeeFormId=? order by sCreatedTimestamp desc limit 1 ");
                             $stmt2->bind_param('i',$row1['iEmployeeFormId']);
                             $stmt2->execute();
                             $result2 = $stmt2->get_result();
                             while ($row2 = $result2->fetch_assoc()){
                               echo htmlentities($row2['sUnit'],ENT_QUOTES);
                             
                           }
                           
                         
                           ?></td>
                           <td><?php echo date('d/m/Y',strtotime($row1['sDateofbirth']));?>
                      </td>  
                     




                            <td>

                              <form action="list-birthday.php" method="post">
                                <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">
                                  <!-- <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button> -->
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