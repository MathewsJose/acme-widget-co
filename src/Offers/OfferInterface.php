<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Offers;

interface OfferInterface
{
    public function apply(array $items, array $catalog): float;
}
