<?php
/**
 * Tests for the locale classes.
 *
 * @package WPZAPP\Locale
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Locale\Tests;

use WPZAPP\Locale\Language;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{

    /**
     * @dataProvider dataSetValue
     */
    public function testSetValue($rawValue, $expected)
    {
        $language = new Language($rawValue);
        $this->assertSame($expected, $language->getValue());
    }

    public function dataSetValue()
    {
        return array(
            array('en', 'en'),
            array('eng', 'en'),
            array('EN', 'en'),
        );
    }
}
