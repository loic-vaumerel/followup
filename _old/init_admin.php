<?php
    declare (strict_types = 1);

    require_once ('../tools/init.php');

    require_once ('../settings/db.php');
    require_once ('../model/DBManager.php');
    require_once ("../model/DBManagerRO.php");
    require_once ("../model/DBManagerRW.php");

    $v_dbm_ro = new DBManagerRO ();
    $v_dbm_rw = new DBManagerRW ();
    $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    // echo ('<pre>');print_r ($v_admin_user);echo ('</pre>');
    if (count ($v_admin_user) === 0) {
        echo ('<div>Admin user creation ...</div>');
        $v_dbm_rw->createUser ('admin', '');
        echo ('<div>Admin user created</div>');
    }
    $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    if (count ($v_admin_user) === 0) {
        die ('<div>Admin user not found</div>');
    }
    if ($v_admin_user [0]['admin'] !== 1) {
        echo ('<div>Admin user promotion ...</div>');
        $v_dbm_rw->promoteAdminUserByName ('admin');
        echo ('<div>Admin user promoted</div>');
    }
    $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    if ($v_admin_user [0]['admin'] !== 1) {
        die ('<div>Admin user not promoted</div>');
    }
    if ($v_admin_user [0]['active'] !== 1) {
        echo ('<div>Admin user activation ...</div>');
        $v_dbm_rw->activateUserByName ('admin');
        echo ('<div>Admin user activated</div>');
    }
    $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    if ($v_admin_user [0]['active'] !== 1) {
        die ('<div>Admin user not activated</div>');
    }
    if ($v_admin_user [0]['password'] === 'NOT_INITIALIZED') {
        echo ('<div>Admin user password change ...</div>');
        $v_dbm_rw->setUserPasswordByName ('admin', password_hash ('password', PASSWORD_DEFAULT));
        echo ('<div>Admin user password changed to the default value</div>');
    }
    $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    if ($v_admin_user [0]['password'] === 'NOT_INITIALIZED') {
        die ('<div>Admin user password not initialized</div>');
    }
    echo ('<div>Admin user OK</div>');
    // echo ('<pre>');print_r ($v_admin_user);echo ('</pre>');
    // echo (count ($v_admin_user));
    // $v_dbm_rw = new DBManagerRW ();
    // $v_dbm_rw->createUser ('admin', '');
    // $v_dbm_ro = new DBManagerRO ();
    // $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    // print_array ($v_admin_user);
    // // print_array ($v_dbm_ro->readUserByName ('admin'));
    // // echo ('--' . f_safe_read_array_item ($v_dbm_ro->readUserByName ('admin')[0], 'password') . '-- ');
    // // if (is_null (f_safe_read_array_item ($_SESSION, 'logged_username'))) {

    // if (is_null (f_safe_read_array_item ($_SESSION, 'logged_username'))) {
    //     require ('view/login.html');
    // } else {
    //     echo ('logged in');
    // }

    // require_once ('../tools/display_session.php');
?>