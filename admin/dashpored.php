<?php
    session_start();
    if(isset($_SESSION['UserName'])){
        include 'init.php';
        echo "welcome";
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
    }