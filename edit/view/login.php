<link rel="stylesheet" href="view/global.css">

<style>
    div#container {
        background-color:#DDDDDD;
        height:100vh;
        display:flex;
    }
    div#container > form {
        background-color:#FFFFFF;
        border-radius:0.5em;
        margin:auto;
        padding:0.5em;
        display:flex;
        flex-direction: column; 
    }
    div#container > form > input {
        border-radius:0.5em;
        border:solid 1px #DDDDDD;
        margin:1em;
        padding:1em;
    }
    div#container > form > h1 {
        text-align:center;
    }
</style>

<div id="container">
    <form method="post" action="?action=do_login">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Login">
    </form>
</div>

