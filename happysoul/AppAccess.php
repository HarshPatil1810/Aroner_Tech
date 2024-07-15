<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>App Access </title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php 
include 'layouts/body.php'; 


if(isset($_POST['employeeId']) ){
    $employeeId=$_POST['employeeId'];
}else{

}

if(isset($_POST['btnsave']) && isset($_POST['employeeId'])){
    $AppaccessName=""; 
   
    $employeeId=$_POST['employeeId'];
        
    if(isset($_POST['AppaccessName'])){
        $arrAppaccessName =$_POST['AppaccessName']; 
    }
    if(count($arrAppaccessName) > 0){
        $AppaccessName = implode(",",$arrAppaccessName);
    }



    $AppaccessBy="";
    $employeeId=$_POST['employeeId'];
    if(isset($_POST['AppaccessBy'])){
        $arrAppaccessBy =$_POST['AppaccessBy']; 
    }
    if(count($arrAppaccessBy) > 0){
        $AppaccessBy = implode(",",$arrAppaccessBy);
    }


    $query = "update tblemployeejoiningform set sAppAccess=? ,sAppAccessBy=? where iEmployeeFormId=?";
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "ssi", $AppaccessName,$AppaccessBy,$employeeId);
    $ret = mysqli_stmt_execute($stmt);
     $error=mysqli_error($link);
    print("error occured:".$error);
    mysqli_stmt_close($stmt);
    
    // exit();

    if(!$ret){
        $msg= "Data Not Updated";
    }else{
        $msg= "Data Updated";

        // echo "<script>window.location.href = 'AppAccess.php';</script>";
    } 

}else  
//  if(isset($_POST['btnsave']) ){
//     $AppaccessName=""; 
//     $employeeId=$_POST['employeeId'];
        
//     if(isset($_POST['AppaccessName'])){
//         $arrAppaccessName =$_POST['AppaccessName']; 
//     }
//     if(count($arrAppaccessName) > 0){
//         $AppaccessName = implode(",",$arrAppaccessName);
//     }

//     $query = "INSERT INTO tblappaccess (sAppAccess) VALUES (?)";
//     $stmt = mysqli_prepare($link,$query);
//     mysqli_stmt_bind_param($stmt, "s", $AppAcessName);
//     $ret = mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     if(!$ret){
//         $msg= "Data Not Saved";
//     }else{
//         $msg= "Data Saved";

//         echo "<script>window.location.href = 'AppAccess.php';</script>";
//     }    




// }else
 if(isset($_POST['employeeId'])){ 

    $employeeId  = $_POST['employeeId']; 
            
    $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
    $stmt->bind_param('i',$employeeId);
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
                    <div class="col-6">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">App Accesss :</h4>
                       </div>
                    </div>

                    <div class="col-6">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-1 font-size-18">Type Of :</h4>
                       </div>
                    </div>
                </div>


                
                <!-- end page title -->
                
                        
               
                        <form action="AppAccess.php" method="post" enctype="multipart/form-data"  >
                            
                            <div class="col-md-12 row">
                       <?php
                            if(isset($output) && $output['sAppAccess'] != ""){
                                            $arr_selectedappaccess = explode(",",$output['sAppAccess']);
                                        }

                                        ?>

                                    <div class="col-md-6">
                                           <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="dashboard"   value="dashboard"   <?php if(isset($arr_selectedappaccess)  && in_array("dashboard",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Dashboard</label> 

                                            </div>
                                        </div>



                                        
                                        <?php
                                           if(isset($output) && $output['sAppAccessBy'] != ""){
                                            $arr_selectedappaccessby = explode(",",$output['sAppAccessBy']);
                                        }

                                        ?>

                                        <div class="col-md-4">
                                          <div class="mb-3">
                                          <select class="form-select" name="AppaccessBy[]" id="AppaccessBy" required>
                                          <option value="" <?php if(!isset($arr_selectedappaccessby) || (isset($arr_selectedappaccessby) && empty($arr_selectedappaccessby))) echo 'selected'; ?>>Select Option</option>
                <option <?php if(isset($arr_selectedappaccessby) && in_array("User", $arr_selectedappaccessby)) echo "selected"; ?>>User</option> 
                <option <?php if(isset($arr_selectedappaccessby) && in_array("Admin", $arr_selectedappaccessby)) echo "selected"; ?>>Admin</option> 
                                        </select>
                                        
                                          </div>
                                      </div>



                                        <div class="col-md-8">
                                           <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="taskSystem"   value="taskSystem"   <?php if(isset($arr_selectedappaccess)  && in_array("taskSystem",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Task Managment System</label> 
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                           <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="sales"   value="sales"   <?php if(isset($arr_selectedappaccess)  && in_array("sales",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Sales</label> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="po"   value="po"   <?php if(isset($arr_selectedappaccess)  && in_array("po",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">PO</label> 
                                            </div>
                                            
                                            <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="delivery"   value="delivery"   <?php if(isset($arr_selectedappaccess)  && in_array("delivery",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Delivery</label> 
                                            </div>
                                            
                                            <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="delivery"   value="purchase"   <?php if(isset($arr_selectedappaccess)  && in_array("purchase",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Purchase</label> 
                                            </div>
                                            
                                            <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="delivery"   value="consumption"   <?php if(isset($arr_selectedappaccess)  && in_array("consumption",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">Consumption</label> 
                                            </div>
                                            
                                            <div class="mb-3">
                                                <input class="form-check-input"  style="margin-left:20px;" type="checkbox"  name="AppaccessName[]" id="hrm"   value="hrm"   <?php if(isset($arr_selectedappaccess)  && in_array("hrm",$arr_selectedappaccess)) echo "checked";  ?> >
                                                <label for="formrow-firstname-input" class="form-label">HRM</label> 
                                            </div>
                                        </div>
                                        
                                       

                                      
                                        <!-- <div class="col-md-4">
                                          <div class="mb-3">
                                       
                                          <select id="formrow-inputState" class="form-select" name="AppaccessName[]" required>
                                                    <option <?php if(isset($output) && $output['AppaccessName[]'] == 'User') echo 'selected'; ?>>User</option> 
                                                    <option <?php if(isset($output) && $output['AppaccessName[]'] == 'Admin') echo 'selected'; ?>>Admin</option> 
                                                  
                                                                                                                                                        
                                                </select>
                                          </div>
                                      </div> -->

                                        <?php

                                            // $stmt = $link->prepare('select * from tblappaccess where iAppaccessId = ?');
                                            // $stmt->bind_param('i',$Id);
                                            // $stmt->execute();
                                            // $result = $stmt->get_result();
                                            // while($row = $result->fetch_assoc()){

                                        ?>

                                <!-- <input type="checkbox" style="margin-left: 15px;"   name="AppaccessId[]"  value="<?php  //echo $row['iAppaccessId']; ?>"   <?php //if(isset($selecteddispatchid)  && in_array($row['iAppaccessId'],$selecteddispatchid)) echo "checked";  ?> /> <?php // echo $row['iAppaccessId']; ?> -->
                                        
                                        <?php
                                            // }

                                        ?>



                                    <?php
                                        if (isset($employeeId)) {
                                    ?>
                                        <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">
                                    <?php        
                                        }
                                    ?>
                                        
                                        
                                        <div class="row">
                                          <div class="col-md-4">
                                                <div class="mb-3">
                                                </div>
                                            </div> 
                                      
                                        <div>
                                            <center><button type="submit" class="btn btn-primary w-md" name="btnsave" >Save</button></center>
                                        </div>
                                      
                                        
                                    </div>     
                                          
                                    </div>  
                                 </div>




                

                                      </div>
                                      </div>


                                  
                                  
                                     </div>
                              </form>
                              
                             
                              <br>

            
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



  <!-- <select  class="form-select" name="AppaccessBy[]" id="AppaccessBy" value="AppaccessBy"   <?php if(isset($arr_selectedappaccessby)  && in_array("AppaccessBy",$arr_selectedappaccessby)) echo "selected";  ?>required>

                                           <option <?php if(isset($arr_selectedappaccessby) && $arr_selectedappaccessby['sAppaccessBy'] == 'User')  echo 'selected'; ?>>User</option> 
                                           <option <?php if(isset($arr_selectedappaccessby) && $arr_selectedappaccessby['sAppaccessBy'] == 'Admin') echo 'selected'; ?>>Admin</option> 
                                          </select> -->