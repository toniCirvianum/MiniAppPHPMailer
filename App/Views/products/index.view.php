<?php

/**
 * @var string $title
 * @var string $error
 * @var array $products
 * @var string $role

 */
?>
<h4>Crear producte</h4>

<a href="/products/create" class="btn btn-primary">Crear producte</a>
<h3><?= htmlspecialchars($title) ?></h3>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Preu</th>
            <th>Categoria</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody><?php foreach ($products as $product): ?><tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td><a href="/products/<?= $product['id']?>"><?= htmlspecialchars($product['name']) ?></a></td>
                <td><?= number_format($product['price'], 2, ',', '.') ?> €</td>
                <td><?= htmlspecialchars($product['category']) ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/products/<?= $product['id']?>/edit"
                            class="btn btn-warning">
                            Editar
                        </a>
                        <?php // if ($role=='admin'): ?>
                        <form action="/products/<?= $product['id'] ?>" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                Eliminar
                            </button>
                        </form>
                        <?php //endif; ?>
                    </div>
                </td>
            </tr><?php endforeach; ?></tbody>
</table>