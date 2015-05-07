<h1>List of Songs</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Score</th>
        <th colspan="2">Action</th>
    </tr>
    <?php foreach ($this->songs as $song) : ?>
        <tr>
            <td><?= htmlspecialchars($song['id']) ?></td>
            <td><?= htmlspecialchars($song['title']) ?></td>
            <td><?= htmlspecialchars($song['artist_name']) ?></td>
            <td><?= htmlspecialchars($song['genre_name']) ?></td>
            <td><?= htmlspecialchars($song['year']) ?></td>
            <td>
                <?php
                if($song['rating_votes']) {
                     echo $song['rating_score'] / $song['rating_votes'] + $song['rating_votes']; }
                else {
                    echo 0;
                }?>
            </td>
            <td><a href="/songs/edit/<?=$song['id'] ?>">[Edit]</td>
            <td><a href="/songs/delete/<?=$song['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/songs/create">[Create New]</a>
