<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Users</h1>
    <div id="toolbar">
        <form method="post" action="?action=goto_main">
            <input type="submit" value="Main">
        </form>
        <form method="post" action="?action=goto_settings">
            <input type="submit" value="Settings">
        </form>
        <form method="post" action="?action=goto_create_user">
            <input type="submit" value="Create User">
        </form>
        <form method="post" action="?action=do_logout">
            <input type="submit" value="Logout">
        </form>
    </div>

    <table>
        <thead>
            <td>Id</td>
            <td>Name</td>
            <td>E-mail</td>
            <td>Active</td>
            <td>Type</td>
            <td>Password</td>
            <td>Delete</td>
        </thead>
        <tbody>
    <?php
        function e (int $p_spaces, string $p_text) {
            echo (str_repeat ("    ", $p_spaces) . $p_text);
        }

        foreach ($v_dbm_ro->listAllUsers () as $v_user) {
            $v_id     = $v_user ["id"];
            $v_name   = $v_user ["name"];
            $v_email  = $v_user ["email"];
            $v_active = $v_user ["active"];
            $v_admin  = $v_user ["admin"];

            e (2, "<tr>\n");
            e (3, "<td>$v_id</td>\n");
            e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'name', '$v_name');\">$v_name</td>\n");
            e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'email', '$v_email');\">$v_email</td>\n");
            if ($v_active) {
                e (3, "<td class=\"clickable green\" onClick=\"displayModal ($v_id, '$v_name', 'disable', null);\">Yes</td>\n");
            } else {
                e (3, "<td class=\"clickable red\" onClick=\"displayModal ($v_id, '$v_name', 'activate', null);\">No</td>\n");
            }
            if ($v_admin) {
                e (3, "<td class=\"clickable blue\" onClick=\"displayModal ($v_id, '$v_name', 'demote_admin', null);\">Yes</td>\n");
            } else {
                e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'promote_admin', null);\">No</td>\n");
            }
            e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'password', null);\">******</td>\n");
            e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'delete', null);\">delete</td>\n");
            e (2, "</tr>\n");
        }
    ?>
        </tbody>
    </table>
</div>

<div class="modal_dialog_container">
    <div class="modal_dialog">
        <h1></h1>
        <form method="post">
            <input type="hidden" name="id">
            <div id="current_fields">
                <label for="current_value">Current:</label>
                <input type="text" name="current_value" disabled>
            </div>
            <div id="new_fields">
                <label for="new_value">New:</label>
                <input type="text" name="new_value">
            </div>
            <div>
                <input type="button" value="Cancel" onClick="hideModal ();">
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
</div>

<script>
    function displayModal (p_id, p_name, p_field, p_value) {
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div#current_fields").style.display = "none";
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields").style.display = "none";
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "Save";
        document.querySelector (".modal_dialog_container > .modal_dialog > form > input[name=\"id\"]").value = p_id;
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields > input").type = "text";
        switch (p_field) {
            case "name":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#current_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_change_user_name";
                v_title = "Change name for ";
                break;
            case "email":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#current_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_change_user_email";
                v_title = "Change e-mail for ";
                break;
            case "activate":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "Activate";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_activate_user";
                v_title = "Activate ";
                break;
            case "disable":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "Disable";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_disable_user";
                v_title = "Disable ";
                break;
            case "promote_admin":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "Promote Admin";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_promote_admin";
                v_title = "Admin promotion for ";
                break;
            case "demote_admin":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "Demote";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_demote_admin";
                v_title = "Admin demotion for ";
                break;
            case "password":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_change_user_password";
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields > input").type = "password";
                v_title = "Change password for ";
                break;
            case "delete":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "I confirm I want to DELETE " + p_name + " user !";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_delete_user";
                v_title = "Delete ";
                break;
            default:
                return;
        }
        v_title += p_name + " (" + p_id + ")";
        document.querySelector (".modal_dialog_container > .modal_dialog > h1").innerHTML = v_title;
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[name=\"current_value\"]").value = p_value;
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[name=\"new_value\"]").value = p_value;
        document.querySelector (".modal_dialog_container").style.display = "flex";
        document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[name=\"new_value\"]").focus();
    }
    function hideModal () {
        document.querySelector (".modal_dialog_container").style.display = "none";
    }

    document.addEventListener("keydown", function(event) {
        // Check if the Esc key is pressed
        if (event.key === "Escape" || event.keyCode === 27) {
            hideModal ();
        }
    });
</script>

