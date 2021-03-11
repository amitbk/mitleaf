@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="text-center font-weight-bold">{{$event->name}}</h3>
            <h4 class="text-center">Edit</h4>
            <div class="card">


                <div class="card-body">
                   @include('helpers._flash')
                    <form action="{{ route('events.update', $event->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        @include ("admin.events._form", ['buttonText' => "Update"])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
