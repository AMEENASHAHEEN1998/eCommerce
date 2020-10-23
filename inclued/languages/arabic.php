<?php

function lang($phrase){

    static $lang = array(
        'AdminArea' => 'منطقة الأدمن',
        'Categories'   => 'المواصفات',
        'userName' =>'أمينة',
        'Items' =>'العناصر',
        'Members'=>'الأعظاء',
        'Statistic'=>'الأحصائيات',
        'Logs'=>'السجلات',
        'EditProfile'=>'تحديث الملف الشخصي',
        'Settings'=>'الاعدادات',
        'Logout'=>'خروج',
        // member page
        'EditMember'=>'تحديث البيانات',
        'UserName'=>'اسم المستخدم',
        'Password'=>'كلمة السر',
        'Email'=>'الايميل',
        'FullName'=>'الاسم بالكامل',
        'Save'=>'حفظ'
    );

    return $lang[$phrase];
}