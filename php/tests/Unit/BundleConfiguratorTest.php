<?php
declare(strict_types = 1);

namespace KataTests;

use Kata\BundleConfigurator;
use PHPUnit\Framework\TestCase;

final class BundleConfiguratorTest extends TestCase
{
    public function individualProductsProvider(): array
    {
        return [
            ['P1'],
            ['P2'],
            ['P3'],
            ['P4'],
            ['P5'],
        ];
    }

    /**
     * @test
     * @dataProvider individualProductsProvider
     */
    public function should_not_return_bundle_for_individual_product(string $productName): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame($productName, $bundleConfigurator->select($productName));
    }

    public function twoOrMoreProductsProvider(): array
    {
        return [
            ['P1,P2', 'B1'],
            ['P1,P4', 'B2'],
            ['P3,P4', 'B3'],
            ['P1,P2,P3,P4', 'B4'],
            ['P1,P5', 'B5'],
        ];
    }

    /**
     * @test
     * @dataProvider twoOrMoreProductsProvider
     */
    public function should_create_bundle_for_two_or_more_product(string $productsName, string $expectBundle): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame($expectBundle, $bundleConfigurator->select($productsName));
    }

    /** @test */
    public function should_create_bundle_and_return_leftover_products(): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('B1,P1', $bundleConfigurator->select('P1,P2,P1'));
    }

    /** @test */
    public function should_create_bundle_with_products_in_different_order(): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('B1', $bundleConfigurator->select('P2,P1'));
    }

    /** @test */
    public function should_create_bundle_with_products_in_different_order_B2(): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('B2', $bundleConfigurator->select('P4,P1'));
    }
}
