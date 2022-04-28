<?php
declare(strict_types = 1);

namespace KataTests;

use Kata\BundleConfigurator;
use PHPUnit\Framework\TestCase;

final class BundleConfiguratorTest extends TestCase
{
    /** @test */
    public function should_not_return_bundle_for_individual_product()
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('P1', $bundleConfigurator->select('P1'));
    }

    /** @test */
    public function should_not_return_bundle_for_individual_product_P2()
    {
        $bundleConfigurator = new BundleConfigurator();

        self::assertSame('P2', $bundleConfigurator->select('P2'));
    }
}
