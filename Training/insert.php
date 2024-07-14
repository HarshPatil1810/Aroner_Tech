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
define('DB_NAME', 'newdb');





//define('server_path', 'http://localhost/Fie/'); 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);




// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['save']) )
{
    

    $dept=$_POST['DeptName'];
    $name=$_POST['UserName'];
    $email=$_POST['emailAddress'];
        
    $query = "INSERT INTO UserInfo (DeptName, UserName, emailAddress, ) VALUES ($dept,$name,$email)"; 
    if(mysqli_query($link, $query)){
        echo "<h3>data stored in a database successfully</h3>"; 

       } 
       
       else{
        echo " Error ";
           
    }

    

}
}


?>