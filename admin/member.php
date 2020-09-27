<?php
/* member page can add | delete | edit | update */
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Member';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){
            echo "welcome from manage page in member";
        }
        elseif($do == 'Edit'){
            // check if GET request user id is number and get userid value
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']): 0 ;
           // select all data depends in this id 
            $stmt = $con->prepare("SELECT * FROM shop.users WHERE UserId = ?  LIMIT 1");
            //ececute query
            $stmt->execute(array($userid));
            // featch data from db
            $row = $stmt->fetch(); 
            // the row count 
            $count = $stmt->rowCount();
            // if there is such id show the form 
            if($count > 0){?>

                <h2 class=" text-center"  >Edit Member</h2>
                <div class ='container'>
                    <form class='form-horizontal ' action = '?$do=Update' method = 'POST'>
                        <input type = 'hidden' value = '<?php echo $userid ?>' name = 'userid'>
                    <!-- Start username filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 " >User Name</label>
                            <div class = "col-sm-10 col-md-4">
                                <input type="text" name="username" class="form-control" value = "<?php echo $row['UserName'] ?>" autocomplete = 'off'>
                            </div>
                        </div>
                    <!-- End username filed-->

                    <!-- Start Password filed-->
                        <div class ='row form-group'>
                            <label class='control-lable col-sm-2' >Password</label>
                            <div class = 'col-sm-10 col-md-4'>
                                <input type="hidden" name='oldPassword' value = "<?php echo $row['Password'] ?>">
                                <input type="password" name='newPassword' class='form-control' autocomplete = 'new-password'>
                            </div>
                        </div>
                    <!-- End Password filed-->
                    <!-- Start email filed-->
                        <div class ='row form-group'>
                            <label class='control-lable col-sm-2' >Email</label>
                            <div class = 'col-sm-10 col-md-4'>
                                <input type="email" name='email' value = "<?php echo $row['Email'] ?>" class='form-control'>
                            </div>
                        </div>
                    <!-- End email filed-->
                    <!-- Start Full Name filed-->
                        <div class ='row form-group '>
                            <label class=' col-sm-2 control-lable' >Full Name</label>
                            <div class = 'col-sm-10 col-md-4'>
                                <input type="text" name='fullname' value = "<?php echo $row['FullName'] ?>" class='form-control'>
                            </div>
                        </div>
                    <!-- End Full Name filed-->
                    <!-- Start save filed-->
                        <div class ='row form-group text-center'>
                            <div class = 'col-sm-offset-2 col-lg-offset-2 col-sm-10'>
                                <input type="submit" value='Save' class='btn btn-primary '>
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

                //echo $username . $userid . $email . $fullname;

                $stmt = $con-> prepare("UPDATE shop.users SET UserName = ? , Email = ? , FullName = ?,Password = ? WHERE UserId = ?");
                $stmt->execute(array($username ,$email ,$fullname ,$pass ,$userid ));
                echo $stmt->rowCount() . "Recored updated";
            }else {
                echo "Sorry you can not access this browser directly";
            }
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
    }