<?php
  declare (strict_types = 1);

  require_once ("DBTestCase.php");

  final class DBManagerTest extends DBTestCase {
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
  }
?>