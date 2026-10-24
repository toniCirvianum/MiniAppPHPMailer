<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Mailer;

class TestMailerController extends Controller
{
    public function index()
    {
        $this->render('users/mailer', [
            'title' => 'Prova de correu',
            'to' => 'prova@miniapp.test',
            'subject' => 'Prova de PHPMailer i Mailpit',
            'body' => 'Hola! Aquest és un correu de prova enviat des de la MiniApp.'
        ]);
    }

    public function send()
    {   
        //desem les dades en l'array data
        $data = [
            'title' => 'Prova de correu',
            'to' => trim($_POST['to'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'body' => trim($_POST['body'] ?? '')
        ];
        //amb filer_var comrpovem que el mail es correcte
        if (!filter_var($data['to'], FILTER_VALIDATE_EMAIL) ||
            $data['subject'] === '' || $data['body'] === '') {
            http_response_code(422);
            $data['error'] = 'Introdueix un correu vàlid, un assumpte i un missatge.';
            $this->render('users/mailer', $data);
            return;
        }
        //Ara ja podem instanciar la classe Mailer per enviar el correu
        $mailer = new Mailer();
        if ($mailer->send($data['to'], $data['subject'], $data['body'])) {
            $data['success'] = 'Correu enviat correctament. Ja el pots consultar a Mailpit.';
        } else {
            http_response_code(502);
            $data['error'] = 'No s’ha pogut enviar el correu. Comprova que Mailpit està en marxa.';
        }

        $this->render('users/mailer', $data);
    }
}
