<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{

    /** == create order
    * @return RazorpayOrder
    */
    public static function create_order($data)
    {

      // init api for razorpay
      $api = static::create_api();
      //
      // We create an razorpay order using orders api
      // Docs: https://docs.razorpay.com/docs/orders
      //
      $orderData = [
          'receipt'         => $data['receipt_id'],
          'amount'          => $data['amount'] * 100, // 2000 rupees in paise
          'currency'        => 'INR',
          'payment_capture' => 1 // auto capture
      ];

      $razorpayOrder = $api->order->create($orderData);

      $razorpayOrderId = $razorpayOrder['id'];
      session(['razorpay_order_id' => $razorpayOrderId]);
      return $razorpayOrder;
    }

    /** == create order
    * @return RazorpayOrder
    */
    public static function create_subscription()
    {

      // init api for razorpay
      $api = static::create_api();
      //
      // We create an razorpay order using orders api
      // Docs: https://docs.razorpay.com/docs/orders
      //
      // $orderData = [
      //     'receipt'         => 1,
      //     'amount'          => $data['amount'] * 100, // 2000 rupees in paise
      //     'currency'        => 'INR',
      //     'payment_capture' => 1 // auto capture
      // ];
      $start = strtotime(date("Y-m-d 00:00:00") . " + 1day");
      $subscription  = $api->subscription->create(
          array('plan_id' => 'plan_Gla3rjwMeEi9Zz', "quantity" => 28, 'customer_notify' => 1, 'total_count' => 12,
          // 'start_at' => $start 
          ));
      dd($subscription);
      $razorpayOrder = $api->order->create($orderData);

      $razorpayOrderId = $razorpayOrder['id'];
      session(['razorpay_order_id' => $razorpayOrderId]);
      dd($razorpayOrder);
    }

    /** Init razorpay api
    * @return Razorpay/Api
    */
    public static function create_api()
    {
      $keyId = env('RAZORPAY_KEY', null);
      $keySecret = env('RAZORPAY_SECRET', null);
      $api = new Api($keyId, $keySecret);
      return $api;
    }

    /** Verify Razorpay signature after order
    * @param Request
    * @return bool
    */
    public static function verify_signature(Request $request)
    {
      $is_verified = false;
      try
      {
          $attributes = array(
              'razorpay_order_id' => session('razorpay_order_id'),
              'razorpay_payment_id' => $request->razorpay_payment_id,
              'razorpay_signature' => $request->razorpay_signature
          );

          $api = static::create_api();
          $api->utility->verifyPaymentSignature($attributes);
          $is_verified = true;
      }
      catch(SignatureVerificationError $e)
      {
          $error = 'Razorpay Error : ' . $e->getMessage();
      }
      return $is_verified;
    }

    public static function getKey()
    {
      return env('RAZORPAY_KEY', null);
    }
}
