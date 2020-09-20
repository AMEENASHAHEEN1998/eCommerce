<?php

function lang($phrase){

    static $lang = array(
        'AdminArea' => 'منطقة الأدمن',
        'Categories'   => 'المواصفات',
        'userName' =>'أمينة'
    );

    return $lang[$phrase];
}