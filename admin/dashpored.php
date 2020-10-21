<?php
    ob_start(); // output buffering start
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
                    <div class = "stat st-members">
                        Total Member
                        <span> <a href="member.php"> <?php echo countItem('UserId' ,'shops.users') ?></a></span>
                        <!-- <span><?php $stmt = $con->prepare("SELECT count('UserId') FROM shops.users");
                                    $stmt->execute();
                                    ECHO $stmt->fetchColumn(); ?>
                        </span>-->
                        
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-pending">
                        Pending Member
                        <span><a href="member.php?do=Manage&page=Pending"><?php echo checkItem('RegStatus','shops.users',0) ?></a> </span>
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-items">
                        Total Items
                        <span> <a href="item.php"> <?php echo countItem('ID' ,'shops.items') ?></a></span>
                        
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-comments">
                        Total Comments
                        <span>100</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container latest">
            <div class = "row">
                <div class="col-sm-6">
                    <div class="panel panel-default panalBG">
                        <div class="panel-heading">
                            <?php $latestNumber = 5; ?>
                            <i class="fa fa-users"></i> Latest <?php echo $latestNumber?> Registered Users
                        </div>
                        <div class="panel-body">
                            <ul class = "list-unstyled latest-users ">
                                <?php $latestUsers = getLatest("*" ,"shops.users" ,"UserId" ,$latestNumber);
                                    foreach($latestUsers as $user){
                                    echo "<li>".$user["UserName"] ."<a href='member.php?do=Edit&userid=".$user["UserId"]."'class='btn btn-success pull-right '><i class='far fa-edit'></i>Edit</a>";
                                    if($user['RegStatus'] == 0){
                                        echo "<a href='member.php?do=Active&userid=". $user['UserId'] ." ' class='btn btn-info btnPadd active pull-right'><i class='far fa-window-close'></i>Active</a>";
                                        }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default panalBG">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest Items
                        </div>
                        <div class="panel-body">
                            Test
                        </div>
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
    ob_end_flush();
