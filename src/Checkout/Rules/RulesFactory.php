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
        return
            (new Rules())
                ->add(new Item('A'), new UnitaryRule(50))
                ->add(new Item('B'), new UnitaryRule(30))
                ->add(new Item('C'), new UnitaryRule(20))
                ->add(new Item('D'), new UnitaryRule(15));
    }
}