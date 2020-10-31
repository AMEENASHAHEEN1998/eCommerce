<?php
    session_start();
    $pageTitle = 'Home Page';

    
    include 'init.php'; // include init file
    
    ?>
<div class='container'>
    <div class='row' >
    <?php 
        $allItems = getAllFrom('items' , 'shops.items.ID' ,'where Approve = 1');
        foreach($allItems as $item){
            echo '<div class = "col-sm-6 col-md-3">';
                echo'<div class= "thumbnail item-box"> ';
                    echo '<span class = "price-tag">$'.$item["Price"].'</span>';
                    echo '<img class ="img-responsive"src= "layout/image/personal.png" alt =""/>';
                    echo '<div class = "caption">';
                        echo '<h3> <a href="items.php?itemid='. $item['ID'] .'">'.$item['Name'].'</a> </h3>';
                        echo '<p> '.$item['Description'].' </p>';
                        echo '<div class=""> '.$item['AddDate'].'</div>';
                    echo'</div>';

                echo'</div>';

            echo'</div>';
            
        }
        
    ?>
    </div>    
    
</div>   

<?php
    include $tpl . 'Footer.php';
    ?>