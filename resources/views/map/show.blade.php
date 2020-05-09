@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="row no-gutter py-5">
        <div class=" d-md-flex col-md-4 col-lg-6 bg-image_" style="position:relative" > 

            <div id="ajaxModel" style="max-height:1000px; width: 100%"aria-hidden="true">
                <div class="modal-header" style=" background-color: #6c7ae0; color:white">
                    <p>{{ $map->addressLine1 }}, {{ $map->addressLine2 }} {{ $map->addressLine3 }}</p>
                    <p><strong>{{ $map->postCode }}</strong></p>
                </div>
                <div id="map"></div>
            </div>


        </div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4 text-right">Show Answer</h3>
                            <div class="border-top my-3 mb-5"></div>


                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Id:</strong>
                                        {{ $map->id }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Address Line 1:</strong>
                                        <span class="map_address_{{ $map->id }}">{{ $map->addressLine1 }}</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Address Line 2:</strong>
                                        <span class="map_address_{{ $map->id }}">{{ $map->addressLine2 }}</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="form-group">
                                        <strong>Address Line 3:</strong>
                                        <span class="map_address_{{ $map->id }}">{{ $map->addressLine3 }}</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>City:</strong>
                                        {{ $map->city }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>County State:</strong>
                                        {{ $map->countyState }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Country:</strong>
                                        {{ $map->country }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Post Code:</strong>
                                        {{ $map->postCode }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Notes:</strong>
                                        {{ $map->notes }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Lat:</strong>
                                        {{ $map->Lat }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Lng:</strong>
                                        {{ $map->lng }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Google Place Id:</strong>
                                        {{ $map->googlePlaceId }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Created At:</strong>
                                        {{ $map->created_at }}
                                    </div>
                                </div>

                            </div>
                            <div class="pull-left">
                                <a class="btn btn-v" href="{{ route('map.index') }}">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<script src='js/map.js?mapId={{ $map->id }}'></script>-->
<!--<script id="helper" src='{{ URL::asset('../resources/js/map.js') }} data-mapId={{ $map->id }} data-token={{ csrf_token() }} '></script>-->
<script src='{{ URL::asset('../resources/js/map.js') }}?mapId={{ $map->id }}'></script>
@endsection