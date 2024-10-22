<?php
  declare (strict_types = 1);

  require_once ('./model/DBManager.php');
  require_once ("./settings/db.php");

  class DBManagerRO {
    private $iv_db_manager = null;

    public function __construct () {
      $this->iv_db_manager = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RO, DB_PASSWORD_RO, DB_OPTIONS);
    }

    public function readUser (string $p_name): array {
      $v_sql = "SELECT *
                  from user
                 where name = :param_name";
      $v_parameters = array (array ("param_name", $p_name, PDO::PARAM_STR));
      return $this->iv_db_manager->getQueryResult ($v_sql, $v_parameters);
    }

    public function listAllUsers (): array {
      $v_sql = "SELECT *
                  from user";
      $v_parameters = array ();
      return $this->iv_db_manager->getQueryResult ($v_sql, $v_parameters);
    }
  }
?>