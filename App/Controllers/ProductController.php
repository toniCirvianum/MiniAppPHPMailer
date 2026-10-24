<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');


    
        //A traves del model PRODUCT aconseguim tot els productes
        $p = new Product();
        $products = $p->getAll();
        $u = new User();
        $role = $u->getRole();
        //els passem a la vista amb el render
        $this->render('products/index', [
            'title' => 'Productes',
            'products' => $products,
            'role' => $role 
        ], 'app');
    }
    public function store()
    {
        
         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');

        //Recepció via POST
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? '',
            'category' => $_POST['category'] ?? ''
        ];
        //Validacions
        if (
            $data['name'] === '' ||
            $data['category'] === '' ||
            !is_numeric($data['price']) ||
            $data['price'] < 0
        ) {
            http_response_code(422);
            //Eviem error a la vista amb el layout app
            $this->render('products/create', [
                'title' => 'Crear producte',
                'error' => 'Les dades del producte no són vàlides'
            ],'app');

            return;
        }

        //Si arribem aqui ja podem crear el producte amb el MODEL PRODUCT
        $model = new Product();
        $model->create($data);
        $data="";

        $this->redirect('/products');
    }
    public function update($id)
    {
         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');
        //A traves del model recuperem el producte que te el id
        //que s'ha passat com a parametre
        $model = new Product();
        $product = $model->getById($id);
        //si no troba el producte mostrem error
        if ($product === null) {
            $n = new HomeController();
            $n->notFound();
            return;
        }
        //Desem info que rebem via POST
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? '',
            'category' => $_POST['category'] ?? ''
        ];
        //Validacions
        if (
            $data['name'] === '' ||
            $data['category'] === '' ||
            !is_numeric($data['price']) ||
            $data['price'] < 0
        ) {
            //Si no passa les validacions mostrem error amb el layout app
            http_response_code(422);
            $this->render('products/edit', [
                'title' => 'Editar producte',
                //Array_merge agafa els camps modificats de $data i els que no de $product
                'product' => array_merge($product, $data),
                'error' => 'Les dades del producte no són vàlides'
            ],'app');

            return;
        }


        $model->update($id, $data);

        $this->redirect('/products');
    }
    public function destroy($id)
    {

         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');
        //comprovem si es admin
        $this->hasRole('admin');
        //Esborrem fent servir el model
        $model = new Product();
        $deleted = $model->delete($id);

        if (!$deleted) {
            $n = new HomeController();
            $n->notFound();
            return;
        }

        $this->redirect('/products');
    }
    public function show($id)
    {
         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');
        //A traves del model recuperem el producte que te el id
        //que s'ha passat com a parametre
        $p = new Product();
        $product = $p->getById($id);
        //Enviem el productee a la vista a través del render
        if ($product) {
            $this->render('products/show', [
                'title' => 'detalls de producte',
                'product' => $product
            ]);
            return;
        }
        //si arribem fins aqui vol dir que no s'ha trobat el producte
        $n = new HomeController();
        $n->notFound();
    }

    public function create()
    {
         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');
        //Genera la vista de creació de productes amb el layout app
        $this->render('products/create', [
            'title' => 'Crear producte'
        ],'app');
    }

    public function edit($id)
    {
         //Si no s'ha fet login retorna a la pagina principal
        if (!$this->isAuthenticated()) $this->redirect('/');

        //A traves del model recuperem el producte que te el id
        //que s'ha passat com a parametre
        $model = new Product();
        $product = $model->getById($id);
        //Si no troba el producte mostrem error
        if ($product === null) {
            $hc = new HomeController;
            $hc->notFound();
            return;
        }
        //Mostrem vista per editar producte amb el layout app
        $this->render('products/edit', [
            'title' => 'Editar producte',
            'product' => $product
        ],'app');
    }
}
