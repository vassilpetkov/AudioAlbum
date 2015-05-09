<?php

class SongsModel extends BaseModel {
    public function fetchAll() {
        $statement = self::$db->query("SELECT * FROM songs s LEFT JOIN artists a ON s.artist_id = a.Id LEFT JOIN genres g ON s.genre_id = g.Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($column, $types, $value) {
        return parent::find("songs", $column, $types, $value);
    }

    public function create($title, $artist_name = null, $genre_name = null, $year = null, $target_file) {
        if ($title == '') {
            return false;
        }
        if ($this->find("title", "s", $title)) {
            return false;
        }

        $artist_id = null;
        $genre_id = null;
        if($artist_name) {
            $this->artistsModel = new ArtistsModel();
            $artist = $this->artistsModel->find("artist_name", "s", $artist_name);
            if ($artist) {
                $artist_id = $artist['id'];
            }
            else {
                $this->artistsModel->create("s", $artist_name);
                $artist = $this->artistsModel->find("artist_name", "s", $artist_name);
                $artist_id = $artist['id'];
            }
        }
        if($genre_name) {
            $this->genresModel = new GenresModel();
            $genre = $this->genresModel->find("genre_name", "s", $genre_name);
            if ($genre) {
                $genre_id = $genre['id'];
                return $genre_id;
            } else {
                $this->genresModel->create("s", $genre_name);
                $genre = $this->genresModel->find("genre_name", "s", $genre_name);
                $genre_id = $genre['id'];
                return $genre_id;
            }
        }

        $statement = self::$db->prepare(
            "INSERT INTO songs VALUES(NULL, ?, ?, ?, ?, ?, null, null)");
        $statement->bind_param("siiis", $title, $artist_id, $genre_id, $year, $target_file);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function delete($column, $types, $value) {
        return parent::delete("songs", $column, $types, $value);
    }

    public function vote($id, $score) {
        $song = $this->find("id", "i", $id);
        return parent::vote("songs", $song, $score);
    }
}
