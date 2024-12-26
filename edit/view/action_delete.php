<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_POST, 'id');
  $v_db_action = $_SESSION ['dbm_ro']->readActionById ($v_id)[0];
  $v_db_action_giver_name = $v_db_action ["giver_name"];
  $v_db_action_name = $v_db_action ["name"];
  $v_db_action_receiver_name = $v_db_action ["receiver_name"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Delete action (<?php echo ($v_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Actions"], [], ["Logout"]); ?>

    <div>Giver : <?php echo ($v_db_action_giver_name); ?></div>
    <div>Name : <?php echo ($v_db_action_name); ?></div>
    <div>Receiver : <?php echo ($v_db_action_receiver_name); ?></div>
    <hr>
    <div>Are you sure you want to delete this action ?</div>
    <hr>
    <form method="post" action="?action=do_action_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
    </form>
</div>
