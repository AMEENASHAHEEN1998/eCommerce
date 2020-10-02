<?php

function lang($phrase){

    static $lang = array(
        'AdminArea' => 'Admin Area',
        'Categories'   => 'Categories',
        'userName' =>'Ameena',
        'Items' =>'Items',
        'Members'=>'Members',
        'Statistic'=>'Statistic',
        'Logs'=>'Logs',
        'EditProfile'=>'Edit Profile',
        'Settings'=>'Settings',
        'Logout'=>'Logout',
        // member page
        'EditMember'=>'Edit Member',
        'UserName'=>'User Name',
        'Password'=>'Password',
        'Email'=>'Email',
        'FullName'=>'Full Name',
        'Save'=>'Save',
        'AddMember'=>'Add New Member'
    );

    return $lang[$phrase];
}