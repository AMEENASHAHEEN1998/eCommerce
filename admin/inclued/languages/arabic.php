<?php

function lang($phrase){

    static $lang = array(
        'Message' => 'مرحبا',
        'Admin'   => 'أدمن'
    );

    return $lang[$phrase];
}