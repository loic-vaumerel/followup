<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_persons = $_SESSION ['dbm_ro']->listAllPersons ();

  $v_id = f_safe_read_array_item ($_GET, 'id');
  if (!is_null ($v_id)) {
    $v_action = "do_action_edit";
    $v_title = "Edit an existing action (" . $v_id . ")";
    $v_button_label = "Save Changes";

    $v_db_action = $_SESSION ['dbm_ro']->readActionById ($v_id)[0];
    $v_db_action_giver_id = $v_db_action ["giver_id"];
    $v_db_action_name = $v_db_action ["name"];
    $v_db_action_receiver_id = $v_db_action ["receiver_id"];
  } else {
    $v_id = null;
    $v_action = "do_action_create";
    $v_title = "Create a new action";
    $v_button_label = "Create action";

    $v_db_action_name = null;
  }

  // echo ("<pre>"); print_r ($v_persons); echo ("<pre>");
?>

<!-- <select name="active">
  <option value=0 <?php //echo ($v_db_user_active_selected_no); ?>>No</option>
  <option value=1 <?php //echo ($v_db_user_active_selected_yes); ?>>Yes</option>
</select> -->


<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1><?php echo ($v_title); ?></h1>
    <?php generate_toolbar (["Main", "Settings", "Actions"], [], ["Logout"]); ?>

    <div class="flex_col">
        <form method="post" action="?action=<?php echo ($v_action); ?>">
            <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
            <table>
                <tbody>
                    <tr>
                        <td><label for="giver_id">Giver:</label></td>
                        <td>
                            <select name="giver_id">
<?php foreach ($v_persons as $v_person) {
    if ($v_db_action_giver_id == $v_person["id"]) {
        $v_selected_attribute = " selected=\"selected\"";
    } else {
        $v_selected_attribute = "";
    } ?>
                                <option value=<?php echo ($v_person["id"] . $v_selected_attribute); ?>><?php echo ($v_person["name"]); ?></option>
<?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" name="name" value="<?php echo ($v_db_action_name); ?>" autofocus></td>
                    </tr>
                    <tr>
                        <td><label for="receiver_id">Giver:</label></td>
                        <td>
                            <select name="receiver_id">
<?php foreach ($v_persons as $v_person) {
    if ($v_db_action_receiver_id == $v_person["id"]) {
        $v_selected_attribute = " selected=\"selected\"";
    } else {
        $v_selected_attribute = "";
    } ?>
                                <option value=<?php echo ($v_person["id"] . $v_selected_attribute); ?>><?php echo ($v_person["name"]); ?></option>
<?php } ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <input type="submit" value="<?php echo ($v_button_label); ?>">
            </div>
        </form>
<?php if ($v_action == "do_action_edit") { ?>
        <div>
            <form method="post" action="?action=goto_action_delete">
            <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
            <input type="submit" value="Delete">
            </form>
        </div>
<?php } ?>
    </div>
</div>

