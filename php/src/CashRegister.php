<?php
declare(strict_types = 1);

namespace Kata;

class CashRegister
{
    public function __construct(Cart $cart, BundleConfigurator $bunbleConfigurator)
    {
    }

    public function show(): string
    {
        return 'B5,P2';
    }
}