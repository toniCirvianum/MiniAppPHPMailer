<?php

/** @var string $content */ ?>
<!doctype html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Exemple router') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script>
        //executa function despres d'un temps determinat 2000ms=2seg
        setTimeout(function() {
            //accedeix al element per id, en aquesta cas al paragraf "p"
            const alert = document.getElementById('alertError');

            if (alert) {
                alert.remove();
            }
        }, 2000);
    </script>
    <div class="container py-4">
        <header>
            <h2>Exemples de router PHP</h2>
            <nav class="d-flex gap-3 mb-3">
                <a href="/">Inici</a>
                <a href="/login">Login</a>
                <a href="#">Register</a>
                <a href="/test-mailer">Prova de correu</a>
            </nav>
        </header>
        <hr>
        <main><?= $content ?></main>
        <hr>
        <footer class="text-center">PHP · Router, autoload i render</footer>
    </div>
</body>

</html>
