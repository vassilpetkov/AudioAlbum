<div class="page-header">
    <h1><?= $this->playlist[0]['playlist_name']?></h1>
</div>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Score</th>
            <th>Vote</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($this->playlist as $playlistSong) : ?>
        <tr>
            <td><a href="/songs/play/<?=$playlistSong['id'] ?>"><?= htmlspecialchars($playlistSong['title']) ?></a></td>
            <td><?= htmlspecialchars($playlistSong['artist_name']) ?></td>
            <td><?= htmlspecialchars($playlistSong['genre_name']) ?></td>
            <td><?= htmlspecialchars($playlistSong['year']) ?></td>
            <td>
                <?php if($playlistSong['rating_votes']) {
                    echo round($playlistSong['rating_score'] / $playlistSong['rating_votes'] + $playlistSong['rating_votes'] / 10, 2); }
                else {
                    echo 0;
                }?>
            </td>
            <td>
                <form method="post" action="/songs/vote">
                    <input type="text" name="song_id" value="<?= $playlistSong['song_id']; ?>" hidden />
                    <select>
                        <option name="score" value="0">0</option>
                        <option name="score" value="1">1</option>
                        <option name="score" value="2">2</option>
                        <option name="score" value="3">3</option>
                        <option name="score" value="4">4</option>
                        <option name="score" value="5">5</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-xs">Vote</button>
                </form>
            </td>
            <?php if (isset($_SESSION['isAdmin'])) :?>
                <td>
                    <a href="/songs/edit/<?=$playlistSong['id'] ?>" class="btn btn-default btn-xs">Edit</a>
                    <a href="/songs/delete/<?=$playlistSong['id'] ?> " class="btn btn-default btn-xs">Delete</a>
                </td>
            <?php endif?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<form method="post" action="/playlistsComments/create" class="form-horizontal">
    <fieldset>
        <legend>Leave a comment:</legend>
        <input type="text" name="author_username" value="<?= $_SESSION['username']; ?>" hidden />
        <input type="number" name="playlist_id" value="<?=$this->playlist[0]["id"]?>" hidden />
        <div class="form-group">
            <div class="col-lg-10">
            <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Post</button>
            <button type="reset" class="btn btn-default">Cancel</button>
        </div>
    </fieldset>
</form>
<?php if ($this->comments) : ?>
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>User</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($this->comments as $comment) : ?>
            <tr>
                <td><?= htmlspecialchars($comment['username']) ?></td>
                <td><?= htmlspecialchars($comment['text']) ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>