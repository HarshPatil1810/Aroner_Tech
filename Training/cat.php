<?php
include 'layouts/config.php';
include 'layouts/head-main.php';
include 'layouts/body.php';
if(isset($_POST['addcat']) )
{
   

    $cname=$_POST['catname'];
    
        
    $query = "INSERT INTO category (catname) VALUES (?)"; 
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt, "s",$cname);
    $ret = mysqli_stmt_execute($stmt);
    if(!$ret){
     echo "Data Not Saved";
    }else{
      echo '<script>alert("Saved")</script>';
   }
    mysqli_stmt_close($stmt);
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include 'layouts/head.php'; ?>
    <?php  include 'layouts/head-style.php'; ?>
</head>
<body>
    
<form action="cat.php" method="post" >
		
<div class="container">
<div class="form-group">
    <h4>Category Details:</h4>
          <label for="categeory">Enter Categeory Name</label>
          <input type="text" class="form-control" name="catname"  placeholder="Categeory">
          <button type="submit" class="btn btn-primary" name="addcat" style="padding-top=5cm">Insert</button>
    </div>
    </div>
</form>
</body>
<?php  include 'layouts/footer.php';?>
</html>