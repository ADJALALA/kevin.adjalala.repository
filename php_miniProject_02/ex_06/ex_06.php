<?php
function my_create_continent($continentNameToAdd, &$worldMap){
    $worldMap[$continentNameToAdd] = array();
}
function my_create_country($countryNameToAdd, $continentName, &$worldMap){
    if(!isset($worldMap[$continentName])){
        echo "Failure to get continent.\n";
        return NULL;
    }
    $worldMap[$continentName][$countryNameToAdd] = array();
}
function my_create_city($cityNameToAdd, $postalCodeOfCityToAdd, $countryName, $continentName, &$worldMap){
    if(!isset($worldMap[$continentName])){
        echo "Failure to get continent.\n";
        return NULL;
    }
    if(!isset($worldMap[$continentName][$countryName])){
        echo "Failure to get country.\n";
        return NULL;
    }
    $worldMap[$continentName][$countryName][$cityNameToAdd] = [$postalCodeOfCityToAdd];
}
function my_get_countries_of_continent($continentName, $worldMap){
    if(!isset($worldMap[$continentName])){
        echo "Failure to get continent.\n";
        return NULL;
    }
    return array_keys($worldMap[$continentName]);
}
function my_get_cities_of_country($continentName, $countryName, $worldMap){
    if(!isset($worldMap[$continentName])){
        echo "Failure to get continent.\n";
        return NULL;
    }
    if(!isset($worldMap[$continentName][$countryName])){
        echo "Failure to get country.\n";
        return NULL;
    }
    return array_keys($worldMap[$continentName][$countryName]);
}
function my_get_city_postal_code($continentName, $countryName, $cityNaame, &$worldMap){
    if(!isset($worldMap[$continentName])){
        echo "Failure to get continent.\n";
        return NULL;
    }
    if(!isset($worldMap[$continentName][$countryName])){
        echo "Failure to get country.\n";
        return NULL;
    }
    if(!isset($worldMap[$continentName][$countryName][$cityNaame])){
        echo "Failure to get city.\n";
        return NULL;
    }
    return array_keys($worldMap[$continentName][$countryName][$cityNaame]);
}

// $map = array();
// my_create_continent("Europe", $map);
// my_create_country ("France", "Europe", $map);
// my_create_city("Marseille", "13000", "France", "Europe", $map);
// var_dump($map);
    
?>