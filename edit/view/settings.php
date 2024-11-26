<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Settings</h1>
    <div id="toolbar">
        <form method="post" action="?action=goto_main">
            <input type="submit" value="Main">
        </form>
        <form method="post" action="?action=do_logout">
            <input type="submit" value="Logout">
        </form>
    </div>
    <div class="flex_central_menu">
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
            <input type="submit" value="Data Types - Category">
        </form>
        <form method="post" action="?action=goto_positions">
            <input type="submit" value="Data Types - Positions">
        </form>
    </div>
</div>
