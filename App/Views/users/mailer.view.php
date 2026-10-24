<?php
/**
 * @var string $title
 * @var string $to
 * @var string $subject
 * @var string $body
 * @var string $success
 * @var string $error
 */
?>
<h3><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h3>

<?php if (isset($success)): ?>
    <p id="alertError" class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<?php if (isset($error)): ?>
    <p id="alertError" class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="post" action="/test-mailer">
    <label class="form-label" for="to">Destinatari</label>
    <input class="form-control mb-3" type="email" id="to" name="to"
           value="<?= htmlspecialchars($to, ENT_QUOTES, 'UTF-8') ?>" required>

    <label class="form-label" for="subject">Assumpte</label>
    <input class="form-control mb-3" type="text" id="subject" name="subject"
           value="<?= htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') ?>" required>

    <label class="form-label" for="body">Missatge</label>
    <textarea class="form-control mb-3" id="body" name="body" rows="5" required><?= htmlspecialchars($body, ENT_QUOTES, 'UTF-8') ?></textarea>

    <button class="btn btn-primary" type="submit">Enviar correu de prova</button>
</form>

<p class="mt-3"><a href="http://localhost:8025" target="_blank" rel="noopener">Obrir Mailpit</a></p>
