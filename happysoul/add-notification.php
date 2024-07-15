<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php';

include "sendSinglePush.php";
?>

<?php 


    $msg = "";
    
    // if(isset($_POST['btnsave']) && isset($_POST['notificationid'])){
    //     $notificationid  = $_POST['notificationid']; 

    //     // $model = $_POST['model'];
    //     $itemname = $_POST['itemname'];
       
    //     $query = "update tblnotification set sName=? where iNotificationId  = ?";
    //     $stmt = mysqli_prepare($link,$query);
    //     mysqli_stmt_bind_param($stmt, "si", $itemname,$notificationid);
    //     $ret = mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);

    //     // exit();

    //     if(!$ret){
    //         $msg= "Data Not Updated";
    //     }else{
    //         $msg= "Data Updated";

    //         echo "<script>window.location.href = 'list-notification.php';</script>";
    //     } 

    // }
    // else 
    
    if(isset($_POST['btnsave']))
    {
        // $model = $_POST['model'];
          $text = $_POST['text'];
          $imagepath="";

          if(isset($_FILES['pdffile']) && $_FILES['pdffile']['size'] > 0){
            $target_dir = "policypdfs/";        
            $ext = substr(strrchr($_FILES["pdffile"]["name"],'.'),1);
            $time = time();
            $target_file = $target_dir ."notificationpdf_". $time.".".$ext;       
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], $target_file)) {
                $imagepath = server_path."policypdfs/notificationpdf_". $time.".".$ext;
            }
        }

            $query = "INSERT INTO tblnotification (sText,sPDFUrl,iAddedBy) VALUES (?,?,?)";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "ssi", $text,$imagepath,$_SESSION['id']);
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if(!$ret){
                $msg= "Data Not Saved";
            }else{
                $msg= "Data Saved";

                $msg = $text;
                
                $message  = "{'type':'New Notification','dataid':'0','text':'".$msg."'}";
                sendNotification("FIE HR",$message,"dummy","hr",0,$link);

                echo "<script>window.location.href = 'list-notification.php';</script>";
            }    
       

    }
    else if(isset($_POST['notificationid'])){
        $notificationid  = $_POST['notificationid']; 
            
        $stmt = $link->prepare('select * from tblnotification where iNotificationId  = ?');
        $stmt->bind_param('i',$notificationid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
        
            $output = $row;

        }
    } 

    
 ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Notification</title>
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
                            <h4 class="mb-sm-0 font-size-18">Add Notification</h4>
                            

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Notification</a></li>
                                    <li class="breadcrumb-item active">Add Notification</li>
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
                                <form action="add-notification.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                 <!--         
                                    <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Resolution Type</label>
                                                <select id="formrow-inputState" class="form-select" name="resolutiontype">
                                                    <option <?php //if(isset($output) && $output['sResolutionType'] == 'Digital') echo 'selected'; ?>>Digital</option> 
                                                    <option <?php //if(isset($output) && $output['sResolutionType'] == 'Analog') echo 'selected'; ?>>Analog</option>                                                   
                                                </select>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Text</label>
                                                <input type="text" class="form-control" id="text"  name="text" value="<?php if(isset($output)) echo $output['sText']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Upload File</label>
                                                <input type="file" class="form-control" id="pdffile"  name="pdffile"  required>
                                            </div>
                                        </div>

                                       

                                        
                                        <!-- <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Percent Payable</label>
                                                <input type="number" class="form-control" id="formrow-password-input" name="percentpayment" value="<?php // if(isset($output)) echo $output['iPercentPayment']; else $globalsettings['iPercentPayable']; ?>">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-password-input" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="formrow-password-input" name="password" <?php //if(!isset($output)) echo 'required'; ?>>
                                            </div>
                                        </div> -->
                                      
                                    </div>

                                    <?php
                                        if (isset($notificationid)) {
                                    ?>
                                        <input type="hidden" name="notificationid" value="<?php echo $notificationid ; ?>">
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