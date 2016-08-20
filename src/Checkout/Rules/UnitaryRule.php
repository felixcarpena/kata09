<?php
declare(strict_types = 1);

namespace Checkout\Rules;

final class UnitaryRule implements Rule
{
    /** @var float */
    private $price;

    /**
     * @param float $price
     */
    public function __construct(float $price)
    {
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