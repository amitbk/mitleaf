@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 text-center">
            @include('helpers._flash')
            <h2>{{ $pageTitle ?? 'Firms' }}
                <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
            @foreach($firms as $firm)
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 justify-content-center">

            <div class="card">
                <div class="card-body">
                    <h4><a href="{{route('firms.show', $firm->id)}}" class="text-decoration-none">{{$firm->name}}</a></h4>
                    {{$firm->firm_type->name ?? ''}}
                </div>
                <div class="card-footer">
                    <a href="{{route('firms.edit',$firm->id)}}" class="btn btn-primary btn-sm">Edit Information</a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection
