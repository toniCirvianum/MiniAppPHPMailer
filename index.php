<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/autoload.php';
require __DIR__.'/App/config/init.php';

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Controllers\TestMailerController;

$router = new Router();
//definicio de rutes

//ruta arrel
$router->get('/', [HomeController::class, 'index']);

// Formulari de prova d'enviament de correus amb Mailpit.
$router->get('/test-mailer', [TestMailerController::class, 'index']);
$router->post('/test-mailer', [TestMailerController::class, 'send']);

//rutes Crud productes, protegides
$router->get('/products', [ProductController::class, 'index']); //lista productes
$router->get('/products/create',[ProductController::class,'create']);//mostra form per crear products
$router->get('/products/{id}', [ProductController::class, 'show']); //mostra producte per id
$router->post('/products', [ProductController::class, 'store']);//desa producte
$router->get('/products/{id}/edit', [ProductController::class, 'edit']);//mostra producte per id per actualitzar
$router->put('/products/{id}', [ProductController::class, 'update']);//actualitza producte per id
$router->delete('/products/{id}', [ProductController::class, 'destroy']);//elimina producte per id

//rute de usuari sense protegir
$router->get('/login', [UserController::class, 'index']); //mostra form de login
$router->post('/login', [UserController::class, 'authenticate']); //realitza logica del login

//Rutes usuari protegides
$router->get('/logout',[UserController::class,'logout']);


//codi per enganya al servidor amb metodes PUT i DELETE
$method = $_SERVER['REQUEST_METHOD'];
//strtoupper --> converteix a majuscules
if ($method === 'POST' &&  
    isset($_POST['_method']) && 
    in_array(strtoupper($_POST['_method']), ['PUT', 'DELETE'], true)) {
    $method = strtoupper($_POST['_method']);
}
$router->dispatch($method, parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
