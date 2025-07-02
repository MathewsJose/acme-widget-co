<?php

require __DIR__ . '/../vendor/autoload.php';

use AcmeWidgetCo\Basket;
use AcmeWidgetCo\Offers\BuyOneGetOneHalfPrice;

$catalog = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95,
];

$deliveryRules = [
    50 => 4.95,
    90 => 2.95,
    PHP_INT_MAX => 0.0,
];

$offers = [new BuyOneGetOneHalfPrice()];

$basket = new Basket($catalog, $deliveryRules, $offers);

foreach ($argv as $i => $code) {
    if ($i === 0) continue;
    $basket->add($code);
}

echo "Total: $" . number_format($basket->total(), 2) . PHP_EOL;
