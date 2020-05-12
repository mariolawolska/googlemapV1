@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class=" d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4 text-right">Add address</h3>
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

                            <form action="{{ route('map.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    {{-- Address1 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 1:</strong>
                                            <input type="text" name="addressLine1" class="form-control" placeholder="AddressLine1">
                                        </div>
                                    </div>
                                    {{-- Address2 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 2:</strong>
                                            <input type="text" name="addressLine2" class="form-control" placeholder="AddressLine2">
                                        </div>
                                    </div>
                                    {{-- Address3 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Address Line 3:</strong>
                                            <input type="text" name="addressLine3" class="form-control" placeholder="AddressLine3">
                                        </div>
                                    </div>

                                    {{-- City --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>City:</strong>
                                            <input type="text" name="city" class="form-control" placeholder="City">
                                        </div>
                                    </div>

                                    {{-- CountyState --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>County State:</strong>
                                            <input type="text" name="countyState" class="form-control" placeholder="County State">
                                        </div>
                                    </div>

                                    {{-- Country --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Country:</strong>
                                            <input type="text" name="country" class="form-control" placeholder="County">
                                        </div>
                                    </div>

                                    {{-- PostCode --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Post Code:</strong>
                                            <input type="text" name="postCode" class="form-control" placeholder="Post Code">
                                        </div>
                                    </div>

                                    {{-- Notes --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Notes:</strong>
                                            <textarea class="form-control" style="height:150px" name="notes" placeholder="Notes"></textarea>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                                        <a class="btn btn-v pull-left" href="{{ route('map.index') }}">Back</a>
                                        <button type="submit" class="btn btn-v pull-right">Submit</button>
                                    </div>
                                    <div class="pull-left">
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection