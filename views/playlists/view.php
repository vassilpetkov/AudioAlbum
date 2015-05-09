
<h2><?= $this->playlist[0]['playlist_name']?></h2>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Genre</th>
        <th>Year</th>
        <th colspan="4">Action</th>
    </tr>
    <?php foreach ($this->playlist as $playlistSong) : ?>
    <tr>
        <td><?= htmlspecialchars($playlistSong['song_id']) ?></td>
        <td><?= htmlspecialchars($playlistSong['title']) ?></td>
        <td><?= htmlspecialchars($playlistSong['artist_name']) ?></td>
        <td><?= htmlspecialchars($playlistSong['genre_name']) ?></td>
        <td><?= htmlspecialchars($playlistSong['year']) ?></td>
        <td><a href="/songs/play/<?=$playlistSong['id'] ?>">[Play]</td>
        <td><a href="/songs/download/<?=$playlistSong['id'] ?>">[Download]</td>
        <td><a href="/songs/edit/<?=$playlistSong['id'] ?>">[Edit]</td>
        <td><a href="/songs/delete/<?=$playlistSong['id'] ?>">[Delete]</td>
    </tr>
    <?php endforeach ?>
</table>
<form method="post" action="/playlistsComments/create">
    <input type="text" name="author_username" value="<?= $_SESSION['username']; ?>" hidden />
    <input type="number" name="playlist_id" value="<?=$this->playlist[0]["id"]?>" hidden />
    <label for="comment">Leave a comment:</label>
    <input type="text" name="comment" id="comment" />
    <br/>
    <input type="submit" value="Post">
</form>
<?php if ($this->comments) { ?>
    <table>
        <tr>
            <th>User</th>
            <th>Comment</th>
        </tr>
        <?php foreach ($this->comments as $comment) : ?>
            <tr>
                <td><?= htmlspecialchars($comment['username']) ?></td>
                <td><?= htmlspecialchars($comment['text']) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php } ?>