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
}
?>
<audio controls autoplay="autoplay">
    <source src="<?=$this->song["path"]?>" type="<?=$this->soundType?>">
    Your browser does not support the audio element.
</audio>
<form method="post" action="/songsComments/create">
    <input type="text" name="author_username" value="<?= $_SESSION['username']; ?>" hidden="true" />
    <input type="number" name="song_id" value="<?=$this->song["id"]?>" hidden="true" />
    <label for="comment">Leave a comment:</label>
    <input type="text" name="comment" id="comment" />
    <br/>
    <input type="submit" value="Post">
</form>
<?php if ($this->comments) { ?>
    <table>
        <tr>
            <th>User</th>
            <th>Comment</th>
        </tr>
        <?php foreach ($this->comments as $comment) : ?>
            <tr>
                <td><?= htmlspecialchars($comment['username']) ?></td>
                <td><?= htmlspecialchars($comment['text']) ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php } ?>