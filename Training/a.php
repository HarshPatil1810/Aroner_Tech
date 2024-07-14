<?php
include "configfie.php";
?>
<?php

$stmt1 = $link->prepare("Select DISTINCT(FIE_PartyGSTIN) as FIE_PartyGSTIN,FIE_PurVch_PartyLedgerName  from purchasevchheader Where FIE_PartyGSTIN !='' " );
$stmt1->execute();
$result1 = $stmt1->get_result();
while ($row1 = $result1->fetch_assoc()){
    $gstno=$row1['FIE_PartyGSTIN'];
    $pname=$row1['FIE_PurVch_PartyLedgerName'];

    $check="SELECT * from partydetail WHERE sGSTNo='$gstno'";
    $cr= mysqli_query($link,$check);

    if(mysqli_num_rows($cr)>0)
    {
        $query = "update partydetail set sName=? Where sGSTNo=?";
        $stmt = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($stmt, "ss", $pname,$gstno);
        $ret = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else
    {
    $q="INSERT INTO partydetail (sName,sGSTNo) VALUES (?,?)";
    $stmt = mysqli_prepare($link,$q);
    mysqli_stmt_bind_param($stmt, "ss",$row1['FIE_PurVch_PartyLedgerName'],$row1['FIE_PartyGSTIN']);
    $ret = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    }
    }



?>