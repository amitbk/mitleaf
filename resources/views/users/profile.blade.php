@extends('layouts.admin2')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">
              <h2>Welcome {{$user->name}}</h2>

              <span class="fl_tag">You are refered by : {{$user->referrer->name}}</span>
            </div>
          </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
@endsection