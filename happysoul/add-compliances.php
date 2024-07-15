<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>

<?php
if(isset($_POST['btnsave']) && isset($_POST['ComplianceId']) ){

  
    $ComplianceId  = $_POST['ComplianceId'];
    $actname = $_POST['actname'];
    $name = $_POST['name'];
    $ReminderDays = $_POST['ReminderDays'];

    $stmt = $link->prepare('select * from tblcompliance where iComplianceId=?');
    $stmt->bind_param('i',$ComplianceId);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
    
        $output = $row;

    }
   
    $query = "update tblcompliance set sActName=?,sName=?,iReminderDays=? where iComplianceId=?";
     $stmt = mysqli_prepare($link,$query);
     mysqli_stmt_bind_param($stmt,"ssii",$actname,$name,$ReminderDays,$ComplianceId);
     $ret = mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     if(!$ret){
        $msg= "Data Not Saved";
      }else{
        $msg= "Data  Saved";
	     header("location:add-compliances.php");
     }
    }

else if (isset($_POST['btnsave']))
{
   
    $actname = $_POST['actname'];
    $name = $_POST['name'];
    $ReminderDays = $_POST['ReminderDays'];

    $query="insert into tblcompliance (sActName	,sName,iReminderDays) values (?,?,?)";
    $stmt=mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt,"ssi",$actname,$name,$ReminderDays);
    $ret= mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if(!$ret)
    {
        $msg="not saved";
    }
    else
    {
        // header("location:list.php");
    }
    
}
else if (isset($_POST['btndelelte'])){
        
    $query = "DELETE from tblcompliance where iComplianceId=?";
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "i", $_POST['ComplianceId']);
    $ret = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if (!$ret) {
        $msg  = "Data Not Deleted";
    }
    else{
        $msg  = "Data Deleted";
    }

}

 
 if(isset($_POST['ComplianceId'])){
    $ComplianceId  = $_POST['ComplianceId'];
    
    $stmt = $link->prepare('select * from tblcompliance  where iComplianceId=?');
    $stmt->bind_param('i',$ComplianceId);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        
        $output = $row;
    }
}

?>

<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Compliances</title>
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
                             
                                <form action="add-compliances.php" method="post" enctype="multipart/form-data">
                                    <div class="row">

                                       
                                    <div class="col-md-4">
                                    <label for="formrow-firstname-input" class="form-label"> Act Name :</label>
                                    <select id="formrow-inputState" class="form-control"name="actname"  >
                                        <option value="0"></option>
                                            <?php
                                            $stmt = $link->prepare('select * from tblact ');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while($row = $result->fetch_assoc()){
                                                
                                            ?>
                                        <option value="<?php echo $row['iActId'];?>" <?php if (isset($output) && $output['sActName'] == $row['iActId']) echo "Selected"; ?>><?php echo $row['sActName']; ?></option>
                                        <?php 
                                        }
                                            ?>
                                    </select>
                                    </div>
                  





                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label"> Compliance Name :</label>
                                            <input type="text" class="form-control" for="formrow-firstname-input" name="name" value="<?php if(isset($output)) echo $output['sName']; ?>" required>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label"> Reminder Days :</label>
                                            <input type="number" class="form-control" for="formrow-firstname-input" name="ReminderDays" value="<?php if(isset($output)) echo $output['iReminderDays']; ?>" required>
                                        </div>
                                    </div>
                                    
                                      
                                       
                                
                                      

                                    </div>

                                    <?php
                                        if (isset($ComplianceId)) {
                                    ?>
                                        <input type="hidden" name="ComplianceId" value="<?php echo $ComplianceId; ?>">
                                    <?php        
                                        }
                                    ?>
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md" name="btnsave">Add</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>                                                                                                        
                    <!-- end col -->

                    
                </div>
                <table id="datatable" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                          
                          <th>Sr No.</th>
                          <th>Act Name</th>

                          <th>Compliances Name</th>
                          <th>Reminder Days</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          
                          
                       
                     
                         
                       
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;

                            $stmt1 = $link->prepare("Select * from tblcompliance  ");
                            // $stmt1->bind_param('s',$_SESSION['id'] );
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            <td><?php echo $count; ?></td>
                           
                            <td><?php 

                                $stmt = $link->prepare("Select * from tblact where iActId=?  ");
                                $stmt->bind_param('i',$row1['sActName'] );
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()){        
                                    echo htmlentities($row['sActName'], ENT_QUOTES);
                                }                          

                            
                            
                            ?></td>
                            <td><?php echo htmlentities($row1['sName'], ENT_QUOTES);?></td>
                            <td><?php echo htmlentities($row1['iReminderDays'], ENT_QUOTES);?></td>

                            <td>
                            <form action="add-compliances.php" method="post">
                 <input type="hidden" name="ComplianceId" value="<?php echo htmlentities($row1['iComplianceId'], ENT_QUOTES);?>">

                     <button type="submit" name="btnedit" value="Edit" onclick="return confirm('Are you sure you want to edit this Data?');" class="btn btn-warning" >Edit</button>
                 </form>
             </td>
                                 

                            <td>

                              <form action="add-compliances.php" method="post">
                                <input type="hidden" name="ComplianceId" value="<?php echo htmlentities($row1['iComplianceId'], ENT_QUOTES);?>">
                                 
                                <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                           

                        

                        </tr>

                        <?php 
                            }
                        ?> 
                    </tbody>
                </table> 
                <!-- end row -->

               

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