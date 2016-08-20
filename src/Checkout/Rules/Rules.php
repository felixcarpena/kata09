<?php
declare(strict_types = 1);

namespace Checkout\Rules;

use Checkout\Item;

final class Rules
{
    /** @var Rule[] */
    private $rules;

    public function __construct()
    {
        $this->rules = [];
    }

    /**
     * @param Item $item
     * @param Rule $rule
     * @return Rules
     */
    public function add(Item $item, Rule $rule): self
    {
        $this->rules[$item->getIdentifier()][] = $rule;

        return $this;
    }

    /**
     * @param Item $item
     * @return Rule[]
     */
    public function get(Item $item)
    {
        return $this->rules[$item->getIdentifier()] ?? [];
    }
}