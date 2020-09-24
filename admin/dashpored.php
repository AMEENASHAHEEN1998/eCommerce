<?php
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Dashpored';
        include 'init.php';
        echo "welcome";
        print_r($_SESSION);
        
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
    }