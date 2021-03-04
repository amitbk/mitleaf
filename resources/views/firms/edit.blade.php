@extends('layouts.app')

@section('content')
<firm-create :firm_types="{{$firm_types}}" :firm-type-id="{{$firm->firm_type_id ?? '4'}}" inline-template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <!-- <h2 class="text-center">{{$firm->name}}</h2> -->
                <h3 class="text-center font-weight-bold">{{$firm->name}}</h3>
                <h4 class="text-center">Edit</h4>
                <div class="card shadow">


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
