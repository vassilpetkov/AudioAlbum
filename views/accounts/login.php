<form action="/accounts/login" method="post" class="form-horizontal">
    <fieldset>
        <legend>Login</legend>
        <div class="form-group">
            <label for="username" class="col-lg-2 control-label">Username</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/accounts/register" class="btn btn-default">Register</a>
            </div>
        </div>
    </fieldset>
</form>