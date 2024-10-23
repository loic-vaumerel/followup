<?php
  declare (strict_types = 1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // require_once ("model/DBManager.php");
  // require_once ("settings/db.php");

  // require_once ("model/DBManager.php");
  require_once ("./settings/db.php");
  require_once ("./model/DBManagerRO.php");
  require_once ("./model/DBManagerRW.php");

  require_once ("./tools/debug.php");

  session_start ();

  $v_dbm_ro = new DBManagerRO ();
  $v_dbm_rw = new DBManagerRW ();

  echo ("<hr>");
  $v_dbm_rw->deleteUserByName ("UT_0001");
  $v_dbm_rw->deleteUserByName ("UT_0002");
  $v_dbm_rw->deleteUserByName ("UT_0003");
  $v_dbm_rw->deleteUserByName ("UT_0004");
  $v_dbm_rw->deleteUserByName ("UT_0005");
  print_array ($v_dbm_ro->listAllUsers ());

  echo ("<hr>");
  $v_dbm_rw->createUser ('UT_0001', "ut_0001@email.com");
  $v_dbm_rw->createUser ('UT_0002', "ut_0002@email.com");
  $v_dbm_rw->createUser ('UT_0003', "ut_0003@email.com");
  $v_dbm_rw->createUser ('UT_0004', "ut_0004@email.com");
  $v_dbm_rw->createUser ('UT_0005', "ut_0005@email.com");
  print_array ($v_dbm_ro->listAllUsers ());

  echo ("<hr>");
  $v_id = $v_dbm_ro->readUserByName ("UT_0001")[0]["id"];
  $v_dbm_rw->setUserPasswordById ($v_id, "password1");
  $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
  $v_dbm_rw->setUserPasswordById ($v_id, "password2");
  $v_id = $v_dbm_ro->readUserByName ("UT_0003")[0]["id"];
  $v_dbm_rw->setUserPasswordById ($v_id, "password3");
  $v_dbm_rw->setUserPasswordByName ("UT_0004", "password4");
  $v_dbm_rw->setUserPasswordByName ("UT_0005", "password5");
  print_array ($v_dbm_ro->listAllUsers ());

  echo ("<hr>");
  $v_id = $v_dbm_ro->readUserByName ("UT_0002")[0]["id"];
  $v_dbm_rw->activateUserById ($v_id);
  $v_id = $v_dbm_ro->readUserByName ("UT_0003")[0]["id"];
  $v_dbm_rw->activateUserById ($v_id);
  $v_dbm_rw->deactivateUserById ($v_id);
  $v_dbm_rw->activateUserByName ("UT_0004");
  $v_dbm_rw->activateUserByName ("UT_0005");
  $v_dbm_rw->deactivateUserByName ("UT_0005");
  print_array ($v_dbm_ro->listAllUsers ());


  print_array ($v_dbm_ro->readUserById (-1));
  print_array ($v_dbm_ro->readUserByName ("UT_0001"));

  // echo ("<hr>");
  // $v_dbm_rw->deleteUser ((int)$v_dbm_ro->readUser ("UT_0001")[0]["id"]);
  // $v_dbm_rw->deleteUser ((int)$v_dbm_ro->readUser ("UT_0002")[0]["id"]);
  // $v_dbm_rw->deleteUser ((int)$v_dbm_ro->readUser ("UT_0003")[0]["id"]);
  // // $v_dbm_rw->deleteUser ("UT_0001");
  // $v_result = $v_dbm_ro->readUser ("UT_0001");
  // echo ("<pre>"); print_r ($v_result); echo ("<pre>");

  // $v_dbm_ro = new DBManager (DB_HOSTNAME, DB_DBNAME, DB_USERNAME_RO, DB_PASSWORD_RO, DB_OPTIONS);
  // $v = $v_dbm_ro->getQueryResult ("SELECT *
  //                                    from test
  //                                   where a=:a or b=:b",
  //                                 array (array ("a", 1      , PDO::PARAM_INT),
  //                                        array ("b", "three", PDO::PARAM_STR)));
  // echo ("<pre>"); print_r ($v); echo ("</pre>");
  // echo ("<div>" . $v_dbm_ro->getMessage() . "</div>");

  // echo ("<hr>");
  // echo ('<pre><h1>Get</h1>'); print_r ($_GET); echo ('</pre>');
  // echo ('<pre><h1>Post</h1>'); print_r ($_POST); echo ('</pre>');
  // echo ('<pre><h1>Globals</h1>'); print_r ($GLOBALS); echo ('</pre>');
  // echo ('<pre><h1>Session</h1>'); print_r ($_SESSION); echo ('</pre>');
?>