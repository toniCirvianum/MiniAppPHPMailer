<h3>Login</h3>
<div>
    <?php if (isset($error)):?>
        <p id="alertError" class="alert alert-danger"><?= $error ?></p>
        <?php unset($error); ?>
    <?php endif; ?>
</div>

<form method="post" action="/login">
    <input class="form-control mb-2" name="username" placeholder="Usuari" required>
    <input class="form-control mb-2" type="password" name="password" placeholder="Contrasenya" required><button class="btn btn-primary">Entrar</button>
</form>


