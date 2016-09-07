<?php
namespace Msp;

use Giggsey\Locale;

/**
 * Class Countries
 * @package Msp
 */
class Countries extends Locale\Locale
{

    /**
     * @param $country_name
     * @return mixed
     */
    function getIdFromName($country_name)
    {
        $flipped = array_flip($this->getDisplayRegion('en-GB', 'en-GB'));
        return $flipped[$country_name];
    }
}
