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

    public function add(Item $item, Rule $rule)
    {
        $this->rules[$item->getIdentifier()][] = $rule;
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