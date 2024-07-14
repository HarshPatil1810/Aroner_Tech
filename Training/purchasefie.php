<?php
include "configfie.php";
?>
<?php


$stmt1 = $link->prepare("Select DISTINCT(FIE_PartyGSTIN) as FIE_PartyGSTIN,FIE_PurVch_PartyLedgerName from purchasevchheader Where FIE_PartyGSTIN !='' " );
$stmt1->execute();
$result1 = $stmt1->get_result();
while ($row1 = $result1->fetch_assoc()){
    $gstno=$row1['FIE_PartyGSTIN'];
    $pname=$row1['FIE_PurVch_PartyLedgerName'];
 


      
    $url = "https://gstapi.charteredinfo.com/commonapi/v1.0/returns?aspid=1661111921&password=naresh@1988&&Action=RETTRACK&Gstin=".$gstno."&fy=2023-24";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_USERPWD, API_CALL_USERNAME.":".API_CALL_PASSWORD); 
                        
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);

    print_r($obj);
    //$tradename = $obj->tradeNam;
    $gstfillingdata = $obj->EFiledlist;
 
    $gst3bdof = "";
    $gstr1dof = "";

    for($i = 0; $i < count($gstfillingdata); $i++){
        if($gst3bdof == "" && $gstfillingdata[$i]->rtntype == 'GSTR3B'){
            $gst3bdof =  $gstfillingdata[$i]->dof;
        }

        if($gstr1dof == "" && $gstfillingdata[$i]->rtntype == 'GSTR1'){
            $gstr1dof =  $gstfillingdata[$i]->dof;
        }

        if($gst3bdof != "" && $gstr1dof != ""){
            break;
        }
    }




    $url = "https://gstapi.charteredinfo.com/commonapi/v1.1/search?aspid=1661111921&password=naresh@1988&Action=TP&Gstin=".$gstno;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_USERPWD, API_CALL_USERNAME.":".API_CALL_PASSWORD); 
                        
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);
    $gststauts = $obj->sts;
    $gststautsdate = $obj->cxdt;

    $stmt = $link->prepare('select * from partydetail WHERE sGSTNo=?');
    mysqli_stmt_bind_param($stmt, "s",$gstno);
    $stmt->execute();
    $r = $stmt->get_result();
    mysqli_stmt_close($stmt);

    if(mysqli_num_rows($r) > 0)
    {
        
        $query = "update partydetail set sName=?,sLGSTR1=?,sLGSTR3B = ?,sStatus=?,sStatusChangeDate = ? Where sGSTNo=?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ssssss", $pname,$gstr1dof,$gst3bdof,$gststauts,$gststautsdate,$gstno);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else
    {
    $q="INSERT INTO partydetail (sName,sGSTNo,sLGSTR1,sLGSTR3B,sStatus,sStatusChangeDate) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($link,$q);
    mysqli_stmt_bind_param($stmt, "ssssss",$row1['FIE_PurVch_PartyLedgerName'],$row1['FIE_PartyGSTIN'],$gstr1dof,$gst3bdof,$gststauts,$gststautsdate);
    $ret = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    }
    }



?>