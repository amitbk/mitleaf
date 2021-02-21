@extends('layouts.admin2')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">

              <div class="card">
                <div class="card-body shadow">
                  <div class="text-center">
                    <i class="fas fa-user-circle fa-5x"></i>
                    <h2 class="font-weight-bold my-2">{{$user->name}}</h2>

                    @if($user->referrer)
                      <span class="fl_tag">You are refered by : {{$user->referrer->name ?? ''}}</span>
                    @endif
                  </div>
                  <hr>
                  <div class="">
                    <div class="font-weight-bold">
                      Email
                    </div>
                    <div class="mb-2">
                      {{$user->email}}
                    </div>

                    <div class="font-weight-bold">
                      Mobile
                    </div>
                    <div class="mb-2">
                      {{$user->mobile}}
                    </div>

                    <div class="font-weight-bold">
                      Businesses registered
                    </div>
                    <div class="mb-2">
                      {{$user->firms->count()}}
                    </div>

                    <div class="font-weight-bold">
                      Account creation date
                    </div>
                    <div class="mb-2">
                      {{$user->created_at}}
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
    </div>
</div>
@endsection
