<?php

namespace Hackathon3\Robinduval;

class Geo
{
    public function __construct()

    {

    }

    public function getClosestCityFromId($id){
        $myCities = new CitiesData();
        $cities = $myCities->getCities();
        $srcCity = $myCities->getCityInfoById($id);
        $closestDistance = PHP_INT_MAX;
        $closestCity = $srcCity;
        $cosDeg2RadLat1 = cos(deg2rad($srcCity['lat']));

        foreach ($cities as $dstCity) {
            if ($dstCity['id'] === $srcCity['id']){
                continue;
            }

            $distance = $this->computeDistance(
                $srcCity['lat'],
                $srcCity['long'],
                $dstCity['lat'],
                $dstCity['long'],
                $cosDeg2RadLat1
            );

            if ($closestDistance > $distance) {
                $closestDistance = $distance;
                $closestCity = $dstCity;
            }
        }

        return $closestCity;

    }

    /**
     * Give the distance in meter between two points (in kilometer)
     *
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return int
     */

    private function computeDistance($lat1, $lng1, $lat2, $lng2, $cosDeg2RadLat1){
        // BOUUUUUHHHH !!
        $r = $lat1 - $lat2;
        if ($r > 0.5) {
            return PHP_INT_MAX;
        }

        $earth_radius = 6378137; // Earth Radius is 6378.137 km
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a =
            (sin($dla) * sin($dla)) +
            cos($rla1) * cos($rla2) *
            (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return ($earth_radius * $d) / pow(10, 3);
    }
}
