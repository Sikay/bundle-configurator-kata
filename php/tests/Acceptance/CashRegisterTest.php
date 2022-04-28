<?php

namespace KataTests;

use Kata\BundleConfigurator;
use Kata\Cart;
use Kata\CashRegister;
use Kata\Product;
use PHPUnit\Framework\TestCase;

class CashRegisterTest extends TestCase
{
    /** @test */
    public function should_show_best_combination_of_bundle_and_product(): void
    {
        $productP1 = new Product('P1');
        $productP2 = new Product('P2');
        $productP5 = new Product('P5');

        $cart = new Cart();
        $cart->add($productP1);
        $cart->add($productP2);
        $cart->add($productP5);

        $bunbleConfigurator = new BundleConfigurator();

        $cashRegister = new CashRegister($cart, $bunbleConfigurator);

        self::assertSame('B5,P2', $cashRegister->show());
    }
}
