<?php
    ob_start(); // output buffering start
    session_start();
    $pageTitle = 'Show Items';
    include 'init.php'; // include init file

    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])? intval($_GET['itemid']): 0 ;
    // select all data depends in this id 
    $stmt = $con->prepare("SELECT shops.items.* , shops.categores.Name AS categoryName , shops.users.UserName AS MemberName
                           FROM shops.items
                           INNER JOIN shops.categores on shops.categores.ID = shops.items.CatId
                           INNER JOIN shops.users on shops.users.UserId = shops.items.MemberId
                           WHERE shops.items.ID = ?");
    //ececute query
    $stmt->execute(array($itemid));
    // the row count 
    $count = $stmt->rowCount();
    if($count > 0){

    
    $row = $stmt->fetch(); 

    
    ?>
<h2 class='text-center header2'><?php echo $row['Name']?></h2>
<div class='container'>
    <div class='row'>
        <div class='col-md-3'>
            <img class ="img-responsive img-thumbnail center-block"src= "layout/image/personal.png" alt =""/>
        </div>
        <div class='col-md-9 item-info'>
            <h2 ><?php echo $row['Name']?></h2>
            <p><?php echo $row['Description']?></p>
            <ul class='list-unstyled'>
                <li >
                    <i class='fa fa-calendar fa-fw'></i>
                    <span>Added Date </span>:<?php echo $row['AddDate']?>
                </li>
                <li >
                    <i class='fa fa-money fa-fw'></i>
                    <span>Price </span>: $<?php echo $row['Price']?>
                </li>
                <li >
                    <i class='fa fa-building fa-fw'></i>
                    <span>Made In </span>: <?php echo $row['CountryMade']?>
                </li>
                <li >
                    <i class='fa fa-tags fa-fw'></i>
                    <span>Category Name is </span>: <a href="categories.php?pageid=<?php echo $row['CatId']?>"> <?php echo $row['categoryName']?></a>
                </li>
                <li >
                    <i class='fa fa-user fa-fw'></i>
                    <span>Ads Added By </span>: <a href=""> <?php echo $row['MemberName']?></a>
                </li>
            </ul>


            


        </div>
    </div>
    <hr class='custom-hr'>
    <div class='row'>
        <div class='col-md-3'>
        user image
        </div>
        <div class='col-md-9'>
        user comments
        </div>
    </div>
</div>



<?php
 }else{
     echo 'There Is No Sush Id ';
 }   

    
    include $tpl . 'Footer.php';
    ob_end_flush();

?>