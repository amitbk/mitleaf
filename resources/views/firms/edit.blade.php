@extends('layouts.app')

@section('content')
<firm-create :firm_types="{{$firm_types}}" :firm_type_id="{{$firm->firm_type_id}}" inline-template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center">{{$firm->name}}</h2>
                <div class="card">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('firms.update', $firm->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            @include ("firms._form", ['buttonText' => "Update"])
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</firm-create>
@endsection