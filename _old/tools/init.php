<?php
    declare (strict_types = 1);
    if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start ();
?>