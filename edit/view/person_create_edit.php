<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_GET, 'id');
  if (!is_null ($v_id)) {
    $v_action = "do_person_edit";
    $v_title = "Edit an existing person (" . $v_id . ")";
    $v_button_label = "Save Changes";

    $v_db_person = $_SESSION ['dbm_ro']->readPersonById ($v_id)[0];
    $v_db_person_name = $v_db_person ["name"];
  } else {
    $v_id = null;
    $v_action = "do_person_create";
    $v_title = "Create a new person";
    $v_button_label = "Create person";

    $v_db_person_name = null;
}
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1><?php echo ($v_title); ?></h1>
    <?php generate_toolbar (["Main", "Settings", "Persons"], [], ["Logout"]); ?>

    <div class="flex_col">
        <form method="post" action="?action=<?php echo ($v_action); ?>">
            <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
            <table>
                <tbody>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" name="name" value="<?php echo ($v_db_person_name); ?>" autofocus></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <input type="submit" value="<?php echo ($v_button_label); ?>">
            </div>
        </form>
<?php if ($v_action == "do_person_edit") { ?>
        <div>
            <form method="post" action="?action=goto_person_delete">
            <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
            <input type="submit" value="Delete">
            </form>
        </div>
<?php } ?>
    </div>
</div>

