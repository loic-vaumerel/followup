<?php
  declare (strict_types = 1);
  if (!isset ($_SESSION ["NO_DIRECT_ACCESS"])) exit (0);

  class DBManagerRW {
    private $iv_db_manager = null;

    public function __construct () {
      $this->iv_db_manager = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
    }

    // /********
    //  * USER
    //  ********/

    // // Create user

    // public function createUser (string $p_name, string $p_email): int {
    //   $v_sql  = "insert into user (name, email, password, active, admin) ";
    //   $v_sql .= "          values (:param_name, :param_email, :param_password, :param_active, :param_admin)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_name"    , strip_tags ($p_name) , PDO::PARAM_STR));
    //   array_push ($v_parameters, array ("param_email"   , strip_tags ($p_email), PDO::PARAM_STR));
    //   array_push ($v_parameters, array ("param_password", "NOT_INITIALIZED"    , PDO::PARAM_STR));
    //   array_push ($v_parameters, array ("param_active"  , false                , PDO::PARAM_BOOL));
    //   array_push ($v_parameters, array ("param_admin"   , false                , PDO::PARAM_BOOL));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Set name

    // public function setUserName (int $p_id, string $p_name): void {
    //   $v_sql  = "update user set name = :param_name where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }
    
    // // Set email
    
    // public function setUserEmail (int $p_id, string $p_email): void {
    //   $v_sql  = "update user set email = :param_email where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"   , $p_id   , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_email", $p_email, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Set password
  
    // public function setUserPassword (int $p_id, string $p_password): void {
    //   $v_sql  = "update user set password = :param_password where id = :param_id";
    //   $v_password = password_hash ($p_password, PASSWORD_DEFAULT);

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"      , $p_id      , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_password", $v_password, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Activate user

    // public function activateUser (int $p_id): void {
    //   $v_sql  = "update user set active = true where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Disable user

    // public function disableUser (int $p_id): void {
    //   $v_sql  = "update user set active = false where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Promote user to admin

    // public function promoteAdminUser (int $p_id): void {
    //   $v_sql  = "update user set admin = true where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Demote admin user

    // public function demoteAdminUser (int $p_id): void {
    //   $v_sql  = "update user set admin = false where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Delete user

    // public function deleteUser (int $p_id): void {
    //   $v_sql  = "delete from user where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // /**********
    //  * PERSON
    //  **********/

    // // Create person

    // public function createPerson (string $p_name): int {
    //   $v_sql  = "insert into person (name) ";
    //   $v_sql .= "            values (:param_name)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Set name

    // public function setPersonName (int $p_id, string $p_name): void {
    //   $v_sql  = "update person set name = :param_name where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Delete person

    // public function deletePerson (int $p_id): void {
    //   $v_sql  = "delete from person where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // /************
    //  * POSITION
    //  ************/

    // // Create position

    // public function createPosition (string $p_name): int {
    //   $v_sql  = "insert into type_position (name) ";
    //   $v_sql .= "            values (:param_name)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Set name

    // public function setPositionName (int $p_id, string $p_name): void {
    //   $v_sql  = "update type_position set name = :param_name where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Delete position

    // public function deletePosition (int $p_id): void {
    //   $v_sql  = "delete from type_position where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // /************
    //  * ACTION
    //  ************/

    // // Create action

    // public function createAction (string $p_name): int {
    //   $v_sql  = "insert into type_action (name) ";
    //   $v_sql .= "            values (:param_name)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Set giver

    // public function setActionGiver (int $p_id, int $p_giver_id): void {
    //   $v_sql  = "update type_action set giver_id = :param_giver_id where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"      , $p_id      , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_giver_id", $p_giver_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Set name

    // public function setActionName (int $p_id, string $p_name): void {
    //   $v_sql  = "update type_action set name = :param_name where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Set receiver

    // public function setActionReceiver (int $p_id, int $p_receiver_id): void {
    //   $v_sql  = "update type_action set receiver_id = :param_receiver_id where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"         , $p_id         , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_receiver_id", $p_receiver_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }
    
    // // Delete action

    // public function deleteAction (int $p_id): void {
    //   $v_sql  = "delete from type_action where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Assign category to an action

    // public function assignActionCategory (int $p_action_id, int $p_category_id): int {
    //   $v_sql  = "insert into type_action_category (type_action_id, type_category_id) ";
    //   $v_sql .= "            values (:param_action_id, :param_category_id)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_action_id"  , $p_action_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_category_id", $p_category_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Unassign category from an action

    // public function unassignActionCategory (int $p_action_id, int $p_category_id): void {
    //   $v_sql  = "delete from type_action_category";
    //   $v_sql .= " where type_action_id = :param_action_id";
    //   $v_sql .= "   and type_category_id = :param_category_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_action_id"  , $p_action_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_category_id", $p_category_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // /************
    //  * CATEGORY
    //  ************/

    // // Create category

    // public function createCategory (string $p_name): int {
    //   $v_sql  = "insert into type_category (name) ";
    //   $v_sql .= "            values (:param_name)";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_name", strip_tags ($p_name), PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);

    //   return $this->iv_db_manager->getLastInsertedId ();
    // }

    // // Set name

    // public function setCategoryName (int $p_id, string $p_name): void {
    //   $v_sql  = "update type_category set name = :param_name where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id"  , $p_id  , PDO::PARAM_INT));
    //   array_push ($v_parameters, array ("param_name", $p_name, PDO::PARAM_STR));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

    // // Delete category

    // public function deleteCategory (int $p_id): void {
    //   $v_sql  = "delete from type_category where id = :param_id";

    //   $v_parameters = array ();
    //   array_push ($v_parameters, array ("param_id", $p_id, PDO::PARAM_INT));

    //   $this->iv_db_manager->executeQuery ($v_sql, $v_parameters);
    // }

  }
?>