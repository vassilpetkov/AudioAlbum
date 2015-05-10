<?php

class GenresController extends BaseController {
    private $genresModel;

    protected function onInit() {
        $this->title = 'Genres';
        $this->genresModel = new GenresModel();
    }

    public function index() {
        $this->genres = $this->genresModel->fetchAll();
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->genresModel->create("s", $name)) {
                $this->addInfoMessage("Genre created.");
                $this->redirect("genres");
            } else {
                $this->addErrorMessage("Cannot create genre.");
            }
        }
    }

    public function edit($id) {
        $this->authorizeAdmin();

        $this->genre = $this->genresModel->find("id", "i", $id);
        if (!$this->genre) {
            $this->addErrorMessage("Invalid genre.");
            $this->redirect("genres");
        }

        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->genresModel->edit("genre_name", "si", $id, $name)) {
                $this->addInfoMessage("Genre edited.");
                $this->redirect("genres");
            } else {
                $this->addErrorMessage("Cannot edit genre.");
            }
        }
    }

    public function delete($id) {
        $this->authorizeAdmin();
        if ($this->genresModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Genre deleted.");
        } else {
            $this->addErrorMessage("Cannot delete genre #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("genres");
    }
}
