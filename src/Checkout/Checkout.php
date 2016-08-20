<?php
declare(strict_types = 1);

namespace Checkout;

use Checkout\Rules\Rules;

final class Checkout
{
    /** @var Rules */
    private $rules;

    /** @var  int[] */
    private $items;

    /**
     * @param $rules
     */
    public function __construct(Rules $rules)
    {
        $this->rules = $rules;
        $this->items = [];
    }

    /**
     * @param Item $item
     * @return Checkout
     */
    public function scan(Item $item): self
    {
        if (!isset($this->items[$item->getIdentifier()])) {
            $this->items[$item->getIdentifier()] = 0;
        }

        $this->items[$item->getIdentifier()]++;

        return $this;
    }

    /**
     * @return int
     */
    public function total():int
    {
        $total = 0;
        foreach ($this->items as $item => $unities) {
            $total += $this->rules->calculate(new Item($item), $unities);
        }

        return $total;
    }
}