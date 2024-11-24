<?php
    function f_safe_read_array_item (array $p_array, string $p_item_name) {
        if (!isset ($p_array [$p_item_name])) {
            return null;
        }
        return $p_array [$p_item_name];
    }
?>