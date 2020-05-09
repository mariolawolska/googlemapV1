<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;

class MapController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $mapCollection = Map::latest()->orderBy('updated_at', 'DESC')->paginate(30);

        return view('map.index', compact('mapCollection'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return view('map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'addressLine1' => 'required',
            'city' => 'required',
            'postCode' => 'required'
        ]);

        $mapObject = Map::create($request->all());
        $this->getApiGeocode($mapObject);

        return redirect()->route('map.index')->with('success', 'Map created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map) {


        return view('map.show', compact('map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map) {

        return view('map.edit', compact('map'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map $map
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map) {

        $request->validate([
            'addressLine1' => 'required',
            'city' => 'required',
            'postCode' => 'required'
        ]);

        $map->update($request->all());

        return redirect()->route('map.index')->with('success', 'Map updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map $map
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map) {
        $map->delete();

        return redirect()->route('map.index')->with('success', 'Map deleted successfully');
    }

    public function lookup(Request $request) {

        $mapObject = Map::findOrFail($request->mapId);
        if (empty($mapObject->postCode)) {
            
        } else {
            $this->getApiGeocode($mapObject);
        }

        return redirect()->route('map.index')->with('success', 'Map updated successfully');
    }

    private function getApiGeocode($mapObject) {

        $postCode = $this->postcodeFormat($mapObject->postCode);

        $data_google_interactive_map_api_key = "AIzaSyC3xyj_YojzsVBUkx0oi9O3goERpd0Lc9E";

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $postCode . '&key=' . $data_google_interactive_map_api_key;
        $geocode = file_get_contents($url);
        $output = json_decode($geocode);

        if ($output->status == 'OK') {
            $mapObject->lat = $output->results[0]->geometry->location->lat;
            $mapObject->lng = $output->results[0]->geometry->location->lng;
            $mapObject->googlePlaceId = $output->results[0]->place_id;

            $mapObject->save();
        }
    }

    /**
     * @param type $postcode
     * 
     * @return type
     */
    private function postcodeFormat($postcode) {
        $postcode = trim(strtoupper($postcode));
        // remove spaces
        $postcode = str_replace(' ', '', $postcode);
        // add space where it should be
        $postcode = substr_replace($postcode, ' ', -3, 0);
        // urlencode
        $postcode = urlencode($postcode);

        return $postcode;
    }

    public function getNearBy() {

        $mapId = basename(url()->previous());

        $mapObject = Map::find($mapId);
        if ($mapObject instanceof Map) {
            $nearByObject = $mapObject->getNearByMiles();
        } else {
            $url = url()->previous();
            $mapId = explode('/', $url);
            $mapId = $mapId[5];
            $mapObject = Map::find($mapId);
            $nearByObject = $mapObject->getNearByMiles();
        }
//        $gmap_co_ordinates = [];
        $key = 1;
        foreach ($nearByObject as $object) {

//            $marker_postcode = str_replace(" ", "%20", $current_postcode);
            // $gmap_postcode_basic .= $marker_postcode . "%7C";
            //            if (($lat * 1) != 0 && ($lng * 1) != 0) {
//            $info_window_content = '<strong>' . $object->postCode . '</strong></br>';
//            $info_window_content .= ' ' . $object->addressLine1 . ' ' . $object->addressLine2 . ' ' . $object->addressLine3 . '<br>';
//            $info_window_content .= ' ' . $object->city . ', ' . $object->country . '<br>';
//            $info_window_content .= '<a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' . $object->lat . ',' . $object->lng . '&query_place_id=' . $object->googlePlaceId . '">Open map</a>';
//
//            $gmap_co_ordinates[] = array(
//                'google_map' => array(
//                    'lat' => $object->lat,
//                    'lng' => $object->lng,
//                ),
//                'info_window_content' => $info_window_content,
//                'alphabet' => 'C',
//                'marker_color' => '#4CCC10',
//                'google_place_id' => $object->googlePlaceId,
//            );
            $gmap[] = [$object->addressLine1 . ' ' . $object->addressLine2 . ' ' . $object->addressLine3, $object->lat, $object->lng, $key];
//            }
            $key++;
        }

//        return response()->json(json_encode($gmap_co_ordinates));
        $json = json_encode($gmap);
        return response()->json($json);
    }

}
