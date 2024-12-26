<?php
    if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0);

    function generate_toolbar ($p_left_items, $p_center_items, $p_right_items) {
        $v_url_list = ["Main"            => "?action=goto_main",
                       "Settings"        => "?action=goto_settings",
                       "Users"           => "?action=goto_users",
                       "Create User"     => "?action=goto_user_create",
                       "Persons"         => "?action=goto_persons",
                       "Create Person"   => "?action=goto_person_create",
                       "Positions"       => "?action=goto_positions",
                       "Create Position" => "?action=goto_position_create",
                       "Actions"         => "?action=goto_actions",
                       "Create Action"   => "?action=goto_action_create",
                       "Categories"      => "?action=goto_categories",
                       "Create Category" => "?action=goto_category_create",
                       "Logout"          => "?action=do_logout"];

        e (0, "<div id=\"toolbar\">");

        e (1, "<div class=\"left\">");
        foreach ($p_left_items as $v_text) {
            e (2, "<div><a href=\"$v_url_list[$v_text]\">$v_text</a></div>");
        }
        e (1, "</div>"); // .left

        e (1, "<div class=\"center\">");
        foreach ($p_center_items as $v_text) {
            e (2, "<div><a href=\"$v_url_list[$v_text]\">$v_text</a></div>");
        }
        e (1, "</div>"); // .center

        e (1, "<div class=\"right\">");
        foreach ($p_right_items as $v_text) {
            e (2, "<div><a href=\"$v_url_list[$v_text]\">$v_text</a></div>");
        }
        e (1, "</div>"); // .right

        e (0, "</div>"); // #toolbar
    }
?>