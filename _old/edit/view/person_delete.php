<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_POST, 'id');
  $v_db_person = $_SESSION ['dbm_ro']->readPersonById ($v_id)[0];
  $v_db_person_name = $v_db_person ["name"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Delete person (<?php echo ($v_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Persons"], [], ["Logout"]); ?>

    <div>Name : <?php echo ($v_db_person_name); ?></div>
    <hr>
    <div>Are you sure you want to delete this person ?</div>
    <hr>
    <form method="post" action="?action=do_person_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
    </form>
</div>
