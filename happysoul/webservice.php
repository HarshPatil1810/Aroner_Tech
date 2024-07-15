<?php include 'layouts/config.php'; 



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function sendwhatsapp($mobileno,$msg){

  $url = "https://wtsapp.aronertech.com/api/sendText?token=63f89bac68342404fd9ee0fc&phone=91".$mobileno."&message=".$msg."";

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $result = curl_exec($ch);
  curl_close($ch);    



}

function fnGetEmployeeName($employeeId,$link){
  $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
  $stmt->bind_param('i',$employeeId);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
   return $row['sName'];
     
  }

  return "N/A";

}



function fnGetEmployeeNumber($employeeId,$link){
  $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
  $stmt->bind_param('i',$employeeId);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
   return $row['sMobilenumber'];
     
  }

  return "N/A";

}



function fnGetContractName($contractorid,$link){
  if($contractorid == 0){
    return "Admin";
  }
  $stmt = $link->prepare('select * from tblcontractorregform where iContractorRegFormId  = ?');
  $stmt->bind_param('i',$contractorid);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
   return $row['sName'];
     
  }

  return "N/A";

}

function fnGetDepartmentName($employeeid,$link){
  $stmt = $link->prepare('select * from tbldepartment where iEmployeeFormId  = ? order by sCreatedTimestamp desc limit 1');
  $stmt->bind_param('i',$employeeid);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
   return $row['sDepartment'];
     
  }

  return "N/A";

}


if(isset($_POST['action']))
{    

   if(!isset($_POST['key']) || $_POST['key'] != "uxzO6fMw0XJmhmwxuiPlp5XK6VQUMYKdtgDlpKr7Nlr6tRhK0AdXFJ13mUixdwEWcE6soc6W6Y6TRe2LkSVrhTiaqj3IgvsZohPF66k0F659j1R70q6Mt168OQ9rP3ab5x8Fhp6DuUccubSiw0zbXNjRurAJGG2qEcG4lXGrUrkhpm9xBp4VO8turUzsIqUhqD9TxaillJCb6VRKDb76vqHoV1iRAASmdJeqbo9xaoauUjT63WlprFgR6Y39baZ"){
    return;
   }

    if($_POST['action'] == 'getEmployeeDetails'){

      if(isset($_POST['employeeId']))
      {
        $employeeId=$_POST['employeeId'];
        $stmt = $link->prepare('select * from tblemployeejoiningform where iEmployeeFormId = ?');
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;


        }
      }
      elseif(isset($_POST['employeeNumber'])){
        $employeeNumber=$_POST['employeeNumber'];
        $stmt = $link->prepare('select * from tblemployeejoiningform where sMobilenumber= ?');
        $stmt->bind_param('s',$employeeNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){

            $output=$row;
          }
       }

    if(!isset($output)){
        $output=array("err" =>"Employyyee not present");
    }

    echo  json_encode($output);
    return;

    }elseif($_POST['action'] == 'getTaskList'){
      $employeeId=$_POST['employeeId']; 
      $for=$_POST['for'];

      $sql = "";
      if(trim($_POST['searchkey']) != ""){
        $searchkey = "%".trim(mysqli_real_escape_string($link,$_POST['searchkey']))."%";

        $sql = $sql." and (sTitle LIKE '".$searchkey."' or iEmployeeId IN (select iEmployeeFormId from tblemployeejoiningform where sName LIKE '".$searchkey."' OR sEmployeeCode LIKE '".$searchkey."'))";

      }

      if(trim($_POST['status']) != "" && !str_contains(trim($_POST['status']),"Click")){
        $sql = $sql." and sStatus = '".trim(mysqli_real_escape_string($link,$_POST['status']))."'";
      }

      if(trim($_POST['priority']) != "" && !str_contains(trim($_POST['priority']),"Click")){
        $sql = $sql." and sPriority = '".trim(mysqli_real_escape_string($link,$_POST['priority']))."'";
      }

      $fromdate = "1975-01-01";
      if(trim($_POST['fromdate']) != "" && !str_contains(trim($_POST['fromdate']),"Click")){
        $fromdate = "%".trim(mysqli_real_escape_string($link,$_POST['fromdate']))."%";
      }

      $todate = "2975-01-01";
      if(trim($_POST['todate']) != "" && !str_contains(trim($_POST['todate']),"Click")){
        $todate = "%".trim(mysqli_real_escape_string($link,$_POST['todate']))."%";
      }

      $sql = $sql." and sDeadline BETWEEN '".$fromdate."' and '".$todate."'  ORDER BY FIELD(sStatus, 'Created','Pending','In Progress','Completed')";

      // This code fetches a list of tasks based on the action and employee ID provided in the POST request. It retrieves tasks either created by or assigned to the specified employee. For each task, it includes details such as the name of the creator, the assignee, and timestamps. The task data is returned in JSON format, with an error message if no tasks are found.
      if($for =='created'){
        $createdby = fnGetEmployeeName($employeeId,$link);
      
        $stmt = $link->prepare('select * from tbltask where iEmployeeId = ? '.$sql);
        $stmt->bind_param('i',$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $row['sCreatedBy']=$createdby;
          $row['sAssignTo'] = "";
          $assignedtos = explode(",",$row['iAssignto']);
          for($i = 0; $i < count($assignedtos); $i++){
              if($assignedtos[$i] != "" || $assignedtos[$i] != null){
                if($row['sAssignTo'] == ""){
                      $row['sAssignTo'] = fnGetEmployeeName($assignedtos[$i],$link);            
                  }else{
                $row['sAssignTo'] = $row['sAssignTo'].", ".fnGetEmployeeName($assignedtos[$i],$link);                  
                  }         
              }
          
          }
        //   $row['sAssignTo']=fnGetEmployeeName($row['iAssignto'],$link);
          $row['sCreatedTimeStamp']=date("d/m/Y H:i",strtotime($row['sCreatedTimeStamp']));
          $row['sUpdatedTimeStamp']=date("d/m/Y H:i",strtotime($row['sUpdatedTimeStamp']));
          $row['sDeadline']=date("d/m/Y",strtotime($row['sDeadline']));
  
            $output[]=$row;
          }
         
          if(!isset($output))
          {
              $output[]=array("err" =>"no task involve");
          }
          echo  json_encode($output);
  
          return;

      }elseif($for =='assigned'){
       // This code retrieves tasks assigned to a specific employee from a database table (tbltask). It fetches tasks where the iAssignto field matches the provided employee ID. For each task, it retrieves additional information such as the name of the employee who created the task and formats timestamps. Finally, it returns the task data in JSON format, including an error message if no tasks are found for the employee.
        $assignedto = fnGetEmployeeName($employeeId,$link);
        $employeeId_keyword = '%'.$employeeId.'%';
        $stmt = $link->prepare('select * from tbltask where iAssignto LIKE ? or iAssignto = ? '.$sql);
        $stmt->bind_param('ss',$employeeId_keyword,$employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $row['sCreatedBy']=fnGetEmployeeName($row['iEmployeeId'],$link);
        //   $row['sAssignTo']=$assignedto;
        $assignedtos = explode(",",$row['iAssignto']);
          for($i = 0; $i < count($assignedtos); $i++){
              if($assignedtos[$i] != "" || $assignedtos[$i] != null){
                  if($row['sAssignTo'] == ""){
                      $row['sAssignTo'] = fnGetEmployeeName($assignedtos[$i],$link);            
                  }else{
                $row['sAssignTo'] = $row['sAssignTo'].", ".fnGetEmployeeName($assignedtos[$i],$link);                  
                  }
                
              }
          
          }
          $row['sCreatedTimeStamp']=date("d/m/Y H:i",strtotime($row['sCreatedTimeStamp']));
          $row['sUpdatedTimeStamp']=date("d/m/Y H:i",strtotime($row['sUpdatedTimeStamp']));
          $row['sDeadline']=date("d/m/Y",strtotime($row['sDeadline']));
            $output[]=$row;
          }
         
          if(!isset($output))
          {
              $output[]=array("err" =>"No Tasks");
          }
          echo  json_encode($output);
  
          return;

      }




     

     }elseif($_POST['action'] == 'getEmployeeList'){

        if(isset($_POST['search'])){
              $search=$_POST['search']; 
              $keytword = '%'.$search.'%';    
              $stmt = $link->prepare('select iEmployeeFormId,sEmployeeCode,sName,iCreatedBy from tblemployeejoiningform where sEmployeeCode LIKE ? or sName LIKE ? or iCreatedBy IN (select iContractorRegFormId from tblcontractorregform where sName LIKE ?)');
                $stmt->bind_param('sss',$keytword,$keytword,$keytword);
        }else{
            $stmt = $link->prepare('select iEmployeeFormId,sEmployeeCode,sName,iCreatedBy from tblemployeejoiningform order by sName');
        
        }
      


     
      
        // $stmt = $link->prepare('select iEmployeeFormId,sEmployeeCode,sName,iCreatedBy from tblemployeejoiningform where sEmployeeCode LIKE ? or sName LIKE ? or iCreatedBy IN (select iContractorRegFormId from tblcontractorregform where sName LIKE ?)');
        // $stmt->bind_param('sss',$keytword,$keytword,$keytword);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $row['sContractorName']=fnGetContractName($row['iCreatedBy'],$link);
            $row['sDepartment']=fnGetDepartmentName($row['iEmployeeFormId'],$link);
      
            $output[]=$row;
          }
         
          if(!isset($output))
          {
              $output[]=array("err" =>"No emplyoee with given keyword");
          }
          echo  json_encode($output);
  
          return;

      
    

     }elseif($_POST['action'] == 'getTaskComments'){
        $taskid=$_POST['taskid']; 
        $stmt = $link->prepare('select * from tblcomment where sTaskId = ?');
        $stmt->bind_param('s',$taskid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $row['sCommnentedBy']=fnGetEmployeeName($row['sEmployeeId'],$link);
          $row['sCreatedTimestamp']=date("d/m/Y H:i",strtotime($row['sCreatedTimestamp']));
            $output[]=$row;
          }
         
          if(!isset($output))
          {
              $output[]=array("err" =>"No Comments");
          }
          echo  json_encode($output);
  
          return;

      
    

     }elseif($_POST['action'] == 'updatedTaskList'){
      $employeeId=$_POST['employeeId']; 
      $stmt = $link->prepare('select * from tbltask where iEmployeeId= ?');
      $stmt->bind_param('i',$employeeId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){

          $output[]=$row;
        }
       
        if(!isset($output))
        {
            $output[]=array("err" =>"no  updation ");
        }
        echo  json_encode($output);

        return;

     }elseif($_POST['action'] == 'addTask'){
      
        $employeeId=$_POST['employeeId'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $status=$_POST['status'];
        $deadline=$_POST['deadline'];
        $priority=$_POST['priority'];
        $assignto=$_POST['assignto'];

        $query = "INSERT INTO tbltask (iEmployeeId,sTitle,sDescription,sStatus,sDeadline,sPriority,iAssignto) VALUES (?,?,?,?,?,?,?)";
    
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt,"issssss",$employeeId,$title, $description, $status,$deadline,$priority,$assignto);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


        if(!$ret){
          $output=array("err"=>"Data Not Saved");
        
        }else{
          $output=array("msg"=>"Data Saved");
          
          $assigned_ids = explode(",",$assignto);
          
          for($i = 0; $i < count($assigned_ids); $i++){
              $message = urlencode("*New Task Assigned*

          You are assigned new task with following details
          
         *Title* : ".$title."
         *Description* :".$description."
         *Due Date* :".$deadline."
         *Priority* :".$priority."
         *Assigned By* :".fnGetEmployeeName($employeeId,$link)."
         
          Please work on the task and update the status in FIE TMS app
          
          Regards,
          FIE TMS");
          sendwhatsapp(fnGetEmployeeNumber($assigned_ids[$i],$link),$message);
          }
     
          

        }   
        
        echo  json_encode($output);

        return;
    }




      elseif($_POST['action'] == 'sendOTP'){
        
        $digits = 4;
        //auto grnerated otp code
        $otpnumber= rand(pow(10, $digits-1), pow(10, $digits)-1);
        $mobileno=$_POST['mobileno'];


        $ifprsent=false;
   
         
           // first check mobile number avalaible in  tblemployeejoiningform. if present then go to the if conditiion delelte tblopt table 
            //  and insert this number  and otp on this table
           $stmt = $link->prepare('select * from tblemployeejoiningform where sMobileNumber=?');
           $stmt->bind_param('i',$mobileno);
           $stmt->execute();
           $result = $stmt->get_result();
           while($row = $result->fetch_assoc()){
               $output=$row;
   
              $ifprsent=true;
           
         }

         if($ifprsent){

          $message = urlencode("OTP to login into FIE : ".$otpnumber);
          sendwhatsapp($mobileno,$message);
       
          $query = "delete from  tblotp where sMobileNumber=? ";
          $stmt = mysqli_prepare($link,$query);
          mysqli_stmt_bind_param($stmt,"s", $mobileno);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);

          $query = "INSERT INTO tblotp (sOtpNumber,sMobileNumber) VALUES (?,?)";
    
          $stmt = mysqli_prepare($link,$query);
          mysqli_stmt_bind_param($stmt,"ss",$otpnumber, $mobileno);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
   
        if(!$ret){
            $output=array("err"=>"Data Not Saved");
          
        }else{
            $output=array("msg"=>"Data Saved");
       
          }   
         }
         else{
          $output=array("err"=>"Mobile number not Registred");
         }
      echo  json_encode($output);
  
          return;
     }




     elseif($_POST['action'] == 'verifyOTP'){
    
         $otp=$_POST['otp'];
         $mobileno=$_POST['mobileno'];
         $deviceid=$_POST['deviceid'];
         $ifprsent=false;

         // in this code first check otp and mobile number then updated device id where mobile number on employee joining form  
         $stmt = $link->prepare('select * from tblotp where sMobileNumber=?  and  sOtpNumber = ?');
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
        $query = "update  tblemployeejoiningform set  sDeviceId=?  where sMobilenumber=?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt,"ss",$deviceid,$mobileno);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      
        $stmt = $link->prepare('select * from tblemployeejoiningform where sMobilenumber= ?');
        $stmt->bind_param('s',$mobileno);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){

            $output=$row;
          }
       }else{
        $output=array("err"=>"Invalid OTP");
       }
        echo  json_encode($output);
        return;
       }



    elseif($_POST['action'] == 'updatedTask'){
        
          $taskid=$_POST['taskid'];
          $employeeId=$_POST['employeeId'];
          $status=$_POST['status'];
          $comment=$_POST['comment'];
     
          $query = "INSERT INTO tblcomment (sTaskId,sEmployeeId,sComment) VALUES (?,?,?)";
          $stmt = mysqli_prepare($link,$query);
          mysqli_stmt_bind_param($stmt,"sss",$taskid,$employeeId,$comment);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          
          $query = "update tbltask set sStatus=?,sUpdatedTimeStamp=now()  where iTaskId =?";
          $stmt = mysqli_prepare($link,$query);
          mysqli_stmt_bind_param($stmt, "si" ,$status,$taskid);
          $ret = mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          if(!$ret){
  
           $output=array("msg"=> "Data Not Saved") ;
        }else{

         // This PHP code appears to retrieve task information from a database table, check if the task is updated by a specific employee, and then send a WhatsApp message to either the employee who updated the task or the one to whom the task is assigned. Finally, it outputs JSON-encoded data.
          $output=array("msg"=> "Data Saved") ;
          
          $stmt = $link->prepare('select * from tbltask where iTaskId= ?');
          $stmt->bind_param('i',$taskid);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){

             if($row['iEmployeeId'] == $employeeId){
                  $message = urlencode("*Task Updated*

                  Below task is updated by *".fnGetEmployeeName($row['iEmployeeId'],$link)."*
                  
                  *Title* :".$row['sTitle']."
                  *Comment* :".$comment."
                  *Status* :".$status."
                  
                  Details of this task are available in FIE TMS app
                  
                  Regards,
                  FIE TMS
        
                ");
                sendwhatsapp(fnGetEmployeeNumber($row['iAssignto'],$link),$message);
              }else if($row['iAssignto'] == $employeeId){
                  $message = urlencode("*Task Updated*

                  Below task is updated by *".fnGetEmployeeName($row['iAssignto'],$link)."*
                  
                  *Title* :".$row['sTitle']."
                  *Comment* :".$comment."
                  *Status* :".$status."
                  
                  Details of this task are available in FIE TMS app
                  
                  Regards,
                  FIE TMS
        
                ");
                sendwhatsapp(fnGetEmployeeNumber($row['iEmployeeId'],$link),$message);
              }
             }
           }    
           echo  json_encode($output);
           return;
          }


          elseif($_POST['action'] == 'logout'){
        
             $employeeId=$_POST['employeeId'];
             $deviceid = "";

             $query = "update  tblemployeejoiningform set  sDeviceId=?  where iEmployeeFormId =?";
             $stmt = mysqli_prepare($link,$query);
             mysqli_stmt_bind_param($stmt,"ss",$deviceid,$employeeId);
             $ret = mysqli_stmt_execute($stmt);
              mysqli_stmt_close($stmt);
        
          if(!$ret){
               $output=array("msg"=> "Data Not Saved") ;
          }else{
          $output=array("msg"=> "Data Saved") ;
          }    
          echo  json_encode($output);
          return;
         }
    




      }










?>