<?php 
include 'layouts/session.php';
include 'layouts/config.php';


function array2csv(array $array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
//    fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}
function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}



if(isset($_POST['btnExport'])){

    $output[] = array("Employee Code","Date of Joining","Name","Mobile Number","Email ID","Contractor Name","Unit","Designation");
    if($_POST['contractor'] != "All"){
        $stmt1 = $link->prepare("Select * from tblemployeejoiningform where iCreatedBy  = ?");
        $stmt1->bind_param('i',$_POST['contractor']);
    }else if($_POST['contractor'] == "All"){
        $stmt1 = $link->prepare("Select * from tblemployeejoiningform");
    }

    $stmt1->execute();
    $result1 = $stmt1->get_result();
    while ($row1 = $result1->fetch_assoc()){
        
        if(isset($_POST['unit']) && $_POST['unit'] != "All"){
            $present = false;
            $stmt = $link->prepare('select * from tblcity where iEmployeeFormId=? order by sCreatedTimestamp desc limit 1');
            $stmt->bind_param('i',$row1['iEmployeeFormId']);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                if($row['sUnit'] == $_POST['unit']){
                    $present = true;
                }
            }
            if(!$present){
                continue;
            }
        }
        if($_GET['type'] == "active" && $row1['iCreatedBy'] == -1){
                continue;
        }else if($_GET['type'] == "inactive" && $row1['iCreatedBy'] != -1){
                continue;
        }
        $contractor = "Admin";
       
        $stmt2 = $link->prepare("Select * from tblcontractorregform where iContractorRegFormId=? ");
        $stmt2->bind_param('i',$row1['iCreatedBy']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while ($row2 = $result2->fetch_assoc()){
            $contractor = $row2['sName'];
        }
        $unit = "NA";

          $stmt2 = $link->prepare("Select * from tblcity  where iEmployeeFormId=? ");
          $stmt2->bind_param('i',$row1['iEmployeeFormId']);
          $stmt2->execute();
          $result2 = $stmt2->get_result();
          while ($row2 = $result2->fetch_assoc()){
           $unit = $row2['sUnit'];
          
        }


    $Designation = "NA";

      $stmt2 = $link->prepare("Select * from tblsubcategory  where iEmployeeFormId=? ");
      $stmt2->bind_param('i',$row1['iEmployeeFormId']);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      while ($row2 = $result2->fetch_assoc()){
       $Designation = $row2['sSubcategory'];
      
    }

        
        $output[] = array($row1['sEmployeeCode'],date("d/m/Y",strtotime($row1['sDateofjoining'])),$row1['sName'],$row1['sMobilenumber'],$row1['sEmailid'],$contractor,$unit, $Designation);
        
    }

    

    download_send_headers("employee_export_" . date("Y-m-d") . ".csv");
        echo array2csv($output);
        return;


}
?>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>List Service Providers Form</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 

    
    $msg = "";

    if (isset($_POST['btndelelte'])){
        
        $query = "DELETE from tblemployeejoiningform where iEmployeeFormId  = ?";
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

    }else if(isset($_POST['btnChangeContractor'])){
        $oldcontractorid = $_POST['oldcontractorid'];
        $contractorid = $_POST['contractor'];
        $employeeid = $_POST['employeeid'];
        $unitdate = $_POST['unitdate'];
        $uint = "contract_change_".$oldcontractorid;
        $query = "insert into tblunitt (iEmployeeFormId,sUnit,iCreatedBy,sDate) values (?,?,?,?)";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "isis", $employeeid,$uint,$_SESSION['id'],$unitdate);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $query = "update tblemployeejoiningform set iCreatedBy = ? where iEmployeeFormId  = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ii",$contractorid,$employeeid);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$ret) {
            echo "<script>alert('Data Not Updated.')</script>";
        }
        else{
            echo "<script>alert('Data Updated.')</script>";
        }

    }else if(isset($_POST['btnLeftJob'])){
        $employeeid = $_POST['leftjobemployeeid'];
        $leftjobunitdate = $_POST['leftjobunitdate'];
        $uint = "left_job";
        $query = "insert into tblcity (iEmployeeFormId,sUnit,iCreatedBy,sDate) values (?,?,?,?)";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "isis", $employeeid,$uint,$_SESSION['id'],$leftjobunitdate);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $contractorid = -1;
        $query = "update tblemployeejoiningform set iCreatedBy = ?,sAppAccess = '',sAppAccessBy = '' where iEmployeeFormId  = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ii",$contractorid,$employeeid);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$ret) {
            echo "<script>alert('Data Not Updated.')</script>";
        }
        else{
            echo "<script>alert('Data Updated.')</script>";
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
                            <h4 class="mb-sm-0 font-size-18">List Service Providers</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Service Provider Joining Form</a></li>
                                    <li class="breadcrumb-item active">List service providers</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data"  >
                            <div class="col-md-12 row">

                                     <div class="col-md-4">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">Agent:</label>
                                             




                 <select class="form-control" name="contractor" >
                 <?php
                          if($_SESSION["usertype"] == "Admin"){ ?>
                       <option value="0">All</option>
                       <?php } ?>
                          <?php
                          
                          
                          
                          if($_SESSION["usertype"] == "Admin"){
                            $stmt = $link->prepare('select * from tblcontractorregform');
                            }else{
                                $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId=?');
                                $stmt->bind_param('i',$_SESSION['id']);
                            }   
                          $stmt->execute();
                          $result = $stmt->get_result();
                          while($row = $result->fetch_assoc()){
                            
                          ?>
                       <option value="<?php echo $row['iContractorRegFormId'];?>" <?php if (isset($_POST['contractor']) && $_POST['contractor'] == $row['iContractorRegFormId']) echo "Selected"; ?>><?php echo $row['sName']; ?></option>
                       <?php 
                       }
                        ?>
                     </select>

                                      </div>
                                      </div>

 

                          <div class="col-md-3" style="display: none;">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">City:</label>
                                             
                            <select class="form-control" name="unit">
                                <option value="All">All</option>
                                 <?php
                                //  $stmt = $link->prepare('select distinct (sUnit) from tblcity');
                                 $stmt = $link->prepare('select distinct (sCity) as sCity from tblcity where sCity IN  ("Intorq","ACD","PCD","HMD","Testing","Corporate Unit","NA")');
                                  $stmt->execute();
                                  $result = $stmt->get_result();
                                  while($row = $result->fetch_assoc()){
                           ?>
                         <option value="<?php echo $row['sUnit'];?>" <?php if (isset($_POST['unit']) && $_POST['unit'] == $row['sUnit']) echo "Selected"; ?>><?php echo $row['sUnit']; ?></option>
                       <?php 
                       }
                        ?>
                     </select>

                                      </div>
                                      </div>
                                   <div class="col-md-1">
                                          <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">&nbsp;</label><br>
                                              <button type="submit" name="btnfilter" value="Filter" class="btn btn-warning" >Filter</button>
                                          </div>
                                          
                                      </div>
                                      <!-- <div class="col-md-2">
                                      <div class="mb-3">
                                              <label for="formrow-firstname-input" class="form-label">&nbsp;</label><br>
                                              <button type="submit" name="btnExport" value="Filter" class="btn btn-info" >Export CSV</button>
                                          </div>
                                      </div> -->
                                     </div>
                                </form>
                             
<br>

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Sr No</th>
                         <th>Service Provider Code</th> 
                       <!-- <th>Category</th>-->
                         <th>Date of Joining</th> 
                         <th>Name</th>
                         <th> Mobile Number</th>
                         <th>Email ID</th>
                         <!-- <th>Personal Photo Copy</th>
                         <th>Present  Address</th>
                         <th>Permanent Address</th>
                         <th> Mobile Number</th>
                         <th>Email ID</th>
                          <th>Date Of Birth</th>
                          <th>Maritial Status</th>
                          <th>Pan Card No</th>
                          <th>Adhar Card No</th>
                           <th>Name As on Pan</th>
                            <th>Name As on Adhar</th> -->
                            <!-- <th>Name</th> -->
                          <!-- <th>Relation</th> -->
                      
                          <th>Agent Name</th>
                          <!-- <th>Contact Number</th> -->
                          <!-- <th>Approval <br> Status</th> -->
                          <th>City</th>
                          <!-- <th>Sub Category</th> -->
                         
                            <th>View</th>
                  
                        <th>PDF</th>
                        <?php if($_SESSION["usertype"] == "Admin"){ ?>
                          <th>Edit</th>
                          
                          <th>Change Agent</th>
                          <!-- <th>Left Job</th> -->
                          <th>Delete</th>
                          <?php } ?>
                         
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;
                            
                             
                             

                            if($_SESSION["usertype"] == "Contractor")
                            {
                                $stmt1 = $link->prepare("Select * from tblemployeejoiningform where iCreatedBy = ? ");
                                $stmt1->bind_param('i',$_SESSION['id']);
                            }
                            else{

                                
                                if(isset($_POST['btnfilter']))
                                {
                                    if($_POST['contractor'] != "0"){
                                        $stmt1 = $link->prepare("Select * from tblemployeejoiningform where iCreatedBy=?");
                                        $stmt1->bind_param('i',$_POST['contractor']);
                                    }else if($_POST['contractor'] == "0"){
                                        $stmt1 = $link->prepare("Select * from tblemployeejoiningform");
                                    } 
                                    
                                    
                                }
                               
                                
                               
                                else{
                                    $stmt1 = $link->prepare("Select * from tblemployeejoiningform ");
                                }
                            }


                            
                           
                          
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                                
                                if(isset($_POST['city']) && $_POST['city'] != "All"){
                                    $present = false;
                                    $stmt = $link->prepare('select * from tblcity where iEmployeeFormId=? order by sCreatedTimestamp desc limit 1');
                                    $stmt->bind_param('i',$row1['iEmployeeFormId']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while($row = $result->fetch_assoc()){
                                        if($row['sCity'] == $_POST['sCity']){
                                            $present = true;
                                        }
                                    }
                                    if(!$present){
                                        continue;
                                    }
                                }
                                
                                if(isset($_GET['type'])){
                                    
                                    if($_GET['type'] == "active" && $row1['iCreatedBy'] == -1){
                                            continue;
                                    }else if($_GET['type'] == "inactive" && $row1['iCreatedBy'] != -1){
                                            continue;
                                    }
                                }

                                // $employee[]
                            $count++;
                        ?>
                          

                          
                        <tr>
                            <td><?php echo htmlentities($count) ?></td>
                          
                            <!--<td><?php // echo date('d/m/Y',strtotime($row1['sDate']));?></td>-->
                         






                          <td><?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?></td> 
                            <!-- <td><?php echo htmlentities($row1['sCategory'], ENT_QUOTES);?></td> -->
                            <td><?php echo date('d/m/Y',strtotime($row1['sDateofjoining']));?></td>
                            
                            <td><?php echo htmlentities($row1['sName'], ENT_QUOTES);?></td>

                            <td><?php echo htmlentities($row1['sMobilenumber'], ENT_QUOTES);?></td>

                            <td><?php echo htmlentities($row1['sEmailid'], ENT_QUOTES);?></td>

                     

                            
                            <td><?php 
                            $currentcontractor = "";
                            $currentcontractorid = 0;
                            if($row1['iCreatedBy']==-1){
                                echo "Left Job";
                                $currentcontractorid = -1;
                                $currentcontractor = "Left Job";
                            }else if($row1['iCreatedBy']==0){
                                echo "Admin";
                                $currentcontractorid = 0;
                                $currentcontractor = "Admin";

                              }else{
                                $currentcontractorid = $row1['iCreatedBy'];
                                $stmt2 = $link->prepare("Select * from tblcontractorregform where iContractorRegFormId=? ");
                                $stmt2->bind_param('i',$row1['iCreatedBy']);
                                $stmt2->execute();
                                $result2 = $stmt2->get_result();
                                while ($row2 = $result2->fetch_assoc()){
                                  echo htmlentities($row2['sName'],ENT_QUOTES);
                                  $currentcontractor = $row2['sName'];
                                }
                              }
                            ?></td>

                         <td><?php 
                             

                              $stmt2 = $link->prepare("Select * from tblcity where iEmployeeFormId=?");
                              $stmt2->bind_param('i',$row1['iEmployeeFormId']);
                              $stmt2->execute();
                              $result2 = $stmt2->get_result();
                              while ($row2 = $result2->fetch_assoc()){
                                echo htmlentities($row2['sCity'],ENT_QUOTES);
                              
                            }
                            
                          
                            ?></td>

                            
                
                          <!-- <td><?php 
                             

                            //  $stmt2 = $link->prepare("Select * from tblsubcategory  where iEmployeeFormId=? order by iSubcategoryId desc limit 1 ");
                            //  $stmt2->bind_param('i',$row1['iEmployeeFormId']);
                            //  $stmt2->execute();
                            //  $result2 = $stmt2->get_result();
                            //  while ($row2 = $result2->fetch_assoc()){
                            //    echo htmlentities($row2['sSubcategory'],ENT_QUOTES);
                             
                           //}
                           
                         
                           ?></td> -->






                            <!-- <td><a href="<?php //if($row1['sPersonalphotocopy'] == NULL || $row1['sPersonalphotocopy'] == '') echo "javascript:void(0)";
                                //else echo $row1['sPersonalphotocopy']; ?>" <?php //if($row1['sPersonalphotocopy'] == NULL || $row1['sPersonalphotocopy'] == '') ;
                                //else echo 'target="_blank"'; ?>>View</a></td>
                              -->
                            

                            <!-- <td><?php //echo htmlentities($row1['sPresentaddress'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sPermanentaddress'], ENT_QUOTES);?></td> -->

                           






                            <!-- <td><?php //echo date('d/m/Y',strtotime($row1['sDateofbirth']));?></td> -->
                            
                          
                            <!-- <td><?php //echo htmlentities($row1['sMaritialstatus'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sPancardno'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sAdharcardno'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sNameasonpan'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sNameasonadhar'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sNamee'], ENT_QUOTES);?></td> -->

                            <!-- <td><?php //echo htmlentities($row1['sRelation'], ENT_QUOTES);?></td> -->

                   
 

                             <!-- <td>
                              <form action="view-contractor-registration-form.php" method="post" target="_blank">
                                <input type="hidden" name="inwardId" value="<?php //echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnView" value="View" class="btn btn-success">View</button>
                                </form>
                            </td> -->
                           
                                <td>
                 
                 <form action="employee-joining-form.php" method="post">
                 <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">

                     <button type="submit" name="btnedit" value="View" class="btn btn-warning" >View</button>
                 </form>
             </td>
             
                              
                                <td>
                              <form action="view.php" method="post" target="_blank">
                                <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">                             
                                 
                                <button type="submit" name="btnPDF" value="View" class="btn btn-success">View</button>
                                </form>
                            </td>  
                                <?php if($_SESSION["usertype"] == "Admin"){ ?>
                            <td>
                 
                 <form action="employee-joining-form.php" method="post">
                 <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">

                     <button type="submit" name="btnedit" value="Edit" onclick="return confirm('Are you sure you want to edit this Data?');" class="btn btn-warning" >Edit</button>
                 </form>
             </td>


              
                           


                           <td>
                                 
                                <button type="button" name="btnChange" value="Change" onclick="fnchangeContractor('<?php echo $currentcontractor; ?>',<?php echo $row1['iEmployeeFormId']; ?>,<?php echo $currentcontractorid; ?>)" class="btn btn-success">Change </button>
                             
                            </td> 


                            <!-- <td>
                                <?php if($currentcontractor != "Left Job"){ ?>

  
  <button type="button" name="btnLeftJob" value="Left Job" onclick="fnLeftJob(<?php echo $row1['iEmployeeFormId']; ?>)" class="btn btn-danger">Left Job </button>
  
  

  <?php } ?>
</td> -->
                                

                            <td>

                              <form action="list-employee-joining-form.php" method="post">
                                <input type="hidden" name="employeeId" value="<?php echo htmlentities($row1['iEmployeeFormId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                          
                        <?php } ?>


                            
                        </tr>

                        <?php 
                            }
                        ?> 
                       
                    </tbody>
                </table> 

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



        <div class="modal fade"  id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <p style="font-size: 15px;" class="modal-title" id="myLargeModalLabel">Load Cell Due Date</p> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="details" >
                        <div class="row col-12" style="font-weight: bold;" id="currentconttractor">
                       
                        </div>
                        <br>
                        <form action="list-employee-joining-form.php" method="post">
                        <div class="row col-12">
                            <label>Change Agent To</label>
                            <select id="formrow-inputState" class="form-control" name="contractor"  >
                                        <option value="0">Admin</option>
                                            <?php
                                            $stmt = $link->prepare('select * from tblcontractorregform');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while($row = $result->fetch_assoc()){
                                                
                                            ?>
                                                
<option value="<?php echo $row['iContractorRegFormId'];?>"><?php echo $row['sName']; ?></option>

                                   
                                        <?php 
                                        }
                                        ?>
                                    </select>
                        </div>
                        <br>
                        <div class="row col-12">
                        <input type="date" class="form-control" name="unitdate" id="unitdate" value="<?php echo date("Y-m-d"); ?>"/>
                                        <input type="hidden" name="employeeid" id="employeeid"/>
                                        <input type="hidden" name="oldcontractorid" id="oldcontractorid"/>
                                        <br>
                            <center><input type="submit" class="btn btn-primary mt-3" name="btnChangeContractor" value="Submit"/></center>
                        </div>
                        </form>
                        <!-- class="row" -->
                        
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div class="modal fade"  id="leftDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <p style="font-size: 15px;" class="modal-title" id="myLargeModalLabel">Load Cell Due Date</p> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="details" >
                        <div class="row col-12" style="font-weight: bold;" id="currentconttractor">
                            Mark as Job Left?
                        </div>
                        <br>
                        <form action="list-employee-joining-form.php" method="post">
                        
                        
                        <div class="row col-12">
                            <input type="date" name="leftjobunitdate" class="form-control" id="leftjobunitdate" value="<?php echo date("Y-m-d"); ?>"/>
                                        <input type="hidden" name="leftjobemployeeid" id="leftjobemployeeid"/>
                                        <br>
                            <center><input type="submit" class="btn btn-primary mt-3" name="btnLeftJob" value="Submit"/></center>
                        </div>
                        </form>
                        <!-- class="row" -->
                        
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->




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

<script>
    function fnchangeContractor(conttractorname,employeeid,oldcontractorid){

        var html = '';
        // html += '<h5> Load Cell <b></b> Due Date is <b>. </b></h5>';
        // var details = document.getElementById('details');
        // details.innerHTML = '';
        // details.innerHTML = html;
        document.getElementById("currentconttractor").innerHTML = "Current Agent : "+conttractorname;
        document.getElementById("employeeid").value = employeeid;
        document.getElementById("oldcontractorid").value = oldcontractorid;
        $('#detailsModal').modal('show');
    }
    
    function fnLeftJob(employeeid){

        var html = '';
        // html += '<h5> Load Cell <b></b> Due Date is <b>. </b></h5>';
        // var details = document.getElementById('details');
        // details.innerHTML = '';
        // details.innerHTML = html;
        // document.getElementById("currentconttractor").innerHTML = "Current Contractor : "+conttractorname;
        document.getElementById("leftjobemployeeid").value = employeeid;
        $('#leftDetailsModal').modal('show');
    }

</script>

</body>

</html>