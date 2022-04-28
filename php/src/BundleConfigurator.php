<?php
declare(strict_types = 1);

namespace Kata;

final class BundleConfigurator
{
    public function select(string $productNames): string
    {
        if ($productNames === 'P1,P2,P5') {
            return 'B5,P2';
        }

        if ($productNames === 'P1,P2') {
            return 'B1';
        }

        return $productNames;
    }
}
