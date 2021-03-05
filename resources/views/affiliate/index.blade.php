@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">

              <div class="card">
                <div class="card-body shadow">
                  <div class="text-center">
                    <i class="fas fa-comments-dollar fa-4x"></i>
                    <h3 class="font-weight-bold my-2">Best 3 tier affiliate progarm - Start refering & Earn</h3>

                    <div>Share this link to reffer a new user</div>
                        @include('affiliate._affiliate_link', ['user' => $user]);
                    </div>



                  <hr>
                  <div class="text-center">
                    <div class="">
                      Your earning is
                    </div>
                    <h2><i class="fas fa-rupee-sign"></i>{{$user->wallet()}}</h2>
                  </div>
                </div>
              </div>

            </div>
          </div>



        </div>
    </div>
</div>
@endsection
