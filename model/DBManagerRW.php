<?php
  declare (strict_types = 1);

  require_once ('./model/DBManager.php');

  class DBManagerRW {
    private $iv_db_manager = null;

    public function __construct () {
      $this->iv_db_manager = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
    }

    public function createUser (string $p_name, string $p_email): void {
      $v_sql  = "insert into user (name, email, password, active) ";
      $v_sql .= "          values (:param_name, :param_email, :param_password, :param_active)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name"    , $p_name          , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_email"   , $p_email         , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_password", "NOT_INITIALIZED", PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_active"  , false            , PDO::PARAM_BOOL));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function activateUser (int $p_id): void {
      $v_sql  = "update user set active = true where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function deactivateUser (int $p_id): void {
      $v_sql  = "update user set active = false where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function deleteUser (int $p_id): void {
      $v_sql  = "delete from user where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }
  }
?>