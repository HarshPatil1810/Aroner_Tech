


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
    

/*if(isset($_POST['btnupdate']) && isset($_POST['usernameup'])){
  $u  = $_POST['usernameup']; 

  $deptu = $_POST['DeptName'];
  $emailu=$_POST['email'];
  
  $query = "update userinfo set DeptName=?, Email=? where UName=?";
  $stmt = mysqli_prepare($link,$query);
  mysqli_stmt_bind_param($stmt, "sss", $deptu,$emailu,$u);
  $ret = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  // exit();

  if(!$ret){
      $msg= "Data Not Updated";
  }else{
      $msg= "Data Updated";

      echo "<script>window.location.href = 'list-results.php';</script>";
  } 

}*/


 
?>
<head>
<?php include 'layouts/head.php'; ?>
 <?php include 'layouts/head-style.php'; ?>
</head>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Program</title>
    <?php include 'layouts/head.php'; ?>
    <?php  include 'layouts/head-style.php'; ?>
</head>
<style>
  <?php include 'layouts/body.php'; ?>
  </style>
<body>
     
    <?php //include 'layouts/menu.php'; ?>
    <form action="UserAdd.php" method="post" enctype="multipart/form-data">
          

      <div class="container">

      <div class="form-group">
       <center> <h2>Add User</h2></center>
          <label for="img">Add Image</label>
          <input type="file" class="form-control" name="img" aria-describedby="emailHelp" placeholder="">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">Enter Departmeent Name</label>
          <input type="text" class="form-control" name="DeptName" aria-describedby="emailHelp" placeholder="Departmeent Name">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Name</label>
          <input type="text" class="form-control" name="UserName" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="text" class="form-control" name="Email" placeholder="Email">
          </div>
          <br>
          <div class="form-group" style="padding-top=1cm ">
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

<button type="submit" name="save" class="btn btn-primary" value="Insert">Insert</button>
       
    </div>
    
    </form>


 
  
  
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

<form action="UserAdd.php" method="post">
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
</tbody>
</table>

<?php include 'layouts/right-sidebar.php'; ?>


<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>



        
</body>
<br>
<br>
<?php  //include 'layouts/footer.php';?>
</html>



