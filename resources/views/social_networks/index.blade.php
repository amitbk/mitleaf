@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-8 col-lg-6">

          @include('social_networks.connect_firm_to_page')
          <hr>
        </div>
        <div class="col-12 col-sm-6 col-md-12 col-lg-6 mb-4">

          <div class="row">
            <div class="col-sm-12">
              <div class="d-flex">
                <h3 class="font-weight-bold">Social Media Connections</h3>
                <a href="{{url('/facebook/connect_pages')}}" class="btn btn-outline-primary ml-auto font-weight-bold">Connect New Pages</a>
              </div>
              You have connected {{$user->social_networks->count()}} social media profiles/pages/groups
              <hr>
              @include('helpers._flash')


              <hr>
              @forelse($user->social_networks as $social_network)
              <div class="card shadow mb-2">
                <div class="card-body">
                  <h4>{{$social_network->name}}</h4>
                </div>
              </div>
              @empty
                You haven't connected social networks yet.
              @endforelse

            </div>
          </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
@endsection
