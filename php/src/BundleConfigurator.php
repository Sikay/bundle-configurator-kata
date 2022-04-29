<?php
declare(strict_types = 1);

namespace Kata;

final class BundleConfigurator
{
    public function select(array $productNames): string
    {
        return implode(',', $this->bestBundle($productNames));
    }

    private function bestBundle(array $productNames): array
    {
        $possibleBundle = $this->allPossibleCombination($productNames);

        if (!empty($possibleBundle)) {
            $bestBundle = $this->bestPriceReduce($possibleBundle);
            $productNames = $this->changeProductsToBundle($productNames, $bestBundle);
        }

        return $productNames;
    }

    private function bundles(): array
    {
        return [
            'B1' => [
                'products' => ['P1','P2'],
                'price'    => 25,
            ],
            'B2' => [
                'products' => ['P1','P4'],
                'price'    => 40,
            ],
            'B3' => [
                'products' => ['P3','P4'],
                'price'    => 60,
            ],
            'B4' => [
                'products' => ['P1','P2','P3','P4'],
                'price'    => 80,
            ],
            'B5' => [
                'products' => ['P1','P5'],
                'price'    => 50,
            ],
        ];
    }

    private function changeProductsToBundle(array $productNames, string $bundle): array
    {
        $products = $this->bundles()[$bundle]['products'];
        foreach ($products as $product) {
            unset($productNames[array_search($product, $productNames)]);
        }
        array_unshift($productNames, $bundle);
        return $productNames;
    }

    private function allPossibleCombination(array $productNames): array
    {
        $bundleConfiguration = $this->bundles();
        $possibleBundle = [];

        foreach ($bundleConfiguration as $bundle => $bundleProducts) {
            if (!array_diff($bundleProducts['products'], $productNames)) {
                $possibleBundle[] = $bundle;
            }
        }
        return $possibleBundle;
    }

    private function bestPriceReduce(array $bundles): string
    {
        $bundleConfiguration = $this->bundles();
        $maxPriceReduce = 0;
        $bestBundle = '';
        foreach ($bundles as $bundle) {
            if ($bundleConfiguration[$bundle]['price'] > $maxPriceReduce) {
                $maxPriceReduce = $bundleConfiguration[$bundle]['price'];
                $bestBundle = $bundle;
            }
        }
        return $bestBundle;
    }
}
