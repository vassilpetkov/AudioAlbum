<?php

class PlaylistsController extends BaseController {

    protected function onInit() {
        $this->title = 'Playlists';
        $this->playlistsModel = new PlaylistsModel();
    }

    public function index() {
        $this->playlists = $this->playlistsModel->getAll();
    }

    public function create() {
        $this->songsModel = new SongsModel();
        $this->songs = $this->songsModel->getAll();
        if ($this->isPost()) {
            $name = $_POST['name'];
            $author_username = $_POST['author_username'];
            $song_ids = $_POST['song_ids'];
            if ($this->playlistsModel->create($name, $author_username, $song_ids)) {
                $this->addInfoMessage("Playlist created.");
                //$this->redirect("playlists");
            } else {
                $this->addErrorMessage("Cannot create playlist.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->playlistsModel->edit($id, $name)) {
                $this->addInfoMessage("Playlist edited.");
                $this->redirect("playlists");
            } else {
                $this->addErrorMessage("Cannot edit playlist.");
            }
        }

        $this->playlists = $this->playlistsModel->find($id);
        if (!$this->playlist) {
            $this->addErrorMessage("Invalid playlist.");
            $this->redirect("playlists");
        }
    }

    public function delete($id) {
        if ($this->playlistsModel->delete($id)) {
            $this->addInfoMessage("Playlist deleted.");
        } else {
            $this->addErrorMessage("Cannot delete playlist #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("playlists");
    }
}
