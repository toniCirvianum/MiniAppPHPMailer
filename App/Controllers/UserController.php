<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $this->render('users/index', [
            'title' => 'Iniciar sessió'
        ]);
    }

    public function authenticate()
    {
        //el trim elimina els espais
        $username = trim($_POST['username']) ?? '';
        $password = $_POST['password'] ?? '';
        $model = new User();
        $user = $model->validateCredentials($username, $password);
        //si les credencials son incorrectes
        if ($user === null) {
            http_response_code(401);
            $this->render('users/index', [
                'title' => 'Iniciar sessió',
                'error' => 'Usuari o contrasenya incorrectes',
                'username' => $username
            ]);
            return;
        }
        //si tot es correce desem usuari logejat
        $model->setUSerSession($username);
        //redirigim a dins l'app
        $this->redirect('/products');
    }

    public function logout()
    {
        if ($this->isAuthenticated()) {
            $u = new User;
            $u->destroyUserSession();
            //redirigim a l'inici
            $this->redirect('/');
        }
        http_response_code(403);
        $this->render('errors/403', [
            'title' => 'Error 403: Accés denegat'
        ]);
        exit;
    }

    public function register()
    {
        $this->render('users/register', [
            'title' => "Crear nou usuari",
            'message' => "Cal implementar form del register i enviar a un metode al Usercontroller per exemple store"
        ]);
    }
}
