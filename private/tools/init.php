<?php
    declare (strict_types = 1);

    if (!isset ($_SESSION ["NO_DIRECT_ACCESS"])) exit (0);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once ("f_safe_array_read.php");
?>