<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Persons</h1>
    <div id="toolbar">
        <form method="post" action="?action=goto_main">
            <input type="submit" value="Main">
        </form>
        <form method="post" action="?action=goto_settings">
            <input type="submit" value="Settings">
        </form>
        <form method="post" action="?action=goto_create_person">
            <input type="submit" value="Create Person">
        </form>
        <form method="post" action="?action=do_logout">
            <input type="submit" value="Logout">
        </form>
    </div>

    <table>
        <thead>
            <td>Id</td>
            <td>Name</td>
            <td>Delete</td>
        </thead>
        <tbody>
    <?php
        function e (int $p_spaces, string $p_text) {
            echo (str_repeat ("    ", $p_spaces) . $p_text);
        }

        foreach ($v_dbm_ro->listAllPersons () as $v_person) {
            $v_id     = $v_person ["id"];
            $v_name   = $v_person ["name"];

            e (2, "<tr>\n");
            e (3, "<td>$v_id</td>\n");
            e (3, "<td class=\"clickable\" onClick=\"displayModal ($v_id, '$v_name', 'name', '$v_name');\">$v_name</td>\n");
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
        switch (p_field) {
            case "name":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#current_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div#new_fields").style.display = "block";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_change_person_name";
                v_title = "Change name for ";
                break;
            case "delete":
                document.querySelector (".modal_dialog_container > .modal_dialog > form > div > input[type=\"submit\"]").value = "I confirm I want to DELETE " + p_name + " person !";
                document.querySelector (".modal_dialog_container > .modal_dialog > form").action="?action=do_delete_person";
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

