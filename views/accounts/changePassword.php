<form action="/accounts/changePassword" method="post" class="form-horizontal">
    <fieldset>
        <legend>Change password</legend>
        <div class="form-group">
            <label for="old-password" class="col-lg-2 control-label">Old password:</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Old password">
            </div>
        </div>
        <div class="form-group">
            <label for="new-password" class="col-lg-2 control-label">New password:</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New password">
            </div>
        </div>
        <div class="form-group">
            <label for="repeat-new-password" class="col-lg-2 control-label">Repeat new password:</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="repeat-new-password" name="repeat-new-password" placeholder="Repeat new password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="/accounts/login" class="btn btn-default">Login</a>
            </div>
        </div>
    </fieldset>
</form>