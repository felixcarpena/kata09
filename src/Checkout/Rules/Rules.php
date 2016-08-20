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

    /**
     * @param Item $item
     * @param int $unities
     * @return int
     */
    public function calculate(Item $item, int $unities): int
    {
        $itemRules = $this->get($item);

        if (empty($itemRules)) {
            return 0;
        }

        $total = 0;
        foreach ($itemRules as $rule) {
            $total += $rule->apply($unities);

            $unities -= $rule->appliedTo($unities);

            if ($unities == 0) {
                break;
            }
        }

        if ($unities != 0) {
            throw new \RuntimeException('No rules can be applied for the unities requested');
        }

        return $total;
    }
}