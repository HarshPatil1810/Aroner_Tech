<?php



class DbOperation

{

    private $con;

 

    public function registerDevice($email,$token){

        if(!$this->isEmailExist($email)){

            $stmt = $this->con->prepare("INSERT INTO devices (email, token) VALUES (?,?) ");

            $stmt->bind_param("ss",$email,$token);

            if($stmt->execute())

                return 0; //return 0 means success

            return 1; //return 1 means failure

        }else{

            return 2; //returning 2 means email already exist

        }

    }



    //the method will check if email already exist 

    private function isEmailexist($email){

        $stmt = $this->con->prepare("SELECT id FROM devices WHERE email = ?");

        $stmt->bind_param("s",$email);

        $stmt->execute();

        $stmt->store_result();

        $num_rows = $stmt->num_rows;

        $stmt->close();

        return $num_rows > 0;

    }



    //getting all tokens to send push to all devices

    public function getAllTokensForNumber($userid,$link){

        $tokens = array(); 

        $stmt = $link->prepare('SELECT sDeviceId FROM tbluser WHERE iUserId IN (select iUserId from tblcontatcfavs where iContactUserId =?)');

        $stmt->bind_param('i', $userid);

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){

            if($row['sDeviceId'] != ""){

                array_push($tokens, $row['sDeviceId']);

            }

        }

//        print_r($tokens);

        return $tokens; 

//        $tokens = array(); 

//        $query = "SELECT sDeviceId FROM tbluser WHERE iUserId IN (select iUserId from tblcontatcfavs where iContactUserId =".$userid.")" ;

//        $getUser =  mysqli_query($link,$query);

//        while ($row = $getUser->fetch_object()){

//            array_push($tokens, $token['sDeviceId']);

//        }

//        return $tokens; 

    }

    

    public function getAllTokens($link,$typeid){

        $stmt = $link->prepare("SELECT sDeviceId FROM tblfcmtoken where  sAppType = ?");

        $stmt->bind_param('s',$typeid);

        $stmt->execute(); 

        $result = $stmt->get_result();

        $tokens = array(); 

        while($token = $result->fetch_assoc()){

            array_push($tokens, $token['sDeviceId']);

        }

        return $tokens; 

    }



    //getting a specified token to send push to selected device

    public function getTokenByEmail($type,$email,$link){

        $stmt = $link->prepare("SELECT sDeviceId FROM tblfcmtoken where iEmployeeId = ? and sAppType = ?");

        $stmt->bind_param('is', $email,$type);

        $stmt->execute(); 

        $result = $stmt->get_result();

        $tokens = array(); 

        while($token = $result->fetch_assoc()){

            array_push($tokens, $token['sDeviceId']);

        }

        return $tokens;  

    }



    //getting all the registered devices from database 

    public function getAllDevices(){

        $stmt = $this->con->prepare("SELECT sDeviceId FROM tblemployeejoiningform");

        $stmt->execute();

        $result = $stmt->get_result();

        return $result; 

    }

}

?>