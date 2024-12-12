<?php
    function f_safe_require_once ($v_file) {
        $GLOBALS ['SAFE_REQUIRE_ONCE'] = true;
        require_once ($v_file);
        unset ($GLOBALS['SAFE_REQUIRE_ONCE']);
    }
?>