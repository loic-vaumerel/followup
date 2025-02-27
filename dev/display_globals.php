<hr>
<h1><?php echo ($_SERVER ["PHP_SELF"]); ?></h1>
<pre>
<?php
    $dummy = $_SERVER;
    unset ($dummy);
    print_r($GLOBALS); ?>
</pre>
