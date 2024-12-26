<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Actions</h1>
    <?php generate_toolbar (["Main", "Settings", "Actions"], ["Create Action"], ["Logout"]); ?>

    <div class="table" id="actions">
        <div>Id</div>
        <div>Giver</div>
        <div>Name</div>
        <div>Receiver</div>
        <div>Action</div>
        <div>Action</div>
<?php
        foreach ($_SESSION ['dbm_ro']->listAllActions () as $v_action) {
            $v_id            = $v_action ["id"];
            $v_giver_name    = $v_action ["giver_name"];
            $v_name          = $v_action ["name"];
            $v_receiver_name = $v_action ["receiver_name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<div>$v_id</div>"); nl();
            e (2, "<div>$v_giver_name</div>"); nl();
            e (2, "<div>$v_name</div>"); nl();
            e (2, "<div>$v_receiver_name</div>"); nl();
            e (2, "<a href=\"?action=goto_action_edit&id=$v_id\"><div>Edit</div></a>"); nl();
            e (2, "<a href=\"?action=goto_action_category_edit&id=$v_id\"><div>Assign Categories</div></a>"); nl();
        }
?>
    </div>
</div>
