<h1>Create New Playlist</h1>

<form method="post" action="/playlists/create">
    <input type="text" name="author_username" value="<?= $_SESSION['username']; ?>" hidden="true" />
    <label for="name">Playlist name:</label>
    <input type="text" name="name" id="name" />
    <br/>
    <span>Add songs</span>
    <br/>
    <?php foreach ($this->songs as $song) : ?>
        <label for="song"><?= htmlspecialchars($song['title']); ?></label>
        <input type="checkbox" name="song_ids[]" id="song" value="<?= htmlspecialchars($song['id']); ?>">
        <br />
    <?php endforeach ?>
    <input type="submit" value="Create">
    <a href="/playlists">Cancel</a>
</form>
