<h1>Login</h1>

<form action="/accounts/login" method="post">
    <label for="username">Username:</label>
    <input id="username" type="text" name="username" />
    <br/>
    <label for="password">Password:</label>
    <input id="password" type="password" name="password" />
    <br/>
    <input type="submit" value="Login" />
    <a href="/accounts/register">Register</a>
</form>