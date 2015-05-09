<h1>Welcome to this Audio Album.</h1>
<h2>Top playlists</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Author</th>
        <th>Score</th>
        <th>Vote</th>
        <th colspan="3">Action</th>
    </tr>
    <?php foreach ($this->playlists as $playlist) : ?>
        <tr>
            <td><?= htmlspecialchars($playlist['id']) ?></td>
            <td><?= htmlspecialchars($playlist['playlist_name']) ?></td>
            <td><?= htmlspecialchars($playlist['username']) ?></td>
            <td>
                <?php
                    if($playlist['rating_votes']) {
                        echo round($playlist['rating_score'] / $playlist['rating_votes'] + $playlist['rating_votes'] / 10, 2); }
                    else {
                        echo 0;
                    }
                ?>
            </td>
            <td>
                <form method="post" action="/playlists/vote">
                    <input type="text" name="playlist_id" value="<?= $playlist['id']; ?>" hidden />
                    <span>0</span><input type="radio" name="score" value="0" >
                    <span>1</span><input type="radio" name="score" value="1" />
                    <span>2</span><input type="radio" name="score" value="2" />
                    <span>3</span><input type="radio" name="score" value="3" />
                    <span>4</span><input type="radio" name="score" value="4" />
                    <span>5</span><input type="radio" name="score" value="5" />
                    <input type="submit" value="Vote" />
                </form>
            </td>
            <td><a href="/playlists/view/<?=$playlist['id'] ?>">[View]</td>
            <td><a href="/playlists/edit/<?=$playlist['id'] ?>">[Edit]</td>
            <td><a href="/playlists/delete/<?=$playlist['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>