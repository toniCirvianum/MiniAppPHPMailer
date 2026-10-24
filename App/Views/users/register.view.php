<?php
/**
 * @var string $title
 * @var string $name
 * @var string $username
 * @var string $email
 * @var string $error
 * @var string $success
 */
?>
<h3><?= htmlspecialchars($title) ?></h3>

<?php if (isset($error)): ?>
    <p id="alertError" class="alert alert-danger"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p id="alertError" class="alert alert-success"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="/register">
    <label class="form-label" for="name">Nom</label>
    <!-- Amb el codi  *** htmlspecialchars($name ?? '') ***
       Quan obrim el formulari per primera vegada, el controlador només 
       passa $title i $message; per tant, $username encara no existeix. 
       Això evita l’avís de variable no definida i deixa el camp buit.       
       Quan retornem al formulari després d’un error de validació, podrem 
       passar-hi $username perquè conservi el valor introduït. -->
    <input class="form-control mb-3" type="text" id="name" name="name"
       value="<?= htmlspecialchars($name ?? '') ?>" autocomplete="name" required>

    <label class="form-label" for="username">Usuari</label>
    <input class="form-control mb-3" type="text" id="username" name="username"
           value="<?= htmlspecialchars($username ?? '') ?>" autocomplete="username" required>

    <label class="form-label" for="email">Correu electrònic</label>
    <input class="form-control mb-3" type="email" id="email" name="email"
           value="<?= htmlspecialchars($email ?? '') ?>" autocomplete="email" required>

    <label class="form-label" for="password">Contrasenya</label>
    <input class="form-control mb-3" type="password" id="password" name="password"
           autocomplete="new-password" required>

    <label class="form-label" for="password_confirmation">Confirma la contrasenya</label>
    <input class="form-control mb-3" type="password" id="password_confirmation" name="password_confirmation"
           autocomplete="new-password" required>

    <button class="btn btn-primary" type="submit">Registrar-me</button>
</form>

<p class="mt-3"><a href="/login">Tornar al login</a></p>
