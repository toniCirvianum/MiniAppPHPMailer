<?php
/**
 * @var array $product
 */
?>
<h3><?= htmlspecialchars($product["name"]) ?></h3>
<p>ID: <?= htmlspecialchars($product["id"]) ?></p>
//La funcio format canvia el format numeri a dos decimals i agafa coma per 
//separador decimal i punt per separador de milers
<p>Preu: <?= number_format($product["price"], 2, ",", ".") ?> €</p>
<h4>Modificar producte</h4>


<a href="/products">Tornar</a>