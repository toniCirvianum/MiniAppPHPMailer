<?php

//Produictes inicials de prova. Es carreguen nomes un cop
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        [
            'id' => 1,
            'name' => 'Mechanical Keyboard',
            'price' => 59.90,
            'category' => 'Peripherals'
        ],
        [
            'id' => 2,
            'name' => 'Gaming Mouse',
            'price' => 29.90,
            'category' => 'Peripherals'
        ],
        [
            'id' => 3,
            'name' => 'Monitor 24"',
            'price' => 149.90,
            'category' => 'Monitors'
        ],
        [
            'id' => 4,
            'name' => 'USB-C Hub',
            'price' => 34.90,
            'category' => 'Accessories'
        ],
        [
            'id' => 5,
            'name' => 'Webcam Full HD',
            'price' => 49.90,
            'category' => 'Peripherals'
        ],
        [
            'id' => 6,
            'name' => 'SSD 1TB',
            'price' => 89.90,
            'category' => 'Storage'
        ],
        [
            'id' => 7,
            'name' => 'Laptop Stand',
            'price' => 24.90,
            'category' => 'Accessories'
        ]
    ];
}


// Usuaris inicials de prova (només quan encara no existeixen a la sessió).
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        [
            'id' => 1,
            'username' => 'admin',
            'name' => 'Toni Fernandez',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ],
        [
            'id' => 2,
            'username' => 'raquel',
            'name' => 'Raquel Boronat',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'role' => 'user'
        ]
    ];
}
