@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('helpers._flash')
            <h2>Firms
                <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>

            <div class="row">
                @foreach($firms as $firm)
                <div class="col-sm-6 mb-4">
                    <div class="card p-3 text-center">

                        <h4><a href="{{route('firms.show', $firm->id)}}" class="stretched-link text-decoration-none">{{$firm->name}}</a></h4>
                    </div>
                </div>
                @endforeach
            </div>


        </div>
    </div>
</div>
@endsection
