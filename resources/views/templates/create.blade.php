@extends('layouts.app8')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-12">
            <form action="{{ route('templates.store') }}" method="post">
                @csrf
                @include ("templates._form", ['buttonText' => "Save"])
            </form>
        </div>
    </div>
</div>
@endsection
