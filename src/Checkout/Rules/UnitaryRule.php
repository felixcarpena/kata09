<?php
declare(strict_types = 1);

namespace Checkout\Rules;

use Checkout\Item;

final class UnitaryRule
{
    /** @var Item */
    private $item;

    /** @var float */
    private $price;

    /**
     * @param Item $item
     * @param float $price
     */
    public function __construct(Item $item, float $price)
    {
        $this->item = $item;
        $this->price = $price;
    }

    /**
     * @param int $unities
     * @return float
     */
    public function apply(int $unities): float
    {
        if ($unities <= 0) {
            return 0.0;
        }

        return $unities * $this->price;
    }
}