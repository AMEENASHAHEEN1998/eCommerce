<?php
/*
** get All function v1.0 
** function to get All filed  from database 
*/
function getAllFrombig($field ,$table , $where =null , $and = null , $orderField , $ordering= 'DESC'){
    global $con ;
    
    $getAll = $con->prepare("SELECT $field FROM $table $where $and   ORDER BY $orderField $ordering");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}
function getAllFrom($tableName , $tableOrder , $where =null){
    global $con ;
    $sql = $where == null ? '':$where ;
    $getAll = $con->prepare("SELECT * FROM shops.$tableName $sql ORDER BY $tableOrder DESC ");
    $getAll->execute();
    $all = $getAll->fetchAll();
    return $all;
}
/*
** get category function v1.0 
** function to get Category  from database 
*/

function getCategory(){
    global $con ;
    $stmt = $con->prepare("SELECT * FROM shops.categores ORDER BY ID ASC ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}
/*
** get item function v1.0 
** function to get Category  from database 
*/

function getItem($where ,$value , $approve = null){
    global $con ;
    if ($approve == null){
        $sql = 'AND Approve = 1';
    }else{
        $sql= null;
    }
    $getItems = $con->prepare("SELECT * FROM shops.items WHERE $where = ? $sql ORDER BY ID DESC ");
    $getItems->execute(array($value));
    $items = $getItems->fetchAll();
    return $items;
}



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
** checkUserStatus function v1.0 
** function to chexk status  
*/
function checkUserStatus($user){
    global $con;
    $stmtStauts = $con->prepare("SELECT UserName ,RegStatus FROM shops.users WHERE UserName = ? AND RegStatus = 0");
    $stmtStauts->execute(array($user));  
    $satuts = $stmtStauts->rowCount();
    return $satuts;
}
//------------------------------------------------------------------------------------
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

/*
** get latest record function v1.0 
** function to get latest item from database [users ,items ,..]
** $select = filed to select
** $table = table name 
** $limit = number of limit to fetch
*/

function getLatest($select ,$table ,$order ,$limit = 5){
    global $con ;
    $stmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

