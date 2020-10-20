<?php
/*
** item page
** can add | delete | edit | update | manage
*/
    ob_start(); // output buffering start
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Item';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){

            echo "hello ";
        }elseif($do == 'Add'){?>

            <h2 class=" text-center"  >Add New Item</h2>
            <div class ='container'>
                <form class='form-horizontal ' action = '?do=Insert' method = 'POST'>
                <!-- Start Name filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="name" class="form-control"  required = "required" placeholder = "Add New Item Name " >
                        </div>
                    </div>
                <!-- End Name filed-->
                <!-- Start Description filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Description</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="description" class="form-control"  required = "required" placeholder = "Enter Description Of Item " >
                        </div>
                    </div>
                <!-- End Description filed-->
                <!-- Start Price filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Price</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="price" class="form-control"  required = "required" placeholder = "Enter Price Of Item " >
                        </div>
                    </div>
                <!-- End Price filed-->
                <!-- Start Country filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Country</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="country" class="form-control"  required = "required" placeholder = "Enter Country Made " >
                        </div>
                    </div>
                <!-- End Country filed-->
                <!-- Start Status filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Status</label>
                    <div class = "col-sm-10 col-md-5">
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
                <!-- Start Status filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Member</label>
                    <div class = "col-sm-10 col-md-5">
                        <select  name="member" >
                            <option value="0">...</option>
                            <?php 
                                $stmt = $con->prepare('SELECT * FROM shops.users');
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach($users as $user){
                                    echo '<option value = " ' .$user['UserId'] . '">" '.$user['UserName'] .'" </option>';
                                }
                            ?>

                        </select>
                    </div>
                </div>
                <!-- End Status filed-->
                <!-- Start Categories filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Categories</label>
                    <div class = "col-sm-10 col-md-5">
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
        <?php 
                
            
        }elseif($do == 'Insert'){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<h2 class='text-center'>Insert Item</h2> ";
                echo "<div class = 'container' >" ;
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                
                $name               = $_POST['name'];
                $description        = $_POST['description'];
                $price              = $_POST['price'];
                $country            = $_POST['country'];
                $status             = $_POST['status'];
                $member             = $_POST['member'];
                $categories         = $_POST['categories'];
                

                

                // validation for input

                $formErrors = array();
                
                if(empty($name)){
                    $formErrors[] = "Item Name is <strong>empty</strong> ";
                }
                if(empty($status)){
                    $formErrors[] = "Item Status is <strong>empty</strong> ";
                }
                if($status == 0){
                    $formErrors[] = "You must choose <strong>Status</strong> ";
                }
                if($member == 0){
                    $formErrors[] = "You must choose <strong>Member</strong> ";
                }
                if($categories == 0){
                    $formErrors[] = "You must choose <strong>Categories</strong> ";
                }
                if(empty($country)){
                    $formErrors[] = "Item Country is <strong>empty</strong> ";
                }
                if(empty($description)){
                    $formErrors[] = " Description of Item is <strong>empty</strong> ";
                }
                if(empty($price)){
                    $formErrors[] = " Price of Item is <strong>empty</strong> ";
                }
                

                foreach($formErrors as $error){
                    $Msg = "<div class = 'alert alert-danger'>" .$error."</div>" ;
                    redirectPage($Msg,'back' , 5);

                }

                // check if is there no error in update process
                if(empty($formErrors)){

                    
                    // insert into db
                    $stmt = $con->prepare("INSERT INTO shops.items(Name ,Description , Price , CountryMade,Status ,AddDate,MemberId,CatId)
                    value (:zName,:zDescription,:zPrice ,:zCountryMade ,:zStatus , now() , :zMemberId ,:zCatId)");
                    $stmt->execute(array(
                        'zName'             => $name,
                        'zDescription'      => $description,
                        'zPrice'            => $price,
                        'zCountryMade'      => $country,
                        'zStatus'           => $status,
                        'zMemberId'         => $member,
                        'zCatId'            => $categories
                        
                    ));
                    $Msg = '<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Insered".'</div>';
                    redirectPage($Msg,'back' , 5);
                    
                    
                }
                
            }else {
                echo '<div class = "container">';
                    $Msg = "<div class ='alert alert-danger' >Sorry you can not access this browser directly</div>";
                    redirectPage($Msg);
                echo '</div>';
            }
            echo "</div>";
            
        }elseif($do == 'Edit'){
            // check if GET request user id is number and get userid value
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])? intval($_GET['itemid']): 0 ;
           // select all data depends in this id 
            $stmt = $con->prepare("SELECT * FROM shops.items WHERE ID = ?  LIMIT 1");
            //ececute query
            $stmt->execute(array($itemid));
            // featch data from db
            $row = $stmt->fetch(); 
            // the row count 
            $count = $stmt->rowCount();
            // if there is such id show the form 
            if($count > 0){?>

                <h2 class=" text-center"  >Edit Item</h2>
                <div class ='container'>
                <form class='form-horizontal ' action = '?do=Update' method = 'POST'>
                    <input type = 'hidden' value = '<?php echo $itemid ?>' name = 'itemid'>

                <!-- Start Name filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="name" class="form-control"  required = "required" placeholder = "Add New Item Name " value="<?php echo $row['Name'] ?>" >
                        </div>
                    </div>
                <!-- End Name filed-->
                <!-- Start Description filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Description</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="description" class="form-control"  required = "required" placeholder = "Enter Description Of Item " value = "<?php echo $row['Description'] ?>">
                        </div>
                    </div>
                <!-- End Description filed-->
                <!-- Start Price filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Price</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="price" class="form-control"  required = "required" placeholder = "Enter Price Of Item " value="<?php echo $row['Price'] ?>">
                        </div>
                    </div>
                <!-- End Price filed-->
                <!-- Start Country filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Country</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="country" class="form-control"  required = "required" placeholder = "Enter Country Made " value="<?php echo $row['CountryMade'] ?>" >
                        </div>
                    </div>
                <!-- End Country filed-->
                <!-- Start Status filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Status</label>
                    <div class = "col-sm-10 col-md-5">
                        <select  name="status"  value = "<?php echo $row['Status'] ?>">
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Old</option>

                        </select>
                    </div>
                </div>
                <!-- End Status filed-->
                <!-- Start Status filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Member</label>
                    <div class = "col-sm-10 col-md-5">
                        <select  name="member"  value="<?php echo $row['MemberId'] ?>">
                            <option value="0">...</option>
                            <?php 
                                $stmt = $con->prepare('SELECT * FROM shops.users');
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach($users as $user){
                                    echo '<option value = " ' .$user['UserId'] . '">" '.$user['UserName'] .'" </option>';
                                }
                            ?>

                        </select>
                    </div>
                </div>
                <!-- End Status filed-->
                <!-- Start Categories filed-->
                <div class ="row form-group form-group-lg">
                    <label class="control-lable col-sm-2 " >Categories</label>
                    <div class = "col-sm-10 col-md-5">
                        <select  name="categories" value="<?php echo $row['CatId'] ?>" >
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
            <?php
            // else show if ther is no such id in db
            }else {
                echo '<div class = "container">';
                    $Msg = "<div class ='alert alert-danger' >there is no id equiavilant " . $userid .'</div>';
                    redirectPage($Msg);
                echo '</div>';
            }
        
           
        
        }elseif($do == 'Update'){
            echo "<h2 class='text-center'>Update Item</h2> ";
            echo "<div class = 'container' >" ;
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                $name               = $_POST['name'];
                $description        = $_POST['description'];
                $price              = $_POST['price'];
                $country            = $_POST['country'];
                $status             = $_POST['status'];
                $member             = $_POST['member'];
                $categories         = $_POST['categories'];;

                
                // validation for input

                $formErrors = array();
                
                if(empty($name)){
                    $formErrors[] = "Item Name is <strong>empty</strong> ";
                }
                if(empty($status)){
                    $formErrors[] = "Item Status is <strong>empty</strong> ";
                }
                if($status == 0){
                    $formErrors[] = "You must choose <strong>Status</strong> ";
                }
                if($member == 0){
                    $formErrors[] = "You must choose <strong>Member</strong> ";
                }
                if($categories == 0){
                    $formErrors[] = "You must choose <strong>Categories</strong> ";
                }
                if(empty($country)){
                    $formErrors[] = "Item Country is <strong>empty</strong> ";
                }
                if(empty($description)){
                    $formErrors[] = " Description of Item is <strong>empty</strong> ";
                }
                if(empty($price)){
                    $formErrors[] = " Price of Item is <strong>empty</strong> ";
                }
                

                foreach($formErrors as $error){
                    $Msg = "<div class = 'alert alert-danger'>" .$error."</div>" ;
                    redirectPage($Msg,'back' , 5);

                }

                // check if is there no error in update process
                if(empty($formErrors)){
                    //echo $username . $userid . $email . $fullname;

                    $stmt = $con-> prepare("UPDATE shops.items SET Name = ? , Description = ? , Price = ?,CountryMade = ? ,Status= ? ,MemberId= ? ,CatId= ? WHERE ID = ?");
                    $stmt->execute(array($name ,$description ,$price ,$country ,$status ,$member,$categories ));

                    $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Recored updated".'</div>';
                    redirectPage($Msg,'back' , 5);
                   // redirectPage($Msg,'member.php' , 5);
                
                }
            
        }
        elseif($do == 'Delete'){ 
            echo "<h2 class='text-center'>Delete Member</h2> ";
            echo "<div class = 'container' >" ;

                // check if GET request user id is number and get userid value
                $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])? intval($_GET['itemid']): 0 ;
                // select all data depends in this id 
                
                $check = checkItem('ID','shops.items',$itemid);
                // if there is such id show the form 
                if($check > 0){
                    $stmt = $con->prepare("DELETE FROM shops.items WHERE ID = :zitemid ");
                    $stmt->bindParam(":zitemid" , $itemid);
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
              
        }elseif($do == 'Active'){ 

             
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();
?>