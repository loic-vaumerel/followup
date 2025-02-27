<?php
$v_password="password";
echo ("<div>$v_password -- PASSWORD_DEFAULT</div>");
echo password_hash($v_password, PASSWORD_DEFAULT);
?>