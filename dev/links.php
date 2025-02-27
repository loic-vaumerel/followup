<pre>
<?php
function generate_links ($p_path) {
    // echo ("<div>func $p_path</div>");
    foreach (glob ($p_path) as $v_elt) {
        if ($v_elt == "../_old") continue;
        // if ($v_elt == "../dev") continue;
        if (is_dir ($v_elt)) {
            echo ("<div><a href='$v_elt'>$v_elt</a></div>");
            generate_links ($v_elt . "/*");
        }
        // if (str_ends_with ($v_elt, ".html") || str_ends_with ($v_elt, ".php")) echo ("<div><a href='$v_elt'>$v_elt</a></div>");
        if (is_file ($v_elt)) echo ("<div><a href='$v_elt'>$v_elt</a></div>");
    }
}
generate_links ("../*");
// print_r (glob("../*"));
?>
</pre>