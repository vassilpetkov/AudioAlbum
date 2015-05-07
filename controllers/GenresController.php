<?php

class GenresController extends BaseController {
    private $genresModel;

    protected function onInit() {
        $this->title = 'Genres';
        $this->genresModel = new GenresModel();
    }

    public function index() {
        $this->genres = $this->genresModel->getAll();
    }

    public function create() {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->genresModel->create($name)) {
                $this->addInfoMessage("Genre created.");
                $this->redirect("genres");
            } else {
                $this->addErrorMessage("Cannot create genre.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->genresModel->edit($id, $name)) {
                $this->addInfoMessage("Genre edited.");
                $this->redirect("genres");
            } else {
                $this->addErrorMessage("Cannot edit genre.");
            }
        }

        $this->genres = $this->genresModel->find($id);
        if (!$this->genre) {
            $this->addErrorMessage("Invalid genre.");
            $this->redirect("genres");
        }
    }

    public function delete($id) {
        if ($this->genresModel->delete($id)) {
            $this->addInfoMessage("Genre deleted.");
        } else {
            $this->addErrorMessage("Cannot delete genre #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("genres");
    }
}
