@extends('layouts.app')

@section('content')
<plans-list :plans="{{ $plans }}" :firm_types="{{$firm_types}}" :firms="{{$firms}}" inline-template>
    <div class="container py-4">

        <div class="row mb-3">
            <div class="col-md-9 col-xs-12 text-center text-sm-left">
                <h3>Select a best plan for you</h3>
            </div>
            <div class="col-md-3 col-xs-12 text-center text-sm-right">
                <!-- firm select option -->
                <div class="form-group">
                  <select v-model="firm_id" class="form-control" id="firm">
                      <option v-for="firm in firms" :value="firm.id">Plan for @{{firm.name}}</option>
                  </select>
                </div>
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
                    <form class="" action="{{url('orders')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="plans" :value="JSON.stringify(localPlans.filter(el => el.is_selected))">
                        <input type="hidden" name="duration_selected" :value="duration_selected">
                        <input type="hidden" name="firm_id" :value="firm_id">
                        <button @click="formStep--" type="button" class="btn btn-default bg-light btn-sm">Back</button>
                        <button @click="submitForm()" type="submit" class="btn btn-default bg-light btn-sm">Done</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</plans-list>
@endsection
