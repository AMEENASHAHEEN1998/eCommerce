<?php
    

    // rout
    $tpl        = "inclued/templates/"; // template path
    $css        = "layout/css/"; // css admin path
    $jsAdmin    = "layout/js/"; // js admin path
    $languages  = "inclued/languages/"; // language directory

    // inclued file important
    include  $languages . 'english.php'; // include english language file
    include "connect.php"; // db connect file 
    include  $tpl . 'Header.php'; // include header file 
    if(!isset($noNavbar)){include $tpl . 'navbar.php';}
    