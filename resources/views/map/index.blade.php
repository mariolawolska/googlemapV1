{{-- answer\index.blade.php --}}

@extends('layout.app')

@section('content')

<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 80vh;

    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        min-height:100vh;
        margin: 0;
        padding: 0;
    }
</style>

<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}

        <div class="col-lg-12" id="start">
            <div id="container" class="container-fluid full-height">


                <div class="limiter back" style="width:100%">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 text-right pull-right"> <a class="btn btn-v " href="{{ route('map.create') }}">Create Map</a></div>
                                
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif     
                    <div class="container-table100 back">
                        <div class="wrap-table100">
                            <div class="table100 ver1 m-b-50">
                                <div class="table100-head table100-body">
                                    <table>
                                        <thead>
                                            <tr class="row100 head">
                                                <th class="cell100 column1">Id</th>
                                                <th class="cell100 column2">Address</th>

                                                <th class="cell100 column3">City</th>
                                                <th class="cell100 column4">County State</th>
                                                <th class="cell100 column5">Country</th>
                                                <th class="cell100 column6">Post Code</th>

                                                <th class="cell100 column7">Lat</th>
                                                <th class="cell100 column8">Lng</th>
                                                <th class="cell100 column9">Google Place Id</th>

                                                <th class="cell100 column10">Created At</th>
                                                <th class="cell100 column11">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="table100-body js-pscroll">
                                    <table>
                                        <tbody>
                                            @foreach ($mapCollection as $map)

                                            <tr class="row100 body">


                                                <td class="cell100 column1">{{ $map->id }}</td>
                                                <td class="cell100 column2">
                                                    <span>{{ $map->addressLine1 }}</span>
                                                    <span>{{ $map->addressLine2 }}</span>
                                                    <span>{{ $map->addressLine3 }}</span>
                                                </td>

                                                <td class="cell100 column3">{{ $map->city }}</td>
                                                <td class="cell100 column4">{{ $map->countyState }}</td>
                                                <td class="cell100 column5">{{ $map->country }}</td>
                                                <td class="cell100 column6">{{ $map->postCode }}</td>

                                                <td class="cell100 column7">{{ $map->lat }}</td>
                                                <td class="cell100 column8">{{ $map->lng }}</td>
                                                <td class="cell100 column9">
                                                    <div class="forModall btn ">
                                                        {{ $map->googlePlaceId }}
                                                    </div>
                                                </td>

                                                <td class="cell100 column10">{{ $map->created_at }}</td>
                                                <td class="cell100 column11">
                                                    <form style="padding-right:30px;"action="{{ route('map.destroy',$map->id) }}" method="POST">

                                                        <a style="background:#64e6f6; color:white; margin:3px;padding:3px" class="btn  btn-action" href="{{ route('map.show', $map->id) }}">Show Map</a>

                                                        <a style="background:#48cbfd ; color:white; margin:3px; padding:3px" class="btn  btn-action m-8" href="{{ route('map.edit', $map->id) }}">Edit Address</a>

                                                        <a style="background:#a4b5d3 ; color:white ; margin:3px;padding:3px" class="btn  btn-action m-8" href="{{ route('map.lookup', ['mapId'=>$map->id]) }}">Address Lookup</a>


                                                        @csrf
                                                        @method('DELETE')
                                                        <button style ="background:#88bdfe ; color:white; margin:3px; padding:3px" type="submit" onclick="return confirm('Are you sure?')" class="btn btn-action m-8">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div class="align-items-center" style="padding:50px 15px 15px 15px; margin:0 auto; text-align:center;">{!! $mapCollection->links() !!} </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('../resources/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('../resources/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ URL::asset('../resources/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('../resources/vendor/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('../resources/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script>
    $('.js-pscroll').each(function () {
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function () {
            ps.update();
        });
    });


</script>


@endsection