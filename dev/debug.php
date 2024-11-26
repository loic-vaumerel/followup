<?php
  declare (strict_types = 1);

  function print_array (array $p_array): void {
    echo ("<pre>");
    print_r ($p_array);
    echo ("</pre>");
  }

  $GLOBALS ["debug_messages"] = array ();

  function dbg ($p_text) {
    array_push ($GLOBALS ["debug_messages"], date('Y-m-d H:i:s.') . gettimeofday()['usec'] . " -- " . $p_text);
  }

  function display_dbg () {
    echo ("<hr style='color:red;'><hr style='color:red;'>Debug<hr style='color:red;'>");
    print_array ($GLOBALS ["debug_messages"]);
    echo ("<hr style='color:red;'><hr style='color:red;'>");
  }
?>