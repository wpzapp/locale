<?php
/**
 * Tests for the locale classes.
 *
 * @package WPZAPP\Locale
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Locale\Tests;

use WPZAPP\Locale\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{

    /**
     * @dataProvider dataSetValue
     */
    public function testSetValue($rawValue, $expected)
    {
        $language = new Country($rawValue);
        $this->assertSame($expected, $language->getValue());
    }

    public function dataSetValue()
    {
        return array(
            array('US', 'US'),
            array('USA', 'US'),
            array('us', 'US'),
        );
    }
}
