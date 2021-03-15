<div class="row justify-content-center">

    <div class="col-12 text-center">
      <h4>Select Payment Option</h4>
    </div>

    <div class="col-md-6 mb-3">
      <div class="border text-center p-3 m-1 cursor_pointer" :class="{'fl_bg1': paymentOption == 'subscription' }" @click="paymentOption = 'subscription', duration_selected = -1 ">
        <h3> Monthly Subscription</h3>
        (Credit Card Required)
        <br>
        Invest ₹ @{{monthlyPlanAmount}}/month
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="border text-center p-3 m-1 cursor_pointer" :class="{'fl_bg1': paymentOption == 'onetime' }" @click="paymentOption = 'onetime', duration_selected = 3 ">
        <h3> One Time Payment</h3>
        (Debit Card, Credit Card, UPI Payments,<br>Netbanking & Online Wallets can be used)
      </div>
    </div>

    <div class="col-12">

      <div v-if="paymentOption == 'onetime'" class="row justify-content-center">
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <select v-model="duration_selected" class="form-control" id="sel1">
              <option value='1'>Invest ₹ @{{monthlyPlanAmount}} for 1 Month (0% OFF)</option>
              <option value='3'>Invest ₹ @{{monthlyPlanAmount*3}} for 3 Months (0% OFF)</option>
              <option value='12'>Invest ₹ @{{yearlyPlanAmount}} for 1 Year (@{{yearDiscount}}% OFF) </option>
            </select>
            </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6 mb-3 d-flex justify-content-center">

          <div class="">
            <button @click="formStep--" type="button" class="btn btn-default btn-lg">Back</button>
          </div>
          <div class="mx-2">
            <form class="" action="{{url('orders')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="plans" :value="JSON.stringify(localPlans.filter(el => el.is_selected))">
                <input type="hidden" name="duration_selected" :value="duration_selected">
                <input type="hidden" name="firm_id" :value="firm_id">
                <button @click="submitForm()" type="submit" class="btn btn-success btn-lg">Checkout Now</button>
            </form>

          </div>
        </div>
      </div>
    </div>


</div>
