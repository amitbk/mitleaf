@extends('layouts.app8')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="">
                    Templates
                    <a href="{{ route('templates.create')}}" class="btn btn-success btn-sm">Add New</a>
                  </div>
                </div>

                <div class="card-body">
                    @include('helpers._flash')
                    @foreach($templates as $template)
                      <h2>{{$template->name}}</h2>
                      <img src="{{$template->image->url}}" class="img-thumbnail">
                      <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
