<?php
  declare (strict_types = 1);

  use PHPUnit\Framework\TestCase;

  require_once ("./phpunit/settings/db.php");
  require_once ('./model/DBManager.php');
 
  final class DBManagerTest extends TestCase {
    private static $cv_dbm_ro = null;
    private static $cv_dbm_rw = null;
    private static $cv_db_root_connection = null;

    /**********************************
     ** Test
     **********************************/
    public function testSelectAllNoFilterNoParameter (): void {
      $this->create_test_objects ();

      $v_sql = "SELECT *
                  from ut_0001";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->assertSame($v_result, array (array ("a" => 1, "b" => "one"),
                                          array ("a" => 2, "b" => "two"),
                                          array ("a" => 3, "b" => "three"),
                                          array ("a" => 4, "b" => "four")));

      $this->delete_test_objects ();
    }

    /**********************************
     ** Test
     **********************************/
    public function testSelectAllFiltersParameters (): void {
      $this->create_test_objects ();

      $v_sql = "SELECT *
                  from ut_0001
                 where a = :param_a
                    or b = :param_b";
      $v_parameters = array (array ("param_a", 1      , PDO::PARAM_INT),
                             array ("param_b", "three", PDO::PARAM_STR));
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql, $v_parameters);

      $this->assertSame($v_result, array (array ("a" => 1, "b" => "one"),
                                          array ("a" => 3, "b" => "three")));

      $this->delete_test_objects ();
    }

    /**********************************
     ** Test
     **********************************/
    public function testSelectSpecificFiltersParameters (): void {
      $this->create_test_objects ();

      $v_sql = "SELECT b
                  from ut_0001
                 where a = :param_a";
      $v_parameters = array (array ("param_a", 2, PDO::PARAM_INT));
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql, $v_parameters);

      $this->assertSame($v_result, array (array ("b" => "two")));

      $this->delete_test_objects ();
    }

    /**********************************
     ** Test
     **********************************/
    public function testSelectFiltersNoParameters (): void {
      $this->expectException(PDOException::class);
      $this->expectExceptionCode(42000);
      $this->expectExceptionMessage("SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ':param_a
                    or b = :param_b' at line 3");

      $this->create_test_objects ();

      $v_sql = "SELECT *
                  from ut_0001
                 where a = :param_a
                    or b = :param_b";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->delete_test_objects ();
    }

    /**********************************
     ** Test
     **********************************/
    public function testCRUD (): void {
      $this->create_test_objects ();

      // Init
      $v_sql = "SELECT *
                  from ut_0001";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->assertSame($v_result, array (array ("a" => 1, "b" => "one"),
                                          array ("a" => 2, "b" => "two"),
                                          array ("a" => 3, "b" => "three"),
                                          array ("a" => 4, "b" => "four")));

      // Insert
      $v_sql = "INSERT into ut_0001
                     values (:param_a, :param_b)";
      $v_parameters = array (array ("param_a", 7      , PDO::PARAM_INT),
                             array ("param_b", "seven", PDO::PARAM_STR));
      $v_result = self::getDBManagerRW ()->executeQuery ($v_sql, $v_parameters);

      $v_sql = "SELECT *
                  from ut_0001";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->assertSame($v_result, array (array ("a" => 1, "b" => "one"),
                                          array ("a" => 2, "b" => "two"),
                                          array ("a" => 3, "b" => "three"),
                                          array ("a" => 4, "b" => "four"),
                                          array ("a" => 7, "b" => "seven")));

      // Update
      $v_sql = "UPDATE ut_0001
                   set b = :param_b
                 where a = :param_a";
      $v_parameters = array (array ("param_a", 3          , PDO::PARAM_INT),
                             array ("param_b", "NEW three", PDO::PARAM_STR));
      $v_result = self::getDBManagerRW ()->executeQuery ($v_sql, $v_parameters);

      $v_sql = "SELECT *
                  from ut_0001";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->assertSame($v_result, array (array ("a" => 1, "b" => "one"),
                                          array ("a" => 2, "b" => "two"),
                                          array ("a" => 3, "b" => "NEW three"),
                                          array ("a" => 4, "b" => "four"),
                                          array ("a" => 7, "b" => "seven")));

      // Delete
      $v_sql = "DELETE from ut_0001 where a <> :param_a";
      $v_parameters = array (array ("param_a", 7, PDO::PARAM_INT));
      $v_result = self::getDBManagerRW ()->executeQuery ($v_sql, $v_parameters);

      $v_sql = "SELECT *
      from ut_0001";
      $v_result = self::getDBManagerRO ()->getQueryResult ($v_sql);

      $this->assertSame($v_result, array (array ("a" => 7, "b" => "seven")));

      $this->delete_test_objects ();
    }

    /**********************************
     ** Test
     **********************************/
    // public function test (): void {
    //   $this->create_test_objects ();
    //   $this->delete_test_objects ();
    // }

    /**********************************
     ** Tools
     **********************************/

    private static function getDBManagerRO (): DBManager {
      if (is_null (self::$cv_dbm_ro)) {
        self::$cv_dbm_ro = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RO, DB_PASSWORD_RO, DB_OPTIONS);
      }
      return self::$cv_dbm_ro;
    }

    private static function getDBManagerRW (): DBManager {
      if (is_null (self::$cv_dbm_rw)) {
        self::$cv_dbm_rw = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RW, DB_PASSWORD_RW, DB_OPTIONS);
      }
      return self::$cv_dbm_rw;
    }

    private static function getDBRootConnection (): PDO {
      if (is_null (self::$cv_dbm_ro)) {
        self::$cv_db_root_connection = new PDO ("mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DBNAME . ";charset=UTF8", DB_USERNAME_ROOT, DB_PASSWORD_ROOT, DB_OPTIONS);
      }
      return self::$cv_db_root_connection;
    }

    private function drop_table (string $p_table_name) {
      $v_connection = self::getDBRootConnection ();
      $v_sql = "drop table if exists " . $p_table_name;
      $v_connection->exec ($v_sql);
    }

    private function create_fill_table (string $p_table_name, string $p_columns, array $p_data) {
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

    private function delete_test_objects () {
      $this->drop_table ("ut_0001");
      $this->drop_table ("ut_0002");
      $this->drop_table ("ut_0003");
      $this->drop_table ("ut_0004");
    }

    private function create_test_objects () {
      $this->delete_test_objects ();
      $this->create_fill_table ("ut_0001",
                                "a integer, b text",
                                array (array (1, "'one'"),
                                       array (2, "'two'"),
                                       array (3, "'three'"),
                                       array (4, "'four'")));
    }
  }
?>