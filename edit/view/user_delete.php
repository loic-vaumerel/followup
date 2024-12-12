<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_POST, 'id');
  $v_db_user = $_SESSION ['dbm_ro']->readUserById ($v_id)[0];
  $v_db_user_name = $v_db_user ["name"];
  $v_db_user_email = $v_db_user ["email"];
  $v_db_user_active = $v_db_user ["active"];
  $v_db_user_admin = $v_db_user ["admin"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Delete user (<?php echo ($v_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Users"], [], ["Logout"]); ?>

    <div>Name : <?php echo ($v_db_user_name); ?></div>
    <div>E-mail : <?php echo ($v_db_user_email); ?></div>
    <div>Active : <?php echo ($v_db_user_active); ?></div>
    <div>Admin : <?php echo ($v_db_user_admin); ?></div>
    <hr>
    <div>Are you sure you want to delete this user ?</div>
    <hr>
    <form method="post" action="?action=do_user_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
    </form>
</div>
