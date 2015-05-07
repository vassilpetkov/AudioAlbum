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

    public function changeUsername() {
        if ($this->isPost()) {
            $username = $_POST['username'];
            if ($this->accountsModel->changeUsername($username)) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Change successful.");
                $this->redirect("accounts", "profile");
            } else {
                $this->addErrorMessage("Change unsuccessful.");
            }
        }
    }

    public function changePassword() {
        if ($this->isPost()) {
            $oldPassword = $_POST['old-password'];
            $password = $_POST['new-password'];
            $passwordRepeat = $_POST['repeat-new-password'];
            if ($password != $passwordRepeat) {
                $this->addErrorMessage("Passwords do not match.");
                die();
            }

            if ($this->accountsModel->changePassword($oldPassword, $password)) {
                $this->addInfoMessage("Change successful.");
                $this->redirect("accounts", "profile");
            } else {
                $this->addErrorMessage("Change unsuccessful.");
            }
        }
    }

    public function profile() {

    }

    public function logout() {
        unset($_SESSION['username']);
        $this->addInfoMessage("Logged out.");
        $this->redirect("home");
    }
} 