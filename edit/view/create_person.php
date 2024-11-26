<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Create a new person</h1>
    <div id="toolbar">
        <form method="post" action="?action=goto_main">
            <input type="submit" value="Main">
        </form>
        <form method="post" action="?action=goto_settings">
                <input type="submit" value="Settings">
        </form>
        <form method="post" action="?action=goto_persons">
            <input type="submit" value="Persons">
        </form>
        <form method="post" action="?action=do_logout">
                <input type="submit" value="Logout">
        </form>
    </div>

    <div class="flex_col">
    <!-- <div class="flex_central_menu"> -->

    <form method="post" action="?action=do_create_person">
        <table>
            <tbody>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" autofocus></td>
                </tr>
            </tbody>
        </table>
        <div>
            <input type="submit" value="Create">
        </div>
    </form>

    <!-- </div> -->
    </div>
</div>

<style>
    div.flex_col > form {
        display:flex;
        flex-direction:column;
    }

    div.flex_col > form > table > tbody > tr > td:nth-child(2),
    div.flex_col > form > table > tbody > tr > td:nth-child(2) > input,
    div.flex_col > form > table > tbody > tr > td:nth-child(2) > select {
        width:100%;
    }

    div.flex_col > form > table > tbody > tr > td > input,
    div.flex_col > form > table > tbody > tr > td > select {
        padding:1em;
    }

    div.flex_col > form > div > input[type="submit"] {
        margin-top:1em;
        padding:1em;
        width:100%;
    }
</style>



