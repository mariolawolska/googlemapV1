@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row no-gutter py-5">
        <div class=" d-md-flex col-md-4 col-lg-6"> 
            <div id="ajaxModel"  class="w-100" aria-hidden="true"> 
                <div class="modal-header btn-v">
                    <p>{{ $map->addressLine1 }} {{ $map->addressLine2 }} {{ $map->addressLine3 }}</p>
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
                            <h3 class="login-heading mb-4 text-right">Edit Location</h3>
                            <div class="border-p my-3 mb-5"></div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('map.update', $map->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    {{-- Address1 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 1:</strong>
                                            <input type="text" name="addressLine1" value="{{ $map->addressLine1 }}" class="form-control" placeholder="AddressLine1">
                                        </div>
                                    </div>
                                    {{-- Address2 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 2:</strong>
                                            <input type="text" name="addressLine2" value="{{ $map->addressLine2 }}" class="form-control" placeholder="addressLine2">
                                        </div>
                                    </div>
                                    {{-- Address3 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 3:</strong>
                                            <input type="text" name="addressLine3" value="{{ $map->addressLine3 }}" class="form-control" placeholder="addressLine3">
                                        </div>
                                    </div>
                                    {{-- City --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>City:</strong>
                                            <input type="text" name="city" value="{{ $map->city }}" class="form-control" placeholder="city">
                                        </div>
                                    </div>
                                    {{-- CountyState --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>County State:</strong>
                                            <input type="text" name="countyState" value="{{ $map->countyState }}" class="form-control" placeholder="countyState">
                                        </div>
                                    </div>
                                    {{-- Country --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Country:</strong>
                                            <input type="text" name="country" value="{{ $map->country }}" class="form-control" placeholder="county">
                                        </div>
                                    </div>
                                    {{-- PostCode --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Post Code:</strong>
                                            <input type="text" name="postCode" value="{{ $map->postCode }}" class="form-control" placeholder="postCode">
                                        </div>
                                    </div>
                                    {{-- Detail --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Notes:</strong>
                                            <textarea class="form-control" style="height:150px" name="notes" placeholder="notes">{{ $map->notes }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Submit --}}        
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="pull-left">
                                            <a class="btn btn-v" href="{{ route('map.index') }}">Back</a>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-v">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3xyj_YojzsVBUkx0oi9O3goERpd0Lc9E&callback=initMap"></script>
<script src='{{ URL::asset('../public/js/map.js') }}?mapId={{ $map->id }}'></script>
@endsection