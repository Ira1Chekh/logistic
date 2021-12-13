<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'longitude', 'latitude'];

    public static function calculateDistance(City $cityFrom, City $cityTo)
    {
        // convert degree to radians
        $long1 = deg2rad($cityFrom->longitude);
        $long2 = deg2rad($cityTo->longitude);
        $lat1 = deg2rad($cityFrom->latitude);
        $lat2 = deg2rad($cityTo->latitude);

        // Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati / 2),2)
            + cos($lat1) * cos($lat2)
            * pow(sin($dlong / 2),2);

        $res = 2 * asin(sqrt($val));

        // Radius of earth in kilometers.
        $radius = 6371;

        return ($res * $radius);
    }
}
