@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => $firm->name, 'logo' => $firm->logo() ] )

    <div class="row justify-content-center">
        <div class="col-md-9 col-xs-12 mt-3">
            @include('helpers._flash')

            <div class="row">
                <div class="col-md-6 mb-5">

                    @foreach ($frames as $frame)
                        @include('firms._frame_view')                        
                    @endforeach

                    {{$frames->links()}}
                </div>

                <div class="col-md-4">
                    <div class="card my-2">
                        Hello
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
