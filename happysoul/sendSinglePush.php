<?php 

//importing required files 

require_once 'DbOperation.php';

require_once 'firebase.php';

require_once 'push.php'; 

require_once 'layouts/config.php'; 

//require_once 'FirebaseIOS.php'; 

//hr

function sendNotification($title,$message,$type,$typeid,$userid,$link)

{



$db = new DbOperation();

 

$response = array(); 

 

 //hecking the required params 

 

 //creating a new push



	if($type == 'dummy'){

            $push = new Push(

             $title,

             $message,

             $type,

             $typeid

             );



            $devicetoken = $db->getAllTokens($link,$typeid);



            $mPushNotification = $push->getPush();



            $firebase = new Firebase();

            if(count($devicetoken) > 1000){

                for($i = 0; $i <= (count($devicetoken)/1000); $i++){

                    $firebase->send(array_slice($devicetoken, $i * 1000,1000), $mPushNotification);    

                }

            }else{

                $firebase->send($devicetoken, $mPushNotification);    

            }

        

            

//            for($i = 0; $i <= count($devicetoken); $i++){

//                sendIOSPushNotification($devicetoken[$i],$message);   

//            }            



            return;



	}else if($type == 'single'){

            $push = new Push(

             $title,

             $message,

             $type,

             $typeid

             );



            $devicetoken = $db->getTokenByEmail($typeid,$userid,$link);



            $mPushNotification = $push->getPush();



            $firebase = new Firebase();

            if(count($devicetoken) > 1000){

                for($i = 0; $i <= (count($devicetoken)/1000); $i++){

                    $firebase->send(array_slice($devicetoken, $i * 1000,1000), $mPushNotification);    

                }

            }else{

                $firebase->send($devicetoken, $mPushNotification);    

            }



            return;

	}

 return;

}

 

?>