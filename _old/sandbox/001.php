<!-- <meta http-equiv="refresh" content="60"> -->

<link rel="stylesheet" href="001.css">
<script type="text/javascript" src="001.js"></script>

<?php echo date('l jS \of F Y h:i:s A'); ?>
<h1>Sandbox - 001</h1>
<div id="display_modal_1">Display Modal 1</div>
<div class="display_modal_2">Display Modal 2 a</div>
<div class="display_modal_2">Display Modal 2 b</div>
<div class="display_modal_2">Display Modal 2 c</div>
<table id="users">
    <thead>
        <td>Id</td>
        <td>Name</td>
        <td>E-mail</td>
        <td>Password</td>
        <td>Active</td>
        <td>Type</td>
        <td>Delete</td>
    </thead>
    <tbody>
    <tr>
            <td class="id">1</td>
            <td class="name clickable">admin</td>
            <td class="e-mail clickable">admin@email.com</td>
            <td class="password clickable">******</td>
            <td class="active clickable">Yes</td>
            <td class="type clickable">Admin</td>
            <td class="delete clickable">Delete</td>
            <td class="not_configured clickable">Not Configured</td>
        </tr>
            <td class="id">2</td>
            <td class="name clickable">user2</td>
            <td class="e-mail clickable">user2@email.com</td>
            <td class="password clickable">******</td>
            <td class="active clickable">No</td>
            <td class="type clickable">Admin</td>
            <td class="delete clickable">Delete</td>
        </tr>
        <tr>
            <td class="id">3</td>
            <td class="name clickable">user_3</td>
            <td class="e-mail clickable">user_3@email.com</td>
            <td class="password clickable">******</td>
            <td class="active clickable">Yes</td>
            <td class="type clickable">Normal</td>
            <td class="delete clickable">Delete</td>
        </tr>
        <tr>
            <td class="id">4</td>
            <td class="name clickable">user_4</td>
            <td class="e-mail clickable">user_4@email.com</td>
            <td class="password clickable">******</td>
            <td class="active clickable">No</td>
            <td class="type clickable">Normal</td>
            <td class="delete clickable">Delete</td>
        </tr>
    </tbody>
</table>
<input type="text" value="0000">
<?php for ($i = 1 ; $i <= 100 ; $i ++) { ?>
<div>Line <?php echo ("$i"); ?></div>
<?php } ?>

<script>
    $all("table#users > tbody > tr > td").forEach ((v_item) => {
        v_id = v_item.parentElement.querySelector ("td.id").innerHTML;
        v_name = v_item.parentElement.querySelector ("td.name").innerHTML;
        v_item.addEventListener ("click", function () {
            alert ("    " + v_name);
            display_modal (v_item, [["name"    , null    , v_name + " - Change name"    , "Enter a new name for " + v_name                       , "user_change_name"    , v_id, v_item.innerHTML, "text"    , "Save"   ],
                                    ["e-mail"  , null    , v_name + " - Change e-mail"  , "Enter a new e-mail for " + v_name                     , "user_change_email"   , v_id, v_item.innerHTML, "text"    , "Save"   ],
                                    ["password", null    , v_name + " - Change password", "Enter a new password for " + v_name                   , "user_change_password", v_id, null            , "password", "Save"   ],
                                    ["active"  , "Yes"   , v_name + " - Disable"        , "Disable " + v_name + " user"                          , "user_disable"        , v_id, null            , null      , "Disable"],
                                    ["active"  , "No"    , v_name + " - Enable"         , "Enable " + v_name + " user"                           , "user_enable"         , v_id, null            , null      , "Enable" ],
                                    ["type"    , "Admin" , v_name + " - Admin demotion" , "Demote " + v_name + " to a normal user"               , "user_demote"         , v_id, null            , null      , "Demote" ],
                                    ["type"    , "Normal", v_name + " - Admin promotion", "Promote " + v_name + " to an admin user"              , "user_promote"        , v_id, null            , null      , "Promote"],
                                    ["delete"  , null    , v_name + " - Delete"         , "Are wou sure you want to DELETE " + v_name + " user ?", "user_delete"         , v_id, null            , null      , "Delete" ]
                                   ]);
        });
    });
</script>

<style>
    table {
        border-collapse:collapse;
    }
    td {
        border:solid 1px;
    }
    td.clickable:hover {
        background-color:#DDE;
    }
    thead {
        background-color:#EEE;
    }
</style>