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

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->songsModel->create($name)) {
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
