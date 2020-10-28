<?php
    ob_start(); // output buffering start
    session_start();
    $pageTitle = 'Create New Item';
    include 'init.php'; // include init file
    
    if(isset($_SESSION['user'])){
        $getUserStmt =$con ->prepare('SELECT * FROM shops.users WHERE UserName = ?');
        $getUserStmt->execute(array($_SESSION['user']));
        $info = $getUserStmt->fetch();
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            echo $_SESSION['user'];
            echo $_SESSION['uid'];
            print_r($_SESSION);

            $formErrors = array();

            $name           =filter_var($_POST['name'],FILTER_SANITIZE_STRING);
            $desc           =filter_var($_POST['description'],FILTER_SANITIZE_STRING);
            $price          =filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
            $country        =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
            $status         =filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
            $categories     =filter_var($_POST['categories'],FILTER_SANITIZE_NUMBER_INT);
            if(strlen($name) < 4){
                $formErrors[] = 'Title Name Can not Be Less Than 4 Charackter';
            }
            if(strlen($desc) < 20){
                $formErrors[] = 'Description Can not Be Less Than 20 Charackter';
            }
            if(strlen($country) < 2){
                $formErrors[] = 'Country Name Can not Be Less Than 2 Charackter';
            }
            if(empty($price)){
                $formErrors[] = 'Price Can Not Be Empty';
            }
            if(empty($status)){
                $formErrors[] = 'Status Can Not Be Empty';
            }
            if(empty($categories)){
                $formErrors[] = 'Categories Can Not Be Empty';
            }
            if(empty($formErrors)){

                    
                // insert into db
                $stmt = $con->prepare("INSERT INTO shops.items(Name ,Description , Price , CountryMade,Status ,AddDate,MemberId,CatId)
                value (:zName,:zDescription,:zPrice ,:zCountryMade ,:zStatus , now() , :zMemberId ,:zCatId)");
                $stmt->execute(array(
                    'zName'             => $name,
                    'zDescription'      => $desc,
                    'zPrice'            => $price,
                    'zCountryMade'      => $country,
                    'zStatus'           => $status,
                    'zMemberId'         => $_SESSION['uid'],
                    'zCatId'            => $categories
                    
                )); 
                if($stmt){
                    echo 'Item Added';
                }
            }
       
        }
        

?>
<h2 class='text-center header2'><?php echo $pageTitle ;?></h2>
<div class = 'create-ads block'>
    <div class = 'container'>
        <div class ='panel panel-primary'>
            <div class ='panel-heading'>
                <?php echo $pageTitle ;?>
            </div>
            <div class ='panel-body'>
                <div class='row'>
                    <div class='col-md-8'>
                        <form class='form-horizontal main-form' action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = 'POST'>
                        <!-- Start Name filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="text-center control-lable col-sm-3 " ><?php echo lang('Name')?></label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="name" class="form-control live" data-class='.live-name'  required = "required" placeholder = "Add New Item Name " >
                            </div>
                        </div>
                        <!-- End Name filed-->
                        <!-- Start Description filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="text-center control-lable col-sm-3 " >Description</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="description" class="form-control live" data-class='.live-desc' required = "required" placeholder = "Enter Description Of Item " >
                            </div>
                        </div>
                        <!-- End Description filed-->
                        <!-- Start Price filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="text-center control-lable col-sm-3 " >Price</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="price" class="form-control live" data-class='.live-price'  required = "required" placeholder = "Enter Price Of Item " >
                            </div>
                        </div>
                        <!-- End Price filed-->
                        <!-- Start Country filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="text-center control-lable col-sm-3" >Country</label>
                            <div class = "col-sm-10 col-md-9">
                                <input type="text" name="country" class="form-control"  required = "required" placeholder = "Enter Country Made " >
                            </div>
                        </div>
                        <!-- End Country filed-->
                        <!-- Start Status filed-->
                        <div class ="row form-group form-group-lg">
                        <label class="text-center control-lable col-sm-3 " >Status</label>
                        <div class = "col-sm-10 col-md-9">
                            <select  name="status" class = "col-sm-10 col-md-9" >
                                <option value="0" class = "col-sm-10 col-md-9">...</option>
                                <option value="1" class = "col-sm-10 col-md-9">New</option>
                                <option value="2"class = "col-sm-10 col-md-9">Like New</option>
                                <option value="3" class = "col-sm-10 col-md-9">Used</option>
                                <option value="4" class = "col-sm-10 col-md-9">Old</option>

                            </select>
                        </div>
                    </div>
                        <!-- End Status filed-->
                        
                    
                        <!-- End Status filed-->
                        <!-- Start Categories filed-->
                        <div class ="row form-group form-group-lg">
                        <label class="text-center control-lable col-sm-3 " >Categories</label>
                        <div class = "col-sm-10 col-md-9">
                            <select  name="categories" class = "col-sm-10 col-md-9" >
                                <option value="0" class = "col-sm-10 col-md-9">...</option>
                                <?php 
                                    $stmt2 = $con->prepare('SELECT * FROM shops.categores');
                                    $stmt2->execute();
                                    $categories = $stmt2->fetchAll();
                                    foreach($categories as $category){
                                        echo '<option class = "col-sm-10 col-md-9" value = " ' .$category['ID'] . '">" '.$category['Name'] .'" </option>';
                                    }
                                ?>

                            </select>
                        </div>
                    </div>
                        <!-- End Categories filed-->
                        <!-- Start save filed-->
                        <div class ='row form-group text-center'>
                            <div class = 'col-sm-8'>
                                <input type="submit" value='Add Item' class='btn btn-primary '>
                            </div>
                        </div>
                        <!-- End save filed-->

                    </form>
                    </div>
                    <div class='col-md-4'>
                        
                        <div class= "thumbnail item-box live-preview"> 
                            <span class = "price-tag ">$<span class='live-price'>0</span></span>
                            <img class ="img-responsive"src= "layout/image/personal.png" alt =""/>
                            <div class = "caption">
                                <h3 class='live-name'>tltile </h3>
                                <p class='live-desc'> description </p>

                            </div>

                        </div>
                        
                    </div>

                </div>
                <?php 
                    if(!empty($formErrors)){
                        foreach($formErrors as $error){
                            echo '<div class="alert alert-danger">'.$error . '</div>';
                        }
                    }
                ?>
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