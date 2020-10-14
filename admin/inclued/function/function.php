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
** Redirect function v2.0
** Redirect function [accept parameter]
** first [the message]
** second [url]
** thired [number of seconds]
*/

function redirectPage($Msg ,$url = null,$seconds = 3){
    if($url === null){
        $url = "index.php";
        $link = "Home Page";
    }else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ){
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'previes Page';
        }else{
            $url = "index.php";
            $link = "Home Page";
        }
    }
    echo  $Msg ;
    echo "<div class = 'alert alert-info'> You will be redirect to $link after $seconds Seconds </div>";
    header("Refresh:$seconds ; url=$url");
    exit();
}

/*
** Check item function v1.0
** function to chesk item in data base [accept parameter]
** $select = item to select [user ,item ,category]
** $from   = the table to select from [user ,item ,category]
** $value  = the value of select [osama , box ,electronics]
*/

function checkItem($select,$from,$value){
    global $con;
    $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statment->execute(array($value));
    $count = $statment->rowCount();
    return $count;

}

/*
** check number of item function version v1.0
** function to count number of item row
** $item = The item to count
** $table = The table to choose from
*/

function countItem($item ,$table){
    global $con;
    $stmt = $con->prepare("SELECT count($item) FROM $table");
    $stmt->execute();
    return $stmt->fetchColumn();
}