<!-- 
<style>
    .bx bx-layout:{
            color:#ffffff;
        }
        .sub-menu:{
            color:#ffffff;
        }
    </style> -->
<header id="page-topbar">
    <div class="navbar-header" style="background-color:#ffffff;">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color:#ffffff;">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <!-- <img src="assets/images/logo.svg" alt="" height="22"> -->
                        <img src="assets/images/icon.jpg" alt="" width="100%">
                        
                    </span>
                    <span class="logo-lg">
                    <span class="logo-text">
                        <!-- <center><b style="color:#ffffff;font-size: 20px;">VN Group</b></center>  -->
                         <center><b style="color:#ffffff;font-size: 20px;">FIE</b></center>
                    </span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <!-- <img src="assets/images/logo-light.svg" alt="" height="22"> -->
                        <img src="assets/images/logo.jpg" alt="" width="40">
                    </span>
                    <span class="logo-lg">
                    <span class="logo-text">
                        <!-- <center><b style="color:#ffffff;font-size: 20px;">FIE</b></center> -->
                        <img src="assets/images/icon.jpg" alt=""  width="100%" >
                        <!-- <center><b style="color:#ffffff;font-size: 20px;">VN Group</b></center> -->
                    </span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars" style="background-color:#ffffff; color:#0080cd"></i>
            </button>

            <!-- App Search-->
            <!--<form class="app-search d-none d-lg-block">-->
            <!--    <div class="position-relative">-->
            <!--    <a href="index.php" style="color: #2a3042;"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;margin-top: 7px;"></i></a>-->
            <!--    </div>-->
            <!--</form>-->

            <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify" ></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            

            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-customize"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/github.png" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="assets/images/brands/slack.png" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div> -->

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> <?php //echo $language["Notifications"]; ?> </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small" key="t-view-all"> <?php //echo $language["View_All"]; ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-cart"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1" key="t-your-order"><?php //echo $language["Your_order_is_placed"]; ?></h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-grammer"><?php //echo $language["languages_grammar"]; ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago"><?php //echo $language["3_min_ago"]; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="assets/images/users/avatar-3.jpg"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-simplified"><?php //echo $language["simplified_English"]; ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago"><?php //echo $language["1_hours_ago"]; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1" key="t-shipped"><?php //echo $language["Your_item_is_shipped"]; ?></h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-grammer"><?php //echo $language["several_grammar"]; ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago"><?php //echo $language["3_min_ago"]; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="assets/images/users/avatar-4.jpg"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-occidental"><?php //echo $language["Cambridge_occidental"]; ?></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago"><?php //echo $language["1_hours_ago"]; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more"><?php //echo $language["View_More"]; ?></span> 
                        </a>
                    </div>
                </div>
            </div> -->

            <div class="dropdown d-inline-block" >
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                    <img class="rounded-circle header-profile-user" src="assets/images/users/user.jpg"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry" ><?php echo ucfirst($_SESSION["username"]); ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile"><?php echo $language["Profile"]; ?></span></a>
                    <!-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet"><?php //echo $language["My_Wallet"]; ?></span></a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings"><?php //echo $language["Settings"]; ?></span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen"><?php //echo $language["Lock_screen"]; ?></span></a>
                    <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout"><?php echo $language["Logout"]; ?></span></a>
                </div>
            </div>

           <!--  <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div> -->

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu"   style="background-color:#0080cd; color:#ffffff">

    <div data-simplebar class="h-100" >

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
            <!-- <span class="logo-text">
                <center><b style="color:#ffffff;font-size: 20px;">LTP Calculator</b></center>
            </span> -->
                <li class="menu-title" key="t-menu" style="color:#ffffff; "><?php echo $language["Menu"]; ?></li>

                    <li>
                        <a href="index.php" class="waves-effect">
                            <i class="bx bx-home-circle" style="color:#ffffff; "></i><!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                            <span key="t-dashboards" style="color:#ffffff; "><?php echo $language["Dashboard"]; ?></span>
                        </a>
                        
                    </li>

                       
                        
                    <?php if($_SESSION["usertype"] == "Admin"){ ?>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Standards</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                            <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">ISO</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-iso-master.php" key="t-saas" style="color:#ffffff; ">Add ISO</a></li>
                                <li><a href="list-iso-master.php" key="t-crypto" style="color:#ffffff; ">List ISO</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">ASTM</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-astm-master.php" key="t-saas" style="color:#ffffff; ">Add ASTM</a></li>
                                <li><a href="list-astm-master.php" key="t-crypto" style="color:#ffffff; ">List ASTM</a></li>
                            </ul>
                        </li>
                            </ul>
                        </li>
                       
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Resolution</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-resolution.php" key="t-saas" style="color:#ffffff; ">Add Resolution</a></li>
                                <li><a href="list-resolution.php" key="t-crypto" style="color:#ffffff; ">List Resolution</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Model</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-model.php" key="t-saas" style="color:#ffffff; ">Add Model</a></li>
                                <li><a href="list-model.php" key="t-crypto" style="color:#ffffff; ">List Model</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"   style="color:#ffffff; "></i>
                                <span key="t-layouts"  style="color:#ffffff; ">Users</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-user.php" key="t-saas"  style="color:#ffffff; ">Add User</a></li>
                                <li><a href="list-user.php" key="t-crypto"  style="color:#ffffff; ">List Users</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Load Cell</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-loadcell.php" key="t-saas" style="color:#ffffff; ">Add Load Cell</a></li>
                                <li><a href="list-loadcell.php" key="t-crypto" style="color:#ffffff; ">List Load Cell</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Direct Calibration</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-directcalibration.php" key="t-saas" style="color:#ffffff; ">Add Direct Calibration</a></li>
                                <li><a href="list-directcalibration.php" key="t-crypto" style="color:#ffffff; ">List Direct Calibration</a></li>
                            </ul>
                        </li>
                        

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Indirect Calibration</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-indirectcalibration.php" key="t-saas" style="color:#ffffff; ">Add Indirect Calibration</a></li>
                                <li><a href="list-indirectcalibration.php" key="t-crypto" style="color:#ffffff; ">List Indirect Calibration</a></li>
                            </ul>
                        </li>
                        <?php } ?>

                        <!-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Customer</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-customer.php" key="t-saas">Add Customer</a></li>
                                <li><a href="list-customer.php" key="t-crypto">List Customer</a></li>
                            </ul>
                        </li> -->


                        <!-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Global Setting</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="global-settings.php" key="t-saas">Global Setting</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Transactions</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="transaction.php?type=casino" key="t-saas">Coins from Casino</a></li>
                                <li><a href="transaction.php?type=master" key="t-saas">Coins to Master</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Payment</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="payment.php?type=casino" key="t-saas">Payment to Casino</a></li>
                                <li><a href="payment.php?type=master" key="t-saas">Payment from Master</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Registers</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="register.php?type=coins_casino" key="t-saas">Coins from Casino</a></li>
                                <li><a href="register.php?type=coins_master" key="t-saas">Coins to Master</a></li>
                                <li><a href="register.php?type=payment_casino" key="t-saas">Payment to Casino</a></li>
                                <li><a href="register.php?type=payment_master" key="t-saas">Payment from Master</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout"></i>
                                <span key="t-layouts">Ledger</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="ledger.php" key="t-saas">View Ledger</a></li>
                            </ul>
                        </li> -->
                       

                        

                        <!-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Results</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="add-results.php" key="t-saas" style="color:#ffffff; ">Add Results</a></li>
                                <li><a href="list-results.php" key="t-crypto" style="color:#ffffff; ">List Results</a></li>
                            </ul>
                        </li> -->
                        

                      

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-layout" style="color:#ffffff; "></i>
                                <span key="t-layouts" style="color:#ffffff; ">Report</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <?php  if ($_SESSION['usertype']=="User"){
                            
                                ?>
                              <li><a href="report.php" key="t-saas" style="color:#ffffff; ">Add New Report</a></li>
                                <?php
                            }?>
                              
                                <li><a href="list_report.php" key="t-crypto" style="color:#ffffff; ">List Report</a></li>

                                <!-- <li><a href="list-indirectcalibration.php" key="t-crypto">List Indirect Calibration</a></li> -->
                            </ul>
                        </li>
                        

                        
                   
                    <!-- <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-layout"></i>
                            <span key="t-layouts">Stages</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="add-stage.php" key="t-saas">Add Stage</a></li>
                            <li><a href="list-stage.php" key="t-crypto">List Stages</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-layout"></i>
                            <span key="t-layouts">Companies</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="add-company.php" key="t-saas">Add Company</a></li>
                            <li><a href="list-company.php" key="t-crypto">List Companies</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-layout"></i>
                            <span key="t-layouts">Files</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="add-file.php" key="t-saas">Add File</a></li>
                            <li><a href="list-file.php" key="t-crypto">List Files</a></li>
                        </ul>
                    </li> -->
                         

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->