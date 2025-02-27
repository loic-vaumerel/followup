<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Persons</h1>
    <?php generate_toolbar (["Main", "Settings", "Persons"], ["Create Person"], ["Logout"]); ?>

    <div class="table" id="persons">
        <div>Id</div>
        <div>Name</div>
        <div>Action</div>
<?php
        foreach ($_SESSION ['dbm_ro']->listAllPersons () as $v_person) {
            $v_id   = $v_person ["id"];
            $v_name = $v_person ["name"];
            e (2, "<!-- Line -->"); nl();
            e (2, "<div>$v_id</div>"); nl();
            e (2, "<div>$v_name</div>"); nl();
            e (2, "<a href=\"?action=goto_person_edit&id=$v_id\"><div>Edit</div></a>"); nl();
        }
?>
    </div>
</div>
