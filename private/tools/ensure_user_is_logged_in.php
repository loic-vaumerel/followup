<?php if (!isset ($_SESSION ["NO_DIRECT_ACCESS"])) exit (0); ?>
<?php
    if (!f_safe_array_read ($_SESSION, "logged_in")) {
        header ("Location:login.php");
    }
?>