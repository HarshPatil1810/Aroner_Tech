<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>

            <?php
            if(isset($_POST['btnsave']) && isset($_POST['FactoryId']) ){

            // for this code used for update Query
            // vendor id  used to required  fetch id 
                $FactoryId   = $_POST['FactoryId'];
                $FactoryName = $_POST['FactoryName'];
                $ComplianceID = $_POST['ComplianceID'];
              
                $Date = $_POST['Date'];
                $DueDate = $_POST['DueDate'];
                $Cost = $_POST['Cost'];
                $Remark = $_POST['Remark'];
            
                
            
                $query = "update tblfactory set sFactoryName=?, iComplianceID=?,sDate=?,sDueDate=?,sCost=?,sRemark=? where iFactoryId=?";
                $stmt = mysqli_prepare($link,$query);
                mysqli_stmt_bind_param($stmt,"ssssssi",$FactoryName,$ComplianceID,$Date,$DueDate,$Cost ,$Remark,$FactoryId);
                $ret = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if(!$ret){
                    $msg= "Data Not Saved";
                }else{
                    $msg= "Data  Saved";
                    // header("location:list.php");
                    echo "<script>window.location.href = 'add-factory-compliance.php';</script>";
                }
                }

            else if (isset($_POST['btnsave']))
            {
                // on submit button work insert program run and data added to the database
                $FactoryName = $_POST['FactoryName'];
                $ComplianceID = $_POST['ComplianceID'];
                $Date = $_POST['Date'];
                $DueDate = $_POST['DueDate'];
                $Cost = $_POST['Cost'];
                $Remark = $_POST['Remark'];
           

                $query="insert into tblfactory (sFactoryName,iComplianceID,sDate,sDueDate,sCost,sRemark) values (?,?,?,?,?,?)";
                $stmt=mysqli_prepare($link,$query);
                mysqli_stmt_bind_param($stmt,"ssssss",$FactoryName,$ComplianceID,$Date, $DueDate,$Cost,$Remark);
                $ret= mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if(!$ret)
                {
                    $msg="not saved";
                }
                else
                {
                    // header("location:list.php");
                    echo "<script>window.location.href = 'add-factory-compliance.php';</script>";
                }
                
            }
            else if (isset($_POST['btndelelte'])){
                    
                $query = "DELETE from tblfactory where iFactoryId=?";
                $stmt = mysqli_prepare($link,$query);
                mysqli_stmt_bind_param($stmt, "i", $_POST['FactoryId']);
                $ret = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if (!$ret) {
                    $msg  = "Data Not Deleted";
                }
                else{
                    $msg  = "Data Deleted";
                }

            }

            // this  below code is use for only id fetching using row 
            if(isset($_POST['FactoryId'])){
                $FactoryId  = $_POST['FactoryId'];
                
                $stmt = $link->prepare('select * from tblfactory  where iFactoryId=?');
                $stmt->bind_param('i',$FactoryId);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    
                    $output = $row;
                }
            }


            ?>

<?php include 'layouts/head-main.php'; ?>

<head>
<title>Add Factory Compliance</title>
<?php include 'layouts/head.php'; ?>
<?php include 'layouts/head-style.php'; ?>
</head>

<?php 

include 'layouts/body.php'; 

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
                            <h4 class="mb-sm-0 font-size-18">add compliances</h4>
                            

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">compliances</a></li>
                                    <li class="breadcrumb-item active">add compliances</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title mb-4">Form Gractid Layout</h4> -->
                             
                                <form action="add-factory-compliance.php" method="post" enctype="multipart/form-data">
                                    <div class="row">


                                    <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> Factory Name  </label>
                                                <input type="text" class="form-control" for="formrow-firstname-input" name="FactoryName" value="<?php if(isset($output)) echo $output['sFactoryName']; ?>" required>
                                            </div>
                                        </div>
                                      
                                        <h5 style="text-align:LEFT;"> Compliance Details :</h5><br><br> 
                                       
                                       
                                        <div class="col-md-4">
                                        <label for="formrow-firstname-input" class="form-label"> Compliances  Name </label>
                                                            <select class="form-control"name="ComplianceID"  >
                                        <option value="0"></option>
                                            <?php
                                            $stmt = $link->prepare('select * from tblcompliance ');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while($row = $result->fetch_assoc()){
                                        
                                            ?>
                                            <option value="<?php echo $row['iComplianceId'];?>" <?php if (isset($output) && $output['iComplianceID'] == $row['iComplianceId']) echo "Selected"; ?>><?php echo $row['sName']; ?></option>
                                            <?php 
                                            }
                                             ?>
                                       </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-DateofCalibration-input" class="form-label">Date </label>
                                                <input type="date"  class="form-control" id="Date" name="Date"  value="<?php if(isset($output)) echo $output['sDate']; else echo date("Y-m-d") ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-DateofCalibration-input" class="form-label">Due Date</label>
                                                <input type="date"  class="form-control" id="DueDate" name="DueDate"  value="<?php if(isset($output)) echo $output['sDueDate']; else echo date("Y-m-d") ?>" required>
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> Cost </label>
                                                <input type="text" class="form-control" for="formrow-firstname-input" name="Cost" value="<?php if(isset($output)) echo $output['sCost']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label"> Remark </label>
                                                <input type="text" class="form-control" for="formrow-firstname-input" name="Remark" value="<?php if(isset($output)) echo $output['sRemark']; ?>" required>
                                            </div>
                                        </div>


                                        
                               </form>


                                <?php
                                        if (isset($FactoryId)) {
                                    ?>
                                        <input type="hidden" name="FactoryId" value="<?php echo $FactoryId; ?>">
                                    <?php        
                                        }
                                    ?>
                                   
                                        
                                   <div>
                                        <button type="submit" class="btn btn-primary w-md" name="btnsave">Save</button>
                                    </div>
                                      
                                    </div>
                                      

                                    </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    
          
                <!-- end row -->
                <table id="datatable" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                          
                          <th>Sr No.</th>
                          <th>Factory Name</th>
                          <th>Act</th>
                          <th>Compliance</th>                          
                          <th>Date</th>
                          <th>DueDate Date</th>
                          <th>Cost</th>
                          <th>Remark</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          
                    <!-- <th>Calibration By </th> -->
                     
                         
                       
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;

                            $stmt1 = $link->prepare("Select * from tblfactory order by  sDueDate Asc  ");
                            // $stmt1->bind_param('s',$_SESSION['id'] );
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>

                            <td><?php echo $count; ?></td>
                            <td><?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?></td>
                            <td><?php 
                                $stmt = $link->prepare("SELECT * from tblact where iActId in (select sActName from  tblcompliance where iComplianceId =?)");
                                $stmt->bind_param('i',$row1['iComplianceID']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()){        
                                    echo htmlentities($row['sActName'], ENT_QUOTES);
                                }   
                            ?></td>
                            
                            <td><?php 

                            
                             $stmt2 = $link->prepare("Select * from tblcompliance  where iComplianceId =?");
                             $stmt2->bind_param('i',$row1['iComplianceID']);
                             $stmt2->execute();
                             $result2 = $stmt2->get_result();
                             while ($row2 = $result2->fetch_assoc()){
                               echo htmlentities($row2['sName'],ENT_QUOTES);
                             
                           }
                            // echo htmlentities($row1['sName'], ENT_QUOTES);
                            ?></td>
                         
                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row1['sDate'])), ENT_QUOTES);?></td>
                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row1['sDueDate'])), ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sCost'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['sRemark'], ENT_QUOTES);?></td>
                           
                            <td>
                            <form action="add-factory-compliance.php" method="post">
                              <input type="hidden" name="FactoryId" value="<?php echo htmlentities($row1['iFactoryId'], ENT_QUOTES);?>">
                              <button type="submit" name="btnedit" value="Edit" onclick="return confirm('Are you sure you want to edit this Data?');" class="btn btn-warning" >Edit</button>
                           </form>
                           </td>
                                 

                            <td>
                            <form action="add-factory-compliance.php" method="post">
                                <input type="hidden" name="FactoryId" value="<?php echo htmlentities($row1['iFactoryId'], ENT_QUOTES);?>">
                                <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                            </form>
                            </td>


                        </tr>

                        <?php 
                            }
                        ?> 
                    </tbody>
                </table> 
                

                    
               

            </div> <!-- container-fluactid -->
        </div>
        <!-- End Page-content -->
        

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sactidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>

</html>