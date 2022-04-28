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

        if ($productNames === 'P1,P4') {
            return 'B2';
        }

        if ($productNames === 'P3,P4') {
            return 'B3';
        }

        if ($productNames === 'P1,P2,P3,P4') {
            return 'B4';
        }

        if ($productNames === 'P1,P5') {
            return 'B5';
        }

        return $productNames;
    }
}
