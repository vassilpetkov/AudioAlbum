<form action="/genres/create" method="post" class="form-horizontal">
    <fieldset>
        <legend>Create New Genre</legend>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Genre name:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/genres" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </fieldset>
</form>
