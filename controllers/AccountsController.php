<?php

class AccountsController extends BaseController {
    private $accountsModel;

    protected function onInit() {
        $this->title = 'Accounts';
        $this->accountsModel = new AccountsModel();
    }

    public function register() {
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->accountsModel->register($username, $password)) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage("User registered.");
                $this->redirect("home");
            } else {
                $this->addErrorMessage("Cannot create user.");
            }
        }
    }

    public function login() {
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->accountsModel->login($username, $password)) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Login successful.");
                $this->redirect("home");
            } else {
                $this->addErrorMessage("Login unsuccessful.");
            }
        }
    }

    public function logout() {
        unset($_SESSION['username']);
        $this->addInfoMessage("Logged out.");
        $this->redirect("home");
    }
} 