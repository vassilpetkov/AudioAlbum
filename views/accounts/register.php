<h1>Register</h1>

<form action="/accounts/register" method="post">
    <label for="username">Username:</label>
    <input id="username" type="text" name="username" />
    <br/>
    <label for="password">Password:</label>
    <input id="password" type="password" name="password" />
    <br/>
    <input type="submit" value="Register" />
    <a href="/accounts/login">Login</a>
</form>