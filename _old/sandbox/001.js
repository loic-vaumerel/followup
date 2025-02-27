/*
<!-- <div class="modal_dialog" id="change_value_dialog">
    <div class="window">
        <h1>Change value</h1>
        <form method="post" action="">
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
</div> -->
*/

function $ (p_selector) {
    return document.querySelector (p_selector);
}
function $all (p_selector) {
    return document.querySelectorAll (p_selector);
}

function html_add_div (p_parent, p_classes = null, p_content = null) {
    v_div = document.createElement ("div");
    if (p_classes != null) {
        v_div.className = p_classes;
    }
    if (p_content != null) {
        v_div.innerHTML = p_content;
    }
    p_parent.appendChild (v_div);
    return v_div;
}

function html_add_title (p_parent, p_level, p_text) {
    v_title = document.createElement ("h" + p_level);
    v_title.innerHTML = p_text;
    p_parent.appendChild (v_title);
    return v_title;
}

function html_add_form (p_parent, p_method, p_action) {
    v_form = document.createElement ("form");
    v_form.method = p_method;
    v_form.action = p_action;
    p_parent.appendChild (v_form);
    return v_form;
}

function html_add_input (p_parent, p_type, p_name, p_value, p_class) {
    v_input = document.createElement ("input");
    if (p_type != null) {
        v_input.type = p_type;
    }
    if (p_name != null) {
        v_input.name = p_name;
    }
    if (p_value != null) {
        v_input.value = p_value;
    }
    p_parent.appendChild (v_input);
    return v_input;
}

function hide_modal () {
    v_item = $("div.modal_change_dialog_container");
    if (v_item) {
        v_item.remove ();
    }
}

function display_modal (p_item, p_parameters) {
    // console.log (p_parameters);
    // console.log (p_item.parentElement.querySelector ("td.id").innerHTML);
    // console.log (p_item.parentElement.querySelector ("td.name").innerHTML);

    if (!p_item.classList.contains ("clickable")) return;

    hide_modal ();
    v_container = html_add_div (document.body, "modal_change_dialog_container", null);
    v_dialog = html_add_div (v_container, "modal_change_dialog", null);
    p_parameters.forEach ((v_parameter) => {
        v_key_class    = v_parameter [0];
        v_key_value    = v_parameter [1];
        v_dialog_title = v_parameter [2];
        v_dialog_text  = v_parameter [3];
        v_form_action  = v_parameter [4];
        v_id           = v_parameter [5];
        v_old_value    = v_parameter [6];
        v_input_type   = v_parameter [7];
        v_button_text  = v_parameter [8];
        if (p_item.classList.contains (v_key_class)) {
            if (v_key_value == null || v_key_value == p_item.innerHTML) {
                v_title = html_add_title (v_dialog, 1, v_dialog_title);
                v_form = html_add_form (v_dialog, "post", "#");
                html_add_div (v_form, null, v_dialog_text);
                html_add_input (v_form, "hidden", "action", v_form_action);
                html_add_input (v_form, "hidden", "id", v_id);
                if (v_input_type != null) {
                    html_add_input (v_form, v_input_type, "new_value", v_old_value).focus ();
                }
                v_submit = html_add_input (v_form, "submit", null, v_button_text);
                if (v_input_type == null) {
                    v_submit.focus ();
                };
            }
        }
    });

    if (document.querySelector ("div.modal_change_dialog_container > div.modal_change_dialog > h1") == null) {
        html_add_title (v_dialog, 1, "/!\\ Not configured /!\\");
    }

    v_close_button = html_add_input (v_title, "button", null, "X");
    v_close_button.addEventListener ("click", function () {
        hide_modal ();
    });
}

document.addEventListener("keydown", function(event) {
    // Check if the Esc key is pressed
    if (event.key === "Escape" || event.keyCode === 27) {
        hide_modal ();
    }
});
