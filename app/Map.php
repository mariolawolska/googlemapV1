<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//
use Illuminate\Support\Facades\DB;

class Map extends Model {

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
    protected $table = 'map';
    protected $fillable = [
        'id', 'addressLine1', 'addressLine2', 'addressLine3', 'city', 'countyState', 'country', 'postCode', 'notes', 'lat', 'lng', 'googlePlaceId',
    ];

    /**
     * Laravel Relations
     */
    /**
     * Laravel Relations END
     */

    /**
     * Search in Miles
     * Where: 
     * $LATITUDE = the latitude of the start point e.g 7.08594109039762;
     * $LONGITUDE = the longitude of the start point e.g 286.95225338731285;
     * $DISTANCE_MILES = your radius of search in Miles e.g 150
     *    
     * @param type $distanceMiles
     * @param type $limit
     * 
     * @return type
     */
    public function getNearByMiles($distanceMiles = 5, $limit = 5) {

        $map = DB::select('SELECT * FROM (
        SELECT *, 
        (
            (
                (
                    acos(
                        sin(( ? * pi() / 180))
                        *
                        sin(( `lat` * pi() / 180)) + cos(( ? * pi() /180 ))
                        *
                        cos(( `lat` * pi() / 180)) * cos((( ? - `lng`) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515
        )
        as distance FROM `map`
        ) map
        WHERE distance <= ?
        LIMIT ?', [$this->lat, $this->lat, $this->lng, $distanceMiles, $limit]);

        return $map;
    }

    /**
      Searching in Kilometers
      Where:
      $LATITUDE = the latitude of the start point e.g 7.08594109039762;
      $LONGITUDE = the longitude of the start point e.g 286.95225338731285;
      $DISTANCE_KILOMETERS = your radius of search in Kilometers e.g 150
     */
    public function getNearByKilometers($distanceKilometers = 5, $limit = 5) {

        $map = DB::select('
            SELECT * FROM (
                SELECT *, 
                    (
                        (
                            (
                                acos(
                                    sin(( ? * pi() / 180))
                                    *
                                    sin(( `lat` * pi() / 180)) + cos(( ? * pi() /180 ))
                                    *
                                    cos(( `lat` * pi() / 180)) * cos((( ? - `lng`) * pi()/180)))
                            ) * 180/pi()
                        ) * 60 * 1.1515 * 1.609344
                    )
                as distance FROM `map`
            ) map
            WHERE distance <= ?
            LIMIT ?', [$this->lat, $this->lat, $this->lng, $distanceKilometers, $limit]);

        return $map;
    }

}
