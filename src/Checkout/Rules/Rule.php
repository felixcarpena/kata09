<?php
namespace Checkout\Rules;

interface Rule
{
    /**
     * @param int $unities
     * @return float
     */
    public function apply(int $unities) : float;
}