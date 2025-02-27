<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Positions</h1>
    <?php generate_toolbar (["Main", "Settings", "Positions"], ["Create Position"], ["Logout"]); ?>

    <div class="table" id="positions">
        <div>Id</div>
        <div>Name</div>
        <div>Action</div>
<?php
        foreach ($_SESSION ['dbm_ro']->listAllPositions () as $v_position) {
            $v_id   = $v_position ["id"];
            $v_name = $v_position ["name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<div>$v_id</div>"); nl();
            e (2, "<div>$v_name</div>"); nl();
            e (2, "<a href=\"?action=goto_position_edit&id=$v_id\"><div>Edit</div></a>"); nl();
        }
?>
    </div>
</div>
