<?php
/**
 * Locale representation and utilities.
 *
 * @package WPZAPP\Locale
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Locale;

use WPZAPP\SimpleValues\SimpleValue;

/**
 * Class representing a locale.
 *
 * @since 1.0.0
 */
class Locale implements SimpleValue
{
    /** @var Language Language of the locale. */
    protected $language;

    /** @var Country Country of the locale. */
    protected $country;

    /**
     * Constructor.
     *
     * Set the language and country.
     *
     * @since 1.0.0
     *
     * @param Language $language Language of the locale.
     * @param Country  $country  Country of the locale.
     */
    public function __construct(Language $language, Country $country)
    {
        $this->language = $language;
        $this->country  = $country;
    }

    /**
     * Get the language of the locale.
     *
     * @since 1.0.0
     *
     * @return Language The language of the locale.
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * Get the country of the locale.
     *
     * @since 1.0.0
     *
     * @return Country The country of the locale.
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->language->getValue() . '_' . $this->country->getValue();
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->language->isEmpty() && $this->country->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function equals(SimpleValue $value): bool
    {
        if (!is_a($value, get_class($this))) {
            return false;
        }

        return $this->language->equals($value->getLanguage()) && $this->country->equals($value->getCountry());
    }

    /**
     * @inheritDoc
     */
    public function fromValue($rawValue): SimpleValue
    {
        list($language, $country) = explode('_', $rawValue);

        $className = get_class($this);

        return new $className(new Language($language), new Country($country));
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
