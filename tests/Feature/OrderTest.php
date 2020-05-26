<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function an_order_consists_of_products()
    {
        $order = $this->createdOrderWithProducts();

        $this->assertCount(2, $order->products());
    }

    /** @test */
    public function an_order_can_determine_the_total_cost_of_all_its_products()
    {
        $order = $this->createdOrderWithProducts();

        $this->assertCount(2, $order->products());
    }

    /** @test */
    public function sum_all_cost_orders()
    {
        $order = $this->createdOrderWithProducts();

        $this->assertEquals(110, $order->total());
    }

    /**
     * @return Order
     */
    protected function createdOrderWithProducts()
    {
        $order = new Order();

        $product = new Product('Fallout 4', 55);
        $product2 = new Product('Fallout 2', 55);

        $order->add($product);
        $order->add($product2);

        return $order;
    }

}
