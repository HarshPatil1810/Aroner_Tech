<?php include 'layouts/session.php'; ?>

<?php include 'layouts/head-main.php'; ?>

<?php include 'layouts/config.php'; ?>







<?php 






if(isset($_POST['save']) )
{
   

    $dept=$_POST['DeptName'];
    $name=$_POST['UserName'];
    $email=$_POST['Email'];
    $cname=$_POST['categoryy'];
   
    
    if(isset($_FILES['img']) && $_FILES['img']['size'] > 0){
      $image="";
      $target_dir = "image/";

      $ext = substr(strrchr($_FILES["img"]["name"],'.'),1);
      $target_file = $target_dir ."". time().".".$ext;
      
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      $check = getimagesize($_FILES["img"]["tmp_name"]);

      if($check == true) {

          $uploadOk = 1;

      } else {

          $uploadOk = 0;

      }


      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {

        $image = "image/". time().".".$ext;
      }
  
    
      if($image == null){
        $image = "";
  
    }
  }
  
    $query = "INSERT INTO userinfo (DeptName, UName, Email , cat ,imgurl ) VALUES (?,?,?,?,?)"; 
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "sssis",$dept,$name,$email,$cname,$image);
    $ret = mysqli_stmt_execute($stmt);
    if(!$ret){
    
    echo '<script>alert("Not Saved")</script>';
    }else{
     
     echo '<script>alert("Saved")</script>';
   }
    mysqli_stmt_close($stmt);


    }


  
  
  
  
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



<head>

    <title>Employee Joining Form</title>

    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>



<?php 



    include 'layouts/body.php'; 



?>





<style>

    

        .div p{

            font-size:28px;

            background-color:#D3D3D3;

            margin-left:260px;

            padding-left:200px;

            padding-bottom:15px;     

        }

       

       .div{

        background-color:#D3D3D3;      

       } 

       .div img{

           width: 150px;

           padding-top:10px;

           margin-left:570px;

           padding-bottom:10px;

       }

       

</style> 

<!-- header-->

    

 <!-- end header-->





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

                            <h4 class="mb-sm-0 font-size-18"> ADD EMPLOYEE </h4>

                            



                            <div class="page-title-right">

                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">EMPLOYEE</a></li>

                                    <li class="breadcrumb-item active">Add Employee</li>

                                </ol>

                            </div>



                        </div>

                    </div>

                </div>

    <div class="">

   

                <div class="row" >

                <div class="col-xl-12" ></div>

                    <!-- <div class="col-xl-5"> -->

                        <div class="card">

                            <div class="card-body">

                                <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->

                              

                                

                                <form action="employee-joining-form.php" method="post" enctype="multipart/form-data" >

                                    <div class="row">

                                        <div class="col-md-6">

                                           

                                        <div>   

                                                          

                                    </div>



                                </div>



                                <div class="row">

     

     

       

                                       <div class="col-md-12">

                                          <div class="mb-3">

                                          <h4>PERSONAL DETAILS</h4><br>

                                          </div>

                                       </div>

                                     

                                         



                     

                                <div class="col-md-6">

                                        <div class="mb-3">

                                        <label for="img">Add Image</label>
          <input type="file" class="form-control" name="img" aria-describedby="emailHelp" placeholder="">
          <small id="emailHelp" class="form-text text-muted"></small>

                                        </div>

                                    </div>
                                             

                                          <div class="col-md-6">

                                            <div class="mb-3">

                                            <label for="exampleInputEmail1">Enter Departmeent Name</label>
          <input type="text" class="form-control" name="DeptName" aria-describedby="emailHelp" placeholder="Departmeent Name">
          <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>

                                        </div>

                              <div class="col-md-6">
                              <div class="mb-3">
                              <label for="exampleInputPassword1">Name</label>
          <input type="text" class="form-control" name="UserName" placeholder="Name">
                                          </div>

                                      </div>

                                      

                        


                                        <div class="col-md-6">

                                            <div class="mb-3">

                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="text" class="form-control" name="Email" placeholder="Email">
                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                          <div class="mb-3">

                                          <label for="category">Select Category:</label>
          <select name="categoryy" >
          <?php         
                            $count = 0;
                            $stmt1 = $link->prepare("Select * from category");
                            $stmt1->execute();
                            $result1 = $stmt1->get_result();
                            while ($row1 = $result1->fetch_assoc()){
                            $count++;
                         ?>
                     
	        <option value="<?php echo  $row1['catid']?>"><?php echo  $row1['catid'].".".$row1['catname']?></option>
	       <?php                                
          }
          ?>
</select>

                                          </div>

                                      </div>



                                     
                                    <div>

                                        <center><button type="submit" class="btn btn-primary w-md" name="save" >Save</button></center>

                                    </div>

                                  

                                    

                                </div>    

                                 

                                      

                                </div>  

                             </div>

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

<script>

    

    // function showMSME(value){

    //     if(value< 500000000){

           

    //         document.getElementById("msme"). = true;

            

    //     }else {

            

    //         document.getElementById("msme"). = false;

    //     }

    // }



//     function check(){

        



        

//     if(document.getElementById("checkbox").checked)

//         {

//         document.getElementById("gstno").readOnly = true;

//         document.getElementById("gstno"). = false;

//         document.getElementById('panno').readOnly = false;

//         document.getElementById("panno"). = true;

        

//         }

//     else

//         {

//         document.getElementById("gstno").readOnly = false;

//         document.getElementById("gstno"). = true;

//         document.getElementById('panno').readOnly = true;

//         document.getElementById("panno"). = false;

        

//         }

//     }







//     function showPAN(gstno){

//     if(gstno.length == 15){

//         document.getElementById("panno").value = gstno.substr(2,10);

//         }

//     }



   /* function showAdd(){

    if(document.getElementById("ckecksameaddress").checked){

        document.getElementById("permanentaddress").value = document.getElementById("presentaddress").value;

        }

    }*/



// function getBankData(IFSCCODE)

//   {

//     $.get( "https://ifsc.razorpay.com/"+IFSCCODE)

//         .done(function(data) {

            

//             var obj = (data);

//             console.log(obj);

//             if(obj.hasOwnProperty("BANK")){

//                 document.getElementById("bankname").value = obj.BANK;

//                 document.getElementById("branch").value = obj.BRANCH;

//             }   

//     });

//   }



// function getGST(GST)

//   {

//     // var gstinformat = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/; 



//     // if (gstinformat.test(GST)) {    

        

//     //                 return true;    

//     //             } else {    

//     //                 alert('Please Enter Valid GSTIN Number');    

                     

//     //             } 

//         $.post( "api.php", {action:'verifyGST',gstno:GST})

//         .done(function(data) {

            

//             var obj  = jQuery.parseJSON(data);

//             console.log(obj);

//             if(obj.hasOwnProperty("tradename")){

//                 document.getElementById("companyname").value = obj.tradename;

//                 document.getElementById("registrationaddress").value = obj.address;

//                 document.getElementById("promotersname").value = obj.tradetype;

                

//             }   

//     });

    

//     }





</script>



</html>