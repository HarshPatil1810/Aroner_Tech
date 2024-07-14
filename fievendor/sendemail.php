<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


function sendEmail($to,$subject,$message,$iPDFAttach,$iExcelAttach,$sEmployeeId){

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $message = $message;
    // $subject = "Reminder from FIE";

    $sender = 'admin@fietest.in';
    $senderName = 'FIE';

    $recipient = $to;

    $usernameSmtp = 'admin@fietest.in';

    $passwordSmtp = 'httg djcb gdfw jshb';

    //$host = 'secure.emailsrvr.com';
    $host = 'smtp.gmail.com';
    //$host = '103.92.235.64';
    
    //$host = 'smtp.epromail.com';
    //$port = 465;
    $port = 587;
    $bodyHtml = $message;

    try {
        
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        //$mail->Host = 'smtp.gmail.com';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        //$mail->SMTPDebug  = 1; 
        $mail->Username = 'admin@fietest.in';
        $mail->Password = 'httg djcb gdfw jshb';
        
        $mail->setFrom('admin@fietest.in', 'Ankush Payamalle');
        $mail->addReplyTo('admin@fietest.in', 'Ankush Payamalle');
        $mail->addAddress($to,$to);
        $mail->SMTPSecure = "tls";
        
        $mail->Subject = $subject;

        $mail->isHTML(true);
    
        $mailContent = $message;
        $mail->Body = $mailContent;
        
        if($iPDFAttach == 1){
            $tmp_name = "../employeefiles/".$sEmployeeId.".pdf";
            $mail->addAttachment($tmp_name,$sEmployeeId.".pdf");
        }else if($iExcelAttach == 1){
            $tmp_name = "../employeefiles/".$sEmployeeId.".xlsx";
            $mail->addAttachment($tmp_name,$sEmployeeId.".pdf");
        }
        
        if($mail->send()){
            echo 'Message has been sent';
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        
        
        

        $output = "Mail Sent.";
        
       

        
        
    } catch (phpmailerException $e) {
        $output = "An error occurred. {$e->errorMessage()}". PHP_EOL;
    } catch (Exception $e) {
        $output = "Email not sent. {$mail->ErrorInfo}";
    } 

    return $output;

    
}

?>