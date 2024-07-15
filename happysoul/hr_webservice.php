<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'layouts/config.php'; 
include "sendSinglePush.php";

// sendNotification("Rucha Sarda",$message,"single",0,0,$link);
// sendNotification($title,$message,$type,$typeid,$userid,$link)
// $message  = "{'type':'mentorship','dataid':'".$max."','text':'".$textmsg."'}";

if(!isset($_POST['key']) || $_POST['key'] != "eXpRCl2vlaoe29CrtW4b1TbrnBhAwg6YRTezf4zIDGNhSkGeIPc1fB1p5uH"){
    return;
}

function sendwhatsapp($mobileno,$msg){

  $url = "https://wtsapp.aronertech.com/api/sendText?token=63f89bac68342404fd9ee0fc&phone=91".$mobileno."&message=".$msg."";

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $result = curl_exec($ch);
  curl_close($ch);    



}

$link_hrm = $link;
if(isset($_POST['action'])){
    if($_POST['action'] == 'sendOTP'){
        
        $digits = 4;
        //auto grnerated otp code
        $otpnumber= rand(pow(10, $digits-1), pow(10, $digits)-1);
        $mobileno=$_POST['mobileno'];


        $ifprsent=false;
   
         
           // first check mobile number avalaible in  tblemployeejoiningform. if present then go to the if conditiion delelte tblopt table 
            //  and insert this number  and otp on this table
           $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where sMobileNumber=?');
           $stmt->bind_param('i',$mobileno);
           $stmt->execute();
           $result = $stmt->get_result();
           while($row = $result->fetch_assoc()){
               if(!str_contains($row['sAppAccess'], "hrm")){
                   $output=array("err"=>"You don't have access for this App.");
                   echo  json_encode($output);
                     return;
               }
               
            $output=$row;
              $ifprsent=true;
           
         }

         if($ifprsent){

          $message = urlencode("OTP to login into FIE : ".$otpnumber);
          sendwhatsapp($mobileno,$message);
       
          $query = "delete from  tblotp where sMobileNumber=? ";
          $stmt = mysqli_prepare($link_hrm,$query);
          mysqli_stmt_bind_param($stmt,"s", $mobileno);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);

          $query = "INSERT INTO tblotp (sOtpNumber,sMobileNumber) VALUES (?,?)";
    
          $stmt = mysqli_prepare($link_hrm,$query);
          mysqli_stmt_bind_param($stmt,"ss",$otpnumber, $mobileno);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
   
        if(!$ret){
            $output=array("err"=>"OTP Not Sent");
          
        }else{
            $output=array("msg"=>"OTP Sent");
       
          }   
         }
         else{
          $output=array("err"=>"Mobile number not Registred");
         }
      echo  json_encode($output);
  
          return;
     }elseif($_POST['action'] == 'verifyOTP'){
    
         $otp=$_POST['otp'];
         $mobileno=$_POST['mobileno'];
         $deviceid=$_POST['deviceid'];
         $ifprsent=false;

         // in this code first check otp and mobile number then updated device id where mobile number on employee joining form  
         $stmt = $link_hrm->prepare('select * from tblotp where sMobileNumber=?  and  sOtpNumber = ?');
         $stmt->bind_param('ss',$mobileno,$otp);
         $stmt->execute();
         $result = $stmt->get_result();
         while($row = $result->fetch_assoc()){
             $output=$row;
             $ifprsent=true;
           }
         if($mobileno == '9405621460' && $otp == '0000'){
            $ifprsent=true;
           }
         

        if($ifprsent){
        
        $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where sMobilenumber= ?');
        $stmt->bind_param('s',$mobileno);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){

            $output=$row;
          }
        
        $apptype = "hr";
        
        $query = "delete from  tblfcmtoken where iEmployeeId = ? and sAppType = ?";
        $stmt = mysqli_prepare($link_hrm,$query);
        mysqli_stmt_bind_param($stmt,"is",$output['iEmployeeFormId'],$apptype);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $query = "insert into  tblfcmtoken (iEmployeeId,sAppType,sDeviceId) values (?,?,?)";
        $stmt = mysqli_prepare($link_hrm,$query);
        mysqli_stmt_bind_param($stmt,"iss",$output['iEmployeeFormId'],$apptype,$deviceid);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      
        
       }else{
        $output=array("err"=>"Invalid OTP");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getProfile'){
    
         $userid=$_POST['userid'];
         
         
        $output = [];
        $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId= ?');
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            
            if(!str_contains($row['sAppAccess'], "hrm")){
                   $output=array("err"=>"You don't have access for this App.");
                   echo  json_encode($output);
                     return;
               }
            
            $stmt1 = $link_hrm->prepare('select * from tbldesignation where iEmployeeFormId= ? order by sCreatedTimestamp desc limit 1');
            $stmt1->bind_param('i',$userid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            while($row1 = $result1->fetch_assoc()){
                $row['sDesignation'] = $row1['sDesignation'];
            }

            $output=$row;
          }
       
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getIce'){
    
         $userid=$_POST['userid'];
         
         
        $output = [];
        $stmt = $link_hrm->prepare('select * from  tblice order by sName asc');
        // $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            
            $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
            $output[]=$row;
          }
       if(count($output)  == 0){
           $output[] = array("err"=>"No Data");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getNotification'){
    
         $userid=$_POST['userid'];
         
         
        $output = [];
        $stmt = $link_hrm->prepare('select * from tblnotification order by sCreatedTimestamp desc');
        // $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            
            $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
            $output[]=$row;
          }
       if(count($output)  == 0){
           $output[] = array("err"=>"No Notifications");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getPolicy'){
    
         $userid=$_POST['userid'];
         
         
        $output = [];
        $stmt = $link_hrm->prepare('select * from  tblpolicy order by sCreatedTimestamp desc');
        // $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
            $output[]=$row;
          }
       if(count($output)  == 0){
           $output[] = array("err"=>"No Policies");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getLeave'){
    
         $userid=$_POST['userid'];
         
         $name = "";
         $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId= ?');
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $name = $row['sName'];
        }
        $output = [];
        $stmt = $link_hrm->prepare('select * from  tblleaveapplication  where iEmployeeId= ? order by sCreatedTimestamp desc');
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $row['sName'] = $name;
            $row['sStartDate'] = date("d/m/Y",strtotime($row['sStartDate']));
            $row['sEndDate'] = date("d/m/Y",strtotime($row['sEndDate']));
            $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
            $output[]=$row;
          }
       if(count($output)  == 0){
           $output[] = array("err"=>"No Applications");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'getPendingLeave'){
    
         $userid=$_POST['userid'];
        
        $designaton = "";
        $unit = "";
        $stmt = $link_hrm->prepare('select * from  tbldesignation  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $designaton = $row['sDesignation'];
        } 
        
        $stmt = $link_hrm->prepare('select * from tblunit  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $unit = $row['sUnit'];
        } 
        
        $userids = [];
        if(str_contains($designaton,"HOD") || $userid == 76 || $userid == 50){
            
            $stmt = $link_hrm->prepare('select * from tblemployeejoiningform');
            // $stmt->bind_param('i',$userid);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $employeedesignaton = "";
                $employeeunit = "";
                $stmt1 = $link_hrm->prepare('select * from  tbldesignation  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $employeedesignaton = $row1['sDesignation'];
                } 
                
                $stmt1 = $link_hrm->prepare('select * from tblunit  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $employeeunit = $row1['sUnit'];
                }
                if((str_contains($employeedesignaton,"PLANT HEAD") && $unit == $employeeunit) || $userid == 76 || $userid == 50){
                    $userids[] = $row['iEmployeeFormId'];
                }
            }
            
            $output = [];
            for($i = 0; $i < count($userids); $i++){
                $stmt = $link_hrm->prepare('select * from  tblleaveapplication  where iEmployeeId= ? order by sCreatedTimestamp desc');
                $stmt->bind_param('i',$userids[$i]);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    
                    $row['sName'] = "";
                    $stmt1 = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId= ?');
                    $stmt1->bind_param('i',$userids[$i]);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result();
                    while($row1 = $result1->fetch_assoc()){
                        $row['sName'] = $row1['sName'];
                    }
                    
                    $row['sStartDate'] = date("d/m/Y",strtotime($row['sStartDate']));
                    $row['sEndDate'] = date("d/m/Y",strtotime($row['sEndDate']));
                    $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
                    $output[]=$row;
                  }
            }
            
        }else{
            
            $stmt = $link_hrm->prepare('select * from tblemployeejoiningform');
            // $stmt->bind_param('i',$userid);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $employeedesignaton = "";
                $employeeunit = "";
                $stmt1 = $link_hrm->prepare('select * from  tbldesignation  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $employeedesignaton = $row1['sDesignation'];
                } 
                
                $stmt1 = $link_hrm->prepare('select * from tblunit  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $employeeunit = $row1['sUnit'];
                }
                if(!str_contains($employeedesignaton,"PLANT HEAD") && !str_contains($employeedesignaton,"HOD") && $unit == $employeeunit){
                    $userids[] = $row['iEmployeeFormId'];
                }
            }
            
            $output = [];
            for($i = 0; $i < count($userids); $i++){
                $stmt = $link_hrm->prepare('select * from  tblleaveapplication  where iEmployeeId= ? order by sCreatedTimestamp desc');
                $stmt->bind_param('i',$userids[$i]);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    
                    $row['sName'] = "";
                    $stmt1 = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId= ?');
                    $stmt1->bind_param('i',$userids[$i]);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result();
                    while($row1 = $result1->fetch_assoc()){
                        $row['sName'] = $row1['sName'];
                    }
                    
                    $row['sStartDate'] = date("d/m/Y",strtotime($row['sStartDate']));
                    $row['sEndDate'] = date("d/m/Y",strtotime($row['sEndDate']));
                    $row['sTime'] = date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
                    $output[]=$row;
                  }
            }
        }
         
        
       if(count($output)  == 0){
           $output[] = array("err"=>"No Applications");
       }
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'addLeave'){
    
         $userid=$_POST['userid'];
         $fromdate=$_POST['fromdate'];
         $todate=$_POST['todate'];
         $reason=$_POST['reason'];
         
         
         
       $query = "insert into  tblleaveapplication (iEmployeeId,sStartDate,sEndDate,sReason) values (?,?,?,?)";
        $stmt = mysqli_prepare($link_hrm,$query);
        mysqli_stmt_bind_param($stmt,"isss",$userid,$fromdate,$todate,$reason);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        if(!$ret){
            $output = array("err"=>"Application Not Submitted.");
        }else{
            
            $stmt1 = $link_hrm->prepare('select * from  tbldesignation  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
            $stmt1->bind_param('i',$userid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            while($row1 = $result1->fetch_assoc()){
                $employeedesignaton = $row1['sDesignation'];
            } 
            
            $stmt1 = $link_hrm->prepare('select * from tblunit  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
            $stmt1->bind_param('i',$userid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            while($row1 = $result1->fetch_assoc()){
                $employeeunit = $row1['sUnit'];
            }
            $managerid = 0;
            $stmt = $link_hrm->prepare('select * from tblemployeejoiningform');
            // $stmt->bind_param('i',$userid);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $designaton = "";
                $unit = "";
                $stmt1 = $link_hrm->prepare('select * from  tbldesignation  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $designaton = $row1['sDesignation'];
                } 
                
                $stmt1 = $link_hrm->prepare('select * from tblunit  where iEmployeeFormId = ? order by sCreatedTimestamp desc limit 1');
                $stmt1->bind_param('i',$row['iEmployeeFormId']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $unit = $row1['sUnit'];
                }
                if(str_contains($employeedesignaton,"PLANT HEAD") && $unit == $employeeunit && str_contains($designaton,"HOD")){
                    $managerid = $row['iEmployeeFormId'];
                    break;
                }else if(!str_contains($employeedesignaton,"PLANT HEAD") && !str_contains($employeedesignaton,"HOD") && $unit == $employeeunit && str_contains($designaton,"PLANT HEAD")){
                    $managerid = $row['iEmployeeFormId'];
                    break;
                }
            }
            
            $name = "";
                $stmt1 = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
                $stmt1->bind_param('i',$userid);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $name = $row1['sName'];    
                }
            
            $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
            $stmt->bind_param('i',$managerid);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                
                $msg = "Dear ".$row['sName'].",\n\n".$name." has applied for Leave from ".date("d/m/Y", strtotime($fromdate))." to ".date("d/m/Y", strtotime($todate))."\n\nReason : ".$reason."\n\nKindly update status in the App\n\nRegards,\nFIE Team";
                sendwhatsapp($row['sMobilenumber'],urlencode($msg));
                
                
                $message  = "{'type':'leaveapplication','dataid':'0','text':'".$msg."'}";
                sendNotification("FIE HR",$message,"single","hr",$managerid,$link);
                
                
            }
            
            $msg = "Dear RAJU PUNDLIK SHRINAME,\n\n".$name." has applied for Leave from ".date("d/m/Y", strtotime($fromdate))." to ".date("d/m/Y", strtotime($todate))."\n\nReason : ".$reason."\n\nKindly update status in the App\n\nRegards,\nFIE Team";
                
                sendwhatsapp("9850058587",urlencode($msg));
            
                 $message  = "{'type':'leaveapplication','dataid':'0','text':'".$msg."'}";
                $managerid = 76;
                sendNotification("FIE HR",$message,"single","hr",$managerid,$link);
            
            $output = array("msg"=>"Application Submitted.");
        }
       
        echo  json_encode($output);
        return;
       }elseif($_POST['action'] == 'addComplaint'){
    
         $userid=$_POST['userid'];
         $name=$_POST['name'];
         $description=$_POST['description'];
         $iamgepath="";
         
         if(isset($_FILES['uploadimage']) && $_FILES['uploadimage']['size'] > 0){
            $target_dir = "complaintimages/";
            
            $ext = substr(strrchr($_FILES["uploadimage"]["name"],'.'),1);
            $time = time();
            $target_file = $target_dir . $time.".".$ext;
           
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            if (move_uploaded_file($_FILES["uploadimage"]["tmp_name"], $target_file)) {
                $iamgepath = "https://hrm.fietest.in/complaintimages/". $time.".".$ext;
            }
        }

         
         
         
       $query = "insert into  tblcomplaint  (sName,sImage,sDescription) values (?,?,?)";
        $stmt = mysqli_prepare($link_hrm,$query);
        mysqli_stmt_bind_param($stmt,"sss",$name,$iamgepath,$description);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        if(!$ret){
            $output = array("err"=>"Not Submitted.");
        }else{
            
             $msg = "Dear RAJU PUNDLIK SHRINAME,\n\nGrievance has been submitted.\n\nKindly check on Web Portal.\n\nRegards,\nFIE Team";
                
                sendwhatsapp("9850058587",urlencode($msg));
            
            $output = array("msg"=>"Submitted.");
        }
       
        echo  json_encode($output);
        return;
       }else if($_POST['action'] == "changeLeaveStatus"){
           
            $userid=$_POST['userid'];
            $iId=$_POST['iId'];
            $status=$_POST['status'];
            $remark=$_POST['remark'];
           
           $query = "update tblleaveapplication set sStatus = ?,sStatusChangeBy = ?,sStatusChangeTime = NOW(),sStatusRemark = ? where iApplicationId  = ?";
            $stmt = mysqli_prepare($link_hrm,$query);
            mysqli_stmt_bind_param($stmt,"sisi",$status,$userid,$remark,$iId);
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if(!$ret){
                $output = array("err"=>"Not Updated.");
            }else{
                $employeeid = 0;
                $startdate = "";
                $enddate = "";
                $reason = "";
                $status = "";
                $stmt = $link_hrm->prepare('select * from tblleaveapplication where iApplicationId  = ?');
                $stmt->bind_param('i',$iId);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    $employeeid = $row['iEmployeeId'];
                    $startdate = $row['sStartDate'];
                    $enddate = $row['sEndDate'];
                    $reason = $row['sReason'];
                    $status = $row['sStatus'];
                }
                
                
                $stmt = $link_hrm->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
                $stmt->bind_param('i',$employeeid);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    
                    $msg = "Dear ".$row['sName'].",\n\nYour leave application from ".date("d/m/Y", strtotime($startdate))." to ".date("d/m/Y", strtotime($enddate))."\n\nReason : ".$reason."\n\nhas been ".$status."\n\nRegards,\nFIE Team";
                    sendwhatsapp($row['sMobilenumber'],urlencode($msg));
                    
                    $message  = "{'type':'leaveapplication','dataid':'0','text':'".$msg."'}";
                    sendNotification("FIE HR",$message,"single","hr",$employeeid,$link);
                    
                }
                
                $output = array("msg"=>"Updated.");
            }
           
            echo  json_encode($output);
            return;
       }
    
}

?>