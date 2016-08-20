<?php
declare(strict_types = 1);

namespace Checkout\Rules;

final class UnitaryRule implements Rule
{
    /** @var float */
    private $price;

    /**
     * @param int $price
     */
    public function __construct(int $price)
    {
        $this->price = $price;
    }

    /**
     * @param int $unities
     * @return int
     */
    public function apply(int $unities): int
    {
        if ($unities <= 0) {
            return 0;
        }

        return $unities * $this->price;
    }

    /**
     * @param int $unities
     * @return int
     */
    public function appliedTo(int $unities): int
    {
        return $unities;
    }
}