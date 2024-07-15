<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>

<?php 



    $msg = "";
    
    if(isset($_POST['btnsave']) && isset($_POST['AppaccessId'])){
        $AppaccessId   = $_POST['AppaccessId']; 

        // $model = $_POST['model'];
        $AppAcessName = $_POST['AppAcessName'];
      
       
        $query = "update tblappaccess set sName=? where iAppaccessId  = ?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "si", $AppAcessName,$AppaccessId);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // exit();

        if(!$ret){
            $msg= "Data Not Updated";
        }else{
            $msg= "Data Updated";

            echo "<script>window.location.href = 'add-AppAccess.php';</script>";
        } 

    }
    else if(isset($_POST['btnsave']))
    {
        // $model = $_POST['model'];
        $AppAcessName = $_POST['AppAcessName'];

            $query = "INSERT INTO tblappaccess (sName) VALUES (?)";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "s", $AppAcessName);
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if(!$ret){
                $msg= "Data Not Saved";
            }else{
                $msg= "Data Saved";

                echo "<script>window.location.href = 'add-AppAccess.php';</script>";
            }    
       

    }
    else if(isset($_POST['Id'])){
        $Id  = $_POST['Id']; 
            
        $stmt = $link->prepare('select * from tblappaccess where iAppaccessId = ?');
        $stmt->bind_param('i',$Id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
        
            $output = $row;

        }
    } 

    
 ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Resolution</title>
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
                            <h4 class="mb-sm-0 font-size-18">Add App Access</h4>
                            

                           

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
                                <form action="add-AppAccess.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                             
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">AppAcessName:</label>
                                                <input type="text"  class="form-control" id=""  name="AppAcessName" value="<?php if(isset($output)) echo $output['sName']; ?>" required>
                                            </div>
                                        </div>

                                       

                                        
                                        <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Percent Payable</label>
                                                <input type="number" class="form-control" id="formrow-password-input" name="percentpayment" value="<?php if(isset($output)) echo $output['iPercentPayment']; else $globalsettings['iPercentPayable']; ?>">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="formrow-password-input" name="password" <?php if(!isset($output)) echo 'required'; ?>>
                                            </div>
                                        </div> -->
                                      
                                    </div>

                                    <?php
                                        if (isset($AppaccessId)) {
                                    ?>
                                        <input type="hidden" name="Id" value="<?php echo $Id; ?>">
                                    <?php        
                                        }
                                    ?>
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md" name="btnsave">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    
                </div>
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