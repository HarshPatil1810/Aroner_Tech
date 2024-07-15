<?php include 'layouts/config.php'; 

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

  

$count=0;

    $output[] = array("Sr. No.","Act Name","Compliances","Factory Name","Date","Due Date","Cost","Remark");

    $stmt1 = $link->prepare("select * from tblfactory where YEAR(sDueDate) = YEAR(CURDATE()) order by  sDueDate ASC  ");

    // $stmt1->bind_param('i',$_POST['FactoryId']);



    $stmt1->execute();

    $result1 = $stmt1->get_result();

    while ($row1 = $result1->fetch_assoc()){
        $count++;


        $Complinces = "";

        $stmt2 = $link->prepare("Select * from tblcompliance  where iComplianceId =?");

        $stmt2->bind_param('i',$row1['iComplianceID']);

        $stmt2->execute();

        $result2 = $stmt2->get_result();

        while ($row2 = $result2->fetch_assoc()){

                $Complinces = "";

                $stmt3 = $link->prepare("Select * from tblact  where iActId =?");

                $stmt3->bind_param('i',$row2['sActName']);

                $stmt3->execute();

                $result3 = $stmt3->get_result();

                while ($row3 = $result3->fetch_assoc()){
                    $row1['sActName']=$row3['sActName']; 
                }

        //   echo htmlentities($row2['sName'],ENT_QUOTES);

        $row1['Complinces']=$row2['sName'];        

      }



        $output[] = array($count,$row1['sActName'], $row1['Complinces'], $row1['sFactoryName'] ,date("d/m/Y",strtotime($row1['sDate'])),date("d/m/Y",strtotime($row1['sDueDate'])),$row1['sCost'],$row1['sRemark']);

    }



    download_send_headers("factory_export_" . date("Y-m-d") . ".csv");

    echo array2csv($output);

    return;



}



?>
<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Current Year Compliance Report</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>



<?php include 'layouts/body.php'; 



    

    // $msg = "";



    // if (isset($_POST['WorkSheetId'])) {

        

    //     $query = "DELETE from tblworksheetforrockwell where iWorkSheetId = ?";

    //     $stmt = mysqli_prepare($link,$query);

    //     mysqli_stmt_bind_param($stmt, "i", $_POST['WorkSheetId']);

    //     $ret = mysqli_stmt_execute($stmt);

    //     mysqli_stmt_close($stmt);



    //     if (!$ret) {

    //         $msg  = "Data Not Deleted";

    //     }

    //     else{

    //         $msg  = "Data Deleted";

    //     }



    // }





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

                            <h4 class="mb-sm-0 font-size-18">List Current Year Compliance Report</h4>



                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Current Year Compliance Report</a></li>

                                    <li class="breadcrumb-item active">List Current Year Compliance Report</li>

                                </ol>

                            </div>



                        </div>

                    </div>

                </div>

                <!-- end page title -->

                <form action="current-year-compliance.php" method="post" enctype="multipart/form-data"  >

                <div class="mb-3">

                                              <label for="formrow-firstname-input" class="form-label">&nbsp;</label><br>

                                              <button type="submit" name="btnExport" value="FactoryId" class="btn btn-info" >Export CSV</button>

                                          </div>

                                      </div>

                                      </form>

                <table id="datatable" class="table table-bordered table-striped" >

                <div class="col-md-12">

                                  

                    <thead>

                        <tr>

                          

                          <th>Sr No.</th>

                          

                          <th>Act</th>

                          <th>Compliance</th> 

                          <th>Factory Name</th>                         

                          <th>Date</th>

                          <th>Due Date</th>

                          <th>cost</th>

                          <th>Remark</th>

                          

                    <!-- <th>Calibration By </th> -->

                     

                         

                       

                        </tr>  

                    </thead> 

                    <tbody>

                        <?php         

                            $count = 0;



                            $stmt1 = $link->prepare(" select * from tblfactory where YEAR(sDueDate) = YEAR(CURDATE()) order by  sDueDate ASC ");

                            // $stmt1->bind_param('s',$_SESSION['id'] );

                            $stmt1->execute();

                            $result1 = $stmt1->get_result();

                            while ($row1 = $result1->fetch_assoc()){

                            $count++;

                        ?>



                        <tr>

                            <td><?php echo $count; ?></td>

                            <td><?php 

                             

                             $stmt = $link->prepare("SELECT * from tblact where iActId in (select sActName from  tblcompliance where iComplianceId =?)");

                             $stmt->bind_param('i',$row1['iComplianceID']);

                             $stmt->execute();

                             $result = $stmt->get_result();

                             while ($row = $result->fetch_assoc()){        

                                 echo htmlentities($row['sActName'], ENT_QUOTES);

                             }   



            //      $stmt2 = $link->prepare("Select * from tblcompliance  where iComplianceId =?");

            //      $stmt2->bind_param('i',$row1['ComplianceId ']);

            //      $stmt2->execute();

            //      $result2 = $stmt2->get_result();

            //      while ($row2 = $result2->fetch_assoc()){

            //        echo htmlentities($row2['sActName'],ENT_QUOTES);  

                     

            //    }



                         

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

                           <td><?php echo htmlentities($row1['sFactoryName'], ENT_QUOTES);?></td>

                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row1['sDate'])), ENT_QUOTES);?></td>

                            <td><?php echo htmlentities(date("d-m-Y",strtotime($row1['sDueDate'])), ENT_QUOTES);?></td>

                            <td><?php echo htmlentities($row1['sCost'], ENT_QUOTES);?></td>

                            <td><?php echo htmlentities($row1['sRemark'], ENT_QUOTES);?></td>

                           



                        



                        </tr>



                        <?php 

                            }

                        ?> 

                    </tbody>

                </table> 



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