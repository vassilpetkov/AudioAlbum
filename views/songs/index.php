<h1>List of Songs</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Score</th>
        <th>Vote</th>
        <th colspan="4">Action</th>
    </tr>
    <?php foreach ($this->songs as $song) : ?>
        <tr>
            <td><?= htmlspecialchars($song['id']) ?></td>
            <td><?= htmlspecialchars($song['title']) ?></td>
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
                    <span>0</span><input type="radio" name="score" value="0" >
                    <span>1</span><input type="radio" name="score" value="1" />
                    <span>2</span><input type="radio" name="score" value="2" />
                    <span>3</span><input type="radio" name="score" value="3" />
                    <span>4</span><input type="radio" name="score" value="4" />
                    <span>5</span><input type="radio" name="score" value="5" />
                    <input type="submit" value="Vote" />
                </form>
            </td>
            <td><a href="/songs/play/<?=$song['id'] ?>">[Play]</td>
            <td><a href="/songs/download/<?=$song['id'] ?>">[Download]</td>
            <td><a href="/songs/edit/<?=$song['id'] ?>">[Edit]</td>
            <td><a href="/songs/delete/<?=$song['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/songs/upload">[Upload New]</a>
