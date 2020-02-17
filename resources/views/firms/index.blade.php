@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('helpers._flash')
            <h2>Firms
                <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>

            @foreach($firms as $firm)
            <div class="card mb-2">
              <div class="card-body">
                  <h4>{{$firm->name}}</h4>
              </div>
            </div>
            @endforeach

            
        </div>
    </div>
</div>
@endsection
