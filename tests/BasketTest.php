<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\Basket;
use AcmeWidgetCo\Offers\BuyOneGetOneHalfPrice;

final class BasketTest extends TestCase
{
    private array $catalog = [
        'R01' => 32.95,
        'G01' => 24.95,
        'B01' => 7.95,
    ];

    private array $delivery = [
        50 => 4.95,
        90 => 2.95,
        PHP_INT_MAX => 0.0,
    ];

    private function basket(): Basket
    {
        return new Basket($this->catalog, $this->delivery, [new BuyOneGetOneHalfPrice()]);
    }

    public function test_b01_g01(): void
    {
        $basket = $this->basket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());
    }

    public function test_r01_r01(): void
    {
        $basket = $this->basket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());
    }

    public function test_r01_g01(): void
    {
        $basket = $this->basket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());
    }

    public function test_b01_b01_r01_r01_r01(): void
    {
        $basket = $this->basket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}
