<?php
require __DIR__ . '/includes.php';

use Shop\Core\DB;
use Shop\Module\Product\Product;
use Shop\Module\Product\ProductRepository;

// database

$mysql = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
$sql = sprintf('create schema %s', MYSQL_DATABASE);
$mysql->query($sql);

// structure

if (!file_exists('structure.sql')) {
    throw new RuntimeException('Cannot create database structure. "structure.sql" is missing.');
}
$sql = file_get_contents('structure.sql');
DB::getInstance()->multiQuery($sql);

// products

$count = 20;
$colors = ['red', 'orange', 'yellow', 'green', 'blue', 'violet', 'white', 'black'];
$names = ['Shoes', 'Skirt', 'Shirt', 'Trousers', 'Socks', 'Coat', 'Jacket', 'Pullover'];

$productRepository = ProductRepository::getInstance();
for ($i = 0; $i < $count; $i++) {
    $product = new Product();

    $product->setName($names[rand(0, count($names) - 1)]);
    $product->setColor($colors[rand(0, count($colors) - 1)]);

    $price = rand(1000, 100000) / 100;
    $product->setPriceNetto($price);
    $product->setPriceBrutto(round($price * 1.1, 2));

    $product->setImagePath(sprintf('img/product%d.jpg', rand(1, 8)));

    $productRepository->addItem($product);
}