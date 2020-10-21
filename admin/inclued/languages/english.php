<?php

function lang($phrase){

    static $lang = array(
        'AdminArea' => 'Admin Area',
        'Categories'   => 'Categories',
        'userName' =>'Ameena',
        'Items' =>'Items',
        'Members'=>'Members',
        'Comments'=>'Comments',
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
        'AddMember'=>'Add New Member',
        'btnAddMember'=>'Add Member',
        'ManageMembers'=>'Manage Members',
        // ctegories page
        'AddCategories' => 'Add New Categories',
        'Name'=>'Name',
        'Description'=>'Description',
        'Ordering'=>'Ordering',
        'Visible'=>'Visible',
        'Commenting'=>'Allow Comments',
        'Ads'=>'Allow Advertise'
    );

    return $lang[$phrase];
}