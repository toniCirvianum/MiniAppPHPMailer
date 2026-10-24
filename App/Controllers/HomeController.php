<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

        if ($this->isAuthenticated()) {
            $this->redirect('/products');
        } else {
            $this->render('home/index', [
                'title' => 'Home',
                'message' => "Aplicació d'exemple per entendre el rotuer"
            ]);
        }
    }
    public function notFound()
    {
        http_response_code(404);
        $this->render('errors/404', ['title' => 'Pàgina no trobada']);
    }
}
