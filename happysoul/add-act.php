<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>

            <?php 

             $msg = "";
                
                if(isset($_POST['btnsave']) && isset($_POST['actid'])){
                    $actid  = $_POST['actid']; 
                    $actname = $_POST['actname'];
                    $stmt = $link->prepare('select * from tblact where iActId=?');
                    $stmt->bind_param('i',$actid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                       $output = $row;
                    }

      

                    $query = "update tblact set sActName=? where iActId=?";
                    $stmt = mysqli_prepare($link,$query);
                    mysqli_stmt_bind_param($stmt, "si", $actname,$actid);
                    $ret = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    if(!$ret){
                        $msg= "Data Not Updated";
                    }else{
                        $msg= "Data Updated";

                        echo "<script>window.location.href = 'add-act.php';</script>";
                    } 

                }

                else if(isset($_POST['btnsave']))
                {
                    $actname = $_POST['actname'];

                    $query = "INSERT INTO tblact (sActName) VALUES (?)";
                    $stmt = mysqli_prepare($link,$query);
                    mysqli_stmt_bind_param($stmt, "s", $actname);
                    $ret = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                        if(!$ret){
                            $msg= "Data Not Saved";
                        }else{
                            $msg= "Data Saved";

                            // echo "<script>window.location.href = 'list-user.php';</script>";
                        }    
                    }

                else if (isset($_POST['btndelelte'])){

                    $query = "DELETE from tblact where iActId = ?";
                    $stmt = mysqli_prepare($link,$query);
                    mysqli_stmt_bind_param($stmt, "i", $_POST['actid']);
                    $ret = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                        if (!$ret) {
                            $msg  = "Data Not Deleted";
                        }
                        else{
                            $msg  = "Data Deleted";
                        }
                
                    }

                    
                else if(isset($_POST['actid'])){
                    $actid  = $_POST['actid']; 
                        
                    $stmt = $link->prepare('select * from tblact where iActId=?');
                    $stmt->bind_param('i',$actid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                    
                        $output = $row;

                    }
                } 

?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Act</title>
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
                            <h4 class="mb-sm-0 font-size-18">Add Act</h4>
                            

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Act</a></li>
                                    <li class="breadcrumb-item active">Add Act</li>
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
                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                                <label><?php echo $msg; ?> <hr> </label>
                                <form action="add-act.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Act Name :</label>
                                                <input type="text" class="form-control" for="formrow-firstname-input" name="actname" value="<?php if(isset($output)) echo $output['sActName']; ?>" required>
                                            </div>
                                        </div>
                                        
                                      
                                       
                                        
                                      

                                    </div>

                                    <?php
                                        if (isset($actid)) {
                                    ?>
                                        <input type="hidden" name="actid" value="<?php echo $actid; ?>">
                                    <?php        
                                        }
                                    ?>
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md" name="btnsave">ADD</button>
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
                          <th>Edit</th>
                          <th>Delete</th>
                          
                          
                       
                     
                         
                       
                        </tr>  
                    </thead> 
                    <tbody>
                        <?php         
                            $count = 0;

                            $stmt1 = $link->prepare("Select * from tblact  ");
                            // $stmt1->bind_param('s',$_SESSION['id'] );
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                        ?>

                        <tr>
                            <td><?php echo $count; ?></td>
                           
                            
                            <td><?php echo htmlentities($row1['sActName'], ENT_QUOTES);?></td>
                           <td>
                            <form action="add-act.php" method="post">
                 <input type="hidden" name="actid" value="<?php echo htmlentities($row1['iActId'], ENT_QUOTES);?>">

                     <button type="submit" name="btnedit" value="Edit" onclick="return confirm('Are you sure you want to edit this Data?');" class="btn btn-warning" >Edit</button>
                 </form>
             </td>
                                 

                            <td>

                              <form action="add-act.php" method="post">
                                <input type="hidden" name="actid" value="<?php echo htmlentities($row1['iActId'], ENT_QUOTES);?>">
                                 
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

<script src="assets/js/app.js"></script>

</body>

</html>