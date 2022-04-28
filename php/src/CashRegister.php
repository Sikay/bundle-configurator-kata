<?php
declare(strict_types = 1);

namespace Kata;

class CashRegister
{
    private Cart $cart;
    private BundleConfigurator $bunbleConfigurator;

    public function __construct(Cart $cart, BundleConfigurator $bunbleConfigurator)
    {
        $this->cart = $cart;
        $this->bunbleConfigurator = $bunbleConfigurator;
    }

    public function show(): string
    {
        foreach ($this->cart->all() as $product) {
            $productsName[] = $product->name();
        }
        return $this->bunbleConfigurator->select(implode(',', $productsName));
    }
}