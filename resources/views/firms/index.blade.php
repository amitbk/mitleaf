@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="">
                    Firms
                    <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New</a>
                  </div>
                </div>

                <div class="card-body">
                    @include('helpers._flash')
                    {{$firms}}
                    @foreach($firms as $firm)
                      <h2>{{$firm->name}}</h2>
                      Created: {{$firm->users()->first()->name}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
