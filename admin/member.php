<?php
/* member page can add | delete | edit | update */
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Member';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){
            
            // select all user in db without admin
            $stmt = $con->prepare("SELECT * from shops.users where GroupId != 1");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            ?>
            <h2 class=" text-center"  ><?php echo lang('ManageMembers')?></h2>
            <div class ='container'>
                <div class = 'table-responsive'>
                    <table class = 'main-table text-center table table-bordered'>
                        <tr>
                            <td>#ID</td>
                            <td>User Name</td>
                            <td>Email</td>
                            <td>Full Name</td>
                            <td>Registerd Date</td>
                            <td>Control</td>
                        </tr>
                        <?php
                            foreach($rows as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['UserId'] . "</td>";
                                    echo "<td>" . $row['UserName'] . "</td>";
                                    echo "<td>" . $row['Email'] . "</td>";
                                    echo "<td>" . $row['FullName'] . "</td>";
                                    echo "<td></td>";
                                    echo "<td>
                                                <a href='member.php?do=Edit&userid=". $row['UserId'] ."  '  class='btn btn-success'>Edit</a>
                                                <a href='' class='btn btn-danger'>Delete</a>
                                          </td>";
                                    
                                echo "</tr>";

                            }
                        ?>
                        
                    </table>
                </div>
            <a href = "member.php?do=Add" class = "btn btn-primary"><i class = "fa fa-plus"></i> Add New Member</a>
            </div>
            
            <?php
        }elseif($do == 'Add'){?>

            <h2 class=" text-center"  ><?php echo lang('AddMember')?></h2>
            <div class ='container'>
                <form class='form-horizontal ' action = '?do=Insert' method = 'POST'>
                <!-- Start username filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('UserName')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="username" class="form-control"  required = "required" placeholder = "Enter username to login into shop " autocomplete = 'off'>
                        </div>
                    </div>
                <!-- End username filed-->

                <!-- Start Password filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Password')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="password" name='password' class='password form-control' autocomplete = 'new-password' required = "required" placeholder = "Password must be hard and complete">
                            <i class = "show-pass fa fa-eye fa-2x"></i>
                            

                        </div>
                    </div>
                <!-- End Password filed-->
                <!-- Start email filed-->
                    <div class ='row form-group'>
                        <label class='control-lable col-sm-2' ><?php echo lang('Email')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="email" name='email'  class='form-control' required = "required" placeholder = "Enter real email">
                        </div>
                    </div>
                <!-- End email filed-->
                <!-- Start Full Name filed-->
                    <div class ='row form-group '>
                        <label class=' col-sm-2 control-lable' ><?php echo lang('FullName')?></label>
                        <div class = 'col-sm-10 col-md-5'>
                            <input type="text" name='fullname'  class='form-control' required = "required" placeholder = "Enter full name to appear in your profile ">
                        </div>
                    </div>
                <!-- End Full Name filed-->
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
                echo "<h2 class='text-center'>Insert Member</h2> ";
                echo "<div class = 'container' >" ;
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                
                $username = $_POST['username'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $pass = $_POST['password'];
                $hashPass = sha1($_POST['password']);

                // validation for input

                $formErrors = array();
                if(strlen($username) < 4){
                    $formErrors[] = " User Name can not be <strong> less than 4 </strong> ";
                }
                if(strlen($username) > 20){
                    $formErrors[] = " User Name can not be <strong>more than 20</strong> ";
                }
                if(empty($username)){
                    $formErrors[] = "User Name is <strong>empty</strong> ";
                }
                if(empty($fullname)){
                    $formErrors[] = " Full Name is <strong>empty</strong> ";
                }
                if(empty($pass)){
                    $formErrors[] = " Password is <strong>empty</strong> ";
                }
                if(empty($email)){
                    $formErrors[] = " User email is <strong>empty</strong> ";
                }

                foreach($formErrors as $error){
                    echo "<div class = 'alert alert-danger'>" .$error."</div>" ;
                }

                // check if is there no error in update process
                if(empty($formErrors)){
                    
                    $stmt = $con->prepare("INSERT INTO shops.users(UserName ,Password , Email , FullName)
                    value (:zuser,:zpass,:zemail ,:zname)");
                    $stmt->execute(array(
                        'zuser'     => $username,
                        'zpass'     => $hashPass,
                        'zemail'    => $email,
                        'zname'     => $fullname
                    ));
                    echo'<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Insered".'</div>';
                }
                
            }else {
                echo "Sorry you can not access this browser directly";
            }
            echo "</div>";
            
        }
        elseif($do == 'Edit'){
            // check if GET request user id is number and get userid value
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']): 0 ;
           // select all data depends in this id 
            $stmt = $con->prepare("SELECT * FROM shops.users WHERE UserId = ?  LIMIT 1");
            //ececute query
            $stmt->execute(array($userid));
            // featch data from db
            $row = $stmt->fetch(); 
            // the row count 
            $count = $stmt->rowCount();
            // if there is such id show the form 
            if($count > 0){?>

                <h2 class=" text-center"  ><?php echo lang('EditMember')?></h2>
                <div class ='container'>
                    <form class='form-horizontal ' action = '?do=Update' method = 'POST'>
                        <input type = 'hidden' value = '<?php echo $userid ?>' name = 'userid'>
                    <!-- Start username filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 " ><?php echo lang('UserName')?></label>
                            <div class = "col-sm-10 col-md-5">
                                <input type="text" name="username" class="form-control" value = "<?php echo $row['UserName'] ?>" required = "required" autocomplete = 'off'>
                            </div>
                        </div>
                    <!-- End username filed-->

                    <!-- Start Password filed-->
                        <div class ='row form-group'>
                            <label class='control-lable col-sm-2' ><?php echo lang('Password')?></label>
                            <div class = 'col-sm-10 col-md-5'>
                                <input type="hidden" name='oldPassword' value = "<?php echo $row['Password'] ?>">
                                <input type="password" name='newPassword' class='form-control' autocomplete = 'new-password' placeholder = "Leave Blank if you do not need change">
                            </div>
                        </div>
                    <!-- End Password filed-->
                    <!-- Start email filed-->
                        <div class ='row form-group'>
                            <label class='control-lable col-sm-2' ><?php echo lang('Email')?></label>
                            <div class = 'col-sm-10 col-md-5'>
                                <input type="email" name='email' value = "<?php echo $row['Email'] ?>" class='form-control' required = "required">
                            </div>
                        </div>
                    <!-- End email filed-->
                    <!-- Start Full Name filed-->
                        <div class ='row form-group '>
                            <label class=' col-sm-2 control-lable' ><?php echo lang('FullName')?></label>
                            <div class = 'col-sm-10 col-md-5'>
                                <input type="text" name='fullname' value = "<?php echo $row['FullName'] ?>" class='form-control' required = "required">
                            </div>
                        </div>
                    <!-- End Full Name filed-->
                    <!-- Start save filed-->
                        <div class ='row form-group text-center'>
                            <div class = 'col-sm-offset-2 col-lg-offset-2 col-sm-10'>
                                <input type="submit" value='<?php echo lang('Save')?>' class='btn btn-primary '>
                            </div>
                        </div>
                    <!-- End save filed-->

                    </form>
                </div>
            <?php
            // else show if ther is no such id in db
            }else {
                echo "there is no id equiavilant " . $userid;
            }
        
        }elseif($do == 'Update'){
            echo "<h2 class='text-center'>Update Member</h2> ";
            echo "<div class = 'container' >" ;
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                $username = $_POST['username'];
                $userid = $_POST['userid'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];

                // password trick 

                $pass ='';
                if (empty($_POST['newPassword'])){
                    $pass = $_POST['oldPassword'];
                }else{
                    $pass = sha1($_POST['newPassword']);
                }
                // validation for input

                $formErrors = array();
                if(strlen($username) < 4){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name can not be <strong> less than 4 </strong> </div>";
                }
                if(strlen($username) > 20){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name can not be <strong>more than 20</strong> </div>";
                }
                if(empty($username)){
                    $formErrors[] = "<div class = 'alert alert-danger'> User Name is <strong>empty</strong> </div>";
                }
                if(empty($fullname)){
                    $formErrors[] = "<div class = 'alert alert-danger'> Full Name is <strong>empty</strong> </div>";
                }
                if(empty($email)){
                    $formErrors[] = "<div class = 'alert alert-danger'> User email is <strong>empty</strong> </div>";
                }

                foreach($formErrors as $error){
                    echo $error ;
                }

                // check if is there no error in update process
                if(empty($formErrors)){
                    //echo $username . $userid . $email . $fullname;

                    $stmt = $con-> prepare("UPDATE shops.users SET UserName = ? , Email = ? , FullName = ?,Password = ? WHERE UserId = ?");
                    $stmt->execute(array($username ,$email ,$fullname ,$pass ,$userid ));
                    echo'<div class= "alert alert-success">'. $stmt->rowCount() . "Recored updated".'</div>';
                }
                
            }else {
                echo "Sorry you can not access this browser directly";
            }
            echo "</div>";
            
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
    }