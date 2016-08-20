<?php
declare(strict_types = 1);

namespace Tests\Unit\Checkout\Rules;

use Checkout\Item;
use Checkout\Rules\Rule;
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

    /** @test */
    public function calculate_price_for_item_that_only_have_one_rule()
    {
        $rules = (new Rules())
            ->add(new Item('Foo'), new UnitaryRule(2));

        $total = $rules->calculate(new Item('Foo'), 10);

        $this->assertEquals(20, $total);
    }

    /** @test */
    public function calculate_price_for_item_whe_have_several_rule()
    {
        $mockedRule1 = $this->createMock(Rule::class);
        $mockedRule1->method('appliedTo')->willReturn(5);
        $mockedRule1->method('apply')->willReturn(10);

        $mockedRule2 = $this->createMock(Rule::class);
        $mockedRule2->method('appliedTo')->willReturn(5);
        $mockedRule2->method('apply')->willReturn(20);

        $item = new Item('Foo');

        $rules = (new Rules())
            ->add($item, $mockedRule1)
            ->add($item, $mockedRule2);

        $total = $rules->calculate($item, 10);

        $this->assertEquals(30, $total);
    }

    /** @test */
    public function check_exception_when_no_rules_are_defined()
    {
        $rules = (new Rules());
        $this->expectException(\RuntimeException::class);
        $rules->calculate(new Item('Foo'), 10);
    }

    /** @test */
    public function check_exception_when_no_rules_can_be_applied_to_requested_unities()
    {
        $mockedRule = $this->createMock(Rule::class);
        $mockedRule->method('appliedTo')->willReturn(5);

        $rules = (new Rules())
            ->add(new Item('Foo'), $mockedRule);

        $this->expectException(\RuntimeException::class);
        $rules->calculate(new Item('Foo'), 10);
    }
}
