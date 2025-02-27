<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_action_id = f_safe_read_array_item ($_GET, 'id');
  $v_db_action = $_SESSION ['dbm_ro']->readActionById ($v_action_id)[0];
  $v_db_action_giver_name = $v_db_action ["giver_name"];
  $v_db_action_name = $v_db_action ["name"];
  $v_db_action_receiver_name = $v_db_action ["receiver_name"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Assign categories to action (<?php echo ($v_action_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Actions"], [], ["Logout"]); ?>

    <div>Giver : <?php echo ($v_db_action_giver_name); ?></div>
    <div>Name : <?php echo ($v_db_action_name); ?></div>
    <div>Receiver : <?php echo ($v_db_action_receiver_name); ?></div>

    <div>&nbsp;</div>

    <div class="table" id="assigned_categories">
        <div>Assigned categories</div>
    <?php
        foreach ($_SESSION ['dbm_ro']->listActionAssignedCategories ($v_action_id) as $v_category) {
            $v_category_id   = $v_category ["type_category_id"];
            $v_category_name = $v_category ["name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<a href=\"?action=do_action_unassign_category&action_id=$v_action_id&category_id=$v_category_id\"><div>$v_category_name</div></a>"); nl();
        }
    ?>
    </div>

    <div>&nbsp;</div>

    <div class="table" id="unassigned_categories">
        <div>Unassigned categories</div>
    <?php
        foreach ($_SESSION ['dbm_ro']->listActionUnassignedCategories ($v_action_id) as $v_category) {
            $v_category_id   = $v_category ["id"];
            $v_category_name = $v_category ["name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<a href=\"?action=do_action_assign_category&action_id=$v_action_id&category_id=$v_category_id\"><div>$v_category_name</div></a>"); nl();
        }
    ?>
    </div>
</div>
