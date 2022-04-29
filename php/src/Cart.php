<?php
declare(strict_types = 1);

namespace Kata;

class Cart
{
    private array $products;

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function all(): array
    {
        return $this->products;
    }
}