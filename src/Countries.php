<?php
namespace EasyCountry;

use SameerShelavale\PhpCountriesArray\CountriesArray;

/**
 * Class Countries
 * @package Msp
 */
class Countries
{
    /**
     * @return array
     */
    function getCountriesList() {
        $countries = CountriesArray::get();
        return $countries;
    }

    /**
     * @param $country_name
     * @return mixed
     */
    function getIdFromName($country_name)
    {
        $countries = $this->getCountriesList();
        $flipped = array_flip($countries);
        return $flipped[$country_name];
    }
}
