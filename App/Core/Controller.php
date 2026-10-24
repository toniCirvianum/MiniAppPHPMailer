<?php

namespace App\Core;

use App\Models\Product;
use App\Models\User;

class Controller
{
    protected function render($path, $params = [], $layout = 'main')
    {
        extract($params);

        ob_start();
        $path2 = __DIR__ . '/../Views/' . $path . '.view.php';
        require __DIR__ . '/../Views/' . $path . '.view.php';
        $content = ob_get_clean();
        $path3 = __DIR__ . '/../Views/layouts/' . $layout . '.layout.php';
        require __DIR__ . '/../Views/layouts/' . $layout . '.layout.php';
    }

    //metode per comprovar si s'ha fet login
    protected function isAuthenticated()
    {
        if (isset($_SESSION['user_logged'])) {
            return true;
        }
        return false;
    }

    //retorna true si l'usuair te el rol que hem passat com a parametre
    // en cas contrari mostra missatge de Acces denegat
    protected function hasRole($role)
    {
        $u = new User;
        $roleUserLogged = $u->getRole();
        if ($this->isAuthenticated()) {
            if ($roleUserLogged == $role) {
                return true;
            }
        }
        http_response_code(403);
        $this->render('errors/403', [
            'title' => 'Accés denegat'
        ]);
        exit;
    }


    //redirigeix a la ruta que passem per parametre
    protected function redirect($url)
    {
        header('Location: ' . $url, true, 303);
        exit;
    }
}
