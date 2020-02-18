@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xs-12">
            @include('helpers._flash')


            <div class="text-center">
                <h3>{{$firm->name}}</h3>
            </div>



            <div class="row mt-1">
                <div class="col-xs-12 col-sm-6 p-1">
                    <div class="shadow h-100 p-1 bg-white text-center border border-gray rounded">
                        <div class="">
                            Logo
                        </div>

                        @if($firm->logo())
                            <img class="img-fluid p-2" src="{{url( $firm->logo() )}}" alt="">
                            <div class="">
                                <a href="{{url('firms/'.$firm->id.'/edit_details')}}" class="btn btn-primary">Change</a>
                            </div>
                        @else
                            <img class="img-fluid p-2" src="{{url('images/no_image.png')}}" alt="">
                            <div class="">
                                <a href="{{url('firms/'.$firm->id.'/edit_details')}}" class="btn btn-primary">Add New</a>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 p-1">
                    <div class="shadow h-100 p-1 bg-white text-center border border-gray rounded">
                        <div class="">
                            Strip
                        </div>

                        @if($firm->strip())
                            <img class="img-fluid p-2" src="{{url( $firm->strip() )}}" alt="">
                            <div class="">
                                <a href="{{url('firms/'.$firm->id.'/edit_details2')}}" class="btn btn-primary">Change</a>
                            </div>
                        @else
                            <img class="img-fluid p-2" src="{{url('images/no_image.png')}}" alt="">
                            <div class="">
                                <a href="{{url('firms/'.$firm->id.'/edit_details2')}}" class="btn btn-primary">Add New</a>
                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
