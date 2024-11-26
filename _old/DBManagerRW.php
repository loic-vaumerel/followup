<?php
  declare (strict_types = 1);

  class DBManagerRW {
    private $iv_db_manager = null;

    public function __construct () {
      $this->iv_db_manager = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
    }

    // Create user

    public function createUser (string $p_name, string $p_email): void {
      $v_sql  = "insert into user (name, email, password, active, admin) ";
      $v_sql .= "          values (:param_name, :param_email, :param_password, :param_active, :param_admin)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name"    , strip_tags ($p_name) , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_email"   , strip_tags ($p_email), PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_password", "NOT_INITIALIZED"    , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_active"  , false                , PDO::PARAM_BOOL));
      array_push ($v_parameters, array ("param_admin"   , false                , PDO::PARAM_BOOL));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set name

    public function setUserNameById (int $p_id, string $p_name): void {
      $v_sql  = "update user set name = :param_name where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }
    
    // Set email
  
    public function setUserEmailById (int $p_id, string $p_email): void {
      $v_sql  = "update user set email = :param_email where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"   , $p_id   , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_email", $p_email, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function setUserEmailByName (string $p_name, string $p_email): void {
      $v_sql  = "update user set email = :param_email where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name" , strip_tags ($p_name), PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_email", $p_email            , PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set password
  
    public function setUserPasswordById (int $p_id, string $p_password): void {
      $v_sql  = "update user set password = :param_password where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"      , $p_id      , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_password", $p_password, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function setUserPasswordByName (string $p_name, string $p_password): void {
      $v_sql  = "update user set password = :param_password where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name"    , strip_tags ($p_name), PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_password", $p_password         , PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Activate user

    public function activateUserById (int $p_id): void {
      $v_sql  = "update user set active = true where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function activateUserByName (string $p_name): void {
      $v_sql  = "update user set active = true where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Deactivate user

    public function deactivateUserById (int $p_id): void {
      $v_sql  = "update user set active = false where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function deactivateUserByName (string $p_name): void {
      $v_sql  = "update user set active = false where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Promote user to admin

    public function promoteAdminUserById (int $p_id): void {
      $v_sql  = "update user set admin = true where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function promoteAdminUserByName (string $p_name): void {
      $v_sql  = "update user set admin = true where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Demote admin user

    public function demoteAdminUserById (int $p_id): void {
      $v_sql  = "update user set admin = false where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function demoteAdminUserByName (string $p_name): void {
      $v_sql  = "update user set admin = false where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Delete user

    public function deleteUserById (int $p_id): void {
      $v_sql  = "delete from user where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    public function deleteUserByName (string $p_name): void {
      $v_sql  = "delete from user where name = :param_name";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }
  }
?>