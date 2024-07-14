<?php

session_start();
include "layouts/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action'] == 'update'){
        
        $uid = $_POST['uid'];
        $DeptName =  $_POST['DeptName'];
        $UserName= $_POST['UserName'];
        $Email= $_POST['Email'];
     
            $query = "update  userinfo set  DeptName=?,UName=?,Email=? where uid=?";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "sssi", $DeptName, $UserName,$Email, $uid );
            $ret = mysqli_stmt_execute($stmt);
        
            mysqli_stmt_close($stmt);
            if (!$ret) {
                echo "Data Not Update";
             }
             else
             {
                // echo " <script type="text/javascript">alert("Data Deleted");</script>;
                echo "Uptaded";
             
             }
          
        }
}
else if($_GET['action'] == 'getuser')
    {
        // $Type  = $_GET['Type'];
        $output=[];
        $Model  = $_GET['uid'];
        $stmt = $link->prepare('select * from userinfo where uid= ?');
        $stmt->bind_param('i',$Model);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc())
        {
            
                    $output=$row;    
        }
            
            echo json_encode($output);
        return;

        }else if($_GET['action'] == 'getusers')
        {
            $output=[];
           
            $stmt = $link->prepare('select * from userinfo');
            
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                
                        $output[]=$row;    
                    }
                
                echo json_encode($output);
            return;
        }else if($_GET['action'] == 'getname')
        {
            // $Type  = $_GET['Type'];
            $output=[];
            $Model  = $_GET['UName'];
            $stmt = $link->prepare('select * from userinfo where UName= ?');
            $stmt->bind_param('s',$Model);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                
                        $output[]=$row;    
                    }
                
                echo json_encode($output);
            return;
    
            }else if($_GET['action'] == 'getdept')
            {
                // $Type  = $_GET['Type'];
                $output=[];
                $Model  = $_GET['DeptName'];
                $stmt = $link->prepare('select * from userinfo where DeptName= ?');
                $stmt->bind_param('s',$Model);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    
                            $output[]=$row;    
                        }
                    
                    echo json_encode($output);
                return;
        
                }else if($_GET['action'] == 'getemail')
                {
                    // $Type  = $_GET['Type'];
                    $output=[];
                    $Model  = $_GET['Email'];
                    $stmt = $link->prepare('select * from userinfo where Email= ?');
                    $stmt->bind_param('s',$Model);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                        
                     $output[]=$row;    
                     }
                        
                    echo json_encode($output);
                    return;
            
                    } 
    

        
        

?>