@extends('layouts.app')

@section('content')
<firm-create :firm_types="{{$firm_types}}" :firm_type_id="{{$firm->firm_type_id ?? '2' }}" inline-template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6">
                <h2 class="text-center">Tell us about your business</h2>
                <div class="card">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('firms.store') }}" method="post">
                            @csrf
                            @include ("firms._form", ['buttonText' => "Save"])
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</firm-create>
@endsection
