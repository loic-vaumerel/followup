<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Create a new user</h1>
    <div id="toolbar">
        <form method="post" action="?action=goto_main">
            <input type="submit" value="Main">
        </form>
        <form method="post" action="?action=goto_settings">
                <input type="submit" value="Settings">
        </form>
        <form method="post" action="?action=goto_users">
            <input type="submit" value="Users">
        </form>
        <form method="post" action="?action=do_logout">
                <input type="submit" value="Logout">
        </form>
    </div>

    <div class="flex_col">
    <!-- <div class="flex_central_menu"> -->

    <form method="post" action="?action=do_create_user">
        <table>
            <tbody>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" autofocus></td>
                </tr>
                <tr>
                    <td><label for="email">E-mail:</label></td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td><label for="active">Active:</label></td>
                    <td>
                        <select name="active">
                            <option value=0>No</option>
                            <option value=1>Yes</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="admin">Admin:</label></td>
                    <td>
                        <select name="admin">
                            <option value=0>No</option>
                            <option value=1>Yes</option>
                        </select>
                    </td>
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



