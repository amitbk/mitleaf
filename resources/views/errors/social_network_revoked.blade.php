@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">

          <div class="card p-3 text-center shadow my-5">
            <i class="fas fa-user-lock fa-5x text-secondary"></i>
            <h3 class="p-3">Permission denied!</h3>

            <a href="{{url('/')}}" class="btn btn-primary">Back to Home</a>
          </div>

        </div>

    </div>
</div>
@endsection
