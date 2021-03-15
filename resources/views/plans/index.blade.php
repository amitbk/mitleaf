@extends('layouts.app')

@section('content')
<plans-list :plans="{{ $plans }}" :firm_types="{{$firm_types}}" :firms="{{$firms}}" :firm-id="{{ $firmId }}"
            :future-plans="{{ json_encode(!!$firm ? $firm->future_plans() : null ) }}" :year-discount="{{$yearDiscount}}" inline-template>

    <div class="container py-4">

        <div class="row mb-3">
            <div class="col-12">
              @include('helpers._flash')
            </div>
            <div class="col-md-9 col-xs-12 text-center text-sm-left">
                <h4 class="font-weight-bold">Select a best plan for you</h4>
            </div>

            <div class="col-md-3 col-xs-12 text-center text-sm-right">
                <!-- firm select option -->
                <div class="form-group">
                  <select v-model="firm_id" class="form-control" id="firm">
                      <option v-for="firm in firms" :value="firm.id">Plan for @{{firm.name}}</option>
                  </select>
                </div>
            </div>

            @if(!$user->is_trial_used && 0)
            <div class="col-12">
              <div class="alert alert-primary">
                <strong>Hurrey!</strong> All plans are free for first 7 days!
              </div>
            </div>
            @endif
        </div>

        <div class="row mb-3">

          <!-- show month, year switch only if purchasing actual plan & not for trial -->
          <div v-if="false" class="col-12 col-sm-12 mb-2 text-center m-auto">
            <div>Select Billing Cycle</div>
            <ul class="nav nav-pills font-weight-bold nav-justified billing-cycle">
              @if(!$user->is_trial_used && 0)
              <li class="nav-item p-1" @click="changeDuration(0)">
                <a class="nav-link py-3 border" :class="{active: duration_selected == 0 }" data-toggle="pill" href="#month">Trial</a>
              </li>
              @endif
              <li class="nav-item p-1" @click="changeDuration(1)">
                <a class="nav-link py-2 border" :class="{active: duration_selected == 1 }" data-toggle="pill" href="#month">
                  <div class="f-20">
                    1 Month
                    <div class="f-12">
                      (0% OFF)
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item p-1" @click="changeDuration(3)">
                <a class="nav-link py-2 border" :class="{active: duration_selected == 3 }" data-toggle="pill" href="#month">
                  <div class="f-20">
                    3 Months
                    <div class="f-12">
                      (0% OFF)
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item p-1" @click="changeDuration(12)">
                <a class="nav-link py-2 border" :class="{active: duration_selected == 12 }" data-toggle="pill" href="#year">
                  <div class="f-20">
                    1 Year
                  </div>
                  <div class="f-12">
                    (@{{yearDiscount}}% OFF)
                  </div>
                </a>
              </li>
            </ul>
            <hr>
          </div>

          <div class="col-12">
            <!-- Create | Publish -->
            <ul v-if="formStep != 3" class="nav nav-tabs mb-2 justify-content-center font-weight-bold">
              <li class="nav-item" @click="formStep = 1">
                <a class="nav-link" :class="{ active: formStep == 1 }" data-toggle="tab" href="#home">Create</a>
              </li>
              <li class="nav-item" @click="formStep = 2">
                <a class="nav-link" :class="{ active: formStep == 2 }" data-toggle="tab" href="#menu1">Publish</a>
              </li>
            </ul>

            <!-- Plans list -->
            <div v-if="formStep == 1" class="plans1_container">
              @include('plans._plans_list')
            </div>
            <div v-if="formStep == 2" class="plans2_container">
              @include('plans._plans2_list')
            </div>
            <div v-if="formStep == 3" class="plans2_container">
              @include('plans._plans_option')
            </div>
          </div>
        </div>

        <div v-if="formStep<3" class="row fixed-bottom bg_cyan1 p-1 text-white text-center p-2">
            <div class="col d-flex justify-content-end final_amount">
                <div class="px-2 d-flex align-items-center">Total</div>
                <div class="font-weight-bold f-20">₹ @{{monthlyPlanAmount}}/month</div>

                @if(!$user->is_trial_used && 0)
                After 7 days
                @endif
            </div>
            <div class="col d-flex next_plan_changer ">
                <div class="mx-1">
                  <button v-if="formStep == 2 || formStep == 3" @click="formStep--" type="button" class="btn btn-default bg-light btn-sm">Back</button>
                </div>
                <div class="mx-1">
                  <button v-if="formStep<3" @click="formStep++" type="button" class="btn btn-default bg-light btn-sm">Continue</button>
                </div>


                <span v-if="formStep == 3">
                    <form class="" action="{{url('orders')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="plans" :value="JSON.stringify(localPlans.filter(el => el.is_selected))">
                        <input type="hidden" name="duration_selected" :value="duration_selected">
                        <input type="hidden" name="firm_id" :value="firm_id">
                        <button @click="submitForm()" type="submit" class="btn btn-default bg-light btn-sm">Done</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</plans-list>
@endsection
