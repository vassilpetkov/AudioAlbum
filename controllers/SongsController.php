<?php

class SongsController extends BaseController {
    private $songsModel;

    protected function onInit() {
        $this->title = 'Songs';
        $this->songsModel = new SongsModel();
    }

    public function index() {
        $this->songs = $this->songsModel->getAll();
    }

    public function create($title, $artist_name, $genre_name, $year, $target_file) {
        if ($this->isPost()) {
            if ($this->songsModel->create($name)) {
                $this->addInfoMessage("Song created.");
                $this->redirect("songs");
            } else {
                $this->addErrorMessage("Cannot create song.");
            }
        }
    }

    public  function upload() {
        if ($this->isPost()) {
            $title = $_POST['title'];
            $artist_name = $_POST['artist'];
            $genre_name = $_POST['genre'];
            $year = (int)$_POST['year'];
            $target_dir = "content/songs/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if (file_exists($target_file)) {
                $this->addErrorMessage("The file already exists.");
                die();
            }
            if ($_FILES["fileToUpload"]["size"] > 50000000) {
                $this->addErrorMessage("The file is too large.");
                die();
            }
            if ($fileType != "mp3" && $fileType != "opus" && $fileType != "wav" && $fileType != "weba"
                && $fileType != "oog") {
                $this->addErrorMessage("Only .mp3, .wav, .oog, .weba or .opus files are allowed");
                die();
            }
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)
                && $this->songsModel->create($title, $artist_name, $genre_name, $year, $target_file)) {
                $this->addInfoMessage("Song created.");
                $this->redirect("songs");
            } else {
                $this->addErrorMessage("Cannot create song.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            $name = $_POST['name'];

            if ($this->songsModel->edit($id, $name)) {
                $this->addInfoMessage("Song edited.");
                $this->redirect("songs");
            } else {
                $this->addErrorMessage("Cannot edit song.");
            }
        }

        $this->songs = $this->songsModel->find($id);
        if (!$this->song) {
            $this->addErrorMessage("Invalid song.");
            $this->redirect("songs");
        }
    }

    public function delete($id) {
        if ($this->songsModel->delete($id)) {
            $this->addInfoMessage("Song deleted.");
        } else {
            $this->addErrorMessage("Cannot delete song #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("songs");
    }
}
