<template>
    <div class="payment_capture__container">
        <slot></slot>
    </div>
</template>

<script>
require('../utils/razorpay.js');
export default {
  name: "PaymentCapture",
  props: ['order_id' ,'razorpay_order_id', 'amount', 'key', 'user', 'firm'],
  data() {
    return {
      paymentSuccess: null
    };
  },
  computed: {},
  mounted() {

    var options = {
      key: this.key,
      amount: this.amount, /// The amount is shown in currency subunits. Actual amount is ₹599.
      order_id: this.razorpay_order_id, // id of paymet intend on payment gateway
      notes: {
        order_id: this.order_id
      },
      name: this.firm.name,
      description: this.firm.description,
      currency: 'INR', // Optional. Same as the Order currency
      image: this.firm.logo_sq,
      handler:  (response) =>{
        this.callback(response);
      },
      prefill: {
          name: this.user.name,
          email: this.user.email,
          contact: this.user.contact,
      },
      notes: {
          address: "Hello World"
      },
      theme: {
          color: "#00ffff"
      }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
  },
  methods: {

    callback: function(response){
      axios.post('/payment_callback', response )
      .then((res)=>{
        console.log("PAYMENT RESPONSE",res)
        this.paymentSuccess = res.data.payment_success == true ? true : false;
      })
      .catch((err)=>{
        console.log('error');
        this.paymentSuccess = false;
      })
    }

  }, // methods
};
</script>

<style lang="css" scoped>
</style>
