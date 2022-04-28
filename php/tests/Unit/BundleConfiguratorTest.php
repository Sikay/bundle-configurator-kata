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

    /**
     * @test
     */
    public function should_create_bundle_for_two_product(): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('B1', $bundleConfigurator->select('P1,P2'));
    }

    /** @test */
    public function should_create_bundle_for_two_product_P1_P4(): void
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('B2', $bundleConfigurator->select('P1,P4'));
    }
}
