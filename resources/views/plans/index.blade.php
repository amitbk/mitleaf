@extends('layouts.app')

@section('content')
<plans-list :plans="{{ $plans }}" :firm_types="{{$firm_types}}" inline-template>
    <div class="container">

        <div class="row justify-content-center mb-3">
            <div class="col-md-8 text-center">
                <h3>Select best plans to continue</h3>
            </div>
        </div>
        @include('plans._plan_list')

        <div class="fixed-bottom bg-primary p-1 text-white text-center">
            Total: @{{totalPlanAmount}}
        </div>
    </div>
</plans-list>
@endsection
