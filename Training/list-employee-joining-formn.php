<?php include 'layouts/config.php';
?>
<?php include 'layouts/session.php'; ?>

<?php include 'layouts/head-main.php'; ?>



<head>

    <title>List Employee Registration Form</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>



<?php include 'layouts/body.php'; 
 if (isset($_POST['btndelelte']))
 {
       
   $query = "DELETE from userinfo where uid = ?";
   $stmt = mysqli_prepare($link,$query);
   mysqli_stmt_bind_param($stmt, "i", $_POST['usernamedel']);
   $ret = mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);

   if (!$ret) {
      echo "Data Not Deleted";
   }
   else
   {
      // echo " <script type="text/javascript">alert("Data Deleted");</script>;
      echo "deleted";
   
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

                            <h4 class="mb-sm-0 font-size-18">List Employee joining Form</h4>



                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Employee Joining Form</a></li>

                                    <li class="breadcrumb-item active">List employee joining Form</li>

                                </ol>

                            </div>



                        </div>

                    </div>

                </div>

                <!-- end page title -->

                


        

                    




                <table id="datatable" class="table table-bordered table-striped">

                    <thead>

                        <tr>

                        <th>Name</th>
    <th>Dept</th>
    <th>Email</th>
    <th>Category</th>
    <th>Image</th>
    <th>Delete</th>
    <th>Edit</th>

                         
                          

                         

                        </tr>  

                    </thead> 

                    <tbody>
                        <tr>
                    <?php         
                            $count = 0;
                            $stmt1 = $link->prepare("Select * from userinfo");
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                       
                          ?>
                        <td><?php echo htmlentities($row1['UName']);?></td>
                        <td><?php echo htmlentities($row1['DeptName']);?></td>
                        <td><?php echo htmlentities($row1['Email']);?></td>
                        <td><?php echo htmlentities($row1['cat']);?></td>
                        <td><img src="<?php echo htmlentities($row1['imgurl']); ?>" alt="not" height="36cm" /></td>
                    

<td>

<form action="list-employee-joining-formn.php" method="post">
<input type="hidden" name="usernamedel" value="<?php echo htmlentities($row1['uid'], ENT_QUOTES);?>">
  <button type="submit" name="btndelelte" value="Delete" onclick="return confirm('Are you sure you want to delete this Data?');" class="btn btn-danger">Delete</button>
  </form>
</td>

<td>

<form action="update.php" method="post">
<input type="hidden" name="userid" value="<?php echo htmlentities($row1['uid']);?>">
  <button type="submit" name="btnupdate" value="Delete" onclick="" class="btn btn-primary " style="my=1cm">Update</button>
  </form>
</td>
</tr>
                       
 <?php
}
?>

</table> 
</div> <!-- container-fluid -->
 </div>

        <!-- End Page-content -->







       
                        <br>

                        <!-- class="row" -->

                        

                    </div>

                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        

     

                       

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





    

   



</body>
</html>