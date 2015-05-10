<form action="/playlists/edit/<?= $this->playlist[0]['id'] ?>" method="post" class="form-horizontal">
    <fieldset>
        <legend>Edit existing playlist</legend>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Playlist name:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($this->playlist[0]['playlist_name']) ?>">
            </div>
        </div>
        <legend>Songs</legend>
        <div class="form-group">
            <div class="form-group">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Genre</th>
                            <th>Year</th>
                            <th>Added</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->songs as $song) : ?>
                        <tr>
                            <td><a href="/songs/play/<?=$song['id'] ?>"><?= htmlspecialchars($song['title']) ?></a></td>
                            <td><?= htmlspecialchars($song['artist_name']) ?></td>
                            <td><?= htmlspecialchars($song['genre_name']) ?></td>
                            <td><?= htmlspecialchars($song['year']) ?></td>
                            <td><input type="checkbox" name="song_ids[]" id="song" value="<?= htmlspecialchars($song['id']); ?>"
                        <?php if (in_array($song['id'], $this->playlistSongIds)) { echo "checked"; }?>></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
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