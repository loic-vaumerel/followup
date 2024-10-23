<?php
  declare (strict_types = 1);

  use PHPUnit\Framework\TestCase;

  require_once ("./phpunit/settings/db.php");
  require_once ("./model/DBManagerRO.php");
  require_once ("./model/DBManagerRW.php");
  // require_once ("DBTestCase.php");

  final class DBManagerRORWTest extends TestCase {
    /**********************************
     ** Test
     **********************************/
    public function testUserCRUD (): void {
      $v_dbm_ro = new DBManagerRO ();
      $v_dbm_rw = new DBManagerRW ();

      // Cleaning
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_dbm_rw->deleteUserById ($v_user ["id"]);
      }

      $this->assertSame ($v_dbm_ro->listAllUsers (),
                         array ()); 
      $this->assertSame ($v_dbm_ro->readUserById (-1),
                         array ()); 
      $this->assertSame ($v_dbm_ro->readUserByName ("UNKNOWN"),
                         array ()); 

      // Create User
      $v_dbm_rw->createUser ('UT_0001', "ut_0001@email.com");
      $v_dbm_rw->createUser ('UT_0002', "ut_0002@email.com");
      $v_dbm_rw->createUser ('UT_0003', "ut_0003@email.com");
      $v_dbm_rw->createUser ('UT_0004', "ut_0004@email.com");
      $v_dbm_rw->createUser ('UT_0005', "ut_0005@email.com");

      // Read all users
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_users [$v_index]["id"] = -1; // skip id check by overwriting it with a fixed value
      }
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001", "email" => "ut_0001@email.com", "password" => "NOT_INITIALIZED", "active" => 0),
                                array ("id" => -1, "name" => "UT_0002", "email" => "ut_0002@email.com", "password" => "NOT_INITIALIZED", "active" => 0),
                                array ("id" => -1, "name" => "UT_0003", "email" => "ut_0003@email.com", "password" => "NOT_INITIALIZED", "active" => 0),
                                array ("id" => -1, "name" => "UT_0004", "email" => "ut_0004@email.com", "password" => "NOT_INITIALIZED", "active" => 0),
                                array ("id" => -1, "name" => "UT_0005", "email" => "ut_0005@email.com", "password" => "NOT_INITIALIZED", "active" => 0))); 
    
      // Set password
      $v_id = $v_dbm_ro->readUserByName ("UT_0001")[0]["id"];
      $v_dbm_rw->setUserPasswordById ($v_id, "password1");
      $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
      $v_dbm_rw->setUserPasswordById ($v_id, "password2");
      $v_id = $v_dbm_ro->readUserByName ("UT_0003")[0]["id"];
      $v_dbm_rw->setUserPasswordById ($v_id, "password3");
      $v_dbm_rw->setUserPasswordByName ("UT_0004", "password4");
      $v_dbm_rw->setUserPasswordByName ("UT_0005", "password5");

      // Read all users
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_users [$v_index]["id"] = -1; // skip id check by overwriting it with a fixed value
      }
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001", "email" => "ut_0001@email.com", "password" => "password1", "active" => 0),
                                array ("id" => -1, "name" => "UT_0002", "email" => "ut_0002@email.com", "password" => "password2", "active" => 0),
                                array ("id" => -1, "name" => "UT_0003", "email" => "ut_0003@email.com", "password" => "password3", "active" => 0),
                                array ("id" => -1, "name" => "UT_0004", "email" => "ut_0004@email.com", "password" => "password4", "active" => 0),
                                array ("id" => -1, "name" => "UT_0005", "email" => "ut_0005@email.com", "password" => "password5", "active" => 0))); 

      // Activate / Deactivate user
      $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
      $v_dbm_rw->activateUserById ($v_id);
      $v_id = $v_dbm_ro->readUserByName ("UT_0003")[0]["id"];
      $v_dbm_rw->activateUserById ($v_id);
      $v_dbm_rw->deactivateUserById ($v_id);
      $v_dbm_rw->activateUserByName ("UT_0004");
      $v_dbm_rw->activateUserByName ("UT_0005");
      $v_dbm_rw->deactivateUserByName ("UT_0005");

      // Read all users
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_users [$v_index]["id"] = -1; // skip id check by overwriting it with a fixed value
      }
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001", "email" => "ut_0001@email.com", "password" => "password1", "active" => 0),
                                array ("id" => -1, "name" => "UT_0002", "email" => "ut_0002@email.com", "password" => "password2", "active" => 1),
                                array ("id" => -1, "name" => "UT_0003", "email" => "ut_0003@email.com", "password" => "password3", "active" => 0),
                                array ("id" => -1, "name" => "UT_0004", "email" => "ut_0004@email.com", "password" => "password4", "active" => 1),
                                array ("id" => -1, "name" => "UT_0005", "email" => "ut_0005@email.com", "password" => "password5", "active" => 0))); 

      // Set name
      $v_id = $v_dbm_ro->readUserByName ("UT_0001")[0]["id"];
      $v_dbm_rw->setUserNameById ($v_id, "UT_0001_NEW");

      // Read all users
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_users [$v_index]["id"] = -1; // skip id check by overwriting it with a fixed value
      }
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001_NEW", "email" => "ut_0001@email.com", "password" => "password1", "active" => 0),
                                array ("id" => -1, "name" => "UT_0002"    , "email" => "ut_0002@email.com", "password" => "password2", "active" => 1),
                                array ("id" => -1, "name" => "UT_0003"    , "email" => "ut_0003@email.com", "password" => "password3", "active" => 0),
                                array ("id" => -1, "name" => "UT_0004"    , "email" => "ut_0004@email.com", "password" => "password4", "active" => 1),
                                array ("id" => -1, "name" => "UT_0005"    , "email" => "ut_0005@email.com", "password" => "password5", "active" => 0))); 

      // Set email
      $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
      $v_dbm_rw->setUserEmailById ($v_id, "ut_0002_new@email.com");
      $v_dbm_rw->setUserEmailByName ("UT_0003", "ut_0003_new@email.com");

      // Read all users
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_users [$v_index]["id"] = -1; // skip id check by overwriting it with a fixed value
      }
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001_NEW", "email" => "ut_0001@email.com"    , "password" => "password1", "active" => 0),
                                array ("id" => -1, "name" => "UT_0002"    , "email" => "ut_0002_new@email.com", "password" => "password2", "active" => 1),
                                array ("id" => -1, "name" => "UT_0003"    , "email" => "ut_0003_new@email.com", "password" => "password3", "active" => 0),
                                array ("id" => -1, "name" => "UT_0004"    , "email" => "ut_0004@email.com"    , "password" => "password4", "active" => 1),
                                array ("id" => -1, "name" => "UT_0005"    , "email" => "ut_0005@email.com"    , "password" => "password5", "active" => 0))); 

      // Read user by id
      $v_id = $v_dbm_ro->readUserByName ("UT_0001_NEW")[0]["id"];
      $v_users = $v_dbm_ro->readUserById ($v_id);
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001_NEW", "email" => "ut_0001@email.com", "password" => "password1", "active" => 0)));
      $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
      $v_users = $v_dbm_ro->readUserById ($v_id);
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0002", "email" => "ut_0002_new@email.com", "password" => "password2", "active" => 1)));
      $v_id = $v_dbm_ro->readUserByName ("UT_0003")[0]["id"];
      $v_users = $v_dbm_ro->readUserById ($v_id);
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0003", "email" => "ut_0003_new@email.com", "password" => "password3", "active" => 0)));
      $v_id = $v_dbm_ro->readUserByName ("UT_0004")[0]["id"];
      $v_users = $v_dbm_ro->readUserById ($v_id);
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0004", "email" => "ut_0004@email.com", "password" => "password4", "active" => 1)));
      $v_id = $v_dbm_ro->readUserByName ("UT_0005")[0]["id"];
      $v_users = $v_dbm_ro->readUserById ($v_id);
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0005", "email" => "ut_0005@email.com", "password" => "password5", "active" => 0)));

      // Read user by name
      $v_users = $v_dbm_ro->readUserByName ("UT_0001_NEW");
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0001_NEW", "email" => "ut_0001@email.com", "password" => "password1", "active" => 0)));
      $v_users = $v_dbm_ro->readUserByName ("UT_0002");
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0002", "email" => "ut_0002_new@email.com", "password" => "password2", "active" => 1)));
      $v_users = $v_dbm_ro->readUserByName ("UT_0003");
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0003", "email" => "ut_0003_new@email.com", "password" => "password3", "active" => 0)));
      $v_users = $v_dbm_ro->readUserByName ("UT_0004");
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0004", "email" => "ut_0004@email.com", "password" => "password4", "active" => 1)));
      $v_users = $v_dbm_ro->readUserByName ("UT_0005");
      $v_users [0]["id"] = -1; // skip id check by overwriting it with a fixed value
      $this->assertSame ($v_users,
                         array (array ("id" => -1, "name" => "UT_0005", "email" => "ut_0005@email.com", "password" => "password5", "active" => 0)));

      // Cleaning
      $v_users = $v_dbm_ro->listAllUsers ();
      foreach ($v_users as $v_index => $v_user) {
        $v_dbm_rw->deleteUserById ($v_user ["id"]);
      }

      $this->assertSame ($v_dbm_ro->listAllUsers (),
                         array ()); 
      $this->assertSame ($v_dbm_ro->readUserById (-1),
                         array ()); 
      $this->assertSame ($v_dbm_ro->readUserByName ("UNKNOWN"),
                         array ()); 
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