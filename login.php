<?php include 'init.php'; // include init file ?> 
<div class='container login-page'>
    <h2 class='text-center header2'>
        <span class='selected' data-class='login'>LogIn</span> | 
        <span data-class='signup'>SignUp</span></h2>
    <form class='login' action="">
        <div class='input-container'>
            <input class='form-control' type="text" name='username' autocomplete ='off' placeholder='Enter Your User Name' required='required'>
            <input class='form-control' type="password" name='password' autocomplete ='new-password' placeholder='Enter Your Password'required='required'>
            <input class='btn btn-primary btn-block' type="submit" value='LogIn'>
        </div>
    </form>

    <form class='signup' action="">
        <input class='form-control' type="text" name='username' autocomplete ='OFF' placeholder='Enter Your User Name'>
        <input class='form-control' type="email" name='email' autocomplete ='off' placeholder='Enter Vailed Email'>
        <input class='form-control' type="password" name='password' autocomplete ='new-password' placeholder='Enter Complex Password'>
        <input class='form-control' type="password" name='password-again' autocomplete ='new-password' placeholder='Enter Password Again'>
        <input class='btn btn-success btn-block' type="submit" value='SignUp'>

    </form>
</div>
<?php include $tpl . 'Footer.php';?>

