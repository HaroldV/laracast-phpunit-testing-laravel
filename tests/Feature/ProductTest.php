<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    protected $product;

    public function setUp(): void
    {
        $this->product = new Product('milk', 35);
    }

    /** @test */
    public function product_has_a_name()
    {
        $this->assertEquals('milk', $this->product->name());
    }

    /** @test */
    public function product_has_a_cost()
    {
        $this->assertEquals(35, $this->product->cost());
    }
}
