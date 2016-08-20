<?php
declare(strict_types = 1);

namespace Checkout\Rules;

use Checkout\Item;

final class RulesFactory
{
    /**
     * @return Rules
     */
    public static function create()
    {
        $itemA = new Item('A');
        $itemB = new Item('B');

        return
            (new Rules())
                ->add($itemA, new DiscountOverUnitiesRule(3, 130))
                ->add($itemA, new UnitaryRule(50))
                ->add($itemB, new DiscountOverUnitiesRule(2, 45))
                ->add($itemB, new UnitaryRule(30))
                ->add(new Item('C'), new UnitaryRule(20))
                ->add(new Item('D'), new UnitaryRule(15));
    }
}