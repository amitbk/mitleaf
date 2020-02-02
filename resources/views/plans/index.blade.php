@extends('layouts.app')

@section('content')
<plans-list :plans="{{ $plans }}" inline-template>
    <div class="container">

        <div class="row justify-content-center mb-3">
            <div class="col-md-8 text-center">
                <h3>Select best plans to continue</h3>
            </div>
        </div>
        @include('plans._plan_list')
    </div>
</plans-list>
@endsection
