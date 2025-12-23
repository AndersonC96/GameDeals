<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $this->redirect('/');
        }
        $this->view('login');
    }

    public function authenticate() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if (empty($username) || empty($password)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                $this->redirect('/');
            } else {
                $error = "Usuário ou senha incorretos!";
            }
        }

        $this->view('login', ['error' => $error]);
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
}
