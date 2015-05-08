<h1>List of Playlists</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Author</th>
        <th>Score</th>
        <th colspan="2">Action</th>
    </tr>
    <?php foreach ($this->playlists as $playlist) : ?>
        <tr>
            <td><?= htmlspecialchars($playlist['id']) ?></td>
            <td><?= htmlspecialchars($playlist['playlist_name']) ?></td>
            <td><?= htmlspecialchars($playlist['username']) ?></td>
            <td>
                <?php
                if($playlist['rating_votes']) {
                     echo $playlist['rating_score'] / $playlist['rating_votes'] + $playlist['rating_votes']; }
                else {
                    echo 0;
                }?>
            </td>
            <td><a href="/playlists/view/<?=$playlist['id'] ?>">[View]</td>
            <td><a href="/playlists/edit/<?=$playlist['id'] ?>">[Edit]</td>
            <td><a href="/playlists/delete/<?=$playlist['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/playlists/create">[Create New]</a>
