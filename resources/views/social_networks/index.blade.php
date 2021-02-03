@extends('layouts.admin2')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">
              <div class="d-flex">
                <h3 class="font-weight-bold">Social Media Connections</h3>
                <a href="{{url('/facebook/connect_pages')}}" class="btn btn-outline-primary ml-auto font-weight-bold">Connect More Pages</a>
              </div>
              You have connected following social media profiles/pages/groups
              <hr>
              @include('helpers._flash')
              
              @foreach($user->social_networks as $social_network)
              <div class="card shadow mb-2">
                <div class="card-body">
                  <h4>{{$social_network->name}}</h4>
                </div>
              </div>
              @endforeach

            </div>
          </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
@endsection
