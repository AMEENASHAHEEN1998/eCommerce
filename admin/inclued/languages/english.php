<?php

function lang($phrase){

    static $lang = array(
        'AdminArea' => 'Admin Area',
        'Categories'   => 'Categories',
        'userName' =>'Ameena',
        'Items' =>'Items',
        'Members'=>'Members',
        'Statistic'=>'Statistic',
        'Logs'=>'Logs'
    );

    return $lang[$phrase];
}