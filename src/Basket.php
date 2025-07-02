<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class Basket
{
    private array $catalog;
    private array $deliveryRules;
    private array $offers;
    private array $items = [];

    public function __construct(array $catalog, array $deliveryRules, array $offers = [])
    {
        $this->catalog = $catalog;
        ksort($deliveryRules);
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalog[$productCode])) {
            throw new \InvalidArgumentException("Invalid product code: $productCode");
        }
        $this->items[] = $productCode;
    }

    public function total(): float
    {
        $itemCounts = array_count_values($this->items);
        $subTotal = 0.0;

        foreach ($itemCounts as $code => $count) {
            $subTotal += $this->catalog[$code] * $count;
        }

        foreach ($this->offers as $offer) {
            $subTotal -= $offer->apply($this->items, $this->catalog);
        }

        $delivery = 0.0;
        foreach ($this->deliveryRules as $threshold => $charge) {
            if ($subTotal < $threshold) {
                $delivery = $charge;
                break;
            }
        }

        return floor(($subTotal + $delivery) * 100) / 100;
    }
}
