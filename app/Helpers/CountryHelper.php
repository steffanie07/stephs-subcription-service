<?php

use League\ISO3166\ISO3166;

if (!function_exists('getCountriesList')) {
    function getCountriesList()
    {
        $iso3166 = new ISO3166();
        $countries = $iso3166->all();
        $countryList = [];
        foreach ($countries as $country) {
            $countryList[$country['alpha2']] = $country['name'];
        }
        return $countryList;
    }
}
