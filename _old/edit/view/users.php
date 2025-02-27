<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Users</h1>
    <?php generate_toolbar (["Main", "Settings", "Users"], ["Create User"], ["Logout"]); ?>

    <div class="table" id="users">
        <div>Id</div>
        <div>Name</div>
        <div>E-mail</div>
        <div>Active</div>
        <div>Admin</div>
        <div>Password</div>
        <div>Action</div>
<?php
        foreach ($_SESSION ['dbm_ro']->listAllUsers () as $v_user) {
            $v_id        = $v_user ["id"];
            $v_name      = $v_user ["name"];
            $v_email     = $v_user ["email"];
            $v_active    = $v_user ["active"];
            $v_admin     = $v_user ["admin"];
            $v_password  = $v_user ["password"];
            if ($v_active == 0) {
                $v_active = "No";
                $v_active_class = "red";
            }
            if ($v_active == 1) {
                $v_active = "Yes";
                $v_active_class = "green";
            }
            if ($v_admin == 0) {
                $v_admin = "No";
                $v_admin_class = "";
            }
            if ($v_admin == 1) {
                $v_admin = "Yes";
                $v_admin_class = "blue";
            }
            if ($v_password == "NOT_INITIALIZED") {
                $v_password_link_label = "Initialize password";
                $v_password_class = "orange";
            } else {
                $v_password_link_label = "Change password";
                $v_password_class = "";
            }
            e (2, "<!-- Line -->"); nl();
            e (2, "<div>$v_id</div>"); nl();
            e (2, "<div>$v_name</div>"); nl();
            e (2, "<div>$v_email</div>"); nl();
            e (2, "<div class=\"$v_active_class\">$v_active</div>"); nl();
            e (2, "<div class=\"$v_admin_class\">$v_admin</div>"); nl();
            e (2, "<a class=\"$v_password_class\" href=\"?action=goto_user_update_password&id=$v_id\"><div>$v_password_link_label</div></a>"); nl();
            e (2, "<a href=\"?action=goto_user_edit&id=$v_id\"><div>Edit</div></a>"); nl();
        }
?>
    </div>
</div>
