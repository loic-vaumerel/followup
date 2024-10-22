<?php
  declare (strict_types = 1);

  require_once ("./model/DBManagerRO.php");
  require_once ("./model/DBManagerRW.php");
  require_once ("DBTestCase.php");

  final class DBManagerRORWTest extends DBTestCase {
    /**********************************
     ** Test
     **********************************/
    public function test (): void {
      $v_dbm_ro = new DBManagerRO ();
      $v_dbm_rw = new DBManagerRW ();

      $v_result = $v_dbm_ro->readUser ("UT_0001");
      $this->assertSame ($v_result, array ());

      print_r ($v_results);
      // $this->create_test_objects ();
      // $this->delete_test_objects ();
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