<?php
declare(strict_types = 1);

namespace Checkout\Rules;

use Checkout\Item;
use PHPUnit\Framework\TestCase;

class UnitaryRuleTest extends TestCase
{
    /** @test */
    public function when_apply_strategy_for_two_items_then_the_price_should_be_four()
    {
        $item = new Item('Foo');
        $strategy = new UnitaryRule($item, 2.0);
        $this->assertEquals(4.0, $strategy->apply(2));
    }

    /** @test */
    public function when_apply_strategy_for_negative_items_then_the_price_should_be_zero()
    {
        $item = new Item('Foo');
        $strategy = new UnitaryRule($item, 2.0);
        $this->assertEquals(0.0, $strategy->apply(-2));
    }
}
