<?php
declare(strict_types = 1);

namespace Checkout\Rules;

final class DiscountOverThreeUnitiesRule implements Rule
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
        return $unities < 3 ? 0 : intdiv($unities, 3) * $this->price;
    }

    /**
     * @param int $unities
     * @return int
     */
    public function appliedTo(int $unities): int
    {
        return $unities < 3 ? 0 : $unities - intdiv($unities, 3);
    }
}