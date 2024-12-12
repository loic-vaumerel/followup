<?php
    declare (strict_types = 1);

    require_once ('../tools/f_safe_require_once.php');

    f_safe_require_once ('../dev/debug.php');

    f_safe_require_once ('../tools/init.php');
    f_safe_require_once ('../tools/f_safe_read_array_item.php');
    f_safe_require_once ('../tools/html.php');
    f_safe_require_once ('../tools/generate_toolbar.php');

    f_safe_require_once ('../settings/db.php');
    f_safe_require_once ('../model/DBManager.php');
    f_safe_require_once ("../model/DBManagerRO.php");
    f_safe_require_once ("../model/DBManagerRW.php");
    $_SESSION ['dbm_ro'] = new DBManagerRO ();


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

                header ('Location:?action=goto_login');
                break;
            case 'do_user_create':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "User creation failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_users');
                }

                $v_name = f_safe_read_array_item ($_POST, 'name');
                $v_email = f_safe_read_array_item ($_POST, 'email');
                $v_active = f_safe_read_array_item ($_POST, 'active');
                $v_admin = f_safe_read_array_item ($_POST, 'admin');
                $v_password = f_safe_read_array_item ($_POST, 'password');

                $v_id = $v_dbm_rw->createUser ($v_name, $v_email);
                if ($v_active) {
                    $v_dbm_rw->activateUser ($v_id);
                }
                if ($v_admin) {
                    $v_dbm_rw->promoteAdminUser ($v_id);
                }
                if (!is_null ($v_password) && $v_password != "") {
                    $v_dbm_rw->setUserPassword ($v_id, $v_password);
                }

                unset ($v_name);
                unset ($v_email);
                unset ($v_active);
                unset ($v_admin);
                unset ($v_password);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_users');
                break;
            case 'do_user_edit':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "User update failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_users');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_name = f_safe_read_array_item ($_POST, 'name');
                $v_email = f_safe_read_array_item ($_POST, 'email');
                $v_active = f_safe_read_array_item ($_POST, 'active');
                $v_admin = f_safe_read_array_item ($_POST, 'admin');

                $v_dbm_rw->setUserName ($v_id, $v_name);
                $v_dbm_rw->setUserEmail ($v_id, $v_email);
                if ($v_active) {
                    $v_dbm_rw->activateUser ($v_id);
                } else {
                    $v_dbm_rw->disableUser ($v_id);
                }
                if ($v_admin) {
                    $v_dbm_rw->promoteAdminUser ($v_id);
                } else {
                    $v_dbm_rw->demoteAdminUser ($v_id);
                }

                unset ($v_name);
                unset ($v_email);
                unset ($v_active);
                unset ($v_admin);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_users');
                break;
            case 'do_user_update_password':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "User password change failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_users');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_password = f_safe_read_array_item ($_POST, 'password');

                if (!is_null ($v_password) && $v_password != "") {
                    $v_dbm_rw->setUserPassword ($v_id, $v_password);
                }

                unset ($v_password);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_users');
                break;
            case 'do_user_delete':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "User deletion failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_users');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw->deleteUser ($v_id);

                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_users');
                break;
            case 'do_person_create':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Person creation failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_persons');
                }

                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_id = $v_dbm_rw->createPerson ($v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_persons');
                break;
            case 'do_person_edit':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Person update failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_persons');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_dbm_rw->setPersonName ($v_id, $v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_persons');
                break;
            case 'do_person_delete':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Person deletion failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_persons');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw->deletePerson ($v_id);

                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_persons');
                break;
            case 'do_position_create':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Position creation failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_positions');
                }

                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_id = $v_dbm_rw->createPosition ($v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_positions');
                break;
            case 'do_position_edit':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Position update failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_positions');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_dbm_rw->setPositionName ($v_id, $v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_positions');
                break;
            case 'do_position_delete':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Position deletion failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_positions');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw->deletePosition ($v_id);

                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_positions');
                break;
            case 'do_category_create':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Category creation failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_categories');
                }

                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_id = $v_dbm_rw->createCategory ($v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_categories');
                break;
            case 'do_category_edit':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Category update failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_categories');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));
                $v_name = f_safe_read_array_item ($_POST, 'name');

                $v_dbm_rw->setCategoryName ($v_id, $v_name);

                unset ($v_name);
                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_categories');
                break;
            case 'do_category_delete':
                if ($_SESSION ['logged_in_is_admin'] == 1) {
                    $v_dbm_rw = new DBManagerRW ();
                } else {
                    array_push ($_SESSION ['error_messages'], "Category deletion failed ! " . $_SESSION ['logged_in_username'] . " is not admin !");
                    header ('Location:?action=goto_categories');
                }

                $v_id = intval (f_safe_read_array_item ($_POST, 'id'));

                $v_dbm_rw->deleteCategory ($v_id);

                unset ($v_id);
                unset ($v_dbm_rw);

                header ('Location:?action=goto_categories');
                break;
        }
    } else { // not loggued in
        switch ($v_action) {
            case 'do_login':
                $v_post_username = f_safe_read_array_item ($_POST, 'username');
                $v_post_password = f_safe_read_array_item ($_POST, 'password');
                $v_db_user = $_SESSION ['dbm_ro']->readUserByName ($v_post_username);
                $v_db_user_password = null;
                if (isset ($v_db_user [0])) {
                    $v_db_user_password = $v_db_user [0]['password'];
                    $v_db_user_admin = $v_db_user [0]['admin'];
                }
                if (!is_null ($v_post_password ) && !is_null ($v_db_user_password) && password_verify ($v_post_password, $v_db_user_password)) {
                    $_SESSION ['logged_in_username'] = $v_post_username;
                    $_SESSION ['logged_in_is_admin'] = $v_db_user_admin;
                    $_SESSION ['error_messages'] = array ();

                    header ('Location:?action=goto_main');
                } else {
                    unset ($_SESSION ['logged_in_username']);
                    unset ($_SESSION ['logged_in_is_admin']);

                    header ('Location:?action=goto_login');
                }
                break;
        }
    }

    if (!$v_logged_in) {
        $v_action = "goto_login";
    } else {
        echo ("<div>Connected as " . $_SESSION ["logged_in_username"]);
        if ($_SESSION ['logged_in_is_admin'] == 1) {
            echo (" (Admin)");
        }
        echo ("</div>");nl ();
        foreach ($_SESSION ['error_messages'] as $v_error_message) {
            echo ("<div class=\"error_message\">$v_error_message</div>"); nl ();
        }
        $_SESSION ['error_messages'] = array ();
    }
    switch ($v_action) {
        case 'goto_login':
            f_safe_require_once ('view/login.php');
            break;
        case 'goto_settings':
            f_safe_require_once ('view/settings.php');
            break;
        case 'goto_users':
            f_safe_require_once ('view/users.php');
            break;
        case 'goto_user_create':
            f_safe_require_once ('view/user_create_edit.php');
            break;
        case 'goto_user_edit':
            f_safe_require_once ('view/user_create_edit.php');
            break;
        case 'goto_user_update_password':
            f_safe_require_once ('view/user_update_password.php');
            break;
        case 'goto_user_delete':
            f_safe_require_once ('view/user_delete.php');
            break;
        case 'goto_persons':
            f_safe_require_once ('view/persons.php');
            break;
        case 'goto_person_create':
            f_safe_require_once ('view/person_create_edit.php');
            break;
        case 'goto_person_edit':
            f_safe_require_once ('view/person_create_edit.php');
            break;
        case 'goto_person_delete':
            f_safe_require_once ('view/person_delete.php');
            break;
        case 'goto_positions':
            f_safe_require_once ('view/positions.php');
            break;
        case 'goto_position_create':
            f_safe_require_once ('view/position_create_edit.php');
            break;
        case 'goto_position_edit':
            f_safe_require_once ('view/position_create_edit.php');
            break;
        case 'goto_position_delete':
            f_safe_require_once ('view/position_delete.php');
            break;
        case 'goto_categories':
            f_safe_require_once ('view/categories.php');
            break;
        case 'goto_category_create':
            f_safe_require_once ('view/category_create_edit.php');
            break;
        case 'goto_category_edit':
            f_safe_require_once ('view/category_create_edit.php');
            break;
        case 'goto_category_delete':
            f_safe_require_once ('view/category_delete.php');
            break;
        default:
            f_safe_require_once ('view/main.php');
            break;
    }

    echo ('<div style="margin-top:10em;"/>');
    display_dbg ();
    require_once ('../dev/dev_links.html');
    require_once ('../dev/display_session.php');
?>