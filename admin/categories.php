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
            $sort = 'ASC'; //DESC OR ASC
            $sort_array = array("ASC","DESC");
            if(isset($_GET['sort']) && in_array($_GET['sort'] , $sort_array)){
                $sort = $_GET['sort'];
            }
            $stmt = $con->prepare("SELECT * from shops.categores ORDER BY Ordering $sort");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            ?>
            <h2 class="text-center">Manage Categories</h2>
            <div class= "container categories">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        Manage Categories
                        <div class="option pull-right">
                            Ordering:
                            <a class = "<?php if($_GET['sort'] == 'ASC'){echo "active" ;} ?>" href="?sort=ASC">ASC</a>
                            |
                            <a class = "<?php if($_GET['sort'] == 'DESC'){echo "active" ;} ?>" href="?sort=DESC">DESC</a>
                            View:
                            <span class='active' data-view = 'Full'>Full</span> |
                            <span>Classic</span>
                        </div>
                        </div>
                    <div class="panel-body">
                        <?php
                        foreach($rows as $row){
                            echo "<div class='cat'>";
                                echo "<div class='hidden-buttons'>";
                                    echo "<a href='categories.php?do=Edit&catid=". $row['ID'] . " 'class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
                                    echo "<a href='categories.php?do=Delete&catid=". $row['ID'] . " ' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a>";
                                echo"</div>";
                                echo "<h3>".$row['Name'] . "</h3>";
                                echo "<div class='full_view'>";
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
                                echo "</div>";
                            echo '<hr>';
                        }
                        
                        ?>
                    </div>
                </div>
                <a href="categories.php?do=Add" class = " btn btn-primary"><i class = "fa fa-plus"></i> New Category</a>
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
                        <div class = 'col-sm-10'>
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
            // check if GET request category id is number and get userid value
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])? intval($_GET['catid']): 0 ;
           // select all data depends in this id 
            $stmt = $con->prepare("SELECT * FROM shops.categores WHERE ID = ?");
            //ececute query
            $stmt->execute(array($catid));
            // featch data from db
            $row = $stmt->fetch(); 
            // the row count 
            $count = $stmt->rowCount();
            // if there is such id show the form 
            if($count > 0){?>

            <h2 class=" text-center"  >Edit Category</h2>
            <div class ='container'>
                <form class='form-horizontal ' action = '?do=Update' method = 'POST'>
                <input type = 'hidden' value = '<?php echo $catid ?>' name = 'catid'>
                <!-- Start Name filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="name" class="form-control"  required = "required" placeholder = "Add New Categories Name " autocomplete = 'off' value = "<?php echo $row['Name']; ?>">
                        </div>
                    </div>
                <!-- End Name filed-->

                <!-- Start Description filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Description')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="text" name='description' class=' form-control'  placeholder = "Descripe the categories" value = "<?php echo $row['Description']; ?>">
                        </div>
                    </div>
                <!-- End Description filed-->
                <!-- Start Ordering filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Ordering')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="text" name='ordering'  class='form-control'  placeholder = "Number to Arange Category" value = "<?php echo $row['Ordering']; ?>">
                        </div>
                    </div>
                <!-- End Ordering filed-->
                <!-- Start Visiblility filed-->
                    <div class ='row form-group '>
                        <label class=' col-sm-2 control-lable' ><?php echo lang('Visible')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <div>
                                <input type="radio" id="visible-yes" name='visiblility'  value="0" <?php if($row['Visibility'] == 0 ){ echo "checked" ;} ?>  >
                                <label for="visible-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="visible-no" name='visiblility'  value="1" <?php if($row['Visibility'] == 1 ){ echo "checked" ;} ?> >
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
                                <input type="radio" id="comment-yes" name='Commenting'  value="0" <?php if($row['AllowComment'] == 0 ){ echo "checked" ;} ?> >
                                <label for="comment-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="comment-no" name='Commenting'  value="1" <?php if($row['AllowComment'] == 1 ){ echo "checked" ;} ?> >
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
                                <input type="radio" id="Ads-yes" name='Ads'  value="0" <?php if($row['AllowAdverties'] == 0 ){ echo "checked" ;} ?> >
                                <label for="Ads-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="Ads-no" name='Ads'  value="1" <?php if($row['AllowAdverties'] == 1 ){ echo "checked" ;} ?> >
                                <label for="Ads-no">No</label>
                            </div>
                        </div>
                    </div>
                <!-- End Ads filed-->
                <!-- Start save filed-->
                    <div class ='row form-group text-center'>
                        <div class = 'col-sm-10'>
                            <input type="submit" value='<?php echo lang('btnAddMember')?>' class='btn btn-primary '>
                        </div>
                    </div>
                <!-- End save filed-->

                </form>
            </div> 
        <?php 
            // else show if ther is no such id in db
            }else {
                echo '<div class = "container">';
                    $Msg = "<div class ='alert alert-danger' >there is no id equiavilant " . $catid .'</div>';
                    redirectPage($Msg ,'back' , 3);
                echo '</div>';
            }
            
        }elseif($do == 'Update'){
            echo "<h2 class='text-center'>Update Category</h2> ";
            echo "<div class = 'container' >" ;
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                $catid          = $_POST['catid'];
                $name           = $_POST['name'];
                $description    = $_POST['description'];
                $ordering       = $_POST['ordering'];
                $visiblility    = $_POST['visiblility'];
                $Commenting     = $_POST['Commenting'];
                $Ads            = $_POST['Ads'];


                
                // validation for input

                $formErrors = array();
                if(strlen($name) < 4){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name can not be <strong> less than 4 </strong> </div>";
                }
                if(strlen($name) > 20){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name can not be <strong>more than 20</strong> </div>";
                }
                if(empty($name)){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name is <strong>empty</strong> </div>";
                }
                

                foreach($formErrors as $error){
                    $Msg= $error ;
                    redirectPage($Msg,'back' , 5);
                }

                // check if is there no error in update process
                if(empty($formErrors)){
                    //echo $username . $userid . $email . $fullname;
                    
                    $stmt = $con-> prepare("UPDATE shops.categores SET Name = ? , Description = ? , Visibility = ? , AllowComment = ? , AllowAdverties = ? WHERE ID = ?");
                    $stmt->execute(array($name ,$description ,$ordering ,$visiblility ,$Commenting ,$Ads));

                    $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Recored updated".'</div>';
                    redirectPage($Msg,'back' , 5);
                   // redirectPage($Msg,'member.php' , 5);
                
                }
                
            }else {
                $Msg = "<div class = 'alert alert-danger'>Sorry you can not access this browser directly</div>";
                redirectPage($Msg);
                
            }
            echo "</div>";
            
        
        }elseif($do == 'Delete'){ // delete page member
            echo "<h2 class='text-center'>Delete Category</h2> ";
            echo "<div class = 'container' >" ;

                // check if GET request user id is number and get userid value
                $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])? intval($_GET['catid']): 0 ;
                // select all data depends in this id 
                
                $check = checkItem('ID','shops.categores',$catid);
                // if there is such id show the form 
                if($check > 0){
                    $stmt = $con->prepare("DELETE FROM shops.categores WHERE ID = :zid ");
                    $stmt->bindParam(":zid" , $catid);
                    $stmt->execute();
                    $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Deleted".'</div>';
                    redirectPage($Msg,'back' , 5);
                    
                }else{
                    echo '<div class = "container">'; 
                        $Msg = "id number is not exist";
                        redirectPage($Msg);
                    echo '</div>';

                }
            echo'</div>';  
            
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();