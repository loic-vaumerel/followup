<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once ('../tools/f_safe_require_once.php');
    f_safe_require_once ('../tools/init.php');

    function generate_links ($p_path) {
        foreach (glob ($p_path . "/*") as $v_file) {
            if (in_array ($v_file, ["../_old", "../db", "../dev", "../phpunit", "../sandbox", ])) continue;
            if (is_file ($v_file)) {
                echo ("<div><a href=$v_file>$v_file</a></div>");
            } elseif (is_dir ($v_file)) {
                // echo ($v_file . "/*");
                generate_links ($v_file);
            }
            // echo (">> " . $v_file . "<br>");
        }
    }

    generate_links ("..");

    function list_files ($p_path) {
        $v_files = array ();
        foreach (glob ($p_path . "/*") as $v_file) {
            if (is_file ($v_file)) {
                array_push ($v_files, $v_file);
            } elseif (is_dir ($v_file)) {
                foreach (list_files ($v_file) as $v_file) {
                    array_push ($v_files, $v_file);
                }
            }
        }
        return $v_files;
    }
    $v_files = list_files ("..");
    $v_actions = array ();
    foreach ($v_files as $v_file) {
        foreach (file ($v_file) as $v_line) {
            if (preg_match ('/\?action=/', $v_line)) {
                $v_action = substr ($v_line, strpos ($v_line, '?action='));
                $v_pos = strpos ($v_action, '"');
                if (!$v_pos) $v_pos = strpos ($v_action, "'");
                if ($v_pos) $v_action = substr ($v_action, 0, $v_pos);
                $v_actions [$v_action] = $v_action;
            }
        }
    }
    asort ($v_actions);
    foreach ($v_actions as $v_action) {
        echo ("<div><a href=\"../edit/$v_action\">$v_action</a></div>");
    }

    echo ("<pre>"); print_r ($v_files); echo ("</pre>");
    // echo ("<pre>"); print_r ($v_actions); echo ("</pre>");


    // $v_actions = array ();

    // function list_action_links ($p_path, $p_actions) {
    //     foreach (glob ($p_path . "/*") as $v_file) {
    //         if (is_file ($v_file)) {
    //             foreach (file ($v_file) as $v_line) {
    //                 if (preg_match ('/\?action=/', $v_line)) {
    //                     $v_action = substr ($v_line, strpos ($v_line, '?action='));
    //                     $v_pos = strpos ($v_action, '"');
    //                     if (!$v_pos) $v_pos = strpos ($v_action, "'");
    //                     if ($v_pos) $v_action = substr ($v_action, 0, $v_pos);
    //                     $p_actions [$v_action] = $v_action;
    //                 }
    //             }
    //         } elseif (is_dir ($v_file)) {
    //             list_action_links ($v_file, $p_actions);
    //         }
    //     }
    // }

    // list_action_links ("..", $v_actions);
    // echo ("<pre>"); print_r ($v_actions); echo ("</pre>");

    // print_r (glob ("../db/*"));
//     $config=file_get_contents('../edit/index.php');
// $currentprofile=preg_grep('/actixon=/', $config);
// echo "Current Profile: ".$currentprofile;
    // $v_actions = array ();
    // $v_file = '../edit/index.php';
    // foreach (file ($v_file) as $v_line) {
    //     if (preg_match ('/\?action=/', $v_line)) {
    //         $v_action = substr ($v_line, strpos ($v_line, '?action='));
    //         $v_pos = strpos ($v_action, '"');
    //         if (!$v_pos) $v_pos = strpos ($v_action, "'");
    //         if ($v_pos) $v_action = substr ($v_action, 0, $v_pos);
    //         // array_push ($v_actions, $v_line);
    //         // array_push ($v_actions, $v_action);
    //         $v_actions [$v_action] = $v_action;
    //     }
    // }

    // echo ("<pre>"); print_r ($v_actions); echo ("</pre>");
?>