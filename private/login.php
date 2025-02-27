<?php
    session_start();

    $_SESSION ["NO_DIRECT_ACCESS"] = "ok";
    require ("./tools/init.php");
    // require ("./model/DBManagerRO.php");
    require ("settings/db.php");
    require ("../model/DBManager.php");
    require ("../model/DBManagerRO.php");
    unset ($_SESSION ["NO_DIRECT_ACCESS"]);
?>

<?php
    if (f_safe_array_read ($_SESSION, "logged_in") == "true") {
        header ("Location:index.php");
    } else {
        $v_post_username = f_safe_array_read ($_POST, "username");
        $v_post_password = f_safe_array_read ($_POST, "password");
        $v_dbm_ro = new DBManagerRO ();
        if (is_null ($v_post_username)) {
            unset ($_SESSION ["logged_in"]);
        } else {
            $v_db_user = f_safe_array_read ($v_dbm_ro->readUserByName ($v_post_username), 0);
            if (!is_null ($v_db_user) && password_verify ($v_post_password, f_safe_array_read ($v_db_user, "password"))) {
                $_SESSION ["logged_in"] = "true";
                header ("Location:index.php");
            } else {
                unset ($_SESSION ["logged_in"]);
            }
        }
        // echo ("<pre>"); print_r($v_dbm_ro->readUserByName ("admin")[0]); echo ("</pre>");
        // echo "<div>$v_post_username</div>";
        // echo "<div>$v_post_password</div>";
        // echo ("<pre>"); print_r(f_safe_array_read ($v_dbm_ro->readUserByName ("username"), 0)); echo ("</pre>");
        // echo ("<pre>"); print_r(f_safe_array_read ($v_dbm_ro->readUserByName ("ksdhds"), 0)); echo ("</pre>");
    }
    
    // elseif (f_safe_array_read ($_POST, "username") == "username" && f_safe_array_read ($_POST, "password") == "password") {
    //     $_SESSION ["logged_in"] = "true";
    //     header ("Location:index.php");
    // } else {
    //     unset ($_SESSION ["logged_in"]);
    // }
?>

<form method="post" action="">
    <input type="text" name="username" value="username" autofocus>
    <input type="password" name="password" value="password">
    <input type="submit" value="Login">
</form>

<?php require ("../dev/display_globals.php"); ?>