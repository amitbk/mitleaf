@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="">
                    Your Firm/Business
                    <a href="{{ route('firms.index')}}" class="btn btn-info btn-sm">Back</a>
                  </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('firms.store') }}" method="post">
                        @include ("firms._form", ['buttonText' => "Save"])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
