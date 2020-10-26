<?php
    ob_start(); // output buffering start
    session_start();
    $pageTitle = 'Profile';
    include 'init.php'; // include init file
    
    if(isset($_SESSION['user'])){
        $getUserStmt =$con ->prepare('SELECT * FROM shops.users WHERE UserName = ?');
        $getUserStmt->execute(array($_SESSION['user']));
        $info = $getUserStmt->fetch();
        

?>
<h2 class='text-center header2'><?php echo $_SESSION['user'] ; ?> Profile</h2>
<div class = 'information block'>
    <div class = 'container'>
        <div class ='panel panel-primary'>
            <div class ='panel-heading'>
                My Information
            </div>
            <div class ='panel-body'>
                Name : <?php echo $info['UserName'] ?> </br>
                Email : <?php echo $info['Email'] ?> </br>
                Full Name : <?php echo $info['FullName'] ?> </br>
                Register Date : <?php echo $info['Date'] ?> </br>
                Favourite Category : 

            </div>
        </div>
    </div>
</div>

<div class = 'my-Ads block'>
    <div class = 'container'>
        <div class ='panel panel-primary'>
            <div class ='panel-heading'>
                My Advertise
            </div>
            <div class ='panel-body'>

            <div class='row' >
                <?php 
                    foreach(getItem('shops.items.MemberId',$info['UserId']) as $item){
                        echo '<div class = "col-sm-6 col-md-3">';
                            echo'<div class= "thumbnail item-box"> ';
                                echo '<span class = "price-tag">'.$item["Price"].'</span>';
                                echo '<img class ="img-responsive"src= "layout/image/personal.png" alt =""/>';
                                echo '<div class = "caption">';
                                    echo '<h3> '.$item['Name'].' </h3>';
                                    echo '<p> '.$item['Description'].' </p>';

                                echo'</div>';

                            echo'</div>';

                        echo'</div>';
                        
                    }
                    
                ?>
            </div>
            </div>
        </div>
    </div>
</div>

<div class = 'my-comments block'>
    <div class = 'container'>
        <div class ='panel panel-primary'>
            <div class ='panel-heading'>
                Latest Comments
            </div>
            <div class ='panel-body'>
                <?php
                    $stmt = $con->prepare("SELECT Comment FROM shops.comments WHERE User_Id = ?");
                    $stmt->execute(array($info['UserId']));
                    $comments = $stmt->fetchAll();
                    
                    if(! empty($comments)){
                        foreach($comments as $comment){
                            echo '<p>'. $comment['Comment'] . '</p>';
                        }
                    }else {
                        echo 'There is no comment to show';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
        header('location :login.php');
        exit();
    }
    include $tpl . 'Footer.php';
    ob_end_flush();

?>