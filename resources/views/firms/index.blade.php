@extends('layouts.admin2')

@section('content')
<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 text-center d-flex border-bottom mb-3">
            <h3><i class="fas fa-briefcase"></i> {{ $pageTitle ?? 'Firms' }}           </h3>
            <div class="ml-auto">
              <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New Business</a>
            </div>
        </div>
        @include('helpers._flash')
    </div>
    <div class="row justify-content-center">
        @foreach($firms as $firm)
        <div class="col-md-4 justify-content-center mb-4">

            <div class="card">
                <div class="card-body">
                    <h4><a href="{{route('firms.show', $firm->id)}}" class="text-decoration-none">{{$firm->name}}</a></h4>
                    <div class="">
                      {{$firm->firm_type->name ?? ''}}
                    </div>
                    <small class="font-weight-bold text-success">Plan expiring on: {{$firm->date_expiry()}}</small>
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
