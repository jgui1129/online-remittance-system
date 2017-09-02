<?php 
    
    if (!isset($_SESSION["username"])){
        header("location: login.php");
    }
?>

<a href="index.php"><h2 id="logo"><i class="fa fa-truck"></i> BSUexpress</h2></a>
<div id="wrapper" class="toggled">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
            <br/><br/><br/><br/>
                <li class="sidebar-brand">
                        <a href="settings.php"><h1 style="padding-left: 50px"><i class="fa fa-user-circle fa-2x" aria-hidden="true" style="padding-bottom: 10px"></i><br/>Hi <?php echo $_SESSION["username"]; ?></h1></a>
                </li>
                <br/><br/><br/><br/><br/>
                <li>
                     <a href="tracking-number-lookup.php" class="effects"><i class="fa fa-search" aria-hidden="true"></i> Lookup</a>
                </li>
                <li>
                     <a href="send-money-remittance.php" class="effects"><i class="fa fa-rub" aria-hidden="true"></i> Send Money Remittance</a>
                </li>
                <li>
                     <a href="send-package-remittance.php" class="effects"><i class="fa fa-dropbox" aria-hidden="true"></i> Send Package Remittance</a>
                </li>
                <li>
                     <a href="claim-remittance.php" class="effects"><i class="fa fa-file" aria-hidden="true"></i> Claim Remittance</a>
                </li>
                <?php 
                    if ($_SESSION["access"] == "admin") {
                        
                echo '<li>
                     <a href="manage-users.php" class="effects"><i class="fa fa-user" aria-hidden="true"></i> Manage Users</a>
                </li>
                <li>
                     <a href="view-reports.php" class="effects"><i class="fa fa-line-chart " aria-hidden="true"></i> View Reports</a>
                </li>
                <li>
                     <a href="view-archive.php" class="effects"><i class="fa fa-trash-o" aria-hidden="true"></i> View Archive</a>
                </li>';

                    }
                ?>
  
                <li>
                     <a href="logout.php" class="effects"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </div>
<div id="page-content-wrapper">