<?php  // include init file
    session_start();
    
    $pageTitle = 'LogIn|SignUp';
    if(isset($_SESSION['user'])){
        header('location:index.php');
    }
    include 'init.php'; // include init file


    //check if user come from http request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $hashedPass = sha1($pass);
         
        

        // check if user exist in database
        $stmt = $con->prepare("SELECT  UserName ,Password FROM shops.users WHERE UserName = ? AND Password = ? ");
        $stmt->execute(array($username,$hashedPass));  
        $count = $stmt->rowCount();
        
        // if count > 0 this mean that connect to database correct
        if($count > 0){
            $_SESSION['user'] = $username; // register session name 
            
            header('location:index.php'); // transfer to dashpored page
            exit();
        }
    }
    
?> 
<div class='container login-page'>
    <h2 class='text-center header2'>
        <span class='selected' data-class='login'>LogIn</span> | 
        <span data-class='signup'>SignUp</span></h2>
    <!-- Start login form -->
    <form class='login' action="">
        <div class='input-container'>
            <input class='form-control' type="text" name='username' autocomplete ='off' placeholder='Enter Your User Name' required='required'>
        </div>
        <div class='input-container'>
            <input class='form-control' type="password" name='password' autocomplete ='new-password' placeholder='Enter Your Password'required='required'>
        </div>
        <input class='btn btn-primary btn-block' type="submit" value='LogIn'>
        
    </form>
    <!-- End login form -->
    <!-- Start signup form -->
    <form class='signup' action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
        <input class='form-control' type="text" name='username' autocomplete ='OFF' placeholder='Enter Your User Name'>
        <input class='form-control' type="email" name='email' autocomplete ='off' placeholder='Enter Vailed Email'>
        <input class='form-control' type="password" name='password' autocomplete ='new-password' placeholder='Enter Complex Password'>
        <input class='form-control' type="password" name='password-again' autocomplete ='new-password' placeholder='Enter Password Again'>
        <input class='btn btn-success btn-block' type="submit" value='SignUp'>

    </form>
    <!-- end signup form -->

</div>
<?php include $tpl . 'Footer.php';?>

