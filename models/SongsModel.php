<?php

class SongsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM songs s LEFT JOIN artists a ON s.artist_id = a.Id LEFT JOIN genres g ON s.genre_id = g.Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM songs WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function findByTitle($title) {
        $statement = self::$db->prepare(
            "SELECT * FROM songs WHERE title = ?");
        $statement->bind_param("s", $title);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($title, $artist_name = null, $genre_name = null, $year = null, $target_file) {
        if ($title == '') {
            return false;
        }
        if ($this->findByTitle($title)) {
            return false;
        }

        $artist_id = null;
        $genre_id = null;
        if($artist_name) {
            $artist_id = $this->CheckIfArtistExistsCreateAndGetId($artist_name);
        }
        if($genre_name) {
            $genre_id = $this->CheckIfGenreExistsCreateAndGetId($genre_name);
        }

        $statement = self::$db->prepare(
            "INSERT INTO songs VALUES(NULL, ?, ?, ?, ?, ?, null, null)");
        $statement->bind_param("siiis", $title, $artist_id, $genre_id, $year, $target_file);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE songs SET name = ? WHERE id = ?");
        $statement->bind_param("si", $name, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM songs WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteByTitle($title) {
        $statement = self::$db->prepare(
            "DELETE FROM songs WHERE title = ?");
        $statement->bind_param("s", $title);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function CheckIfArtistExistsCreateAndGetId($artist_name)
    {
        $this->artistsModel = new ArtistsModel();
        $artist = $this->artistsModel->findByName($artist_name);
        if ($artist) {
            $artist_id = $artist['id'];
            return $artist_id;
        } else {
            $this->artistsModel->create($artist_name);
            $artist = $this->artistsModel->findByName($artist_name);
            $artist_id = $artist['id'];
            return $artist_id;
        }
    }

    public function CheckIfGenreExistsCreateAndGetId($genre_name)
    {
        $this->genresModel = new GenresModel();
        $genre = $this->genresModel->findByName($genre_name);
        if ($genre) {
            $genre_id = $genre['id'];
            return $genre_id;
        } else {
            $this->genresModel->create($genre_name);
            $genre = $this->genresModel->findByName($genre_name);
            $genre_id = $genre['id'];
            return $genre_id;
        }
    }
}
