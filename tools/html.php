<?php
    if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0);

    function e (int $p_spaces, string $p_text) {
        echo (str_repeat ("    ", $p_spaces) . $p_text);
    }

    function html_odiv ($p_classes = null, $p_id = null) {
        echo ("<div");
        if (!is_null ($p_classes)) {
            echo (" class=\"$p_classes\"");
        }
        if (!is_null ($p_id)) {
            echo (" id=\"$p_id\"");
        }
        echo (">");
    }

    function html_cdiv () {
        echo ("</div>");
    }

    function html_post_button ($p_text, $p_action) {
        echo ("<form method=\"post\" action=\"$p_action\">" .
                  "<input type=\"submit\" value=\"$p_text\">" .
              "</form>");
    }

    function html_a ($p_text, $p_href) {
        echo ("<a href=\"$p_href\">$p_text</a>");
    }

    function nl () {
        echo ("\n");
    }

    function sp ($p_indent) {
        $v_output = "";
        for ($i = 0 ; $i < $p_indent ; $i ++) {
            $v_output .= "    ";
        }
        echo ($v_output);
    }
?>