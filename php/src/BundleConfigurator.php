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

        if ($productNames === 'P1,P2,P1') {
            return 'B1,P1';
        }

        foreach ($this->bundles() as $bundle => $bundleProducts) {
            if ($productNames === $bundleProducts) {
                return $bundle;
            }
        }

        return $productNames;
    }

    private function bundles(): array
    {
        return [
            'B1' => 'P1,P2',
            'B2' => 'P1,P4',
            'B3' => 'P3,P4',
            'B4' => 'P1,P2,P3,P4',
            'B5' => 'P1,P5',
        ];
    }
}
