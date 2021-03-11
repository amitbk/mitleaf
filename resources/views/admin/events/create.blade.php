@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-7 col-lg-6">
            <h2 class="text-center">Create New Event</h2>
            <div class="card">


                <div class="card-body">
                   @include('helpers._flash')
                    <form action="{{ route('events.store') }}" method="post">
                        @csrf
                        @include ("admin.events._form", ['buttonText' => "Save"])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
