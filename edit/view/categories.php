<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Categories</h1>
    <?php generate_toolbar (["Main", "Settings", "Categories"], ["Create Category"], ["Logout"]); ?>

    <div class="table" id="categories">
        <div>Id</div>
        <div>Name</div>
        <div>Action</div>
<?php
        foreach ($_SESSION ['dbm_ro']->listAllCategories () as $v_category) {
            $v_id   = $v_category ["id"];
            $v_name = $v_category ["name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<div>$v_id</div>"); nl();
            e (2, "<div>$v_name</div>"); nl();
            e (2, "<a href=\"?action=goto_category_edit&id=$v_id\"><div>Edit</div></a>"); nl();
        }
?>
    </div>
</div>
