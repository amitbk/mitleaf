@extends('layouts.app')

@section('content')
<payment-capture :razorpay_order_id="{{json_encode($razorpay_order_id)}}"
                 :amount="{{json_encode($amount)}}"
                 :order_id="{{json_encode($order_id)}}"
                 :key="{{json_encode($key)}}"
                 :user="{{json_encode($user)}}"
                 :firm="{{json_encode($firm)}}"
                 inline-template>

<div class="container">
    <div class="row justify-content-center">

        <div v-if="paymentSuccess == true" class="col-md-12 text-center" >
          <div class="container">
              <div class="row justify-content-center">
                <div class="col-5">
                  <div class="card">
                    <div class="card-body text-center">

                      <i class="fa fa-check-circle fa-5x text-success p-3"></i>
                      <h2 class="font-weight-bold">Your order has been placed.</h2>
                      <h3>Thank you for your order.</h3>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div v-else-if="paymentSuccess == false" class="col-md-12 text-center">
          <div class="card">
            <div class="card-body">
              <h2>Payment Failed.</h2>
            </div>
          </div>
        </div>

        <div v-else class="col-md-12 text-center">
          <div class="card">
            <div class="card-body">
              <h2>Please wait, Proessing payment...</h2>
            </div>
          </div>
        </div>

    </div>
</div>
</payment-capture>
@endsection
