<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>
<?php 

if(!isset($_SESSION['username'])){
    echo "<script>window.location.href = 'auth-login.php';</script>";
}

?>
<head>
    
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <title>Dashboard</title>
</head>

<?php include 'layouts/body.php'; ?>
<style>
  /* .card{
      margin : 0px;
      text-align: center;
      min-height : 120px;
      padding-top : 15px;
  }*/
  body{
    background-color:#ebebeb !important;
  }
     
.card{
      /*margin : 0px;*/
      text-align: center;
      /* min-height : 50px; */
      padding-top :0px;
      padding-bottom : 0px;
      border-radius: 5px;
      /* background:bg-info ; */
      box-shadow: 20px;
  }
/* .card-body{
     margin : 0px;
       } */
</style>
<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <div class="main-content" >

        <div class="page-content">
            <div class="container-fluid">
                
                    <div class="container" >
                        <h2><center>Welcome <?php echo $_SESSION['username']; ?></center></h2>

                    <div class="row">
                        <div class="col-lg-6 mt-4">
                        <a href="list_report.php?type=pending" class="" >
                        <!-- style="background-color: #0080cd;"  -->
                        <!-- text-white -->
                        <!--<div class="card  "  style="background-color:white;">
                            <div class="card-body">
                                <p  style="font-size:18px;padding: 0;color: #0080cd;">Pending Report </p>
                            <?php 
                                // if($_SESSION['usertype']=="Admin"){
                                //     $stmt = $link->prepare('select count(iId) as num from tblmachinedetails where iAproved = 0');
                                // }else{
                                //     $stmt = $link->prepare('select count(iId) as num from tblmachinedetails where iAproved = 0 and sCalibrationBy =?');
                                //     $stmt->bind_param('s',$_SESSION['id'] );
                                // }
                                // //   $stmt->bind_param('i',$Id );
                                //   $stmt->execute();
                                //   $result = $stmt->get_result();
                                //   while($row = $result->fetch_assoc()){
                                
                            ?>
                            <!-- <b><h5 style="font-size:22px; padding: 0; color:#0080cd; text-shadow: #0080cd;"><?php //echo $row['num'] ?></h5></b> -->
                            <?php 
                                
                                 // }
                            ?>
                        </div>
                        </a>
                        </div>
                        </div>

                        <!--<div class="col-lg-6 mt-4">
                        <a href="list_report.php?type=approved" class="" >
                        <!-- style="background-color: #0080cd;"  -->
                        <!-- text-white -->
                        
                        </a>
                        </div>
                        </div>
                    </div>
                    </div>

            </div>
        </div>

        <?php 

        ?>



        <div class="modal fade"  id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="myLargeModalLabel">Load Cell Due Date</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="details" class="row">
                        
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    
    <!-- ============================================================== -->

        <?php include 'layouts/footer.php'; ?>
    <!-- end main content-->
    </div>
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- <script src="assets/js/pages/dashboard.init.js"></script> -->

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>
<script>
    // function getDetails()
    // {
    //     var html = '';
    //     $.post( "api.php", { action:'duedateloadcell' })
    //         .done(function( data ) {
    //         var myObj = JSON.parse(data);
    //         console.log(myObj);
    //         for (const x in myObj) {
    //             // console.log(myObj[x]);
    //             // html += '<div class="col-md-6"><div class="mb-3"><label for="formrow-firstname-input" class="form-label">'+x+'</label><label class="form-control">'+myObj[x]+'</label></div></div>';
    //         }

    //         var details = document.getElementById('details');
    //         details.innerHTML = '';
    //         details.innerHTML = html;
    //         if(myObj['sCalibrationDue']>date()){
    //             $('#detailsModal').modal('show');
    //         }

          
    //     });
    // }

    function getDetails(){
   
        $.ajax({
        type: "POST",
        url: "api.php",
        dataType:"text",
        data:{action:'duedateloadcell'},
        success: function(data){
            console.log(data);
            var html = '';
            var obj = JSON.parse(data);
        //   var myObj = JSON.parse(data);
            var q = new Date();
            var sCalibrationDue = new Date(obj[0]['sCalibrationDue']) ;
            var date = new Date(obj[0]['date']);
                var details = document.getElementById('details');
                details.innerHTML = '';
                details.innerHTML = html;
                    console.log(sCalibrationDue >= q );
                // if(sCalibrationDue >= q && q >= date){
                if( q >= date ){
                    const m = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"];
                    const str_op = sCalibrationDue.getDate() + ' ' + m[sCalibrationDue.getMonth()] + ' ' + sCalibrationDue.getFullYear();

                    html += '<h5> Load Cell <b>'+obj[0]['loadcell']+'</b> Due Date on '+str_op+' . </h5>';
                    var details = document.getElementById('details');
                    details.innerHTML = '';
                    details.innerHTML = html;
                    $('#detailsModal').modal('show');
                }

            }
        });
    }

    getDetails();

</script>
 

</html>