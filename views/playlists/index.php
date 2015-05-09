<div class="page-header">
    <h1>List of Playlists</h1>
</div>
<a href="/playlists/create" class="btn btn-primary">Create new playlist</a>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Score</th>
            <th>Vote</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($this->playlists as $playlist) : ?>
        <tr>
            <td><a href="/playlists/view/<?=$playlist['id'] ?>"><?= htmlspecialchars($playlist['playlist_name']) ?></a></td>
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
                <a href="/playlists/edit/<?=$playlist['id'] ?>" class="btn btn-default btn-xs">Edit</a>
                <a href="/playlists/delete/<?=$playlist['id'] ?> " class="btn btn-default btn-xs">Delete</a>
            </td>
            <?php endif?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
