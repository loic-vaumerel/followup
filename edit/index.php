<?php
    declare (strict_types = 1);

    require_once ('../tools/init.php');
    require_once ('../tools/f_safe_read_array_item.php');

    require_once ('../settings/db.php');
    require_once ('../model/DBManager.php');
    require_once ("../model/DBManagerRO.php");
    $v_dbm_ro = new DBManagerRO ();

    $v_logged_in_name = f_safe_read_array_item ($_SESSION, 'logged_in_username');
    $v_logged_in = !is_null ($v_logged_in_name);

    // Actions - Do

    $v_action = f_safe_read_array_item ($_GET, 'action');
    if ($v_logged_in) {
        switch ($v_action) {
            case 'do_logout':
                unset ($_SESSION ['logged_in_username']);
                header ('Location:?action=goto_login'); // TO REPLACE
                break;
            // case 'do_create_person':
            //     break;
            // case 'do_update_person':
            //     break;
            // case 'do_delete_person':
            //     break;
        }
        if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {
            header ('Location:?action=goto_main'); // TO REPLACE
            // $v_action = 'goto_main';
        }
    } else {
        switch ($v_action) {
            case 'do_login':
                $v_post_username = f_safe_read_array_item ($_POST, 'username');
                $v_post_password = f_safe_read_array_item ($_POST, 'password');
                $v_db_user = $v_dbm_ro->readUserByName ($v_post_username);
                $v_db_user_password = null;
                if (isset ($v_db_user [0])) {
                    $v_db_user_password = $v_db_user [0]['password'];
                    $v_db_user_admin = $v_db_user [0]['admin'];
                }
                if (!is_null ($v_post_password ) && !is_null ($v_db_user_password) && password_verify ($v_post_password, $v_db_user_password)) {
                    $_SESSION ['logged_in_username'] = $v_post_username;
                    $_SESSION ['logged_in_is_admin'] = $v_db_user_admin;
                    header ('Location:?action=goto_main'); // TO REPLACE
                    // echo ('OK');
                } else {
                    unset ($_SESSION ['logged_in_username']);
                    // echo ('KO');
                }
                break;
        }
        // header ('Location:?action=goto_login');
        // if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {
        //     $v_action = 'goto_login';
        // }
    }

    // Actions - Go To

    if ($v_logged_in) {
        require ('view/main.php');
        // if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {

        // switch ($v_action) {
        //     case 'goto_main':
        //     default
        //         break;
        //     // case 'goto_2':
        //     //     break;
        //     // case 'goto_3':
        //     //     break;
        // }
    } else {
        require ('view/login.php');
    }


    // require_once ('../tools/debug.php');
    // require_once ('../settings/db.php');
    // require_once ('../model/DBManager.php');
    // require_once ("../model/DBManagerRO.php");
    // require_once ("../model/DBManagerRW.php");
    // $v_dbm_ro = new DBManagerRO ();
    // $v_admin_user = $v_dbm_ro->readUserByName ('admin');
    // print_array ($v_admin_user);
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

    require_once ('../tools/dev_links.html');
    require_once ('../tools/display_session.php');
?>