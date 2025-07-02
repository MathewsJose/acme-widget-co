<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Offers;

final class BuyOneGetOneHalfPrice implements OfferInterface
{
    private string $productCode;

    public function __construct(string $productCode = 'R01')
    {
        $this->productCode = $productCode;
    }

    public function apply(array $items, array $catalog): float
    {
        $discount = 0.0;
        $count = count(array_filter($items, fn($item) => $item === $this->productCode));

        if ($count >= 2 && isset($catalog[$this->productCode])) {
            $price = $catalog[$this->productCode];
            $halfPriceItems = intdiv($count, 2);
            $discount = $halfPriceItems * ($price / 2);
        }

        return $discount;
    }
}
