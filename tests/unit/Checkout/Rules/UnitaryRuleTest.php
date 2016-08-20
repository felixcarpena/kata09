<?php
declare(strict_types = 1);

namespace Tests\Unit\Checkout\Rules;

use Checkout\Rules\UnitaryRule;
use PHPUnit\Framework\TestCase;

class UnitaryRuleTest extends TestCase
{
    /** @test */
    public function when_apply_strategy_for_two_items_then_the_price_should_be_four()
    {
        $strategy = new UnitaryRule(2);
        $this->assertEquals(4, $strategy->apply(2));
    }

    /** @test */
    public function when_apply_strategy_for_negative_items_then_the_price_should_be_zero()
    {
        $strategy = new UnitaryRule(2);
        $this->assertEquals(0, $strategy->apply(-2));
    }

    /** @test */
    public function check_that_this_rule_could_be_applied_to_all_unities()
    {
        $strategy = new UnitaryRule(1);
        $this->assertEquals(2, $strategy->appliedTo(2));
    }
}
