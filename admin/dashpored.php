<?php
    session_start();
    if(isset($_SESSION['UserName'])){
        echo 'welcome ' . $_SESSION['UserName'];
    }else{
        header('location:index.php');
    }