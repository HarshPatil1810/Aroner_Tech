<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>
    <title>Send Contractor Whatsapp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; 


if(!isset($_SESSION['id'])){

    header("Location:auth-login.php");

}





          

                          if (isset($_POST['btnsubmit'])) {
                            if (isset($_POST['contractor'])) {
                                $number = [];
                                $contractor = $_POST['contractor'];
                                $stmt = $link->prepare('SELECT * FROM tblcontractorregform WHERE iContractorRegFormId=? ORDER BY sCreatedTimestamp DESC LIMIT 1');
                                foreach ($contractor as $id) {
                                    $stmt->bind_param('i', $id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $number[] = $row['sContactNumber'];
                                    }
                                }
                            } else {
                                $number = [];
                                $stmt = $link->prepare('SELECT * FROM tblcontractorregform ORDER BY sCreatedTimestamp DESC LIMIT 1');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $number[] = $row['sContactNumber'];
                                }
                            }
  

              
                    
              
                  if(isset($_POST['textmsg'])){
              
                      $textmsg = $_POST['textmsg'];
              
                  }
              



                  $imagepath = "";

                  if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){

                    $target_dir = "whatsappimages/";

                    //$target_dir = "banners/";  

                    

                    $ext = substr(strrchr($_FILES["image"]["name"],'.'),1);

                    $target_file = $target_dir . time().".".$ext;

                  

                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    $check = getimagesize($_FILES["image"]["tmp_name"]);

                    if($check == true) {

                        $uploadOk = 1;

                    } else {

                        $uploadOk = 0;

                    }

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $imagepath = "http://hrm.fietest.in/whatsappimages/". time().".".$ext;

                   

                    }

                }



  



    // print_r($_FILES['image']['name']);

    if(!isset($textmsg)){

        

        for ($i=0; $i < count($number); $i++) {

       

        //   $msg1 = urlencode($textmsg);

           $url = "https://wtsapp.aronertech.com/api/sendFiles?token=63f89bac68342404fd9ee0fc&phone=91".trim($number[$i])."&link=".$imagepath."";

    

           $ch = curl_init($url);

    

          //  echo $url;

      // exit();

           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

           curl_setopt($ch, CURLOPT_HEADER, 0);

           $result = curl_exec($ch);

           

           

           if (strpos($result, 'error') !== false) {

               $name = "";

                $stmt1 = $link->prepare('select sName from tblcontractorregform where sContactNumber=?');

                $stmt1->bind_param('s',$number[$i]);

                $stmt1->execute();

                $result1 = $stmt1->get_result();

                while($row1 = $result1->fetch_assoc()){

                  $name = $row1['sName'];

                }

               

                $query = "insert into tblwahtsapperror (sNumber,sName,sError) values (?,?,?)";

                $stmt = mysqli_prepare($link,$query); 
                mysqli_stmt_bind_param($stmt,"sss",$number[$i],$name,$result);

                $ret = mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);

            }

           

           curl_close($ch);

    

         }

    

     


        

    }else if ($_FILES['image']['name'] == "") {



      for ($i=0; $i < count($number); $i++) {

       

       $msg1 = urlencode($textmsg);

       $url = "https://wtsapp.aronertech.com/api/sendText?token=63f89bac68342404fd9ee0fc&phone=91".trim($number[$i])."&message=".$msg1."";



       $ch = curl_init($url);



      //  echo $url;

  // exit();

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       curl_setopt($ch, CURLOPT_HEADER, 0);

       $result = curl_exec($ch);

       

       if (strpos($result, 'error') !== false) {

               $name = "";

                $stmt1 = $link->prepare('select sName from tblcontractorregform where sContactNumber = ?');

                $stmt1->bind_param('s',$number[$i]);

                $stmt1->execute();

                $result1 = $stmt1->get_result();

                while($row1 = $result1->fetch_assoc()){

                  $name = $row1['sName'];

                }

               

                $query = "insert into tblwahtsapperror (sNumber,sName,sError) values (?,?,?)";

                $stmt = mysqli_prepare($link,$query); mysqli_stmt_bind_param($stmt,"sss",$number[$i],$name,$result);

                $ret = mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);

            }

       

       curl_close($ch);



     }



    


    }else{

      for ($i=0; $i < count($number); $i++) {



        $msg1 = urlencode($textmsg);

        $url = "https://wtsapp.aronertech.com/api/sendFileWithCaption?token=63f89bac68342404fd9ee0fc&phone=91".$number[$i]."&link=".$imagepath."&message=".$msg1."";

      

        $ch = curl_init($url);



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = curl_exec($ch);

        

        if (strpos($result, 'error') !== false) {

               $name = "";

                $stmt1 = $link->prepare('select sName from tblcontractorregform where sContactNumber = ?');

                $stmt1->bind_param('s',$number[$i]);

                $stmt1->execute();

                $result1 = $stmt1->get_result();

                while($row1 = $result1->fetch_assoc()){

                  $name = $row1['sName'];

                }

               

                $query = "insert into tblwahtsapperror (sNumber,sName,sError) values (?,?,?)";

                $stmt = mysqli_prepare($link,$query); mysqli_stmt_bind_param($stmt,"sss",$number[$i],$name,$result);

                $ret = mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);

            }

        

        curl_close($ch);



     }

    //  $obj = json_decode($result, true);

    // //  print_r($obj['status']);



    //  if ($obj['status'] == 'error') {

    //   $msg = "Message Not Sent..";

    //  }else{

    //   $msg = "Message Sent";

    //  }

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
                
            <div class="content-wrapper">

  

                          <section class="content-header">

                                         <h2>Send Contractor Whatsapp </h2> </section>   
                                                    
                                                    
                                                    <section class="content">
                                                     <div class="box box-warning">

                                                    <div class="box-header with-border">
                                                    <div class="box-body">

                                                    <form role="form" action="sendwhastsapp-Contractor.php" method="post"  enctype="multipart/form-data">
                                                   <div class="col-md-12 row">
                                                 <?php

                                               if(isset($msg)){
                                                echo $msg;
                                                            }

                                                        ?>

                      <div class="col-md-3">
                          <div class="mb-3">
                              <label for="formrow-firstname-input" class="form-label">Contractor:</label>
                              




                      <select class="form-control" name="contractor[]"  multiple >
                      <?php
                      if($_SESSION["usertype"] == "Admin"){ ?>

                      <?php } ?>
                      <?php
                      if($_SESSION["usertype"] == "Admin"){
                      $stmt = $link->prepare('select * from tblcontractorregform');
                      }else{
                      $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId = ?');
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







 



 












 


</div>

</div>    

<br>



 
             
                   


                    

                  
  
                    <div class="col-md-12">

                    

                        <div class="col-md-9 form-unit">

                          <label>Message</label>

                          <textarea class="form-control" name="textmsg" rows="4"></textarea>                         

                        </div>

                    </div> 

                    <div class="col-md-12">

                    

                        <div class="col-md-9 form-unit">

                          <label>Image</label>

                           <input type="file" class="form-control" name="image" id="image">                      

                        </div>

                    </div>
<br>


                     <div class="col-md-12">

                    

                        <div class="col-md-9 form-unit">

                   <CENTER>

                       <button type="submit" name="btnsubmit" value="Save" class="btn btn-info">Send</button>

                   </CENTER>

                 </div>

               </div>

                   

                </div>

              </form>

                

               

         </div>

        </div>

  </section>  

</div>  


                  
                        

               

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