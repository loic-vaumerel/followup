<?php
  declare (strict_types = 1);

  use PHPUnit\Framework\TestCase;

  require_once ("./model/DBManager.php");
  require_once ("./phpunit/settings/db.php");

  class DBTestCase extends TestCase {
    protected static $cv_dbm_ro = null;
    protected static $cv_dbm_rw = null;
    protected static $cv_db_root_connection = null;

    protected function drop_table (string $p_table_name) {
      $v_connection = self::getDBRootConnection ();
      $v_sql = "drop table if exists " . $p_table_name;
      $v_connection->exec ($v_sql);
    }

    protected function create_fill_table (string $p_table_name, string $p_columns, array $p_data) {
      $v_connection = self::getDBRootConnection ();
      $this->drop_table ($p_table_name);
      $v_sql = "create table if not exists " . $p_table_name . "(" . $p_columns . ")";
      $v_connection->exec ($v_sql);
      foreach ($p_data as $line) {
        $v_sql = "insert into " . $p_table_name . " values (";
        foreach ($line as $field) {
          $v_sql .= $field . ", ";
        }
        $v_sql = rtrim ($v_sql, ", ") . ")";
        $v_connection->exec ($v_sql);
      }
    }

    protected function delete_test_objects () {
      $this->drop_table ("ut_0001");
      $this->drop_table ("ut_0002");
      $this->drop_table ("ut_0003");
      $this->drop_table ("ut_0004");
    }

    protected function create_test_objects () {
      $this->delete_test_objects ();
      $this->create_fill_table ("ut_0001",
                                "a integer, b text",
                                array (array (1, "'one'"),
                                       array (2, "'two'"),
                                       array (3, "'three'"),
                                       array (4, "'four'")));
    }

    protected static function getDBManagerRO (): DBManager {
      if (is_null (self::$cv_dbm_ro)) {
        self::$cv_dbm_ro = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RO, DB_PASSWORD_RO, DB_OPTIONS);
      }
      return self::$cv_dbm_ro;
    }

    protected static function getDBManagerRW (): DBManager {
      if (is_null (self::$cv_dbm_rw)) {
        self::$cv_dbm_rw = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
      }
      return self::$cv_dbm_rw;
    }

    protected static function getDBRootConnection (): PDO {
      if (is_null (self::$cv_dbm_ro)) {
        self::$cv_db_root_connection = new PDO ("mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DBNAME . ";charset=UTF8", DB_USERNAME_ROOT, DB_PASSWORD_ROOT, DB_OPTIONS);
      }
      return self::$cv_db_root_connection;
    }
  }
?>
