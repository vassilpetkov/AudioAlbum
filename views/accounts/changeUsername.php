<form action="/accounts/changeUsername" method="post" class="form-horizontal">
    <fieldset>
        <legend>Change username</legend>
        <div class="form-group">
            <label for="username" class="col-lg-2 control-label">New username:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Change</button>
                <a href="/accounts/profile" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </fieldset>
</form>