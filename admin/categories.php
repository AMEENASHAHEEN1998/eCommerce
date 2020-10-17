<?php
/*
** categories page
** can add | delete | edit | update | manage
*/
    ob_start(); // output buffering start
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Categories';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){
            $stmt = $con->prepare("SELECT * from shops.categores");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            ?>
            <h2 class="text-center">Manage Categories</h2>
            <div class= "container categories">
                <div class="panel panel-default ">
                    <div class="panel-heading">Manage Categories</div>
                    <div class="panel-body">
                        <?php
                        foreach($rows as $row){
                            echo "<div class='cat'>";
                                echo "<div class='hidden-buttons'>";
                                    echo "<a href='#' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
                                    echo "<a href='#' class='btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a>";
                                echo"</div>";
                                echo "<h3>".$row['Name'] . "</h3>";
                                echo "<p>"; 
                                    if($row['Description'] == ""){
                                        echo "this category without description";
                                    } else{
                                       echo $row['Description'];
                                    }
                                echo "</p>";
                                if($row['Visibility'] == 1){echo "<span class='Visibility'> Hidden</span>";}
                                if($row['AllowComment'] == 1){echo "<span class='AllowComment'>Comment Disable</span>";}
                                if($row['AllowAdverties'] == 1){echo "<span class='AllowAdverties'>Adverties Disable</span>";}
                            echo "</div>";
                            echo '<hr>';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
            <?php
            
        }elseif($do == 'Add'){?>

            <h2 class=" text-center"  ><?php echo lang('AddCategories')?></h2>
            <div class ='container'>
                <form class='form-horizontal ' action = '?do=Insert' method = 'POST'>
                <!-- Start Name filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="name" class="form-control"  required = "required" placeholder = "Add New Categories Name " autocomplete = 'off'>
                        </div>
                    </div>
                <!-- End Name filed-->

                <!-- Start Description filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Description')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="text" name='description' class=' form-control'  placeholder = "Descripe the categories">
                        </div>
                    </div>
                <!-- End Description filed-->
                <!-- Start Ordering filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Ordering')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="text" name='ordering'  class='form-control'  placeholder = "Number to Arange Category">
                        </div>
                    </div>
                <!-- End Ordering filed-->
                <!-- Start Visiblility filed-->
                    <div class ='row form-group '>
                        <label class=' col-sm-2 control-lable' ><?php echo lang('Visible')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <div>
                                <input type="radio" id="visible-yes" name='visiblility'  value="0" checked >
                                <label for="visible-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="visible-no" name='visiblility'  value="1"  >
                                <label for="visible-no">No</label>
                            </div>
                        </div>
                    </div>
                <!-- End Visiblility filed-->
                <!-- Start Commenting filed-->
                <div class ='row form-group '>
                        <label class=' col-sm-2 control-lable' ><?php echo lang('Commenting')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <div>
                                <input type="radio" id="comment-yes" name='Commenting'  value="0" checked >
                                <label for="comment-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="comment-no" name='Commenting'  value="1"  >
                                <label for="comment-no">No</label>
                            </div>
                        </div>
                    </div>
                <!-- End Commenting filed-->
                <!-- Start Ads filed-->
                <div class ='row form-group '>
                        <label class=' col-sm-2 control-lable' ><?php echo lang('Ads')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <div>
                                <input type="radio" id="Ads-yes" name='Ads'  value="0" checked >
                                <label for="Ads-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="Ads-no" name='Ads'  value="1"  >
                                <label for="Ads-no">No</label>
                            </div>
                        </div>
                    </div>
                <!-- End Ads filed-->
                <!-- Start save filed-->
                    <div class ='row form-group text-center'>
                        <div class = 'col-sm-offset-2 col-lg-offset-2 col-sm-10'>
                            <input type="submit" value='<?php echo lang('btnAddMember')?>' class='btn btn-primary '>
                        </div>
                    </div>
                <!-- End save filed-->

                </form>
            </div> 
        <?php 
                
            
        }elseif($do == 'Insert'){

            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<h2 class='text-center'>Insert Gategory</h2> ";
                echo "<div class = 'container' >" ;
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                
                $name           = $_POST['name'];
                $description    = $_POST['description'];
                $ordering       = $_POST['ordering'];
                $visiblility    = $_POST['visiblility'];
                $Commenting     = $_POST['Commenting'];
                $Ads            = $_POST['Ads'];
                

                // validation for input

                $formErrors = array();
                if(strlen($name) < 4){
                    $formErrors[] = " Name category can not be <strong> less than 4 </strong> ";
                }
                if(strlen($name) > 20){
                    $formErrors[] = " Name category can not be <strong>more than 20</strong> ";
                }
                if(empty($name)){
                    $formErrors[] = " Name category is <strong>empty</strong> ";
                }
                
                if(empty($ordering)){
                    $formErrors[] = " Ordering is <strong>empty</strong> ";
                }
                

                foreach($formErrors as $error){
                    $Msg = "<div class = 'alert alert-danger'>" .$error."</div>" ;
                    redirectPage($Msg,'back' , 5);

                }

                // check if is there no error in update process
                if(empty($formErrors)){

                    $check = checkItem("Name","shops.categores",$name);
                    if($check == 1){
                        $Msg = "<div class = 'alert alert-danger'>Sorry this Name Category is exist</div>";
                        redirectPage($Msg,'back' , 5);
                    }else{
                        // insert into db
                        $stmt = $con->prepare("INSERT INTO shops.categores(Name ,Description , Ordering , Visibility,AllowComment,AllowAdverties)
                        value (:zname,:zdesc,:zorder ,:zvisible ,:zallowComment ,:zallowAds )");
                        $stmt->execute(array(
                            'zname'          => $name,
                            'zdesc'          => $description,
                            'zorder'         => $ordering,
                            'zvisible'       => $visiblility,
                            'zallowComment'  => $Commenting,
                            'zallowAds'      => $Ads

                        ));
                        $Msg = '<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Insered".'</div>';
                        redirectPage($Msg,'back' , 5);
                    
                    }
                }
                
            }else {
                echo '<div class = "container">';
                    $Msg = "<div class ='alert alert-danger' >Sorry you can not access this browser directly</div>";
                    redirectPage($Msg,'back' , 5);
                echo '</div>';
            }
            echo "</div>";
       
            
        }elseif($do == 'Edit'){
            
        }elseif($do == 'Update'){
            
        }elseif($do == 'Delete'){ // delete page member

            
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();