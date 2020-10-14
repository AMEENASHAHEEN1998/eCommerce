<?php
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Dashbored';
        include 'init.php';
        /* Start Dashbored Page*/
?>

        <div class = "container home-stats text-center">
            <h2>Dashbored</h2>
            <div class="row">
                <div class = "col-md-3">
                    <div class = "stat">
                        Total Member
                        <span><?php countItem('UserId' ,'shops.users') ?></span>
                        <!--<span><?php $stmt = $con->prepare("SELECT count('UserId') FROM shops.users");
                                    $stmt->execute();
                                    ECHO $stmt->fetchColumn(); ?>
                        </span>-->
                        
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat">
                        Pending Member
                        <span>100</span>
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat">
                        Total Items
                        <span>100</span>
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat">
                        Total Comments
                        <span>100</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container latest">
            <div class="col-sm-6">
                <div class="panel panel-defult">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Latest Registered Users
                    </div>
                    <div class="panel-body">
                        Test
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-defult">
                    <div class="panel-heading">
                        <i class="fa fa-tag"></i> Latest Items
                    </div>
                    <div class="panel-body">
                        Test
                    </div>
                </div>
            </div>
        </div>
<?php

        /* End Dashbored Page*/ 
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }