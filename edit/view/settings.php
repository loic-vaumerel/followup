<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Settings</h1>
    <?php generate_toolbar (["Main", "Settings"], [], ["Logout"]); ?>
    <!-- <div class="flex_central_menu"> -->
    <div class="flex_col central_menu">
        <form method="post" action="?action=goto_users">
            <input type="submit" value="Credentials - Users">
        </form>
        <form method="post" action="?action=goto_persons">
            <input type="submit" value="Data Types - Persons">
        </form>
        <form method="post" action="?action=goto_actions">
            <input type="submit" value="Data Types - Actions">
        </form>
        <form method="post" action="?action=goto_categories">
            <input type="submit" value="Data Types - Categories">
        </form>
        <form method="post" action="?action=goto_positions">
            <input type="submit" value="Data Types - Positions">
        </form>
    </div>
</div>
