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

    public function register() {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $this->redirect('/');
        }
        $this->view('register');
    }

    public function store() {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $error = '';
        $success = '';

        if (empty($username) || empty($password) || empty($confirmPassword)) {
            $error = "Por favor, preencha todos os campos.";
        } elseif (strlen($username) < 3) {
            $error = "O usuário deve ter pelo menos 3 caracteres.";
        } elseif (strlen($password) < 4) {
            $error = "A senha deve ter pelo menos 4 caracteres.";
        } elseif ($password !== $confirmPassword) {
            $error = "As senhas não coincidem.";
        } else {
            $userModel = new User();
            $existingUser = $userModel->findByUsername($username);
            
            if ($existingUser) {
                $error = "Este nome de usuário já está em uso.";
            } else {
                $created = $userModel->create($username, $password);
                if ($created) {
                    $success = "Conta criada com sucesso! Faça login.";
                } else {
                    $error = "Erro ao criar conta. Tente novamente.";
                }
            }
        }

        $this->view('register', ['error' => $error, 'success' => $success]);
    }
}
