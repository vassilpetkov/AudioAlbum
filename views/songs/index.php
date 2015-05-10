<div class="page-header">
    <h1>List of Songs</h1>
</div>
<form action="/songs/filter" method="post" class="form-horizontal">
    <fieldset>
        <legend>Filter songs</legend>
        <div class="form-group">
            <label for="song" class="col-lg-2 control-label">Song name:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="song" name="song" placeholder="Song name">
            </div>
        </div>
        <div class="form-group">
            <label for="playlist" class="col-lg-2 control-label">Playlist name:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="playlist" name="playlist" placeholder="Playlist name">
            </div>
        </div>
        <div class="form-group">
            <label for="genre" class="col-lg-2 control-label">Genre name:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </fieldset>
</form>
<a href="/songs/create" class="btn btn-primary">Upload new song</a>
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
    <?php foreach ($this->songs as $song) : ?>
        <tr>
            <td><a href="/songs/play/<?=$song['id'] ?>"><?= htmlspecialchars($song['title']) ?></a></td>
            <td><?= htmlspecialchars($song['artist_name']) ?></td>
            <td><?= htmlspecialchars($song['genre_name']) ?></td>
            <td><?= htmlspecialchars($song['year']) ?></td>
            <td>
                <?php if($song['rating_votes']) {
                    echo round($song['rating_score'] / $song['rating_votes'] + $song['rating_votes'] / 10, 2); }
                else {
                    echo 0;
                }?>
            </td>
            <td>
                <form method="post" action="/songs/vote">
                    <input type="text" name="song_id" value="<?= $song['id']; ?>" hidden />
                    <select name="score">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-xs">Vote</button>
                </form>
            </td>
                <td>
                    <a href="/songs/download/<?=$song['id'] ?>" class="btn btn-primary btn-xs">Download</a>
                    <?php if (isset($_SESSION['isAdmin'])) :?>
                    <a href="/songs/edit/<?=$song['id'] ?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="/songs/delete/<?=$song['id'] ?> " class="btn btn-primary btn-xs">Delete</a>
                    <?php endif?>
                </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>