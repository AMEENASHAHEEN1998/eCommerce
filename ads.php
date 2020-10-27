<?php
    ob_start(); // output buffering start
    session_start();
    $pageTitle = 'Create New Ads';
    include 'init.php'; // include init file
    
    if(isset($_SESSION['user'])){
        $getUserStmt =$con ->prepare('SELECT * FROM shops.users WHERE UserName = ?');
        $getUserStmt->execute(array($_SESSION['user']));
        $info = $getUserStmt->fetch();
        

?>
<h2 class='text-center header2'>Create New Ads</h2>
<div class = 'create-ads block'>
    <div class = 'container'>
        <div class ='panel panel-primary'>
            <div class ='panel-heading'>
                Create New Ads
            </div>
            <div class ='panel-body'>
                <div class='row'>
                    <div class='col-md-8'>
                        <form class='form-horizontal ' action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = 'POST'>
                        <!-- Start Name filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="name" class="form-control live-name"  required = "required" placeholder = "Add New Item Name " >
                            </div>
                        </div>
                        <!-- End Name filed-->
                        <!-- Start Description filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 live-desc" >Description</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="description" class="form-control"  required = "required" placeholder = "Enter Description Of Item " >
                            </div>
                        </div>
                        <!-- End Description filed-->
                        <!-- Start Price filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 live-price" >Price</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="price" class="form-control"  required = "required" placeholder = "Enter Price Of Item " >
                            </div>
                        </div>
                        <!-- End Price filed-->
                        <!-- Start Country filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 " >Country</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="country" class="form-control"  required = "required" placeholder = "Enter Country Made " >
                            </div>
                        </div>
                        <!-- End Country filed-->
                        <!-- Start Status filed-->
                        <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Status</label>
                        <div class = "col-sm-10 col-md-9">
                            <select  name="status" >
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Old</option>

                            </select>
                        </div>
                    </div>
                        <!-- End Status filed-->
                        
                    
                        <!-- End Status filed-->
                        <!-- Start Categories filed-->
                        <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Categories</label>
                        <div class = "col-sm-10 col-md-9">
                            <select  name="categories" >
                                <option value="0">...</option>
                                <?php 
                                    $stmt2 = $con->prepare('SELECT * FROM shops.categores');
                                    $stmt2->execute();
                                    $categories = $stmt2->fetchAll();
                                    foreach($categories as $category){
                                        echo '<option value = " ' .$category['ID'] . '">" '.$category['Name'] .'" </option>';
                                    }
                                ?>

                            </select>
                        </div>
                    </div>
                        <!-- End Categories filed-->
                        <!-- Start save filed-->
                        <div class ='row form-group text-center'>
                            <div class = 'col-sm-10'>
                                <input type="submit" value='Add Item' class='btn btn-primary '>
                            </div>
                        </div>
                        <!-- End save filed-->

                    </form>
                    </div>
                    <div class='col-md-4'>
                        
                        <div class= "thumbnail item-box live-preview"> 
                            <span class = "price-tag">$0</span>
                            <img class ="img-responsive"src= "layout/image/personal.png" alt =""/>
                            <div class = "caption">
                                <h3>tltile </h3>
                                <p> description </p>

                            </div>

                        </div>
                        
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php
    }else{
        
        header('location:login.php');
        exit();
    }
    include $tpl . 'Footer.php';
    ob_end_flush();

?>