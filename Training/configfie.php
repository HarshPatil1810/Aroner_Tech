<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', '127.0.0.1');
// define('DB_USERNAME', 'aronerte_samconsultancy');
// define('DB_PASSWORD', 'Developer@123');
// define('DB_NAME', 'aronerte_dbsamconsultancy');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
//define('DB_NAME', 'dbfiephr');
define('DB_NAME', 'dbfiepurchase');





define('server_path', 'http://localhost/fiephr/'); 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//define('FIREBASE_KEY', 'AAAAs8shB_w:APA91bFDCsRG4cfjd8I4IOcMOqIUCWFaDeKnW1J2hX7ZXX9MwEq-0mQDStaDuaubbR6X2eTcZcbYRejtAXEoDrb3m6r6aetMd3nfaMgYNFJN-87I5flSklGSHRJWX9IqO_nc7MHrQ7rU');
?>