<?php  
    ob_start(); // output buffering start
    session_start();
    
    $pageTitle = 'LogIn|SignUp';
    if(isset($_SESSION['user'])){
        header('location:index.php');
    }
    include 'init.php'; // include init file


    //check if user come from http request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $pass = $_POST['password'];
            $hashedPass = sha1($pass);
            
            

            // check if user exist in database
            $stmt = $con->prepare("SELECT UserId , UserName ,Password FROM shops.users WHERE UserName = ? AND Password = ? ");
            $stmt->execute(array($username,$hashedPass)); 
            $get = $stmt->fetch(); 
            $count = $stmt->rowCount();
            
            // if count > 0 this mean that connect to database correct
            if($count > 0){
                $_SESSION['user'] = $username; // register session name 
                $_SESSION['uid'] = $get['UserId'];// register userid in session
                header('location:index.php'); // transfer to dashpored page
                exit();
            }
        }else {
            $formErrors = array();
            if(isset($_POST['username'])){

                $filterUser = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                if(strlen($filterUser) < 4){
                    $formErrors[] = 'User Name Can not Be Less Than 4 Charackter';
                }
            }

            if(isset($_POST['password']) && isset($_POST['password-again'])){
                if(empty($_POST['password'])){
                    $formErrors[] = 'Sorry Password Can Not Be Empty';
                }

                $pass = sha1($_POST['password']);
                $pass_again = sha1($_POST['password-again']);

                if($pass !== $pass_again){
                    $formErrors[] = 'Sorry Password Not Match';
                }
            }

            $formErrors = array();
            if(isset($_POST['email'])){

                $filterEmail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
                if(filter_var($filterEmail ,FILTER_SANITIZE_EMAIL ) != true){
                    $formErrors[] = 'This Email Is Not Valid';
                }
            }
        }
    }
    
?> 
<div class='container login-page'>
    <h2 class='text-center header2'>
        <span class='selected clog' data-class='login'>LogIn </span> | 
        <span data-class='signup' class='csig'> SignUp</span>
    </h2>
    <!-- Start login form -->
    <form class='login' action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
        <div class='input-container'>
            <input class='form-control' type="text" name='username' autocomplete ='off' placeholder='Enter Your User Name' required='required'>
        </div>
        <div class='input-container'>
            <input class='form-control' type="password" name='password' autocomplete ='new-password' placeholder='Enter Your Password'required='required'>
        </div>
        <input class='btn btn-primary btn-block' type="submit" name='login' value='LogIn'>
        
    </form>
    <!-- End login form -->
    <!-- Start signup form -->
    <form class='signup' action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST" >
        <input class='form-control' type="text" name='username' autocomplete ='OFF' pattern = '.{4,}' title='User Name Must Be more than 4 chars' placeholder='Enter Your User Name' required>
        <input class='form-control' type="email" name='email' autocomplete ='off' minlenght = '5' placeholder='Enter Vailed Email' required>
        <input class='form-control' type="password" name='password' autocomplete ='new-password' minlenght = '5' placeholder='Enter Complex Password' required>
        <input class='form-control' type="password" name='password-again' autocomplete ='new-password' placeholder='Enter Password Again' required>
        <input class='btn btn-success btn-block'  type="submit" name ='signup' value='SignUp'>

    </form>
    <!-- end signup form -->

    <div class = 'the-errors text-center'>
        <?php 
            if(!empty($formErrors)){
                foreach($formErrors as $error){
                    echo $error . '</br>';
                }
            }
        ?>
    </div>
</div>
<?php 
    include $tpl . 'Footer.php';
    ob_end_flush();

?>

