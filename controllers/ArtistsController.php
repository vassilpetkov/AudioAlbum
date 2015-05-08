<?php

class ArtistsController extends BaseController {
    private $artistsModel;

    protected function onInit() {
        $this->title = 'Artists';
        $this->artistsModel = new ArtistsModel();
    }

    public function index() {
        $this->artists = $this->artistsModel->fetchAll();
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->artistsModel->create("s", $name)) {
                $this->addInfoMessage("Artist created.");
                $this->redirect("artists");
            } else {
                $this->addErrorMessage("Cannot create artist.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->artistsModel->edit($id, $name)) {
                $this->addInfoMessage("Artist edited.");
                $this->redirect("artists");
            } else {
                $this->addErrorMessage("Cannot edit artist.");
            }
        }

        $this->artists = $this->artistsModel->find($id);
        if (!$this->artist) {
            $this->addErrorMessage("Invalid artist.");
            $this->redirect("artists");
        }
    }

    public function delete($id) {
        if ($this->artistsModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Artist deleted.");
        } else {
            $this->addErrorMessage("Cannot delete artist #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("artists");
    }
}
