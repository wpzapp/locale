<?php
/**
 * Locale representation and utilities.
 *
 * @package WPZAPP\Locale
 * @license GPL-3.0
 * @link    https://wpzapp.org
 */

namespace WPZAPP\Locale;

use WPZAPP\SimpleValues\AbstractSimpleValue;

/**
 * Class representing a country.
 *
 * @since 1.0.0
 */
class Country extends AbstractSimpleValue
{

    /**
     * Set the raw value.
     *
     * @since 1.0.0
     *
     * @param mixed $value Raw value.
     */
    protected function setValue($value)
    {
        $this->value = substr(strtoupper((string) $value), 0, 2);
    }
}
