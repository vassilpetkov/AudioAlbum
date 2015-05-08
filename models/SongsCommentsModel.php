<?php

class SongsCommentsModel extends BaseModel{
    public function fetchAllForSong($song_id) {
        $statement = self::$db->query(
            "SELECT s.id, text, username FROM songs_comments s LEFT JOIN users u ON s.author_id = u.Id WHERE song_id = ".$song_id);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function create($author_username, $song_id, $comment) {
        if ($comment == '') {
            return false;
        }
        if (!$comment) {
            return false;
        }

        $this->accountsModel = new AccountsModel();
        $author = $this->accountsModel->find("username", "s", $author_username);
        $author_id = $author["id"];

        $statement = self::$db->prepare(
            "INSERT INTO songs_comments VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("sii", $comment, $author_id, $song_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}