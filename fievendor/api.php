<?php  
session_start();
include "layouts/config.php";


if($_POST['action'] =='verifyGST'){

    $gstno =  $_POST['gstno'];
      
    $url = "https://gstapi.charteredinfo.com/commonapi/v1.1/search?aspid=1661111921&password=naresh@1988&Action=TP&Gstin=".$gstno;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_USERPWD, API_CALL_USERNAME.":".API_CALL_PASSWORD); 
                        
    $result = curl_exec($ch);
    curl_close($ch);
    
        // echo  $gstno; 
    //Single Address
    // $result = '{"stjCd":"MHCG0001","lgnm":"POOJA NARESH KABRA","stj":"ICHALKARANJI_701","dty":"Regular","adadr":[],"cxdt":"","gstin":"27AAJPZ2357G1Z9","nba":["Supplier of Services","Wholesale Business"],"lstupdt":"27/03/2021","rgdt":"27/03/2021","ctb":"Proprietorship","pradr":{"addr":{"bnm":"SHANTINATH COMPLEX","st":"BUNGLOW ROAD","loc":"ICHALKARANJI","bno":"12/79/7","dst":"Kolhapur","lt":"","locality":"","pncd":"416115","landMark":"","stcd":"Maharashtra","geocodelvl":"NA","flno":"BONGALE GALLI","lg":""},"ntr":"Supplier of Services, Wholesale Business"},"tradeNam":"SHRI RADHAMADHAV ENTERPRISES","sts":"Active","ctjCd":"UE0203","ctj":"RANGE-III","einvoiceStatus":"No"}';

    //Multi Address
    // $result = '{"stjCd":"MHCG0050","dty":"Regular","stj":"ICHALKARANJI_502","lgnm":"FUEL INSTRUMENTS AND ENGINEERS PRIVATE LIMITED","adadr":[{"addr":{"bnm":"PARVATI CO-OP","st":"INDUSTRIAL ESTATE","loc":"YADRAV","bno":"68-89","dst":"Kolhapur","lt":"","locality":"","pncd":"416145","landMark":"","stcd":"Maharashtra","geocodelvl":"NA","flno":"","lg":""},"ntr":"Factory / Manufacturing"},{"addr":{"bnm":"PARVATI CO-OP INDUSTRIAL ESTATE","st":"PHASE II","loc":"YADRAV TAL - SHIROL","bno":"PLOT NO 120","dst":"Kolhapur","lt":"","locality":"","pncd":"416145","landMark":"","stcd":"Maharashtra","geocodelvl":"NA","flno":"SECTOR C","lg":""},"ntr":"Factory / Manufacturing"},{"addr":{"bnm":"PARVATI CO-OP INDUSTRIAL ESTATE","st":"PHASE-1","loc":"YADRAV TAL-SHIROL","bno":"PLOT NO 2-7","dst":"Kolhapur","lt":"","locality":"","pncd":"416145","landMark":"","stcd":"Maharashtra","geocodelvl":"NA","flno":"SECTOR A","lg":""},"ntr":"Factory / Manufacturing"}],"cxdt":"","gstin":"27AAACF3770F1ZS","nba":["Factory / Manufacturing"],"lstupdt":"06/12/2021","ctb":"Private Limited Company","rgdt":"01/07/2017","pradr":{"addr":{"bnm":"","st":"OLD INDUSTRIAL ESTATE","loc":"ICHALKARANJI","bno":"1","dst":"Kolhapur","lt":"","locality":"","pncd":"416115","landMark":"","stcd":"Maharashtra","geocodelvl":"NA","flno":"","lg":""},"ntr":"Factory / Manufacturing"},"ctjCd":"UE0203","tradeNam":"FUEL INSTRUMENTS AND ENGINEERS PVT LTD","sts":"Active","ctj":"RANGE-III","einvoiceStatus":"Yes"}';

    $obj = json_decode($result);

    $tradename = $obj->tradeNam;
    $status = $obj->sts;

    if($obj->adadr != []){
        $address = $obj->adadr[0]->addr->bnm.", ".$obj->adadr[0]->addr->st.", ".$obj->adadr[0]->addr->loc.", ".$obj->adadr[0]->addr->bno.", ".$obj->adadr[0]->addr->dst.", ".$obj->adadr[0]->addr->lt.", ".$obj->adadr[0]->addr->locality.", ".$obj->adadr[0]->addr->pncd.", ".$obj->adadr[0]->addr->landMark.", ".$obj->adadr[0]->addr->stcd.", ".$obj->adadr[0]->addr->flno;
    }else{
       /* $address = $obj->pradr->addr->bnm.", ".$obj->pradr->addr->st.", ".$obj->pradr->addr->loc.", ".$obj->pradr->addr->bno.", ".$obj->pradr->addr->dst.", ".$obj->pradr->addr->lt.", ".$obj->pradr->addr->locality.", ".$obj->pradr->addr->pncd.", ".$obj->pradr->addr->landMark.", ".$obj->pradr->addr->stcd;*/

        $address = $obj->pradr->addr->bnm.", ".$obj->pradr->addr->bno;
    }

  //  $city=$obj->pradr->addr->loc;
  $city=$obj->pradr->addr->loc;
  $pin=$obj->pradr->addr->pncd;
  $tradetype = $obj->ctb;
  $state=$obj->pradr->addr->stcd;

    echo json_encode(array("tradename" => $tradename,"address"=>$address,"tradetype"=>$tradetype,"status"=>$status,"city"=>$city,"pin"=>$pin,"state"=>$state));
     
     return;
    }

    


















if(isset($_GET['action']))
{    
    if($_GET['action'] == 'getISOstd')
    {
        
        $hardnessrange  = $_GET['hardnessrange'];
        $stdreading  = $_GET['stdreading'];
        $stmt = $link->prepare('select * from tbliso where sHardnessRanges= ?');
        $stmt->bind_param('s',$hardnessrange);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
           $std = preg_replace('/[^.0-9 & ]/i', '',  $stdreading);
           $min = preg_replace('/[^.0-9 & ]/i', '',  $row['sMinstd']);
           $max = preg_replace('/[^.0-9 & ]/i', '',  $row['sMaxstd']);
            if($min<$std &&  $std < $max){
                $output[]=$row;
                echo json_encode($output);
                return;
            }

        }if(!isset($output)){
            $output[]=array("sErrorAllowed"=>"","sRepetabilityAllowed"=>"");
            echo json_encode($output);
            return;
        }
        echo json_encode($output);
        return;
    }else    if($_GET['action'] == 'getresolution')
    {
        // $Type  = $_GET['Type'];
        $output=0;
        $Model  = $_GET['Model'];
        $stmt = $link->prepare('select * from tblmodel where sModel= ?');
        $stmt->bind_param('s',$Model);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            // if($row['sResolutionType']==""){
            //     $output=0;
            // }else{

                $stmt1 = $link->prepare('select * from tblresolution where sResolutionType= ?');
                $stmt1->bind_param('s',$row['sResolutionType']);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                while($row1 = $result1->fetch_assoc()){
                    $output=$row1['sResolution'];    
                }
            // }

        }
        // if(isset($row)){
        echo json_encode($output);
        return;
        // }else{
        //     return;
        // }
    }else  if($_GET['action'] == 'getdirectcalibrationbymodel')
    {
        $model  = $_GET['model'];
        $stmt1 = $link->prepare('select * from tblmodel where sModel= ?');
        $stmt1->bind_param('s',$model);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while($row1 = $result1->fetch_assoc()){
            if($row1['iDirectCalibrationId'] !=""){
                $stmt = $link->prepare('select * from tbldirectcalibration where iDirectCalibrationId  IN('.$row1['iDirectCalibrationId'].')');
                // $stmt->bind_param('i',$ModelId);
                // echo('select * from tbldirectcalibration where iDirectCalibrationId  IN('.$row1['iDirectCalibrationId'].')');
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    $output[]=$row;
                }
            }

            
        }
        if(isset($output)){
        echo json_encode($output);
        return;
        }else{
            return;
        }
    }else if($_GET['action'] == 'getResults')
    {
        $ResultId  = $_GET['ResultId'];

        $stmt = $link->prepare('select * from tblresults where sHardnessRanges= ?');
        $stmt->bind_param('s',$ResultId);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;
        }
        echo json_encode($output);
        return;
    }else if($_GET['action'] == 'getDirectcalibration')
    {
        $DirectCalibrationId   = $_GET['DirectCalibrationId'];

        $stmt = $link->prepare('select * from tbldirectcalibration where sTestForce = ?');
        $stmt->bind_param('s',$DirectCalibrationId );
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;
        }
        echo json_encode($output);
        return;
    }else    if($_GET['action'] == 'getIndirectcalibration')
    {
        $IndirectCalibrationId   = $_GET['IndirectCalibrationId'];

        $stmt = $link->prepare('select * from tblindirectcalibration where sHardnessRanges = ?');
        $stmt->bind_param('s',$IndirectCalibrationId );
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;
        }
        echo json_encode($output);
        return;
    }else     if($_GET['action'] == 'getMachinedetails')
    {
        $Id   = $_GET['Id'];

        $stmt = $link->prepare('select * from tblmachinedetails where iId = ?');
        $stmt->bind_param('i',$Id );
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;
        }
        echo json_encode($output);
        return;
    }else   if($_GET['action'] == 'getLoadcell')
    {
        $LoadCellId  = $_GET['LoadCellId'];

        $stmt = $link->prepare('select * from tblloadcell where sModel= ?');
        $stmt->bind_param('i',$LoadCellId );
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $output=$row;
        }
        echo json_encode($output);
        return;
    }else if($_GET['action'] == 'markSaleConversion'){
        $refernceid = $_GET['refernceid'];
        $stmt = $link->prepare('select * from tblreference where iRefernceId = ?');
        $stmt->bind_param('i',$refernceid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $convert = 0;
            if($row['isConverted'] == 0){
                $convert = 1;
            }
            $query = "update tblreference set isConverted = ? where iRefernceId = ?";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "ii",$convert,$refernceid);
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        }

        
        return;
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
    // $txt = file_get_contents("php://input");
    // fwrite($myfile, $txt);
    // fclose($myfile);
   
    
    if($_POST['action'] == 'markApprove'){
        
        $id = $_POST['id'];
        $type =  $_POST['type'];
        $checked= $_POST['checked'];

        if($type=='DirectCalibration'){
            $query = "update  tbldirectcalibrationfinal set  iAproved=?,iAprovedBy=?,sAprovedTimestamp=NOW() where iDirectCalibrationId =?";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "iii", $checked, $_SESSION['id'], $id );
            $ret = mysqli_stmt_execute($stmt);
        
            mysqli_stmt_close($stmt);
       
        } else  if($type=='IndirectCalibration'){
            $query = "update  tblindirectcalibrationfinal set  iAproved=?,iAprovedBy=?,sAprovedTimestamp=NOW() where iIndirectCalibrationId  =?";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "iii", $checked, $_SESSION['id'], $id );
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else  if($type=='Results'){
            $query = "update  tblresultsfinal set  iAproved=?,iAprovedBy=?,sAprovedTimestamp=NOW() where iResultId  =?";
            $stmt = mysqli_prepare($link,$query);
            mysqli_stmt_bind_param($stmt, "iii", $checked, $_SESSION['id'], $id );
            $ret = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } 
        
        if(!($ret)){
            $output=array('error'=>'Not Approved');
            echo json_encode($output);
            return;
        }else{
            $isdirectcal=false;
            $isindirectcal=false;
            $isresult=false;

              $stmt = $link->prepare('select * from tbldirectcalibrationfinal where  iMainId =? and iAproved= 1');
              $stmt->bind_param('i',$_POST['reportid'] );
              $stmt->execute();
              $result = $stmt->get_result();
              while($row = $result->fetch_assoc()){
                $isdirectcal=true;
              }
              $stmt = $link->prepare('select * from tblindirectcalibrationfinal where  iMainId =? and iAproved= 1');
              $stmt->bind_param('i',$_POST['reportid'] );
              $stmt->execute();
              $result = $stmt->get_result();
              while($row = $result->fetch_assoc()){
                $isindirectcal=true;
              }
              $stmt = $link->prepare('select * from tblresultsfinal where  iMainId =? and iAproved= 1');
              $stmt->bind_param('i',$_POST['reportid'] );
              $stmt->execute();
              $result = $stmt->get_result();
              while($row = $result->fetch_assoc()){
                $isresult=true;
              }
              if($isdirectcal==true && $isindirectcal==true && $isresult== true){
                $query = "update  tblmachinedetails set  iAproved=1 where iId  =?";
                $stmt = mysqli_prepare($link,$query);
                mysqli_stmt_bind_param($stmt, "i",  $_POST['reportid'] );
                $ret = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
              }else{
                $query = "update  tblmachinedetails set  iAproved= 0 where iId  =?";
                $stmt = mysqli_prepare($link,$query);
                mysqli_stmt_bind_param($stmt, "i",  $_POST['reportid'] );
                $ret = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
              }

            $output=array('msg'=>'Approved');
            echo json_encode($output);
            return;
        

        }




       
    }
    else if($_POST['action'] == 'duedateloadcell')
    {
        $output =[];
        // SELECT * FROM products
// WHERE Now() >= DATE_SUB(issue_date, INTERVAL 1 MONTH)
        $stmt1 = $link->prepare("Select sCalibrationDue as sCalibrationDue, DATE_SUB(sCalibrationDue, INTERVAL 1 MONTH) as date  , sModel as loadcell from tblloadcell where  NOW()>=  DATE_SUB(sCalibrationDue, INTERVAL 1 MONTH)");
        // $stmt1 = $link->prepare("Select * from tblloadcellfinal where sCalibrationDue > NOW() ");
        // $stmt1->bind_param('i',$yarnid);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while ($row1 = $result1->fetch_assoc()){
            // if($row1['sCalibrationDue'])
            $row1['isTrue'] = "true";
              $output[]=$row1;
              echo json_encode($output);
            // echo "true";
            return ;
        }

        echo "false";
        return;
    }

}
?>