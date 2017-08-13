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
 * Class representing a language.
 *
 * @since 1.0.0
 */
class Language extends AbstractSimpleValue
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
        $this->value = substr(strtolower((string) $value), 0, 2);
    }
}
