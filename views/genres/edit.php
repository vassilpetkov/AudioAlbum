<h1>Edit Existing Genre</h1>

<?php if ($this->genre) : ?>
<form method="post" action="/genres/edit/<?= $this->genre['id'] ?>">
    Genre name:
    <input type="text" name="name"
        value="<?= htmlspecialchars($this->genre['name']) ?>" />
    <br/>
    <input type="submit" value="Edit" />
    <a href="/genres">Cancel</a>
</form>
<?php endif ?>
