<?php
declare(strict_types = 1);

namespace Kata;

final class BundleConfigurator
{
    public function select(string $productNames): string
    {
        return $this->bundleDetector($productNames);
    }

    private function bundleDetector(string $productNames): string
    {
        $bundleConfiguration = $this->bundles();
        $arrayProductNames = explode(',', $productNames);
        $possibleBundle = [];

        foreach ($bundleConfiguration as $bundle => $bundleProducts) {

            if(!array_diff($bundleProducts['products'], $arrayProductNames)) {
                $possibleBundle[] = $bundle;
            }
        }

        $maxPriceReduce = 0;
        $bestBundle = '';
        foreach ($possibleBundle as $bundle) {
            if ($bundleConfiguration[$bundle]['price'] > $maxPriceReduce) {
                $maxPriceReduce = $bundleConfiguration[$bundle]['price'];
                $bestBundle = $bundle;
            }
        }

        if (!empty($bestBundle)) {
            $arrayProductNames = $this->getArrayProductNames($bundleConfiguration[$bestBundle]['products'], $arrayProductNames, $bestBundle);
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

    private function getArrayProductNames($products, $arrayProductNames, $bundle): array
    {
        foreach ($products as $product) {
            unset($arrayProductNames[array_search($product, $arrayProductNames)]);
        }
        array_unshift($arrayProductNames, $bundle);
        return $arrayProductNames;
    }
}
