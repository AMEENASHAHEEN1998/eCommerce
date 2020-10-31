<?php
    ob_start(); // output buffering start
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Dashbored';
        include 'init.php';
        /* Start Dashbored Page*/

        $latestNumber = 5; 
?>

         

        <div class = "container home-stats text-center">
            <h2>Dashbored</h2>
            <div class="row">
                <div class = "col-md-3">
                    <div class = "stat st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            Total Member
                            <span> <a href="member.php"> <?php echo countItem('UserId' ,'shops.users') ?></a></span>
                        </div>
                        
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-pending">
                        <i class="fa fa-user-plus"></i>
                        <div class="info">
                            Pending Member
                            <span><a href="member.php?do=Manage&page=Pending"><?php echo checkItem('RegStatus','shops.users',0) ?></a> </span>
                        </div>
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-items">
                        <i class="fa fa-tag"></i>
                        <div class="info">
                            Total Items
                            <span> <a href="item.php"> <?php echo countItem('ID' ,'shops.items') ?></a></span>
                        </div>
                    </div>
                </div>
                <div class = "col-md-3">
                    <div class = "stat st-comments">
                        <i class="fa fa-comments"></i>
                        <div class="info">
                            Total Comments
                            <span><a href="comment.php"> <?php echo countItem('ID' ,'shops.comments') ?></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container latest">
            <div class = "row">
                <div class="col-sm-6">
                    <div class="panel panel-default panalBG">
                        <div class="panel-heading">
                            
                            <i class="fa fa-users"></i> Latest <?php echo $latestNumber?> Registered Users
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class = "list-unstyled latest-users ">
                                <?php $latestUsers = getLatest("*" ,"shops.users" ,"UserId" ,$latestNumber);
                                if(! empty($latestUsers)){
                                    foreach($latestUsers as $user){
                                        echo "<li>".$user["UserName"] ."<a href='member.php?do=Edit&userid=".$user["UserId"]."'class='btn btn-success pull-right '><i class='far fa-edit'></i>Edit</a>";
                                        if($user['RegStatus'] == 0){
                                            echo "<a href='member.php?do=Active&userid=". $user['UserId'] ." ' class='btn btn-info btnPadd active pull-right'><i class='fa fa-check'></i>Active</a>";
                                        }
                                    }
                                }else{
                                    echo "There\'s No Member To Show";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default panalBG">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i> Latest <?php echo $latestNumber?> Items
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <ul class = "list-unstyled latest-users ">
                                <?php $latestItems = getLatest("*" ,"shops.items" ,"ID" ,$latestNumber);
                                    if(! empty($latestItems)){
                                        foreach($latestItems as $item){
                                        echo "<li>".$item["Name"] ."<a href='item.php?do=Edit&itemid=".$item["ID"]."'class='btn btn-success pull-right '><i class='far fa-edit'></i>Edit</a>";
                                        if($item['Approve'] == 0){
                                            echo "<a href='item.php?do=Approve&itemid=". $item['ID'] ." ' class='btn btn-info btnPadd active pull-right'><i class='fa fa-check'></i>Approve</a>";
                                            }
                                        }
                                    }else{
                                        echo "There\'s No Item to show";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start comment panal -->
            <div class = "row">
                <div class="col-sm-6">
                    <div class="panel panel-default panalBG">
                        <div class="panel-heading">
                            
                            <i class="fa fa-comments-o"></i> Latest <?php echo $latestNumber?> Comments
                            <span class="toggle-info pull-right">
                                <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <?php 
                                $stmt = $con->prepare("SELECT shops.comments.*  , shops.users.UserName AS 'Member Name'
                                FROM shops.comments
                                
                                INNER JOIN shops.users on shops.users.UserId = shops.comments.User_Id
                                ORDER BY shops.comments.ID DESC
                                LIMIT $latestNumber");
                                $stmt->execute();
                                $comments = $stmt->fetchAll();
                                if(! empty($comments)){
                                foreach($comments as $comment){
                                    echo "<div class='comment-box'>";
                                        echo "<span class='member_name' >". $comment['Member Name'] ."</span>";
                                        echo "<p class='member_comment' >". $comment['Comment'] ."</p>";
                                    /*echo "<div class='btn-box'>
                                        <a href='comment.php?do=Edit&commentid=". $comment['ID'] ."  '  class='btn btn-success btnPadd'><i class='far fa-edit'></i> Edit</a>
                                        <a href='comment.php?do=Delete&commentid=". $comment['ID'] ." ' class='btn btn-danger confirm btnPadd'><i class='fa fa-close'></i> Delete</a>";
                                        if($comment['Status'] == 0){
                                            echo "<a href='comment.php?do=Approve&commentid=". $comment['ID'] ." ' class='btn btn-info btnPadd active'><i class='fa fa-check'></i> Approve</a>";
                                        }
                                    echo "</div>";*/

                                    echo"</div>";

                                }}else{
                                    echo "There\'s No Comment To Show";
                                }
                            ?>
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
