<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; ?>

<html>
    <body>
       
            <table cellspacing=0>
                <tr>
                    <td style="width:30%;border:1px solid black;padding:10px;">
                        <img src="assets/images/new-logo.jpg" alt=""  width="" style="width:50%;margin:auto;display:block" >
                    </td>
                    <td style="border:1px solid black">
                    <p style="font-size:28px;margin:auto;display:block;text-align:center">Vendor Registration Details</p>  
                    </td>
                </tr>

                <?php 
                    $companyname = "SHRI RADHAMADHAV ENTERPRISES";
                    $stmt = $link->prepare("Select * from tblvendorregform WHERE sCompanyName= ?");
                    $stmt->bind_param('s',$companyname);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td style="width:30%;padding:20px;">
                       
                        </td>
                        <td style="">
                        <p style="font-size:20px;font-weight:bold;text-align:center">  Company Details</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Company Name</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sCompanyName'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  GST No</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sGSTNo'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  PAN No</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sPANNo'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Registration Address</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sRegistrationAddress'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Communication Address</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sCommunicationAddress'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Year of Establishment</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sEstablishment'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Nature of Company Ownership</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sCompanyOwnership'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Name of Promoters/Directors/Proprietor</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sPromotersDirectorsProprietor'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Annual Turnover</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sAnnualTurnover'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Number of Offices / Manufacturing Units</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sNoOfOffices'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;padding:20px;">
                       
                        </td>
                        <td style="">
                        <p style="font-size:20px;font-weight:bold;text-align:center">  Contact Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Contact Person Name</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sContactPersonName'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Designation</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sDesignation'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Contact Number</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sContactNo'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Email Id</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sEmail'];?> </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="width:30%;padding:20px;">
                       
                        </td>
                        <td style="">
                        <p style="font-size:20px;font-weight:bold;text-align:center">  Bank Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Bank Name</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sBankName'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Account No</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sAccountNo'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Branch</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sBranch'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  IFSC Code</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sIFSCCode'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Cheque Photo</p>
                        </td>
                        <td style="border:1px solid black">
                        <img src="<?php echo $row['sCancelledChequeCopy'];?>" style="height:200px">
                        </td>
                    </tr>


                    <tr>
                        <td style="width:30%;padding:20px;">
                       
                        </td>
                        <td style="">
                        <p style="font-size:20px;font-weight:bold;text-align:center">  Other Details</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  Monthly Volumes Handled</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sMonthlyVolumesHandled'];?> </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%;border:1px solid black;padding:10px;">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center">  MSME Registration No</p>
                        </td>
                        <td style="border:1px solid black">
                        <p style="font-size:18px;margin:auto;display:block;text-align:center"> <?php echo $row['sMSMERegNo'];?> </p>
                        </td>
                    </tr>
                <?php
                    }   
                ?>
            </table>
      
    </body>
</html>