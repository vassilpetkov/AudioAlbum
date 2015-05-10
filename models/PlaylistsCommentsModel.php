<?php

class PlaylistsCommentsModel extends BaseModel{
    public function fetchAllForPlaylist($playlist_id) {
        $statement = self::$db->query(
            "SELECT p.id, text, username FROM playlists_comments p LEFT JOIN users u ON p.author_id = u.Id WHERE playlist_id = ".$playlist_id);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($column, $types, $value) {
        return parent::find("playlists_comments", $column, $types, $value);
    }

    public function create($author_username, $playlist_id, $comment) {
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
            "INSERT INTO playlists_comments VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("sii", $comment, $author_id, $playlist_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($column, $types, $id, $value) {
        return parent::edit("playlists_comments", $column, $types, $id, $value);
    }

    public function delete($column, $types, $value) {
        return parent::delete("playlists_comments", $column, $types, $value);
    }
}