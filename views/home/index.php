<div class="page-header">
    <h1>Welcome to this Audio Album.</h1>
    <h2>Top playlists</h2>
</div>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Score</th>
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
        </tr>
    <?php endforeach ?>
    </tbody>
</table>