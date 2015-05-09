<div class="page-header">
    <h1>Genres</h1>
</div>
<a href="/genres/create" class="btn btn-primary">Create New</a>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($this->genres as $genre) : ?>
        <tr>
            <td><?= htmlspecialchars($genre['genre_name']) ?></td>
            <?php if (isset($_SESSION['isAdmin'])) :?>
            <td>
                <a href="/genres/edit/<?=$genre['id'] ?>" class="btn btn-default btn-xs">Edit</a>
                <a href="/genres/delete/<?=$genre['id'] ?>" class="btn btn-default btn-xs">Delete</a>
            </td>
            <?php endif?>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

