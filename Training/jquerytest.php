<?php
include "layouts/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="jquerytest.php" method="post" enctype="multipart/form-data" >

<input type="text" class="form-control" id="uid" name="uid"  style="text-transform:uppercase" value="" > 
                                                
<button type="button" class="fa fa-search btn btn-info" style="margin-top:-32px; margin-left:80px;" name="search" onclick="getuser(document.getElementById('uid').value)">Search</button>

<button type="button" class="fa fa-search btn btn-info" style="margin-top:-32px; margin-left:40px;" name="Update" onclick="updateuser(document.getElementById('uid').value)">Update</button>
<br>
<br>

<div class="col-md-6">
<div class="mb-3">
<label for="exampleInputPassword1">DeptName</label>
<input type="text" class="form-control" name="DeptName"  id="DeptName" aria-describedby="emailHelp" placeholder="Departmeent Name">
<small id="emailHelp" class="form-text text-muted"></small>
</div>

 </div>

<div class="col-md-6">
<div class="mb-3">
<label for="exampleInputPassword1">Name</label>
<input type="text" class="form-control" name="UserName" id="UserName" placeholder="Name">
</div>

</div>
<div class="col-md-6">

<div class="mb-3">

<label for="exampleInputPassword1">Email</label>
<input type="text" class="form-control" name="Email" id="Email" placeholder="Email">
</div>

</div>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

 
<script>

function getuser(uid)
  {
   
        $.get( "api.php", {action:'getuser',uid:uid})

        .done(function(data) {
            console.log(data);
            var obj  = jQuery.parseJSON(data);
            console.log(obj);
            if(obj.hasOwnProperty("DeptName")){
                document.getElementById("DeptName").value = obj.DeptName;
                document.getElementById("UserName").value = obj.UName;
                document.getElementById("Email").value = obj.Email;
                
            }   
    });
    
    }




    function updateuser(uid)
  {
    var uid= document.getElementById("uid").value;
               var DeptName= document.getElementById("DeptName").value;
               var UserName=  document.getElementById("UserName").value;
               var Email= document.getElementById("Email").value;
            
               $.post( "api.php", {action:'update',uid:uid,DeptName:DeptName,UserName:UserName,Email:Email})

        
               .done(function(data) {
            console.log(data);
            var obj  = jQuery.parseJSON(data);
            console.log(obj);
         }
    );
    
}




</script>
</html>