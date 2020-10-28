<?php include 'init.php'; // include init file ?> 
<div class='container'>
    <!--<h2 class='text-center header2'><?php //echo str_replace("-"," ",$_GET["pagename"]) ?></h2>-->
    <h2 class='text-center header2'>Show Category</h2>

    <div class='row' >
    <?php 
        foreach(getItem('shops.items.CatId',$_GET['pageid']) as $item){
            echo '<div class = "col-sm-6 col-md-3">';
                echo'<div class= "thumbnail item-box"> ';
                    echo '<span class = "price-tag">'.$item["Price"].'</span>';
                    echo '<img class ="img-responsive"src= "layout/image/personal.png" alt =""/>';
                    echo '<div class = "caption">';
                        echo '<h3> <a href="items.php?itemid='. $item['ID'] .'">'.$item['Name'].'</a> </h3>';
                        echo '<p> '.$item['Description'].' </p>';

                    echo'</div>';

                echo'</div>';

            echo'</div>';
            
        }
        
    ?>
    </div>    
    
</div>   
   



<?php include $tpl . 'Footer.php';?>