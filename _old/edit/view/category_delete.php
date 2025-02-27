<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<?php
  $v_id = f_safe_read_array_item ($_POST, 'id');
  $v_db_category = $_SESSION ['dbm_ro']->readCategoryById ($v_id)[0];
  $v_db_category_name = $v_db_category ["name"];
?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Delete category (<?php echo ($v_id); ?>)</h1>
    <?php generate_toolbar (["Main", "Settings", "Categories"], [], ["Logout"]); ?>

    <div>Name : <?php echo ($v_db_category_name); ?></div>
    <hr>
    <div>Are you sure you want to delete this category ?</div>
    <hr>
    <form method="post" action="?action=do_category_delete">
        <input type="hidden" name="id" value="<?php echo ($v_id); ?>">
        <input type="submit" value="Delete">
    </form>
</div>
