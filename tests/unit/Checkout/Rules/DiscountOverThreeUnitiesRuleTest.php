<?php
declare(strict_types = 1);

namespace Tests\Unit\Checkout\Rules;

use Checkout\Rules\DiscountOverThreeUnitiesRule;
use PHPUnit\Framework\TestCase;

class DiscountOverThreeUnitiesRuleTest extends TestCase
{
    /** @test */
    public function when_apply_strategy_for_six_items_then_the_price_should_be_twenty()
    {
        $strategy = new DiscountOverThreeUnitiesRule(10);
        $this->assertEquals(20, $strategy->apply(6));

    }

    /** @test */
    public function when_apply_strategy_for_eight_items_then_the_price_should_be_twenty_and_the_applied_to_unities_six()
    {
        $strategy = new DiscountOverThreeUnitiesRule(10);
        $this->assertEquals(20, $strategy->apply(6));
        $this->assertEquals(6, $strategy->appliedTo(8));
    }

    /** @test */
    public function when_apply_strategy_for_less_than_three_elements_the_calculated_apply_should_be_zero()
    {
        $strategy = new DiscountOverThreeUnitiesRule(10);
        $this->assertEquals(0, $strategy->apply(2));
    }

    /** @test */
    public function when_apply_strategy_for_less_than_three_elements_the_applied_to_unities_should_be_zero()
    {
        $strategy = new DiscountOverThreeUnitiesRule(10);
        $this->assertEquals(0, $strategy->appliedTo(2));
    }
}
