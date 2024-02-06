<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use SmartGeoGMap\Helpers\View;

final class ViewTest extends TestCase
{
    public function testViewWithNoParams(): void
    {
        $this->expectException(\Exception::class);

        new View();
    }
}
