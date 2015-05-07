<h1>List of Genres</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Score</th>
        <th colspan="2">Action</th>
    </tr>
    <?php foreach ($this->genres as $genre) : ?>
        <tr>
            <td><?= htmlspecialchars($genre['id']) ?></td>
            <td><?= htmlspecialchars($genre['genre_name']) ?></td>
            <td><a href="/genres/edit/<?=$genre['id'] ?>">[Edit]</td>
            <td><a href="/genres/delete/<?=$genre['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/genres/create">[Create New]</a>
