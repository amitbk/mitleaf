@extends('layouts.app')

@section('content')
<plans-list :plans="{{ $plans }}" :firm_types="{{$firm_types}}" inline-template>
    <div class="container py-4">

        <div class="row justify-content-center mb-3">
            <div class="col-md-8 text-center">
                <h3>Select best plans to continue</h3>
            </div>
        </div>
        <div v-if="formStep == 1" class="plans1_container">
            @include('plans._plans_list')
        </div>
        <div v-if="formStep == 2" class="plans2_container">
            @include('plans._plans2_list')
        </div>

        <div class="row fixed-bottom bg-primary p-1 text-white text-center">
            <div class="col final_amount">
                Total <span class="font-weight-bold">₹@{{totalPlanAmount}}</span>
            </div>
            <div class="col next_plan_changer ">
                <button v-if="formStep<2" @click="formStep++" type="button" class="btn btn-default bg-light btn-sm">Continue</button>
                <span v-if="formStep == 2">
                    <form class="" action="{{url('order')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="plans" :value="JSON.stringify(localPlans.filter(el => el.is_selected))">
                        <input type="hidden" name="duration_selected" :value="duration_selected">
                        <button @click="formStep--" type="button" class="btn btn-default bg-light btn-sm">Back</button>
                        <button @click="submitForm()" type="submit" class="btn btn-default bg-light btn-sm">Done</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</plans-list>
@endsection
