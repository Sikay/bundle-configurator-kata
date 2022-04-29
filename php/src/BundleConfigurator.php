<?php
declare(strict_types = 1);

namespace Kata;

final class BundleConfigurator
{
    public function select(string $productNames): string
    {
        return $this->bestBundle($productNames);
    }

    private function bestBundle(string $productNames): string
    {
        $arrayProductNames = explode(',', $productNames);
        $possibleBundle = $this->allPossibleCombination($arrayProductNames);

        if (!empty($possibleBundle)) {
            $bestBundle = $this->bestPriceReduce($possibleBundle);
            $arrayProductNames = $this->changeProductsToBundle($arrayProductNames, $bestBundle);
        }

        return implode(',', $arrayProductNames);
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

    private function changeProductsToBundle(array $arrayProductNames, string $bundle): array
    {
        $products = $this->bundles()[$bundle]['products'];
        foreach ($products as $product) {
            unset($arrayProductNames[array_search($product, $arrayProductNames)]);
        }
        array_unshift($arrayProductNames, $bundle);
        return $arrayProductNames;
    }

    private function allPossibleCombination(array $arrayProductNames): array
    {
        $bundleConfiguration = $this->bundles();
        $possibleBundle = [];

        foreach ($bundleConfiguration as $bundle => $bundleProducts) {
            if (!array_diff($bundleProducts['products'], $arrayProductNames)) {
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
