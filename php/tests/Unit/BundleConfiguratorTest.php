<?php
declare(strict_types = 1);

namespace KataTests;

use Kata\BundleConfigurator;
use PHPUnit\Framework\TestCase;

final class BundleConfiguratorTest extends TestCase
{
    /**
     * @test
     * @dataProvider validOrderProductsProvider
     */
    public function should_create_bundle_with_valid_order(string $productsName, string $expectBundle): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame($expectBundle, $bundleConfigurator->select($productsName));
    }

    public function validOrderProductsProvider(): array
    {
        return [
            ['P1', 'P1'],
            ['P2', 'P2'],
            ['P3', 'P3'],
            ['P4', 'P4'],
            ['P5', 'P5'],
            ['P1,P2', 'B1'],
            ['P1,P4', 'B2'],
            ['P3,P4', 'B3'],
            ['P1,P2,P3,P4', 'B4'],
            ['P1,P5', 'B5'],
            ['P1,P2,P1', 'B1,P1'],
            ['P2,P1', 'B1'],
            ['P4,P1', 'B2'],
            ['P1,P2,P3', 'B1,P3'],
            ['P2,P4', 'P2,P4'],
            ['P1,P3,P4', 'B3,P1'],
            ['P2,P3,P4', 'B3,P2'],
            ['P1,P2,P5', 'B5,P2'],
        ];
    }
}
