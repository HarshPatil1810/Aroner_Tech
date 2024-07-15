<?php 
 
class Push {
    //notification title
    private $title;
 
    //notification message 
    private $message;

    private $type;

    private $typeid;
 
    //initializing values in this constructor
    function __construct($title, $message, $type,$typeid) {
         $this->title = $title;
         $this->message = $message; 
         $this->type = $type; 
         $this->typeid = $typeid; 
    }
    
    //getting the push notification
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['message'] = $this->message;
        $res['data']['type'] = $this->type;
        $res['data']['typeid'] = $this->typeid;
        return $res;
    }
 
}