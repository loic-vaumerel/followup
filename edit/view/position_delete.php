<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_POST, 'id');
  $v_db_position = $_SESSION ['dbm_ro']->readPositionById ($v_id)[0];
  $v_db_position_name = $v_db_position ["name"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Delete position (<?php echo ($v_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Positions"], [], ["Logout"]); ?>

    <div>Name : <?php echo ($v_db_position_name); ?></div>
    <hr>
    <div>Are you sure you want to delete this position ?</div>
    <hr>
    <form method="post" action="?action=do_position_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
    </form>
</div>
