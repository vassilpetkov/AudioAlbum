<?php

class PlaylistsController extends BaseController {
    private $playlistsModel;

    protected function onInit() {
        $this->title = 'Playlists';
        $this->playlistsModel = new PlaylistsModel();
    }

    public function index() {
        $this->playlists = $this->playlistsModel->getAll();
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->playlistsModel->create($name)) {
                $this->addInfoMessage("Playlist created.");
                $this->redirect("playlists");
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
