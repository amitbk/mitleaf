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
                    <i class="fas fa-rupee-sign fa-5x"></i>
                    <h2 class="font-weight-bold my-2">Refer & Earn</h2>

                    <div>Use this code to refer friends</div>
                    <span class="fl_tag f-30">{{$user->id}}</span>
                  </div>
                  <hr>
                  <div class="">

                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
    </div>
</div>
@endsection
