<?php
declare(strict_types = 1);

namespace Tests;

use Checkout\Checkout;
use Checkout\Item;
use Checkout\Rules\RulesFactory;
use PHPUnit\Framework\TestCase;

class PricesTest extends TestCase
{
    /** @test */
    public function checkout() :void
    {
        $this->assertEquals(0, $this->price(""));
        $this->assertEquals(50, $this->price("A"));
        $this->assertEquals(80, $this->price("AB"));
        $this->assertEquals(115, $this->price("CDBA"));

        $this->assertEquals(100, $this->price("AA"));
        $this->assertEquals(130, $this->price("AAA"));
        $this->assertEquals(180, $this->price("AAAA"));
        $this->assertEquals(230, $this->price("AAAAA"));
        $this->assertEquals(260, $this->price("AAAAAA"));

        $this->assertEquals(160, $this->price("AAAB"));
        $this->assertEquals(175, $this->price("AAABB"));
        $this->assertEquals(190, $this->price("AAABBD"));
        $this->assertEquals(190, $this->price("DABABA"));
    }

    /** @test */
    public function checkout_incremental(): void
    {
        $checkout = new Checkout(Rules::create());
        $this->assertEquals(0, $checkout->total());

        $checkout->scan(new Item("A"));
        $this->assertEquals(50, $checkout->total());

        $checkout->scan(new Item("B"));
        $this->assertEquals(80, $checkout->total());

        $checkout->scan(new Item("A"));
        $this->assertEquals(130, $checkout->total());

        $checkout->scan(new Item("A"));
        $this->assertEquals(160, $checkout->total());

        $checkout->scan(new Item("B"));
        $this->assertEquals(175, $checkout->total());
    }

    //---[ Helpers ]--------------------------------------------------------------------------------------------------//
    private function price(string $price): int
    {
        $checkout = new Checkout(RulesFactory::create());
        foreach (str_split($price) as $itemName) {
            $checkout->scan(new Item($itemName));
        }

        return $checkout->total();
    }
}