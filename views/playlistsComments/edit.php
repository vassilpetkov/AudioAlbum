<form action="/playlistsComments/edit/<?= $this->playlistComment['id'] ?>" method="post" class="form-horizontal">
    <fieldset>
        <legend>Edit comment</legend>
        <div class="form-group">
            <label for="text" class="col-lg-2 control-label">Text:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="text" name="text" value="<?= htmlspecialchars($this->playlistComment['text']) ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="/playlists" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </fieldset>
</form>