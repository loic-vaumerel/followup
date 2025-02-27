<?php if (!isset ($_SESSION ["NO_DIRECT_ACCESS"])) exit (0); ?>
<?php
  define ('DB_HOSTNAME'   , '127.0.0.1');
  define ('DB_DBNAME'     , 'followup');
  define ('DB_USERNAME_RO', 'followup_ro');
  define ('DB_PASSWORD_RO', 'password');
  define ('DB_USERNAME_RW', 'followup_rw');
  define ('DB_PASSWORD_RW', 'password');
  define ('DB_OPTIONS'    , [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>