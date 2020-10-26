<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php getTitle()?></title>
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."bootstrap.min.css"?>'  >
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."bootstrap.css"?>'>
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."jquery-ui.css"?> '>
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."jquery.selectBoxIt.css"?> '>
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."fontawesome.min.css" ?>'>
        <link rel="stylesheet" type="text/css" href='<?php echo $css ."frontend.css"?> '>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <!--<link rel="stylesheet" href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class='upper-bar'>
            <div class='container'>
                <a href="login.php">
                    <span class="pull-right">LogIn/SignUp</span>
                </a>
            </div>
        </div>
        <nav  class="navbar navbar-inverse navbar-expand-sm bg-dark navbar-dark" >
            <div class="container" >
                <div class="navbar-header" >
                
                <a class="navbar-brand" href="dashpored.php">Home Page</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse ulli" id="app-nav" >
            
            <ul class="nav navbar-nav navbar-right">
                <?php
                    foreach(getCategory() as $cat){
                        echo"<li >
                            <a href='categories.php?pageid=" .$cat['ID'] ."&pagename=" . str_replace(" ","-",$cat["Name"])."'>" 
                            . $cat['Name'].
                            "</a>
                        </li>";
                    }
                ?>
            </ul>
            
            
            
            </div>
        </div>
    </nav>
