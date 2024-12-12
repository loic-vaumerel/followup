<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_GET, 'id');
  if (!is_null ($v_id)) {
    $v_action = "do_user_edit";
    $v_title = "Edit an existing user (" . $v_id . ")";
    $v_button_label = "Save Changes";

    $v_db_user = $_SESSION ['dbm_ro']->readUserById ($v_id)[0];
    $v_db_user_name = $v_db_user ["name"];
    $v_db_user_email = $v_db_user ["email"];
    $v_db_user_active = $v_db_user ["active"];
    $v_db_user_admin = $v_db_user ["admin"];
    if ($v_db_user_active == 0) {
        $v_db_user_active_selected_no = "selected=\"selected\"";
        $v_db_user_active_selected_yes = "";
    }
    if ($v_db_user_active == 1) {
        $v_db_user_active_selected_no = "";
        $v_db_user_active_selected_yes = "selected=\"selected\"";
    }
    if ($v_db_user_admin == 0) {
        $v_db_user_admin_selected_no = "selected=\"selected\"";
        $v_db_user_admin_selected_yes = "";
    }
    if ($v_db_user_admin == 1) {
        $v_db_user_admin_selected_no = "";
        $v_db_user_admin_selected_yes = "selected=\"selected\"";
    }
  } else {
    $v_id = null;
    $v_action = "do_user_create";
    $v_title = "Create a new user";
    $v_button_label = "Create User";

    $v_db_user_name = null;
    $v_db_user_email = null;
    $v_db_user_active_selected_no = "selected=\"selected\"";
    $v_db_user_active_selected_yes = "";
    $v_db_user_admin_selected_no = "selected=\"selected\"";
    $v_db_user_admin_selected_yes = "";
}
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1><?php echo ($v_title); ?></h1>
    <?php generate_toolbar (["Main", "Settings", "Users"], [], ["Logout"]); ?>

    <div class="flex_col">

    <form method="post" action="?action=<?php echo ($v_action); ?>">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <table>
            <tbody>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" value="<?php echo ($v_db_user_name); ?>" autofocus></td>
                </tr>
                <tr>
                    <td><label for="email">E-mail:</label></td>
                    <td><input type="email" name="email" value="<?php echo ($v_db_user_email); ?>"></td>
                </tr>
<?php if ($v_action == "do_user_create") { ?>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password"></td>
                </tr>
<?php } ?>
                <tr>
                    <td><label for="active">Active:</label></td>
                    <td>
                        <select name="active">
                            <option value=0 <?php echo ($v_db_user_active_selected_no); ?>>No</option>
                            <option value=1 <?php echo ($v_db_user_active_selected_yes); ?>>Yes</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="admin">Admin:</label></td>
                    <td>
                        <select name="admin">
                            <option value=0 <?php echo ($v_db_user_admin_selected_no); ?>>No</option>
                            <option value=1 <?php echo ($v_db_user_admin_selected_yes); ?>>Yes</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <input type="submit" value="<?php echo ($v_button_label); ?>">
        </div>
    </form>
<?php if ($v_action == "do_user_edit") { ?>
    <div>
        <form method="post" action="?action=goto_user_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
        </form>
    </div>
<?php } ?>
    </div>
</div>

