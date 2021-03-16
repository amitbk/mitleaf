@extends('layouts.admin')

@section('content')
<create-template inline-template>
    <div class="container-fluid py-4">
        <div class="row row-eq-height justify-content-center">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="col-md-12">
                <form action="{{ route('templates.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include ("templates._form", ['buttonText' => "Save"])
                </form>
            </div>
        </div>
    </div>
</create-template>
@endsection
