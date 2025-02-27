<?php
    session_start();

    $_SESSION ["NO_DIRECT_ACCESS"] = "ok";
    require ("./tools/init.php");
    require ("./tools/ensure_user_is_logged_in.php");
    unset ($_SESSION ["NO_DIRECT_ACCESS"]);
?>

<a href="logout.php">Logout</a>
<a href="settings">Settings</a>

<?php
?>

<?php require ("../dev/display_globals.php"); ?>