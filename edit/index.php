<?php
    declare (strict_types = 1);

    require_once ('../dev/debug.php');

    require_once ('../tools/init.php');
    require_once ('../tools/f_safe_read_array_item.php');

    require_once ('../settings/db.php');
    require_once ('../model/DBManager.php');
    require_once ("../model/DBManagerRO.php");
    require_once ("../model/DBManagerRW.php");
    $v_dbm_ro = new DBManagerRO ();

    $v_logged_in_name = f_safe_read_array_item ($_SESSION, 'logged_in_username');
    $v_logged_in = !is_null ($v_logged_in_name);

    // Actions - Do

    $v_action = f_safe_read_array_item ($_GET, 'action');
    if ($v_logged_in) {
        switch ($v_action) {
            case 'do_logout':
                unset ($_SESSION ['logged_in_username']);
                unset ($_SESSION ['logged_in_is_admin']);
                $v_logged_in_name = null;
                $v_logged_in = null;
                $v_action = "goto_login";
////                header ('Location:?action=goto_login'); // TO REPLACE
                break;
                // case 'do_create_person':
            //     break;
            // case 'do_update_person':
            //     break;
            // case 'do_delete_person':
            //     break;
            case 'do_create_user':
                $v_name = f_safe_read_array_item ($_POST, 'name');
                $v_email = f_safe_read_array_item ($_POST, 'email');
                $v_active = f_safe_read_array_item ($_POST, 'active');
                $v_admin = f_safe_read_array_item ($_POST, 'admin');

                $v_dbm_rw = new DBManagerRW ();
                $v_id = $v_dbm_rw->createUser ($v_name, $v_email);
                if ($v_active) {
                    $v_dbm_rw->activateUser ($v_id);
                }
                if ($v_admin) {
                    $v_dbm_rw->promoteAdminUser ($v_id);
                }

                unset ($v_dbm_rw);
                unset ($v_name);
                unset ($v_email);
                unset ($v_active);
                unset ($v_admin);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_change_user_name':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_new_value = f_safe_read_array_item ($_POST, 'new_value');

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->setUserName ($v_id, $v_new_value);

                unset ($v_dbm_rw);
                unset ($v_id);
                unset ($v_new_value);

                $v_action = "goto_users";
                break;    
            case 'do_change_user_email':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_new_value = f_safe_read_array_item ($_POST, 'new_value');

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->setUserEmail ($v_id, $v_new_value);

                unset ($v_dbm_rw);
                unset ($v_id);
                unset ($v_new_value);

                $v_action = "goto_users";
                break;    
            case 'do_change_user_password':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_new_value = f_safe_read_array_item ($_POST, 'new_value');

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->setUserPassword ($v_id, $v_new_value);

                unset ($v_dbm_rw);
                unset ($v_id);
                unset ($v_new_value);

                $v_action = "goto_users";
                break;    
            case 'do_activate_user':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->activateUser ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_disable_user':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->disableUser ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_promote_admin':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->promoteAdminUser ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_demote_admin':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->demoteAdminUser ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_delete_user':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->deleteUser ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_users";
                break;
            case 'do_create_person':
                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->createPerson ($v_name);

                unset ($v_dbm_rw);
                unset ($v_name);

                $v_action = "goto_persons";
                break;
            case 'do_change_person_name':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_new_value = f_safe_read_array_item ($_POST, 'new_value');

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->setPersonName ($v_id, $v_new_value);

                unset ($v_dbm_rw);
                unset ($v_id);
                unset ($v_new_value);

                $v_action = "goto_persons";
                break;        
            case 'do_delete_person':
                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw = new DBManagerRW ();
                $v_dbm_rw->deletePerson ($v_id);

                unset ($v_dbm_rw);
                unset ($v_id);

                $v_action = "goto_persons";
                break;
        }
        if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {
            $v_action = "goto_main";
            ////            header ('Location:?action=goto_main'); // TO REPLACE
            // $v_action = 'goto_main';
        }
        if (is_null ($v_action) || !str_starts_with ($v_action, "goto_")) {
            $v_action ="goto_main";
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
                    $v_action = "goto_main";
////                    header ('Location:?action=goto_main'); // TO REPLACE
                    // echo ('OK');
                } else {
                    unset ($_SESSION ['logged_in_username']);
                    unset ($_SESSION ['logged_in_is_admin']);
                    $v_action = "goto_login";
                    // echo ('KO');
                }
                break;
        }
        // header ('Location:?action=goto_login');
        // if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {
        //     $v_action = 'goto_login';
        // }
        if (is_null ($v_action) || !str_starts_with ($v_action, "goto_")) {
            $v_action ="goto_login";
        }
    }

    dbg ($v_action);

    switch ($v_action) {
        case 'goto_login':
            require ('view/login.php');
            break;
        case 'goto_settings':
            require ('view/settings.php');
            break;
        case 'goto_users':
            require ('view/users.php');
            break;
        case 'goto_create_user':
            require ('view/create_user.php');
            break;
        case 'goto_persons':
            require ('view/persons.php');
            break;
        case 'goto_create_person':
            require ('view/create_person.php');
            break;
                        // case 'goto_main':
        //     require ('view/main.php');
        //     break;
        default:
            require ('view/main.php');
            break;
                // case 'goto_2':
            //     break;
            // case 'goto_3':
            //     break;
    }

    // Actions - Go To

// dbg ("0001");
//     if ($v_logged_in) {
// dbg ("0002");
//         require ('view/main.php');
// dbg ("0003");
//         // if (is_null ($v_action) || !str_starts_with ($v_action, 'goto_')) {

//         // switch ($v_action) {
//         //     case 'goto_main':
//         //     default
//         //         break;
//         //     // case 'goto_2':
//         //     //     break;
//         //     // case 'goto_3':
//         //     //     break;
//         // }
//     } else {
// dbg ("0004");
//         require ('view/login.php');
// dbg ("0005");
//     }


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

    echo ('<div style="margin-top:10em;"/>');
    display_dbg ();
    require_once ('../dev/dev_links.html');
    require_once ('../dev/display_session.php');
?>