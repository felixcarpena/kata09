<?php
namespace Checkout\Rules;

interface Rule
{
    /**
     * @param int $unities
     * @return int
     */
    public function apply(int $unities) : int;

    /**
     * @param int $unities
     * @return int
     */
    public function appliedTo(int $unities): int;
}