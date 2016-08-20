<?php
declare(strict_types = 1);

namespace Tests\Unit\Checkout\Rules;

use Checkout\Item;
use Checkout\Rules\Rules;
use Checkout\Rules\UnitaryRule;
use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{
    /** @test */
    public function when_add_a_item_rule_then_should_be_well_stored()
    {
        $rules = new Rules();
        $fooItem = new Item('Foo');
        $unitaryRule = new UnitaryRule(2);

        $rules->add($fooItem, $unitaryRule);

        $this->assertEquals(current($rules->get($fooItem)), $unitaryRule);
    }

    /** @test */
    public function when_ask_for_undefined_items_should_return_empty_array()
    {
        $rules = new Rules();

        $this->assertEquals($rules->get(new Item('Foo')), []);
    }
}
