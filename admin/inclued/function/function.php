<?php

// function to determain the page title

function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo 'Defult';
    }
}

/*
** Redirect function [accept parameter]
** first [errors]
** second [number of seconds]
*/

function redirectPage($errorMsg ,$seconds = 3){
    echo "<div class = 'alert alert-danger'> $errorMsg </div>";
    echo "<div class = 'alert alert-info'> You will be redirect to Home Page after $seconds Seconds </div>";
    header("Refresh:$seconds ; url=index.php");
    exit();
}