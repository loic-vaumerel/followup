<?php if (!isset ($_SESSION ["NO_DIRECT_ACCESS"])) exit (0); ?>
<?php
    function f_safe_array_read ($p_array, $p_key) {
        if (!isset ($p_array [$p_key])) {
            // echo ("<div>DEBUG : $p_key 0001</div>");
            return null;
        }
        // echo ("<div>DEBUG : $p_key 0002</div>");
        return $p_array [$p_key];
    }
?>