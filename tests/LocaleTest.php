<?php
/**
 * Tests for the locale classes.
 *
 * @package WPZAPP\Locale
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Locale\Tests;

use WPZAPP\Locale\Locale;
use WPZAPP\Locale\Language;
use WPZAPP\Locale\Country;
use PHPUnit\Framework\TestCase;

class LocaleTest extends TestCase
{

    private $language;

    private $country;

    public function setUp()
    {
        $this->language = $this->getMockBuilder(Language::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->country = $this->getMockBuilder(Country::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetLanguage()
    {
        $locale = new Locale($this->language, $this->country);
        $this->assertSame($this->language, $locale->getLanguage());
    }

    public function testGetCountry()
    {
        $locale = new Locale($this->language, $this->country);
        $this->assertSame($this->country, $locale->getCountry());
    }

    public function testGetValue()
    {
        $locale = new Locale($this->language, $this->country);

        $this->language->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue('en'));
        $this->country->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue('US'));

        $this->assertSame('en_US', $locale->getValue());
    }

    /**
     * @dataProvider dataIsEmpty
     */
    public function testIsEmpty($languageEmpty, $countryEmpty, $expected)
    {
        $locale = new Locale($this->language, $this->country);

        $this->language->method('isEmpty')
            ->will($this->returnValue($languageEmpty));
        $this->country->method('isEmpty')
            ->will($this->returnValue($countryEmpty));

        if ($expected) {
            $this->assertTrue($locale->isEmpty());
        } else {
            $this->assertFalse($locale->isEmpty());
        }
    }

    public function dataIsEmpty()
    {
        return array(
            array(true, true, true),
            array(true, false, false),
            array(false, true, false),
            array(false, false, false),
        );
    }

    /**
     * @dataProvider dataEquals
     */
    public function testEquals($languageEquals, $countryEquals, $expected)
    {
        $locale = new Locale($this->language, $this->country);

        $otherLanguage = $this->createMock(Language::class);
        $otherCountry  = $this->createMock(Country::class);
        $otherLocale   = new Locale($otherLanguage, $otherCountry);

        $this->language->method('equals')
            ->with($otherLanguage)
            ->will($this->returnValue($languageEquals));
        $this->country->method('equals')
            ->with($otherCountry)
            ->will($this->returnValue($countryEquals));

        if ($expected) {
            $this->assertTrue($locale->equals($otherLocale));
        } else {
            $this->assertFalse($locale->equals($otherLocale));
        }
    }

    public function dataEquals()
    {
        return array(
            array(true, true, true),
            array(true, false, false),
            array(false, true, false),
            array(false, false, false),
        );
    }

    public function testEqualsWrongClass()
    {
        $locale = new Locale($this->language, $this->country);
        $this->assertFalse($locale->equals(new Language('en')));
    }

    public function testFromValue()
    {
        $locale = new Locale($this->language, $this->country);

        $result = $locale->fromValue('de_DE');
        $this->assertSame('de_DE', $result->getValue());
    }

    public function testToString()
    {
        $locale = $this->getMockBuilder(Locale::class)
            ->setMethods(array('getValue'))
            ->disableOriginalConstructor()
            ->getMock();
        $locale->expects($this->once())
            ->method('getValue')
            ->will($this->returnValue('en_US'));

        $this->assertSame('en_US', $locale->__toString());
    }
}
