<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once "layouts/config.php";


if (isset($_POST['btnlogin'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    // print_r($username);exit();
    
    if ($username == 'admin' && $password == '7BD0XnahFG') {
        $_SESSION["usertype"] = 'Admin';
        $_SESSION["id"] = 0;
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = "Super Admin";
        
        header("Location:index.php");
    }else{

        $flag = 0;
        $tokenflag = 0;

        $stmt = $link->prepare('select * from tblcontractorregform where sContactNumber = ? or sEmail = ?');
        $stmt->bind_param('ss', $username,$username);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $output = $row;
            $flag = 1;            
        }

        if ($flag == 1)
        {

            $fromsqlhash = $output['sPassword'];
            if (password_verify($password, $fromsqlhash)) {
                
                session_start();

              // print_r("I am here...");exit();
              
              $_SESSION['id'] = $output['iContractorRegFormId'];
              $_SESSION['username'] = $output['sName'];

              $_SESSION['usertype'] = "Contractor";

              $_SESSION["loggedin"] = true;

              header("Location:index.php");
            } else {
              $msg  = "Invalid Userid or Password";
            }
        }
    }

}
?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Happysoul</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <style>
        .auth-logo .auth-logo-dark {
            display: none;
        }

        .forgot-password:hover{
            text-decoration: underline;
            cursor: pointer;
        }
        .bg {
 
       /* background-image: url("assets/images/background.png"); 
        
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;  */

         background-color:#f6b7a3; 
        }
    </style>
</head>

<body >
    <div class="account-pages  pt-2">
        <div class="bg">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <!-- <center><h2> FIE</h2></center> -->
                    <center><img src="assets/images/logohappysoul-removebg.png" alt="" width="40%" ></center>

                    <div class="card overflow-hidden" style="border: 1px solid #275b58;">
                        <div class="bg-primary bg-soft" > 
                            <div class="row" style="background-color:#ffffff;">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <!-- class="text-primary" -->
                                        <center> <h5  style="color:#275b58;">Welcome Back !</h5><center>
                                        </center><p <?php if(isset($msg)) echo 'style="color: red;"'; else echo 'style="color:#275b58;"';  ?>><?php if(isset($msg)) echo $msg;else echo "Sign in to continue to Happy Soul."; ?></p></center>
                                    </div>
                                </div>
                                <!-- <div class="col-5 align-self-end">
                                    <img src="assets/images/icon.jpg" alt="" class="img-fluid">
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="index.php" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="index.php" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="auth-login.php" method="post">

                                    <div class="mb-3">
                                        <label for="username" class="form-label" style="color: #275b58;">Mobile No</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter Mobile No" name="username">
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label" style="color: #275b58;">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                                        </div>
                                    </div><br>

                                    <div class="mt-3 d-grid">
                                        <button name="btnlogin" class="btn btn-primary waves-effect waves-light" type="submit" value="Login" style="background-color:#275b58;">Log In</button>
                                    </div>

                                    <br>

                                    <div class="mb-3">
                                        <center><label  ><a href="signup.php" style="color:#275b58;">Sign Up</a></label></center>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>
                            <!-- <p>Don't have an account ? <a href="auth-register.php" class="fw-medium text-primary"> Signup now </a> </p> -->
                            <p  style="color: #275b58;;" >© <script>
                                    document.write(new Date().getFullYear())
                                </script> Magicians of Wellness India Private Limited</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->

    <!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- App js -->
<script src="assets/js/app.js"></script>
</body>
</html>