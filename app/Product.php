<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $cost;

    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function name()
    {
        return $this->name;
    }

    public function cost()
    {
        return $this->cost;
    }
}
