<?php
  declare (strict_types = 1);
  if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0);

  class DBManagerRW {
    private $iv_db_manager = null;

    public function __construct () {
      $this->iv_db_manager = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
    }

    /********
     * USER
     ********/

    // Create user

    public function createUser (string $p_name, string $p_email): int {
      $v_sql  = "insert into user (name, email, password, active, admin) ";
      $v_sql .= "          values (:param_name, :param_email, :param_password, :param_active, :param_admin)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name"    , strip_tags ($p_name) , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_email"   , strip_tags ($p_email), PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_password", "NOT_INITIALIZED"    , PDO::PARAM_STR));
      array_push ($v_parameters, array ("param_active"  , false                , PDO::PARAM_BOOL));
      array_push ($v_parameters, array ("param_admin"   , false                , PDO::PARAM_BOOL));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

      return $this->iv_db_manager->getLastInsertedId ();
    }

    // Set name

    public function setUserName (int $p_id, string $p_name): void {
      $v_sql  = "update user set name = :param_name where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }
    
    // Set email
    
    public function setUserEmail (int $p_id, string $p_email): void {
      $v_sql  = "update user set email = :param_email where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"   , $p_id   , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_email", $p_email, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set password
  
    public function setUserPassword (int $p_id, string $p_password): void {
      $v_sql  = "update user set password = :param_password where id = :param_id";
      $v_password = password_hash ($p_password, PASSWORD_DEFAULT);

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"      , $p_id      , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_password", $v_password, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Activate user

    public function activateUser (int $p_id): void {
      $v_sql  = "update user set active = true where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Disable user

    public function disableUser (int $p_id): void {
      $v_sql  = "update user set active = false where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Promote user to admin

    public function promoteAdminUser (int $p_id): void {
      $v_sql  = "update user set admin = true where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Demote admin user

    public function demoteAdminUser (int $p_id): void {
      $v_sql  = "update user set admin = false where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Delete user

    public function deleteUser (int $p_id): void {
      $v_sql  = "delete from user where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    /**********
     * PERSON
     **********/

    // Create person

    public function createPerson (string $p_name): void {
      $v_sql  = "insert into person (name) ";
      $v_sql .= "            values (:param_name)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set name

    public function setPersonName (int $p_id, string $p_name): void {
      $v_sql  = "update person set name = :param_name where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Delete person

    public function deletePerson (int $p_id): void {
      $v_sql  = "delete from person where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    /************
     * POSITION
     ************/

    // Create position

    public function createPosition (string $p_name): void {
      $v_sql  = "insert into type_position (name) ";
      $v_sql .= "            values (:param_name)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set name

    public function setPositionName (int $p_id, string $p_name): void {
      $v_sql  = "update type_position set name = :param_name where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Delete position

    public function deletePosition (int $p_id): void {
      $v_sql  = "delete from type_position where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    /************
     * CATEGORY
     ************/

    // Create category

    public function createCategory (string $p_name): void {
      $v_sql  = "insert into type_category (name) ";
      $v_sql .= "            values (:param_name)";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Set name

    public function setCategoryName (int $p_id, string $p_name): void {
      $v_sql  = "update type_category set name = :param_name where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
      array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

    // Delete category

    public function deleteCategory (int $p_id): void {
      $v_sql  = "delete from type_category where id = :param_id";

      $v_parameters = array ();
      array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

      $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    }

  }
?>