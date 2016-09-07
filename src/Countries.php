<?php
namespace Msp;

use Rinvex\Country\Models\Country;

/**
 * Class Countries
 * @package Msp
 */
class Countries
{

    /**
     * @param $country_name
     * @return mixed
     */
    function getIdFromName($country_name)
    {
        $countries = (new Country)->findAll()->pluck('name.common', 'iso_3166_1_alpha2');
        $flipped = array_flip($countries->toArray());
        return $flipped[$country_name];
    }
}
