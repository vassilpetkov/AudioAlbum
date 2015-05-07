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