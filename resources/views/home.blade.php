@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">
              <posts :firms="{{ json_encode( $user->firms ) }}"/>
            </div>
          </div>

        </div>
        <!-- <div class="col-md-4">

        </div> -->
    </div>
</div>
@endsection
