<?php
  declare (strict_types = 1);

  function print_array (array $p_array): void {
    echo ("<pre>");
    print_r ($p_array);
    echo ("</pre>");
  }
?>