<?php
    session_start();
    $noNavbar ='';
    $pageTitle = 'Register';
    if(isset($_SESSION['UserName'])){
        header('location:dashpored.php');
    }
    include 'init.php'; // include init file
    

    //check if user come from http request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);

        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        

        // check if user exist in database
    

        $stmt = $con->prepare("INSERT INTO shops.users(UserName ,Password , Email , FullName,RegStatus,Date)
                        value (:zuser,:zpass,:zemail ,:zname ,0, now())");
                        $stmt->execute(array(
                            'zuser'     => $username,
                            'zpass'     => $hashedPass,
                            'zemail'    => $email,
                            'zname'     => $fullname
                        ));
                         
        $count = $stmt->rowCount();
                        echo '<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Insered".'</div>';
                        
        
        // if count > 0 this mean that connect to database correct
        if($count > 0){
            $_SESSION['UserName'] = $username; // register session name
            $_SESSION['ID']   = $row['UserId']; // register session id
            header('location:dashpored.php'); // transfer to dashpored page
            exit();
        }
    }
?>


<div class = "registerDiv">
<h4 class="text-center headerRegister">User Register</h4>

            <form class='form-horizontal register class ='container' '  action = '<?php echo $_SERVER['PHP_SELF'] ?>' method = 'POST'>

                <!-- Start username filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('UserName')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="username" class="form-control"  required = "required" placeholder = "Enter username to register into shop " autocomplete = 'off'>
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
                        <div class = ' col-sm-10'>
                            <input type="submit" value='Register' class='btn btn-primary '>
                        </div>
                    </div>
                <!-- End save filed-->

                </form>
                </div>
<?php
    include $tpl . 'Footer.php';
    ?>