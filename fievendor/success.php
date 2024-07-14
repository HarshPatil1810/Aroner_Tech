<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>



<head>
    <title>Vendor Registration Successful</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php 

    include 'layouts/body.php'; 

?>


<style>

        p{
            margin-top:20px;
            font-size:16px;
            text-align: justify;
        }
    
        .div p{
            font-size:28px;
            background-color:#D3D3D3;
            padding-bottom:15px;     
        }
       
       .div{
        background-color:#D3D3D3;      
       } 
       .div img{
           padding-top:10px;
           padding-bottom:10px;
           margin:auto;
       }
       
</style> 
<!-- header-->
     <div class="div">    
        <img src="assets/images/new-logo.jpg" alt=""  width="" style="width:15%;margin:auto;display:block" ></div>
        <div class="div">    
        <p style="margin:auto;display:block;text-align:center">Vendor Registration Form</p>  
     </div>
 <!-- end header-->
<div>

<!-- Begin page -->
<div id="layout-wrapper">


    <?php// include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="">
   
                <div class="row" >
                <div class="col-xl-3" ></div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets\images\checked.png" style="width:25%;margin:auto;display:block">
                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->
                                <h2 style="margin-top:30px;text-align:center">Vendor Registration Successful !!!</h2>
                                <p>Congratulations! Your registration with Fuel Instruments And Engineers Pvt Ltd has been successfully completed. We are excited to welcome you to our community! </p>
                                <p>Shortly, you will receive a confirmation email containing a summary of the information you provided during registration.</p>
                                <p>We look forward to working with you!!!</p>
                                
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    
                </div>
                <!-- end row -->
                <div class="col-xl-3"></div>
               

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php //include 'layouts/footer.php'; ?>
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