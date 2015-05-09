<div class="page-header">
    <h1>List of Songs</h1>
</div>
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
                    <a href="/songs/edit/<?=$song['id'] ?>" class="btn btn-default btn-xs">Edit</a>
                    <a href="/songs/delete/<?=$song['id'] ?> " class="btn btn-default btn-xs">Delete</a>
                </td>
            <?php endif?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>