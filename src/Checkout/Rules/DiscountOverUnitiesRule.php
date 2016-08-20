<?php
declare(strict_types = 1);

namespace Checkout\Rules;

final class DiscountOverUnitiesRule implements Rule
{
    /** @var float */
    private $price;

    /** @var int */
    private $unities;

    /**
     * @param int $unities
     * @param int $price
     */
    public function __construct(int $unities, int $price)
    {
        $this->price = $price;
        $this->unities = $unities;
    }

    /**
     * @param int $unities
     * @return int
     */
    public function apply(int $unities): int
    {
        return $unities < $this->unities ? 0 : intdiv($unities, $this->unities) * $this->price;
    }

    /**
     * @param int $unities
     * @return int
     */
    public function appliedTo(int $unities): int
    {
        return $unities < $this->unities ? 0 : intdiv($unities, $this->unities) * $this->unities;
    }
}