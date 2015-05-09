<?php
$extension = pathinfo($this->song["path"],PATHINFO_EXTENSION);
if ($extension == "mp3") {
    $this->soundType = 'audio/mpeg';
}
if ($extension == "opus") {
    $this->soundType = 'audio/ogg; codecs="opus"';
}
if ($extension == "oog") {
    $this->soundType = 'audio/ogg';
}
if ($extension == "wav") {
    $this->soundType = 'audio/wav';
}
if ($extension == "weba") {
$this->soundType = 'audio/webm';
}?>

<audio controls class="center-block">
    <source src="<?=$this->song["path"]?>" type="<?=$this->soundType?>">
    Your browser does not support the audio element.
</audio>
<form method="post" action="/songsComments/create" class="form-horizontal">
    <fieldset>
        <legend>Leave a comment:</legend>
        <input type="text" name="author_username" value="<?= $_SESSION['username']; ?>" hidden />
        <input type="number" name="song_id" value="<?=$this->song["id"]?>" hidden />
        <div class="form-group">
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Post</button>
            <button type="reset" class="btn btn-default">Cancel</button>
        </div>
    </fieldset>
</form>
<?php if ($this->comments) : ?>
<table class="table table-striped table-hover ">
    <thead>
    <tr>
        <th>User</th>
        <th>Comment</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->comments as $comment) : ?>
        <tr>
            <td><?= htmlspecialchars($comment['username']) ?></td>
            <td><?= htmlspecialchars($comment['text']) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php endif ?>