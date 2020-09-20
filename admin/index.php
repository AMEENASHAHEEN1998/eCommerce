<?php
    session_start();
    $noNavbar ='';
    if(isset($_SESSION['UserName'])){
        header('location:dashpored.php');
    }
    include 'init.php'; // include init file
    

    //check if user come from http request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);
        

        // check if user exist in database
        $stmt = $con->prepare("SELECT UserName,Password FROM shop.users WHERE UserName = ? AND Password = ? AND GroupId = 1");
        $stmt->execute(array($username,$hashedPass));
        $count = $stmt->rowCount();
        
        // if count > 0 this mean that connect to database correct
        if($count > 0){
            $_SESSION['UserName'] = $username;
            header('location:dashpored.php');
            exit();
        }
    }
?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
    <h4 class="text-center">User Login</h4>
    <input class="form-control" type = "text" name ="user" placeholder = "User Name" autocomplate="off"/>
    <input class="form-control" type = "password" name ="password" placeholder = "User Password" autocomplate="new-password"/>
    <input class="btn btn-primary btn-block" type = "submit" value = "Login"/>

</form>

<?php
    include $tpl . 'Footer.php';
    ?>